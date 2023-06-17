<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryGRN;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Inventory\InventoryRequisition;
use App\Models\Inventory\InventoryRequisitionDetail;
use App\Models\Inventory\InventoryGRNDetail;
use App\Models\ItemUnit;
use App\Models\Inventory\InventoryItemStock;
use DB;
use Auth;

class ItemGRMController extends Controller
{

    public function index()
    {
        $grm_list = InventoryGRN::where('is_delete', '0')
            ->orderBy('inventory_g_r_n_s.id', 'DESC')
            ->get();

        return view('Inventory.grn.grn-lisiting-inventory', compact('grm_list'));
    }

    public function create_grm()
    {
        $po_list = InventoryPurchaseOrder::select('inventory_purchase_orders.id as po_id', 'inventory_purchase_orders.po_prefix')->where('inventory_purchase_orders.status', '>=', '17')->where('inventory_purchase_orders.grm_status', '!=', '1')
            ->get();

        // dd($po_list);

        return view('Inventory.grn.create-grn-inventory', compact('po_list'));
    }

    public function get_po_item_details($po_id)
    {
        $po_list = InventoryPurchaseOrder::join('users', 'users.id', '=', 'inventory_purchase_orders.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_purchase_orders.stock_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'inventory_purchase_orders.status')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_purchase_orders.vendor')
            ->select('inventory_vendors.vendor_name', 'inventory_purchase_orders.feedback', 'inventory_purchase_orders.expected_delivery_date', 'item_store_rooms.id as workshop_id_no', 'users.first_name', 'users.last_name', 'inventory_purchase_orders.id as po_id', 'item_store_rooms.item_store_room as workshop_name', 'inventory_purchase_orders.po_date', 'inventory_purchase_orders.status as po_status', 'working_statuses.status', 'inventory_purchase_orders.po_prefix', 'inventory_purchase_orders.total', 'inventory_purchase_orders.extra_charges_name', 'inventory_purchase_orders.extra_charges_value', 'inventory_purchase_orders.grand_total', 'inventory_vendors.id as vendor_id_no', 'inventory_purchase_orders.note')
            ->where('inventory_purchase_orders.is_delete', 0)
            ->where('inventory_purchase_orders.id', $po_id)
            ->first();

        $po_item = InventoryPurchaseOrderDetail::join('items', 'items.id', '=', 'inventory_purchase_order_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_purchase_order_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_purchase_order_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_purchase_order_details.unit_id')
            ->select('inventory_purchase_order_details.id as purchase_order_details_id', 'inventory_purchase_order_details.req_id', 'inventory_purchase_order_details.gst', 'inventory_purchase_order_details.quantity', 'inventory_purchase_order_details.grm_qty', 'inventory_purchase_order_details.rate', 'inventory_purchase_order_details.amount', 'inventory_purchase_order_details.req_id', 'item_brands.item_brand_name', 'item_brands.id as brands_id', 'manufactures.id as manufacturer_id', 'items.id as item_id', 'manufactures.manufacture_name', 'item_units.units', 'item_units.id as unit_id', 'inventory_purchase_order_details.quantity', 'items.item_name', 'items.item_description')
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
    public function save_grm(Request $req)
    {
        $po_id = $req->po_no;

        $validator = $req->validate([
            'material_rec_date' => 'required',
        ]);

        $grm_prefix = DB::table('prefixes')->where('name', '=', 'grn')->first();
        $challan_copy = '';
        $invoice_copy = '';

        if ($req->hasfile('challan_copy')) {
            $file = $req->file('challan_copy');
            $challan_copy = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("inventory-challan_copy/", $challan_copy);
        }

        if ($req->hasfile('invoice_copy')) {
            $file = $req->file('invoice_copy');
            $invoice_copy = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("inventory-challan_copy/invoice_copy/", $invoice_copy);
        }


        $grm_details = new InventoryGRN();
        $grm_details->grm_prefix    = $grm_prefix->prefix;
        $grm_details->po_no         = $req->po_no;
        $grm_details->workshop_id   =  $req->workshop_id;
        $grm_details->vendor        =  $req->vendor;
        $grm_details->grm_date      =  date('Y-m-d h:i');
        $grm_details->material_rec_date   =  $req->material_rec_date;
        $grm_details->bill_rec_date   =  $req->bill_rec_date;
        $grm_details->challan_no   =  $req->challan_no;
        $grm_details->challan_copy   =  $challan_copy;
        $grm_details->challan_date   =  $req->challan_date;
        $grm_details->invoice_no   =  $req->invoice_no;
        $grm_details->invoice_copy   =  $invoice_copy;
        $grm_details->invoice_date   =  $req->invoice_date;
        $grm_details->invoice_value   =  $req->invoice_value;
        $grm_details->po_value   =  $req->po_value;
        $grm_details->purpose   =  $req->purpose;
        $grm_details->purpose_grm   =  '';
        $grm_details->note   =  $req->note;
        $grm_details->status   =  1;
        $grm_details->stock_update_status   =  '0';
        $grm_details->generated_by   =   Auth::id();
        $grm_details->is_delete   =  0;
        $grm_details->save();

        $grm_id = $grm_details->id;


        foreach ($req->item as $key => $items) {
            $details = InventoryPurchaseOrderDetail::where('id', $req->po_details_id[$key])->first();
            $qt = $details->grm_qty + $req->qty[$key];

            $grn_details = new InventoryGRNDetail();
            $grn_details->grm_id                      = $grm_id;
            $grn_details->item_id                     = $req->item[$key];
            $grn_details->req_id                      = $req->req[$key];
            $grn_details->brand_id                    = $req->brand[$key];
            $grn_details->manufacturer_id            = $req->manufacturer[$key];
            $grn_details->unit_id                    = $req->unit[$key];
            $grn_details->quantity                   = $req->qty[$key];
            $grn_details->gst                        = $req->gst[$key];
            $grn_details->rate                       = $req->rate[$key];
            $grn_details->amount                       = $req->amount[$key];
            $grn_details->save();

            $grm_details_id = $grn_details->id;

            InventoryPurchaseOrderDetail::where('id', $req->po_details_id[$key])->update(['grm_qty' => $qt]);

            DB::table('inventory_purchase_order_details')
                ->join('inventory_purchase_orders', 'inventory_purchase_order_details.purchase_order_id', '=', 'inventory_purchase_orders.id')
                ->where('inventory_purchase_order_details.grm_qty', '=', DB::raw('inventory_purchase_order_details.quantity'))
                ->where('inventory_purchase_order_details.id', '=', $req->po_details_id[$key])
                ->update(['inventory_purchase_order_details.grm_status' => '1']);
        }

        DB::table('inventory_purchase_orders')
            ->where('id', $po_id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('inventory_purchase_order_details')
                    ->whereRaw('inventory_purchase_order_details.purchase_order_id = inventory_purchase_orders.id')
                    ->where('inventory_purchase_order_details.grm_status', '<>', 1);
            })
            ->update(['grm_status' => 1]);



        if ($grm_details_id != null) {
            return redirect()->route('grm-list-inven')->with('success', "GRN Added Sucessfully");
        } else {
            return redirect()->route('grm-list-inven')->with('error', "Something Went Wrong");
        }
    }

