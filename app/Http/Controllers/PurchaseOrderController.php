<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MedicineCatagory;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\MedicineRequisition;
use App\Models\MedicineUnit;
use App\Models\Vendor;
use App\Models\Medicine;
use App\Models\MedicineStore;
use App\Models\MedicineStoreRoom;
use App\Models\User;
use App\Models\MedicineRequisitionDetails;
use App\Models\PurchaseOrderDetails;
use Illuminate\Support\Facades\DB;
use App\Models\VendorQuatation;
use Illuminate\Support\Facades\Auth;
use PDF;
use Mail;
use Storage;

class PurchaseOrderController extends Controller
{
    public function medicine_purchase_order_details()
    {
        $po_list = PurchaseOrder::where('is_delete', 0)->get();

        return view('pharmacy.purchase.purchase-order.medicine-purchase-order-listing', compact('po_list'));
    }

    public function add_medicine_purchase_order_details()
    {
        $storeroomList = MedicineStoreRoom::where('is_active', '1')->get();
        $requisition_list = MedicineRequisition::where('status', '>=', 10)->where('is_delete', 1)->get();
        $vendor_list = Vendor::where('is_active', '1')->get();
        $catagory_list = MedicineCatagory::get();
        $medicine_unit = MedicineUnit::get();
        $medicine_name = Medicine::get();
        $user_list = User::select('users.id', 'users.first_name', 'users.last_name')->get();

        return view('pharmacy.purchase.purchase-order.add-medicine-purchase-order', compact('user_list', 'catagory_list', 'medicine_unit', 'storeroomList', 'requisition_list', 'vendor_list', 'medicine_name'));
    }

    public function get_requisition_item_details($requisition_id)
    {
        $requisition_item_list = MedicineRequisitionDetails::join('medicines', 'medicines.id', '=', 'medicine_requisition_details.medicine_name')
            ->join('medicine_units', 'medicine_units.id', '=', 'medicines.unit')
            ->join('medicine_catagories', 'medicine_catagories.id', '=', 'medicines.medicine_catagory')
            ->join('medicine_requisitions', 'medicine_requisitions.id', '=', 'medicine_requisition_details.requisition_id')
            ->select('medicine_requisition_details.id as requisition_details_id', 'medicine_requisitions.requisition_prefix', 'medicine_requisition_details.requisition_id', 'medicine_requisition_details.quantity', 'medicine_catagories.id as medicine_catagories_id', 'medicine_units.id as medicine_units_id', 'medicine_units.medicine_unit_name', 'medicine_catagories.medicine_catagory_name', 'medicines.medicine_name', 'medicines.id as medicine_id')
            ->where('medicine_requisition_details.requisition_id', $requisition_id)
            ->where('medicine_requisition_details.po_status', '0')
            ->get();
        return response()->json($requisition_item_list);
    }

    public function get_requisition_details($vendor_id, $storeroom)
    {

        $requisition_list = MedicineRequisition::join('vendor_quatations', 'vendor_quatations.req_id', '=', 'medicine_requisitions.id')
            ->select('medicine_requisitions.id as requisition_id', 'medicine_requisitions.requisition_prefix')
            ->where('medicine_requisitions.store_room_id', $storeroom)
            ->where('medicine_requisitions.is_delete', 0)
            ->where('medicine_requisitions.po_status', '=', '0')
            ->where('vendor_quatations.vendor_id', $vendor_id)
            ->where('vendor_quatations.status', 1)
            ->where(
                function ($query) {
                    return $query
                        ->orwhere('medicine_requisitions.status', '=', '9')
                        ->orwhere('medicine_requisitions.status', '=', '10')
                        ->orwhere('medicine_requisitions.status', '=', '11')
                        ->orwhere('medicine_requisitions.status', '=', '12');
                }
            )

            ->get();

        return response()->json($requisition_list);
    }

