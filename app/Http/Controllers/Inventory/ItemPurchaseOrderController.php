<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryPurchaseOrderDetail;
use App\Models\Inventory\InventoryRequisition;
use App\Models\Inventory\InventoryRequisitionDetail;
use App\Models\InventoryVendorQuatation;
use App\Models\InventoryVendor;
use App\Models\User;
use App\Models\Manufacture;
use App\Models\ItemBrand;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\ItemStoreRoom;
use App\Models\WorkingStatus;
use DB;
use PDF;
use URL;
use Auth;
use Mail;
use Storage;

class ItemPurchaseOrderController extends Controller
{
    public function index()
    {
        $po_list = InventoryPurchaseOrder::where('is_delete', '0')
            ->orderBy('inventory_purchase_orders.id', 'DESC')
            ->get();

        return view('Inventory.purchase-order.purcharge-order-lisiting-inventory', compact('po_list'));
    }

    public function create_po()
    {
        $requisition_list = InventoryRequisition::where('status', '>=', 10)->where('is_delete', 1)->get();
        $vendor_list = InventoryVendor::where('is_active', '1')->get();
        $item_type_list = ItemType::get();
        $brand_list = ItemBrand::get();
        $manufacturer_list = Manufacture::get();
        $stockroom = ItemStoreRoom::where('is_active', '1')->get();

        $user_list = User::select('users.id', 'users.first_name', 'users.last_name')->get();

        return view('Inventory.purchase-order.create-po-in-inventory', compact('user_list', 'item_type_list', 'manufacturer_list', 'brand_list', 'requisition_list', 'vendor_list', 'stockroom'));
    }

    public function get_requisition_details($vendor_id, $workshop)
    {
        // dd($vendor_id);
        $requisition_list = InventoryRequisition::join('inventory_vendor_quatations', 'inventory_vendor_quatations.req_id', '=', 'inventory_requisitions.id')
            ->select('inventory_requisitions.id as requisition_id', 'inventory_requisitions.requisition_prefix')
            ->where('inventory_requisitions.stock_room', $workshop)
            ->where('inventory_requisitions.is_delete', 0)
            ->where('inventory_requisitions.po_status', '=', '0')
            ->where('inventory_vendor_quatations.vendor_id', $vendor_id)
            ->where('inventory_vendor_quatations.status', 1)
            ->where(
                function ($query) {
                    return $query
                        ->orwhere('inventory_requisitions.status', '=', '9')
                        ->orwhere('inventory_requisitions.status', '=', '10')
                        ->orwhere('inventory_requisitions.status', '=', '11')
                        ->orwhere('inventory_requisitions.status', '=', '12');
                }
            )
            ->get();
            // dd( $requisition_list );
        return response()->json($requisition_list);
    }