    public function grm_details($id)
    {
        $grm_id = base64_decode($id);

        $grm_list = InventoryGRN::join('users', 'users.id', '=', 'inventory_g_r_n_s.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_g_r_n_s.workshop_id')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_g_r_n_s.vendor')
            ->select('item_store_rooms.item_store_room as workshop_name', 'inventory_g_r_n_s.grm_date', 'inventory_g_r_n_s.id as grm_id', 'inventory_g_r_n_s.grm_prefix', 'inventory_vendors.vendor_name', 'inventory_g_r_n_s.grm_date', 'inventory_g_r_n_s.material_rec_date', 'inventory_g_r_n_s.bill_rec_date', 'inventory_g_r_n_s.challan_no', 'inventory_g_r_n_s.challan_copy', 'inventory_g_r_n_s.challan_date', 'inventory_g_r_n_s.invoice_copy', 'inventory_g_r_n_s.invoice_no', 'inventory_g_r_n_s.invoice_date', 'inventory_g_r_n_s.invoice_value', 'inventory_g_r_n_s.po_value', 'inventory_g_r_n_s.note', 'users.first_name', 'users.last_name', 'inventory_g_r_n_s.po_no')
            ->where('inventory_g_r_n_s.is_delete', 0)
            ->where('inventory_g_r_n_s.id', $grm_id)
            ->first();

        $po_details = InventoryPurchaseOrder::where('id', $grm_list->po_no)->first();


        $grm_item = InventoryGRNDetail::join('items', 'items.id', '=', 'inventory_g_r_n_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_g_r_n_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_g_r_n_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_g_r_n_details.unit_id')
            ->select('inventory_g_r_n_details.gst', 'inventory_g_r_n_details.quantity', 'inventory_g_r_n_details.rate', 'inventory_g_r_n_details.amount', 'inventory_g_r_n_details.req_id', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'item_units.units', 'inventory_g_r_n_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_g_r_n_details.grm_id', $grm_id)
            ->get();

        return view('Inventory.grn.grm-details-inventory', compact('grm_item', 'grm_list', 'po_details'));
    }