    public function save_medicine_purchase_order_details(Request $req)
    {
        try {
            DB::beginTransaction();
        $prefix = DB::table('prefixes')->where('name', '=', 'medicine_purchase_order')->first();

        $validator = $req->validate([
            'store_room_id' => 'required',
            'po_date' => 'required',
            'vendor' => 'required',
            'requisition_no' => 'required',
            'medicine'  => 'required',
        ]);

        $po_save = new PurchaseOrder();
        $po_save->store_room_id = $req->store_room_id;
        $po_save->po_prefix     = $prefix->prefix;
        $po_save->po_date       = $req->po_date;
        $po_save->vendor                    = $req->vendor;
        $po_save->generated_by              = Auth::id();
        $po_save->note                      = $req->note;
        $po_save->status                    = 10;
        $po_save->is_delete                 = 0;
        $po_save->save();

        $po_id = $po_save->id;

        $no_of_item = count($req->post('medicine'));
        $item = $req->post('medicine');
        $catagory = $req->post('catagory');
        $unit = $req->post('unit');
        $item = $req->post('medicine');
        $quantity = $req->post('qty');
        $gst = $req->post('gst');
        $rate = $req->post('rate');
        $amount = $req->post('amount');
        $req_id = $req->post('req_id');
        $req_id_no = $req->post('req_id_no');
        $requisition_details_id = $req->post('requisition_details_id');

        for ($i = 0; $i < $no_of_item; $i++) {

            $po_details = array(
                'purchase_order_id' => $po_id,
                'req_id' => $req_id[$i],
                'req_no' => $req_id_no[$i],
                'req_details_id' => $requisition_details_id[$i],
                'medicine_name' => $item[$i],
                'medicine_unit_id' => $unit[$i],
                'quantity' => $quantity[$i],
            );
            $po_details_id = PurchaseOrderDetails::insertGetId($po_details);
            MedicineRequisitionDetails::where('id', $requisition_details_id[$i])->update(['po_status' => '1']);
            $i__you = MedicineRequisitionDetails::where('requisition_id', $req_id_no[$i])->where('po_status', '0')->count();

            if ($i__you > 0) {
                MedicineRequisition::where('id', $req_id_no[$i])->update(['status' => 11]);
            } else {
                MedicineRequisition::where('id', $req_id_no[$i])->update(['status' => 10]);
                MedicineRequisition::where('id', $req_id_no[$i])->update(['po_status' => '1']);
            }
        }
        DB::commit();
        if ($po_id != null) {
            return redirect()->route('all-medicine-purchase-order-listing')->with('success', "Purchase Order Added Sucessfully");

        } else {
            return redirect()->route('all-medicine-purchase-order-listing')->with('error', "Something Went Wrong");
        }
    } catch (\Throwable $th) {
        return redirect()->route('all-medicine-purchase-order-listing')->with('error', "Something Went Wrong");
    }
    }

    public function purchase_order_details($id)
    {
        $vendor_details = Vendor::where('is_active', '1')->get();
        $user_list = User::select('users.id', 'users.first_name', 'users.last_name')->get();
        $po_id = base64_decode($id);

        $po_list = PurchaseOrder::where('purchase_orders.is_delete', 0)
            ->where('purchase_orders.id', $po_id)
            ->first();

        $po_item = PurchaseOrderDetails::where('purchase_order_details.purchase_order_id', $po_id)
            ->get();

        $po_req = PurchaseOrderDetails::select('purchase_order_details.req_no')
            ->where('purchase_order_details.purchase_order_id', $po_id)
            ->groupBy('req_no')
            ->get();

        $sl_vender = VendorQuatation::where(function ($q) use ($po_req) {
            for ($i = 0; $i < count($po_req); $i++) {
                $q->where('vendor_quatations.req_id', $po_req[$i]->req_no);
            }
        })
            ->get();


        return view('pharmacy.purchase.purchase-order.medicine-purchase-order-details', compact('user_list', 'po_item', 'po_list', 'vendor_details', 'po_req', 'sl_vender'));
    }

