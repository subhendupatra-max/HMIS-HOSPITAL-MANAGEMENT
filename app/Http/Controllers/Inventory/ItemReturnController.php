<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryReturnItem;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Inventory\InventoryReturnItemDetails;
use App\Models\ItemStoreRoom;
use Auth;
use DB;

class ItemReturnController extends Controller
{
    public function index()
    {

        // $workshops = ItemStoreRoom::select('workshops.id', 'workshops.name')->where('is_active', '1')->get();

        $return_list = InventoryReturnItem::where('is_delete' , '0')->orderBy('inventory_return_items.id', 'DESC')->get();
        // dd($return_list);
        return view('Inventory.return.item-return-list', compact('return_list'));
    }
    public function create_return()
    {
        $return_list = InventoryPurchaseOrder::select('inventory_purchase_orders.id as po_id', 'inventory_purchase_orders.po_prefix')->where('inventory_purchase_orders.status', '>=', '17')->where('inventory_purchase_orders.grm_status', '!=', '1')
            ->get();

        return view('Inventory.return.create-item-return', compact('return_list'));
    }

    public function get_po_item_details_return($po_id)
    {
        // dd($po_id);
        $po_list = InventoryPurchaseOrder::join('users', 'users.id', '=', 'inventory_purchase_orders.generated_by')
            ->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_purchase_orders.stock_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'inventory_purchase_orders.status')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_purchase_orders.vendor')

            ->select('inventory_vendors.vendor_name', 'inventory_purchase_orders.feedback', 'inventory_purchase_orders.expected_delivery_date', 'item_store_rooms.id as workshop_id_no', 'users.first_name', 'users.last_name', 'inventory_purchase_orders.id as po_id', 'item_store_rooms.item_store_room as workshop_name', 'inventory_purchase_orders.po_date', 'inventory_purchase_orders.status as po_status', 'working_statuses.status', 'inventory_purchase_orders.po_prefix', 'inventory_purchase_orders.total', 'inventory_purchase_orders.extra_charges_name', 'inventory_purchase_orders.extra_charges_value', 'inventory_purchase_orders.grand_total', 'inventory_vendors.id as vendor_id_no', 'inventory_purchase_orders.note')
            ->where('inventory_purchase_orders.is_delete', 0)
            ->where('inventory_purchase_orders.id', $po_id)
            ->first();

        // dd( $po_list );
        $po_item = InventoryPurchaseOrderDetail::join('items', 'items.id', '=', 'inventory_purchase_order_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_purchase_order_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_purchase_order_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_purchase_order_details.unit_id')
            ->select('inventory_purchase_order_details.id as inventory_purchase_order_details_id', 'inventory_purchase_order_details.req_id', 'inventory_purchase_order_details.gst', 'inventory_purchase_order_details.quantity', 'inventory_purchase_order_details.grm_qty', 'inventory_purchase_order_details.rate', 'inventory_purchase_order_details.amount', 'inventory_purchase_order_details.req_id', 'item_brands.item_brand_name', 'item_brands.id as item_brands_id', 'manufactures.id as manufacturer_id', 'items.id as item_id', 'manufactures.manufacture_name', 'item_units.units', 'item_units.id as unit_id', 'inventory_purchase_order_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_purchase_order_details.purchase_order_id', $po_id)
            ->where(
                function ($query) {
                    return $query
                        ->orwhere('inventory_purchase_order_details.grm_status', '=', '0')
                        ->orwhere('inventory_purchase_order_details.quantity', '=', 'inventory_purchase_order_details.grm_qty');
                }
            )
            ->get();
        // dd($po_item);