    public function get_requisition_item_details($requisition_id)
    {
        $requisition_item_list = InventoryRequisitionDetail::join('items', 'items.id', '=', 'inventory_requisition_details.item_id')

            ->join('item_brands', 'item_brands.id', '=', 'items.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'items.manufacture')
            ->join('item_units', 'item_units.id', '=', 'inventory_requisition_details.unit_id')
            ->join('inventory_requisitions', 'inventory_requisitions.id', '=', 'inventory_requisition_details.requisition_id')

            ->select('inventory_requisition_details.id as requisition_details_id', 'inventory_requisitions.requisition_prefix', 'inventory_requisition_details.requisition_id', 'inventory_requisition_details.quantity as result_qty', 'inventory_requisition_details.quantity', 'items.item_description', 'items.item_name', 'items.id as item_id', 'manufactures.id as manufacturer_id', 'manufactures.manufacture_name', 'item_brands.id as brands_id', 'item_brands.item_brand_name', 'item_units.id as item_unit_id', 'item_units.units')
            ->where('inventory_requisition_details.requisition_id', $requisition_id)
            ->where('inventory_requisition_details.po_status', '0')
            ->get();
            // dd($requisition_item_list);
        return response()->json($requisition_item_list);
    }

    public function get_item_ajax(Request $req)
    {
        $item_type = $req->post('item_type_id');
        $item = ItemType::join('items', 'item_types.id', '=', 'items.item_type_id')->leftjoin('item_brands', 'items.brand_id', '=', 'item_brands.id')->leftjoin('manufactures', 'items.manufacture', '=', 'manufactures.id')->select('items.item_name', 'items.id as item_id', 'manufactures.manufacture_name', 'item_brands.item_brand_name', 'items.item_description', 'items.part_no')->where('items.item_type_id', $item_type)->get();
        return response()->json($item);
    }

    public function save_purchase_order(Request $request)
    {
        $prefix = DB::table('prefixes')->where('name', '=', 'inventory_purchase_order')->first();

        $validator = $request->validate([
            'workshop' => 'required',
            'po_date' => 'required',
            'vendor' => 'required',
            'requisition_no' => 'required',
            'item'  => 'required',
            'grand_total'  => 'required',
            'payment_terms'  => 'required',
        ]);

        $purchase_order = new InventoryPurchaseOrder();
        $purchase_order->stock_room_id = $request->workshop;
        $purchase_order->po_prefix = $prefix->prefix;
        $purchase_order->po_date = $request->po_date;
        $purchase_order->vendor = $request->vendor;
        $purchase_order->total = $request->total;
        $purchase_order->extra_charges_name = $request->extra_charges_name;
        $purchase_order->extra_charges_value = $request->extra_charges_value;
        $purchase_order->grand_total = $request->grand_total;
        $purchase_order->note = $request->note;
        $purchase_order->payment_terms = $request->payment_terms;
        $purchase_order->generated_by = Auth::id();
        $purchase_order->status = 10;
        $purchase_order->is_delete = 0;
        $purchase_order->save();

        $po_id = $purchase_order->id;

        foreach ($request->item as $key => $items) {
            $requisition_details = new InventoryPurchaseOrderDetail();
            $requisition_details->purchase_order_id           =  $po_id;
            $requisition_details->req_id                      = $request->req_id[$key];
            $requisition_details->req_details_id              = $request->requisition_details_id[$key];
            $requisition_details->req_no                      = $request->req_id_no[$key];
            $requisition_details->item_id                     = $request->item[$key];
            $requisition_details->brand_id                    = $request->brand[$key];
            $requisition_details->manufacturer_id             = $request->manufacturer[$key];
            $requisition_details->unit_id                     = $request->unit[$key];
            $requisition_details->quantity                    = $request->qty[$key];
            $requisition_details->gst                         = $request->gst[$key];
            $requisition_details->rate                        = $request->rate[$key];
            $requisition_details->amount                      = $request->amount[$key];
            $requisition_details = $requisition_details->save();

            $req_item_qty = InventoryRequisitionDetail::where('id', $request->requisition_details_id[$key])->first();

            InventoryRequisitionDetail::where('id',  $request->requisition_details_id[$key])->update(['po_qty' => ($request->qty[$key] + $req_item_qty->po_qty)]);

            $req_item_qty_last = InventoryRequisitionDetail::where('id', $request->requisition_details_id[$key])->first();

            if ($req_item_qty_last->quantity == $req_item_qty_last->po_qty) {
                InventoryRequisitionDetail::where('id', $request->requisition_details_id[$key])->update(['po_status' => '1']);
            }
            $_you = InventoryRequisitionDetail::where('requisition_id', $request->req_id_no[$key])->where('po_status', '0')->count();

            if ($_you > 0) {
                InventoryRequisition::where('id', $request->req_id_no[$key])->update(['status' => 11]);
            } else {
                InventoryRequisition::where('id', $request->req_id_no[$key])->update(['status' => 10]);
                InventoryRequisition::where('id', $request->req_id_no[$key])->update(['po_status' => '1']);
            }
        }

        if ($po_id != null) {
            return redirect()->route('Purchase-Order-list-inventory')->with('success', "Purchase Order Added Sucessfully");
        } else {
            return redirect()->route('Purchase-Order-list-inventory')->with('error', "Something Went Wrong");
        }
    }

    public function purchase_order_details($id)
    {
        // dd($id);
        $po_id = base64_decode($id);
        // dd($po_id);
        // $ids = base64_decode($po_id);
        // dd($ids);
        
        $vendor_details = InventoryVendor::where('is_active', '1')->get();
        $user_list = User::select('users.id', 'users.first_name', 'users.last_name')->get();

        $po_list = InventoryPurchaseOrder::join('users', 'users.id', '=', 'inventory_purchase_orders.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_purchase_orders.stock_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'inventory_purchase_orders.status')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_purchase_orders.vendor')
            ->select('inventory_vendors.id as vendor_id', 'inventory_vendors.vendor_name', 'inventory_purchase_orders.feedback', 'inventory_purchase_orders.expected_delivery_date', 'item_store_rooms.id as workshop_id_no', 'users.first_name', 'users.last_name', 'inventory_purchase_orders.id as po_id', 'item_store_rooms.item_store_room as workshop_name', 'inventory_purchase_orders.po_date', 'inventory_purchase_orders.status as po_status', 'working_statuses.status', 'inventory_purchase_orders.po_prefix', 'inventory_purchase_orders.total', 'inventory_purchase_orders.extra_charges_name', 'inventory_purchase_orders.extra_charges_value', 'inventory_purchase_orders.grand_total', 'inventory_purchase_orders.note')
            ->where('inventory_purchase_orders.is_delete', 0)
            ->where('inventory_purchase_orders.id', $po_id)
            ->first();

        $po_item = InventoryPurchaseOrderDetail::join('items', 'items.id', '=', 'inventory_purchase_order_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_purchase_order_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_purchase_order_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_purchase_order_details.unit_id')

            ->select('items.part_no', 'items.hsn_or_sac_no', 'inventory_purchase_order_details.req_no', 'inventory_purchase_order_details.gst', 'inventory_purchase_order_details.quantity', 'inventory_purchase_order_details.rate', 'inventory_purchase_order_details.amount', 'inventory_purchase_order_details.req_id', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'item_units.units', 'inventory_purchase_order_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_purchase_order_details.purchase_order_id', $po_id)
            ->get();

        $po_req = InventoryPurchaseOrderDetail::select('inventory_purchase_order_details.req_no')
            ->where('inventory_purchase_order_details.purchase_order_id', $po_id)
            ->groupBy('req_no')
            ->get();

        $sl_vender = DB::table('inventory_vendor_quatations')->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_vendor_quatations.vendor_id')->select('inventory_vendor_quatations.req_id', 'inventory_vendor_quatations.comment', 'inventory_vendor_quatations.vendor_quatation', 'inventory_vendor_quatations.status as quatation_status', 'inventory_vendors.id as vendor_id', 'inventory_vendors.vendor_name', 'inventory_vendors.vendor_ph_no', 'inventory_vendors.vendor_address', 'inventory_vendors.vendor_gst')->where(function ($q) use ($po_req) {
            for ($i = 0; $i < count($po_req); $i++) {
                $q->where('inventory_vendor_quatations.req_id', $po_req[$i]->req_no);
            }
        })
            ->get();