    public function save_feedback(Request $req)
    {
        $po_id = $req->post('po_id');
        if ($req->hasfile('feedback_file')) {
            $file = $req->file('feedback_file');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("feedback/", $filename);
        }
        $res = PurchaseOrder::where('id', $po_id)->update(['feedback' => $filename]);
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

        $res = PurchaseOrder::where('id', $po_id)->update(['expected_delivery_date' => $expected_delivery_date]);
        PurchaseOrder::where('id', $po_id)->update(['status' => 14]);
        if ($res == true) {
            return back()->with('success', 'Expecte Delivery Date Added Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Added, Try Again Later.']);
        }
    }

    public function po_status_change(Request $req)
    {
        $po_id = $req->post('po_id');
        $vendor_id = $req->post('vendor_id');
        $status = $req->post('status');

        $vendor_email = Vendor::where('id', $vendor_id)->first();

        if ($status == 17) {
            $details = '';
            $res =  \Mail::to($vendor_email->email)->send(new \App\Mail\poConfirm($details));
        }
        if ($status == 18) {
            $details = '';
            $res =  \Mail::to($vendor_email->email)->send(new \App\Mail\VendorChange($details));
        }

        $res = PurchaseOrder::where('id', $po_id)->update(['status' => $status]);

        if ($res == true) {
            return back()->with('success', ' Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable, Try Again Later.']);
        }
    }

    public function  vendor_select_change(Request $req)
    {
        $po_id = $req->post('po_id');
        $vendor_id = $req->post('vendor_id');
        $quatation_item = $req->post('item_quataion');
        $status = $req->post('selection');
        $req_id = $req->post('req_no');
        $comment = $req->post('note');
        $res =  VendorQuatation::where('req_id', $req_id)->where('vendor_id', $vendor_id)->update(['quatation_item' => $quatation_item, 'status' => $status, 'comment' => $comment]);

        if ($status == 1) {
            PurchaseOrder::where('id', $po_id)->update(['status' => 19, 'vendor' => $vendor_id]);
        }

        if ($res == true) {

            return redirect()->back()->with('success', 'Vendor Changed Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Select Quatation, Try Again Later.']);
        }
    }

    public function print_po($id)
    {
        $po_id = base64_decode($id);

        $po_list = PurchaseOrder::where('purchase_orders.is_delete', 0)
            ->where('purchase_orders.id', $po_id)
            ->first();

        $po_item = PurchaseOrderDetails::where('purchase_order_details.purchase_order_id', $po_id)
            ->get();

        $pdf = PDF::loadView('pharmacy.purchase.purchase-order.print._PurchaseOrder', compact('po_list', 'po_item'));
        return $pdf->download('purchase-order.pdf');
        return redirect()->back();
    }


    public function send_po_feedback($po_i, $ven_i)
    {

        $po_id = base64_decode($po_i);
        $vendor_id = base64_decode($ven_i);
        $vendor_email = Vendor::select('vendors.email')->where('id', $vendor_id)->first();
        $general_details = DB::table('general_settings')->first();

        $po_list = PurchaseOrder::where('purchase_orders.is_delete', 0)->where('purchase_orders.id', $po_id)->first();

        $po_item = PurchaseOrderDetails::where('purchase_order_details.purchase_order_id', $po_id)
            ->get();

        $pdf = PDF::loadView('pharmacy.purchase.purchase-order.print.feedback_form', compact('po_list', 'po_item'));

        $content = $pdf->download()->getOriginalContent();
        Storage::put('create_feedback/' . $po_id . '.pdf', $content);
        /*=================================Mail function=========================*/

        Mail::send('mail.feedback', ['link' => $po_id], function ($message) use ($general_details, $vendor_email) {
            $message->from($general_details->email);
            $message->to($vendor_email->email);
            $message->subject('Feedback');
        });
        /*=======================================================================*/

        PurchaseOrder::where('id', $po_id)->update(['status' => 13]);

        if (true) {
            // return redirect()->route('purchase-order-details'.$po_i)->with('success',"Purchase Order and Feedback Form Send to Vendor Sucessfully");

            return redirect()->route('purchase-order-details', ['id' => ($po_i)])->with('success', "Purchase Order and Feedback Form Send to Vendor Sucessfully");
        } else {
            return redirect()->route('all-medicine-purchase-order-listing')->with('error', "Something Went Wrong");
        }
    }

    public function edit_po($id)
    {
        $user_workshop = Auth::user()->workshop;
        $storeroomList = MedicineStoreRoom::where('is_active', '1')->get();
        $requisition_list = MedicineRequisition::where('status', '>=', 10)->where('is_delete', 1)->get();
        $vendor_list = Vendor::where('is_active', '1')->get();

        $user_list = User::select('users.id', 'users.first_name', 'users.last_name')->get();

        $po_id = base64_decode($id);
        $po_list = PurchaseOrder::where('purchase_orders.is_delete', 0)
            ->where('purchase_orders.id', $po_id)
            ->first();

        $po_item = PurchaseOrderDetails::where('purchase_order_details.purchase_order_id', $po_id)
            ->get();

        $po_req = PurchaseOrderDetails::select('purchase_order_details.req_no')
            ->where('purchase_order_details.purchase_order_id', $po_id)
            ->groupBy('req_no')
            ->get();

        $sl_vender = Vendor::where('is_active', '1')->get();

        return view('pharmacy.purchase.purchase-order.edit-purchase-order-details', compact('storeroomList', 'user_list', 'requisition_list', 'sl_vender', 'po_item', 'po_list'));
    }

    public function po_update(Request $req)
    {

        $validator = $req->validate([
            'store_room_id' => 'required',
            'po_date' => 'required',
            'vendor' => 'required',
            'requisition_no' => 'required',
            'medicine'  => 'required',
        ]);

        try {
            $po_id = $req->po_id;
            $po_details = $this->get_purchase_details_by_order_id($po_id);
            $pre_req_details_id = array_column($po_details, 'req_details_id');

            $requisition_details_id = $req->post('requisition_details_id');
            $no_of_item = count($req->post('medicine'));
            $item = $req->post('medicine');
            $catagory = $req->post('catagory');
            $unit = $req->post('unit');
            $item = $req->post('medicine');
            $quantity = $req->post('qty');
            $gst = $req->post('gst');
            $rate = $req->post('rate');
            $amount = $req->post('amount');
            $req_id = $req->post('req_id');
            $req_id_no = $req->post('req_id_no');

            PurchaseOrderDetails::where('purchase_order_id', $po_id)->delete();
            if (!empty($pre_req_details_id)) {
                MedicineRequisitionDetails::whereIn('id',  $pre_req_details_id)->update(array('po_status' => '0'));
            }

            $po_update =  PurchaseOrder::where('id', $po_id)->first();
            $po_update->store_room_id             = $req->store_room_id;
            $po_update->vendor                    = $req->vendor;
            $po_update->total                     = $req->total;
            $po_update->extra_charges_name        = $req->extra_charges_name;
            $po_update->extra_charges_value       = $req->extra_charges_value;
            $po_update->grand_total               = $req->grand_total;
            $po_update->generated_by              = Auth::id();
            $po_update->note                      = $req->note;
            $po_update->update();

            for ($i = 0; $i < $no_of_item; $i++) {

                $po_details = array(
                    'purchase_order_id' => $po_id,
                    'req_id' => $req_id[$i],
                    'req_no' => $req_id_no[$i],
                    'req_details_id' => $requisition_details_id[$i],
                    'medicine_name' => $item[$i],
                    'medicine_catagory_id' => $catagory[$i],
                    'medicine_unit_id' => $unit[$i],
                    'quantity' => $quantity[$i],
                    'gst' => $gst[$i],
                    'rate' => $rate[$i],
                    'amount' => $amount[$i],
                );

                $po_details_id = PurchaseOrderDetails::insertGetId($po_details);

                MedicineRequisitionDetails::where('id', $requisition_details_id[$i])->update(['po_status' => '1']);

                $i_love_you = MedicineRequisitionDetails::where('requisition_id', $req_id_no[$i])->where('po_status', '0')->count();

                if ($i_love_you > 0) {
                    MedicineRequisition::where('id', $req_id_no[$i])->update(['status' => 11, 'po_status' => '0']);
                } else {
                    MedicineRequisition::where('id', $req_id_no[$i])->update(['status' => 10]);
                    MedicineRequisition::where('id', $req_id_no[$i])->update(['po_status' => '1']);
                }
            }

            return redirect()->route('all-medicine-purchase-order-listing')->with('success', "Purchase Updated Sucessfully");
        } catch (\Throwable $th) {

            return redirect()->route('all-medicine-purchase-order-listing')->with('error', 'Something went wrong');
        }
    }

    private function get_purchase_details_by_order_id($id)
    {
        $PurchaseOrderDetails = PurchaseOrderDetails::select('id', 'purchase_order_id', 'req_id', 'req_details_id')->where('purchase_order_id', $id)->get()->toArray();
        return $PurchaseOrderDetails;
    }
}