        return response()->json(array('po_list' => $po_list, 'po_item' => $po_item));
    }

    public function save_return(Request $req)
    {
        $po_id = $req->po_no;
        $validator = $req->validate([
            'material_rec_date' => 'required',
            'rejection_date' => 'required',
        ]);
        $rejection_prefix = DB::table('prefixes')->where('name', '=', 'rejection_slip')->first();

        $item_return  = new InventoryReturnItem();
        $item_return->return_prefix = $rejection_prefix->prefix;
        $item_return->po_no =  $po_id;
        $item_return->workshop_id = $req->workshop_id;
        $item_return->vendor = $req->vendor;
        $item_return->rejection_date = date('Y-m-d h:i');
        $item_return->material_rec_date = $req->material_rec_date;
        $item_return->bill_rec_date = $req->bill_rec_date;
        $item_return->challan_no = $req->challan_no;
        $item_return->challan_date = $req->challan_date;
        $item_return->invoice_no = $req->invoice_no;
        $item_return->invoice_date = $req->invoice_date;
        $item_return->invoice_value = $req->invoice_value;
        $item_return->po_value = $req->po_value;
        $item_return->purpose = $req->purpose;
        $item_return->note = $req->note;
        $item_return->status = 1;
        $item_return->generated_by = Auth::id();
        $item_return->is_delete = 0;
        $item_return->save();
        $return_id = $item_return->id;

        $po_details_id = $req->po_details_id;
        // dd( $po_details_id);

        foreach ($req->item as $key => $items) {
            $details = InventoryPurchaseOrderDetail::where('id', $po_details_id[$key])->first();
            // dd($details);
            $qt = $details->grm_qty + $req->qty[$key];

            $return_details = new InventoryReturnItemDetails();
            $return_details->return_id                  = $return_id;
            $return_details->req_id                     = $req->req[$key];
            $return_details->item_id                    = $req->item[$key];
            $return_details->brand_id                    = $req->brand[$key];
            $return_details->manufacturer_id            = $req->manufacturer[$key];
            $return_details->unit_id                    = $req->unit[$key];
            $return_details->quantity                   = $req->qty[$key];
            $return_details->gst                        = $req->gst[$key];
            $return_details->rate                       = $req->rate[$key];
            $return_details->amount                       = $req->amount[$key];
            $return_details->save();

            $return_details_id = $return_details->id;
            InventoryPurchaseOrderDetail::where('id', $req->po_details_id[$key])->update(['return_item' => $qt]);
        }

        if ($return_details_id != null) {
            return redirect()->route('grm-list-inven')->with('success', "Rejection Slip genereted Sucessfully");
        } else {
            return redirect()->route('grm-list-inven')->with('error', "Something Went Wrong");
        }
    }


    public function return_details($id)
    {
        $rejection_id = base64_decode($id);
        // dd( $rejection_id);
        $rejection_list = InventoryReturnItem::join('users', 'users.id', '=', 'inventory_return_items.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_return_items.workshop_id')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_return_items.vendor')
            ->select('item_store_rooms.item_store_room as workshop_name', 'inventory_return_items.rejection_date', 'inventory_return_items.id as return_id', 'inventory_return_items.return_prefix', 'inventory_vendors.vendor_name', 'inventory_return_items.material_rec_date', 'inventory_return_items.bill_rec_date', 'inventory_return_items.challan_no', 'inventory_return_items.challan_copy', 'inventory_return_items.challan_date', 'inventory_return_items.invoice_copy', 'inventory_return_items.invoice_no', 'inventory_return_items.invoice_date', 'inventory_return_items.invoice_value', 'inventory_return_items.po_value', 'inventory_return_items.note', 'users.first_name',  'users.last_name', 'inventory_return_items.po_no')
            ->where('inventory_return_items.is_delete', 0)
            ->where('inventory_return_items.id', $rejection_id)
            ->first();

        $rejection_item = InventoryReturnItemDetails::join('items', 'items.id', '=', 'inventory_return_item_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_return_item_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_return_item_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_return_item_details.unit_id')
            ->select('inventory_return_item_details.gst', 'inventory_return_item_details.quantity', 'inventory_return_item_details.rate', 'inventory_return_item_details.amount', 'inventory_return_item_details.req_id', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'item_units.units', 'inventory_return_item_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_return_item_details.return_id', $rejection_id)
            ->get();
        // dd($rejection_item);
        return view('Inventory.return.return-details', compact('rejection_item', 'rejection_list'));
    }

    public function edit_Return($id)
    {
        $rejection_id = base64_decode($id);
        $rejection_list = InventoryReturnItem::join('users', 'users.id', '=', 'inventory_return_items.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_return_items.workshop_id')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_return_items.vendor')
            ->select('item_store_rooms.item_store_room as workshop_name', 'inventory_return_items.rejection_date', 'inventory_return_items.id as return_id', 'inventory_return_items.return_prefix', 'inventory_vendors.vendor_name', 'inventory_return_items.material_rec_date', 'inventory_return_items.bill_rec_date', 'inventory_return_items.challan_no', 'inventory_return_items.challan_copy', 'inventory_return_items.challan_date', 'inventory_return_items.invoice_copy', 'inventory_return_items.invoice_no', 'inventory_return_items.invoice_date', 'inventory_return_items.invoice_value', 'inventory_return_items.po_value', 'inventory_return_items.note', 'users.first_name',  'users.last_name', 'inventory_return_items.po_no')
            ->where('inventory_return_items.is_delete', 0)
            ->where('inventory_return_items.id', $rejection_id)
            ->first();

        $rejection_item = InventoryReturnItemDetails::join('items', 'items.id', '=', 'inventory_return_item_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_return_item_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_return_item_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_return_item_details.unit_id')
            ->select('inventory_return_item_details.id as return_setails_id', 'inventory_return_item_details.gst', 'inventory_return_item_details.quantity', 'inventory_return_item_details.rate', 'inventory_return_item_details.amount', 'inventory_return_item_details.req_id', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'item_units.units', 'inventory_return_item_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_return_item_details.return_id', $rejection_id)
            ->get();


        $po_details = InventoryPurchaseOrder::join('users', 'users.id', '=', 'inventory_purchase_orders.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_purchase_orders.stock_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'inventory_purchase_orders.status')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_purchase_orders.vendor')
            ->select('inventory_vendors.vendor_name', 'inventory_purchase_orders.feedback', 'inventory_purchase_orders.expected_delivery_date', 'item_store_rooms.id as workshop_id_no', 'users.first_name', 'users.last_name', 'inventory_purchase_orders.id as po_id', 'item_store_rooms.item_store_room as workshop_name', 'inventory_purchase_orders.po_date', 'inventory_purchase_orders.status as po_status', 'working_statuses.status', 'inventory_purchase_orders.po_prefix', 'inventory_purchase_orders.total', 'inventory_purchase_orders.extra_charges_name', 'inventory_purchase_orders.extra_charges_value', 'inventory_purchase_orders.grand_total', 'inventory_vendors.id as vendor_id_no', 'inventory_purchase_orders.note')
            ->where('inventory_purchase_orders.is_delete', 0)
            ->where('inventory_purchase_orders.id', $rejection_list->po_no)
            ->first();

        $po_list =  InventoryPurchaseOrder::select('inventory_purchase_orders.id as po_id', 'inventory_purchase_orders.po_prefix')->where('inventory_purchase_orders.status', '>=', '17')->where('inventory_purchase_orders.id', '=', $rejection_list->po_no)->where('inventory_purchase_orders.grm_status', '!=', '1')->first();

        // dd($po_list);

        return view('Inventory.return.edit-return', compact('rejection_item', 'rejection_list', 'po_list', 'po_details'));
    }

    public function get_po_item_details($po_id)
    {
        // dd($po_id);
        $po_list = InventoryPurchaseOrder::join('users', 'users.id', '=', 'inventory_purchase_orders.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_purchase_orders.stock_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'inventory_purchase_orders.status')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_purchase_orders.vendor')
            ->select('inventory_vendors.vendor_name', 'inventory_purchase_orders.feedback', 'inventory_purchase_orders.expected_delivery_date', 'item_store_rooms.id as workshop_id_no', 'users.first_name', 'users.last_name', 'inventory_purchase_orders.id as po_id', 'item_store_rooms.item_store_room as workshop_name', 'inventory_purchase_orders.po_date', 'inventory_purchase_orders.status as po_status', 'working_statuses.status', 'inventory_purchase_orders.po_prefix', 'inventory_purchase_orders.total', 'inventory_purchase_orders.extra_charges_name', 'inventory_purchase_orders.extra_charges_value', 'inventory_purchase_orders.grand_total', 'inventory_vendors.id as vendor_id_no', 'inventory_purchase_orders.note')
            ->where('inventory_purchase_orders.is_delete', 0)
            ->where('inventory_purchase_orders.id', $po_id)
            ->first();

        // dd($po_list);

        $po_item = InventoryPurchaseOrderDetail::join('items', 'items.id', '=', 'inventory_purchase_order_details.item_id')
            ->join('brands', 'brands.id', '=', 'inventory_purchase_order_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_purchase_order_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_purchase_order_details.unit_id')
            ->select('inventory_purchase_order_details.id as purchase_order_details_id', 'inventory_purchase_order_details.req_id', 'inventory_purchase_order_details.gst', 'inventory_purchase_order_details.quantity', 'inventory_purchase_order_details.grm_qty', 'inventory_purchase_order_details.rate', 'inventory_purchase_order_details.amount', 'inventory_purchase_order_details.req_id', 'brands.item_brand_name', 'brands.id as brands_id', 'manufactures.id as manufacturer_id', 'items.id as item_id', 'manufactures.manufacture_name', 'item_units.units', 'item_units.id as unit_id', 'inventory_purchase_order_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_purchase_order_details.purchase_order_id', $po_id)
            ->where(
                function ($query) {
                    return $query
                        ->orwhere('inventory_purchase_order_details.grm_status', '=', '0')
                        ->orwhere('inventory_purchase_order_details.quantity', '=', 'inventory_purchase_order_details.grm_qty');
                }
            )
            ->get();

        return response()->json(array('po_list' => $po_list, 'po_item' => $po_item));
    }

    public function update_return(Request $req)
    {
        $validator = $req->validate([
            'material_rec_date' => 'required',
            'rejection_date' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $po_id = $req->po_no;
            $rejection_prefix = DB::table('prefixes')->where('name', '=', 'rejection_slip')->first();

            $item_id = $req->post('item');
            $qty = $req->post('qty');

            $po_details_id = $req->post('po_details_id');
            $return_details_id = $req->post('return_details_id');

            $item_return  =  InventoryReturnItem::where('id', $req->return_id)->first();
            $item_return->workshop_id = $req->workshop_id;
            $item_return->vendor = $req->vendor;
            $item_return->rejection_date = date('Y-m-d h:i');
            $item_return->material_rec_date = $req->material_rec_date;
            $item_return->bill_rec_date = $req->bill_rec_date;
            $item_return->challan_no = $req->challan_no;
            $item_return->challan_date = $req->challan_date;
            $item_return->invoice_no = $req->invoice_no;
            $item_return->invoice_date = $req->invoice_date;
            $item_return->invoice_value = $req->invoice_value;
            $item_return->po_value = $req->po_value;
            $item_return->purpose = $req->purpose;
            $item_return->note = $req->note;
            $item_return->save();

            $no_of_item = count($item_id);

            for ($i = 0; $i < $no_of_item; $i++) {
                $return_details = array(
                    'quantity' => $qty[$i],
                );

                $return_details_id = InventoryReturnItemDetails::where('id', $return_details_id[$i])->update($return_details);

                InventoryPurchaseOrderDetail::where('id', $po_details_id[$i])->update(['return_item' => $qty[$i]]);
            }

            DB::commit();
            if ($return_details_id != null) {
                return redirect()->route('return-list-inventory')->with('success', "Rejection Slip genereted Sucessfully");
            } else {
                return redirect()->route('return-list-inventory')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return redirect()->route('return-list-inventory')->with('error', "Something Went Wrong");
        }
    }

    public function return_delete($id)
    {
        $return_id = base64_decode($id);
        $res = InventoryReturnItem::where('id', $return_id)->update(['is_delete' => '1']);
        if ($res != null) {
            return redirect()->route('return-list-inventory')->with('success', "Rejection Slip Deleted Sucessfully");
        } else {
            return redirect()->route('return-list-inventory')->with('error', "Something Went Wrong");
        }
    }
}