        return view('Inventory.purchase-order.po-details-in-inventory', compact('user_list', 'po_item', 'po_list', 'vendor_details', 'po_req', 'sl_vender'));
    }

    public function po_status_change(Request $req)
    {
        $po_id = $req->post('po_id');
        $vendor_id = $req->post('vendor_id');
        $status = $req->post('status');

        $vendor_email = InventoryVendor::where('id', $vendor_id)->first();

        $res = InventoryPurchaseOrder::where('id', $po_id)->update(['status' => $status]);
        if ($res == true) {
            return back()->with('success', ' Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable, Try Again Later.']);
        }
    }

    public function vendor_select_change(Request $req)
    {
        $po_id = $req->post('po_id');
        $vendor_id = $req->post('vendor_id');
        $quatation_item = $req->post('item_quataion');
        $status = $req->post('selection');
        $req_id = $req->post('req_no');
        $comment = $req->post('note');
        $res =  InventoryVendorQuatation::where('req_id', $req_id)->where('vendor_id', $vendor_id)->update(['quatation_item' => $quatation_item, 'status' => $status, 'comment' => $comment]);

        if ($status == 1) {
            InventoryPurchaseOrder::where('id', $po_id)->update(['status' => 19, 'vendor' => $vendor_id]);
        }

        if ($res == true) {

            return redirect()->back()->with('success', 'Vendor Changed Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Select Quatation, Try Again Later.']);
        }
    }

    public function save_feedback(Request $req)
    {
        $po_id = $req->post('po_id');
        if ($req->hasfile('feedback_file')) {
            $file = $req->file('feedback_file');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/inventory-po/feedback/", $filename);
        }
        $res = InventoryPurchaseOrder::where('id', $po_id)->update(['feedback' => $filename]);
        $po_i = base64_decode($po_id);
        if ($res == true) {
            return back()->with('success', 'Feedback Added Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Added Feedback, Try Again Later.']);
        }
    }

    public function save_expected_delivery_date(Request $req)
    {
        $po_id = $req->post('po_id');
        $expected_delivery_date = $req->post('expected_delivery_date');

        $res = InventoryPurchaseOrder::where('id', $po_id)->update(['expected_delivery_date' => $expected_delivery_date]);
        InventoryPurchaseOrder::where('id', $po_id)->update(['status' => 14]);
        if ($res == true) {
            return back()->with('success', 'Expecte Delivery Date Added Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Added, Try Again Later.']);
        }
    }

    public function send_po_feedback($po_i, $ven_i)
    {

        $po_id = base64_decode($po_i);
        $vendor_id = base64_decode($ven_i);
        $vendor_email = InventoryVendor::select('inventory_vendors.email')->where('id', $vendor_id)->first();
        $general_details = DB::table('general_settings')->first();

        $po_list = InventoryPurchaseOrder::join('users', 'users.id', '=', 'inventory_purchase_orders.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_purchase_orders.stock_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'inventory_purchase_orders.status')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_purchase_orders.vendor')
            ->select('inventory_vendors.id as vendor_id', 'inventory_vendors.vendor_name', 'inventory_vendors.vendor_address', 'inventory_vendors.vendor_gst', 'inventory_vendors.vendor_address', 'inventory_purchase_orders.feedback', 'inventory_purchase_orders.expected_delivery_date', 'item_store_rooms.id as workshop_id_no', 'users.first_name', 'users.last_name', 'inventory_purchase_orders.id as po_id', 'item_store_rooms.item_store_room as workshop_name', 'inventory_purchase_orders.po_date', 'inventory_purchase_orders.status as po_status', 'working_statuses.status', 'inventory_purchase_orders.po_prefix', 'inventory_purchase_orders.total', 'inventory_purchase_orders.extra_charges_name', 'inventory_purchase_orders.extra_charges_value', 'inventory_purchase_orders.grand_total', 'inventory_purchase_orders.note')
            ->where('inventory_purchase_orders.is_delete', 0)
            ->where('inventory_purchase_orders.id', $po_id)
            ->first();

        $po_item = InventoryPurchaseOrderDetail::join('items', 'items.id', '=', 'inventory_purchase_order_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_purchase_order_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_purchase_order_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_purchase_order_details.unit_id')
            ->select('inventory_purchase_order_details.req_no', 'inventory_purchase_order_details.gst', 'inventory_purchase_order_details.quantity', 'inventory_purchase_order_details.rate', 'inventory_purchase_order_details.amount', 'inventory_purchase_order_details.req_id', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'item_units.units', 'inventory_purchase_order_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_purchase_order_details.purchase_order_id', $po_id)
            ->get();

        $pdf = PDF::loadView('Inventory.purchase-order._print.feedback_form', compact('po_list', 'po_item'));

        $content = $pdf->download()->getOriginalContent();
        Storage::put('inven_feedback/' . $po_id . '.pdf', $content);
        /*=================================Mail function=========================*/

        Mail::send('mail.inventory-feedback', ['link' => $po_id], function ($message) use ($general_details, $vendor_email) {
            $message->from($general_details->email);
            $message->to($vendor_email->email);
            $message->subject('Feedback');
        });
        /*=======================================================================*/

        InventoryPurchaseOrder::where('id', $po_id)->update(['status' => 13]);

        if (true) {
            return redirect()->route('purchase-order-details-inventory', ['id' => base64_encode($po_id)])->with('success', "Purchase Order and Feedback Form Send to Vendor Sucessfully");
        } else {
            return redirect()->route('Purchase-Order-list-inventory')->with('error', "Something Went Wrong");
        }
    }

    public function print_po($id)
    {
        $po_id = base64_decode($id);
        $po_list = InventoryPurchaseOrder::join('users', 'users.id', '=', 'inventory_purchase_orders.generated_by')->join('item_store_rooms', 'item_store_rooms.id', '=', 'inventory_purchase_orders.stock_room_id')
            ->join('working_statuses', 'working_statuses.id', '=', 'inventory_purchase_orders.status')
            ->join('inventory_vendors', 'inventory_vendors.id', '=', 'inventory_purchase_orders.vendor')
            ->select('inventory_vendors.id as vendor_id', 'inventory_vendors.vendor_name', 'inventory_vendors.vendor_address', 'inventory_vendors.vendor_gst', 'inventory_vendors.vendor_address', 'inventory_purchase_orders.feedback', 'inventory_purchase_orders.expected_delivery_date', 'item_store_rooms.id as workshop_id_no', 'users.first_name', 'users.last_name', 'inventory_purchase_orders.id as po_id',  'item_store_rooms.item_store_room as workshop_name', 'inventory_purchase_orders.po_date', 'inventory_purchase_orders.status as po_status', 'working_statuses.status', 'inventory_purchase_orders.po_prefix', 'inventory_purchase_orders.total', 'inventory_purchase_orders.extra_charges_name', 'inventory_purchase_orders.extra_charges_value', 'inventory_purchase_orders.grand_total', 'inventory_purchase_orders.note', 'inventory_purchase_orders.payment_terms')
            ->where('inventory_purchase_orders.is_delete', 0)
            ->where('inventory_purchase_orders.id', $po_id)
            ->first();

        // dd( $po_list);
        $po_item = InventoryPurchaseOrderDetail::join('items', 'items.id', '=', 'inventory_purchase_order_details.item_id')
            ->join('item_brands', 'item_brands.id', '=', 'inventory_purchase_order_details.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'inventory_purchase_order_details.manufacturer_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_purchase_order_details.unit_id')
            ->select('items.hsn_or_sac_no', 'items.part_no', 'inventory_purchase_order_details.req_no', 'inventory_purchase_order_details.gst', 'inventory_purchase_order_details.quantity', 'inventory_purchase_order_details.rate', 'inventory_purchase_order_details.amount', 'inventory_purchase_order_details.req_id', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'item_units.units', 'inventory_purchase_order_details.quantity', 'items.item_name', 'items.item_description')
            ->where('inventory_purchase_order_details.purchase_order_id', $po_id)
            ->get();

        return view('Inventory.purchase-order._print._PurchaseOrder', compact('po_list', 'po_item'));
    }

    public function delete_po($po_id)
    {
        $po_id = base64_decode($po_id);
        $res = InventoryPurchaseOrder::where('id', $po_id)->update(['is_delete' => '1']);
        if ($res == true) {
            return redirect()->back()->with('success', 'Purchase Order Deleted Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Delete, Try Again Later.']);
        }
    }
}