    public function grm_edit($id)
    {
        $grm_id = base64_decode($id);
        // dd( $grm_id);

        $grm_list = InventoryGRN::join('users', 'users.id', '=', 'inventory_g_r_n_s.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_g_r_n_s.workshop_id')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_g_r_n_s.vendor')
            ->select('item_store_rooms.item_store_room as workshop_name', 'inventory_g_r_n_s.grm_date', 'inventory_g_r_n_s.id as grm_id', 'inventory_g_r_n_s.grm_prefix', 'inventory_vendors.vendor_name', 'inventory_g_r_n_s.grm_date', 'inventory_g_r_n_s.material_rec_date', 'inventory_g_r_n_s.bill_rec_date', 'inventory_g_r_n_s.challan_no', 'inventory_g_r_n_s.challan_copy', 'inventory_g_r_n_s.challan_date', 'inventory_g_r_n_s.invoice_copy', 'inventory_g_r_n_s.invoice_no', 'inventory_g_r_n_s.invoice_date', 'inventory_g_r_n_s.invoice_value', 'inventory_g_r_n_s.po_value', 'inventory_g_r_n_s.note', 'users.first_name', 'users.last_name', 'inventory_g_r_n_s.po_no')
            ->where('inventory_g_r_n_s.is_delete', 0)
            ->where('inventory_g_r_n_s.id', $grm_id)
            ->first();

        $po_list = InventoryPurchaseOrder::select('inventory_purchase_orders.id as po_id', 'inventory_purchase_orders.po_prefix')->where('inventory_purchase_orders.id', $grm_list->po_no)->first();

        $grm_item = InventoryGRNDetail::join('items', 'items.id', '=', 'inventory_g_r_n_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_g_r_n_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_g_r_n_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_g_r_n_details.unit_id')
            ->select('inventory_g_r_n_details.gst', 'inventory_g_r_n_details.quantity', 'inventory_g_r_n_details.rate', 'inventory_g_r_n_details.amount', 'inventory_g_r_n_details.req_id', 'item_brands.item_brand_name', 'inventory_g_r_n_details.brand_id', 'manufactures.manufacture_name', 'item_units.units', 'items.item_name', 'items.item_description', 'inventory_g_r_n_details.manufacturer_id', 'inventory_g_r_n_details.item_id', 'inventory_g_r_n_details.unit_id')
            ->where('inventory_g_r_n_details.grm_id', $grm_id)
            ->get();

        // dd($grm_item);

        return view('Inventory.grn.edit-grn-detail-inventory', compact('po_list', 'grm_list', 'grm_item'));
    }

    public function update_grm(Request $req)
    {

        $po_id = $req->po_no;

        $validator = $req->validate([
            'material_rec_date' => 'required',
        ]);

        $grm_prefix = DB::table('prefixes')->where('name', '=', 'grn')->first();

        $grm_details = InventoryGRN::where('id', $req->grm_id)->first();
        $grm_details->grm_prefix    = $grm_prefix->prefix;
        $grm_details->po_no         = $req->po_no;
        $grm_details->workshop_id   =  $req->workshop_id;
        $grm_details->vendor        =  $req->vendor;
        $grm_details->grm_date      =  date('Y-m-d h:i');
        $grm_details->material_rec_date   =  $req->material_rec_date;
        $grm_details->bill_rec_date   =  $req->bill_rec_date;
        $grm_details->challan_no   =  $req->challan_no;
        $grm_details->challan_copy   = '';
        $grm_details->challan_date   =  $req->challan_date;
        $grm_details->invoice_no   =  $req->invoice_no;
        $grm_details->invoice_copy   = '';
        $grm_details->invoice_date   =  $req->invoice_date;
        $grm_details->invoice_value   =  $req->invoice_value;
        $grm_details->po_value   =  $req->po_value;
        $grm_details->purpose   =  $req->purpose;
        $grm_details->purpose_grm   =  '';
        $grm_details->note   =  $req->note;
        $grm_details->status   =  1;
        $grm_details->stock_update_status   =  '0';
        $grm_details->generated_by   =   Auth::id();
        $grm_details->is_delete   =  0;
        $grm_details->save();

        $grm_id = $grm_details->id;


        DB::table('inventory_purchase_orders')
            ->where('id', $po_id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('inventory_purchase_order_details')
                    ->whereColumn('inventory_purchase_order_details.purchase_order_id', 'inventory_purchase_orders.id')
                    ->where('inventory_purchase_order_details.grm_status', '<>', '0');
            })
            ->update(['grm_status' => '0']);

        InventoryGRNDetail::where('grm_id', $req->grm_id)->delete();
        foreach ($req->item as $key => $items) {

            $details = InventoryPurchaseOrderDetail::where('id', $req->po_details_id[$key])->first();
            $qt = $details->grm_qty + $req->qty[$key];

            $grn_details = new InventoryGRNDetail();
            $grn_details->grm_id                      =  $grm_id;
            $grn_details->req_id                      = $req->req[$key];
            $grn_details->item_id                     = $req->item[$key];
            $grn_details->brand_id                    = $req->brand[$key];
            $grn_details->manufacturer_id             = $req->manufacturer[$key];
            $grn_details->unit_id                     = $req->unit[$key];
            $grn_details->quantity                    = $req->qty[$key];
            $grn_details->gst                         = $req->gst[$key];
            $grn_details->rate                        = $req->rate[$key];
            $grn_details->amount                      = $req->amount[$key];
            $grn_details->save();

            $grm_details_id =  $grn_details->id;

            InventoryPurchaseOrderDetail::where('id', $req->po_details_id[$key])->update(['grm_qty' => 0]);

            DB::table('inventory_purchase_order_details')
                ->join('inventory_purchase_orders', 'inventory_purchase_order_details.purchase_order_id', '=', 'inventory_purchase_orders.id')
                ->where('inventory_purchase_order_details.grm_qty', '=', DB::raw('inventory_purchase_order_details.quantity'))
                ->where('inventory_purchase_order_details.id', $req->po_details_id[$key])
                ->update(['inventory_purchase_order_details.grm_status' => '0']);

            InventoryPurchaseOrderDetail::where('id', $req->po_details_id[$key])->update(['grm_qty' => $qt]);

            DB::table('inventory_purchase_order_details')
                ->join('inventory_purchase_orders', 'inventory_purchase_order_details.purchase_order_id', '=', 'inventory_purchase_orders.id')
                ->where('inventory_purchase_order_details.grm_qty', '=', DB::raw('inventory_purchase_order_details.quantity'))
                ->where('inventory_purchase_order_details.id', $req->po_details_id[$key])
                ->update(['inventory_purchase_order_details.grm_status' => '1']);
        }

        DB::table('inventory_purchase_orders')
            ->where('id', $po_id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('purchase_order_details')
                    ->whereColumn('inventory_purchase_order_details.purchase_order_id', 'inventory_purchase_orders.id')
                    ->where('inventory_purchase_order_details.grm_status', '<>', '1');
            })
            ->update(['grm_status' => '1']);

        if ($grm_details_id != null) {
            return redirect()->route('grm-list-inven')->with('success', "GRN Update Sucessfully");
        } else {
            return redirect()->route('grm-list-inven')->with('error', "Something Went Wrong");
        }
    }

    public function stock_update_after_grm($id)
    {
        try {
            DB::beginTransaction();

            $grm_id = base64_decode($id);

            $grm_main = InventoryGRN::join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_g_r_n_s.workshop_id')
                ->select('item_store_rooms.item_store_room as workshop_name', 'item_store_rooms.id as workshop_id')
                ->where('inventory_g_r_n_s.is_delete', 0)
                ->where('inventory_g_r_n_s.id', $grm_id)
                ->first();

            $grm_item = InventoryGRNDetail::join('items', 'items.id', '=', 'inventory_g_r_n_details.item_id')
                ->join('item_brands', 'item_brands.id', '=', 'inventory_g_r_n_details.brand_id')
                ->join('manufactures', 'manufactures.id', '=', 'inventory_g_r_n_details.manufacturer_id')
                ->join('item_units', 'item_units.id', '=', 'inventory_g_r_n_details.unit_id')
                ->select('inventory_g_r_n_details.gst', 'inventory_g_r_n_details.quantity', 'inventory_g_r_n_details.rate', 'inventory_g_r_n_details.amount', 'inventory_g_r_n_details.req_id', 'item_brands.item_brand_name', 'inventory_g_r_n_details.brand_id', 'manufactures.manufacture_name', 'item_units.units', 'inventory_g_r_n_details.quantity', 'items.item_name', 'items.item_description', 'inventory_g_r_n_details.manufacturer_id', 'inventory_g_r_n_details.item_id', 'inventory_g_r_n_details.unit_id')
                ->where('inventory_g_r_n_details.grm_id', $grm_id)
                ->get();

            foreach ($grm_item as $item) {
                $_unit_base = ItemUnit::where('id', $item->unit_id)->first();
                $QTY_value = $item->quantity;
                $main_u = $item->unit_id;

                $item_stock = new InventoryItemStock();
                $item_stock->grm_id = $grm_id;
                $item_stock->workshop_id = $grm_main->workshop_id;
                $item_stock->item_id = $item->item_id;
                $item_stock->brand_id = $item->brand_id;
                $item_stock->manufacturer_id = $item->manufacturer_id;
                $item_stock->quantity = $QTY_value;
                $item_stock->unit_id = $main_u;
                $item_stock->gst = $item->gst;
                $item_stock->rate = $item->rate;
                $item_stock->amount = $item->amount;
                $item_stock->status = 'new_stock';
                $item_stock->save();
            }
            $de = InventoryGRN::where('id', $grm_id)->update(['stock_update_status' => '1']);

            DB::commit();
            if ($de != null) {
                return redirect()->route('grm-list-inven')->with('success', "Stock Updated Sucessfully");
            } else {
                return redirect()->route('grm-list-inven')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return redirect()->route('grm-list-inven')->with('error', "Something Went Wrong");
        }
    }
}
