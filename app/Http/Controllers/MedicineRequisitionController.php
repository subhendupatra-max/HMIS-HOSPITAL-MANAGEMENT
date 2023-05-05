<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MedicineCatagory;
use App\Models\MedicineRequisition;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medicine;
use App\Models\MedicineBaseUnit;
use App\Models\MedicineRequisitionDetails;
use App\Models\MedicineRequisitionPermission;
use App\Models\MedicineStoreRoom;
use App\Models\MedicineUnit;
use App\Models\Prefix;
use App\Models\SaveMedicineAll;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorQuatation;
use App\Models\VendorPermission;
use Illuminate\Support\Facades\DB;
use PDF;
use Mail;
use Throwable;
use URL;

class MedicineRequisitionController extends Controller
{
    public function medicine_requisition_details()
    {

        $medicine_requisition = MedicineRequisition::where('is_delete', 0)
            ->orderBy('medicine_requisitions.id', 'DESC')
            ->paginate(20);

        return view('pharmacy.purchase.requisition.medicine-requisition-listing', compact('medicine_requisition'));
    }

    public function add_medicine_requisition_details()
    {
        $store_room_list = MedicineStoreRoom::where('is_active', '1')->get();
        $medicine_catagory = MedicineCatagory::all();
        $medicine = Medicine::all();
        $medicineUnit = MedicineUnit::all();
        $user_list = User::where('is_active', '1')->get();

        return view('pharmacy.purchase.requisition.add-medicine-requisition', compact('medicine_catagory', 'user_list', 'store_room_list', 'medicine', 'medicineUnit'));
    }

    public function save_medicine_requisition_details(Request $request)
    {
        try {
            DB::beginTransaction();
            $general_details = DB::table('general_settings')->first();

            $validate = $request->validate([
                'date'                      => 'required',

            ]);

            $permission = $request->post('need_permission');

            $prefix = Prefix::where('name', '=', 'medicine_requisition')->first();

            if ($permission == 'yes') {
                $requisition = new MedicineRequisition();
                $requisition->requisition_prefix               = $prefix->prefix;
                $requisition->store_room_id                    = $request->store_room;
                $requisition->date                             = $request->date;
                $requisition->checked_by                       = $request->checked_by;
                $requisition->requested_by                     = $request->requested_by;
                $requisition->genarated_by                     = Auth::user()->id;
                $requisition->status                           = 1;
                $status     =  $requisition->save();
            } else {
                $requisition = new MedicineRequisition();
                $requisition->requisition_prefix               = $prefix->prefix;
                $requisition->store_room_id                    = $request->store_room;
                $requisition->date                             = $request->date;
                $requisition->checked_by                       = $request->checked_by;
                $requisition->requested_by                     = $request->requested_by;
                $requisition->genarated_by                     = Auth::user()->id;
                $requisition->status                           = 3;
                $status     =  $requisition->save();
            }



            foreach ($request->medicine_catagory as $key => $medicine_catagory) {
                $requisition_details = new MedicineRequisitionDetails();
                $requisition_details->requisition_id              = $requisition->id;
                $requisition_details->medicine_catagory           = $request->medicine_catagory[$key];
                $requisition_details->medicine_name               = $request->medicine_name[$key];
                $requisition_details->medicine_unit               = $request->medicine_unit[$key];
                $requisition_details->quantity                    = $request->qty[$key];
                $status = $requisition_details->save();
            }


            if ($permission == 'yes') {
                foreach ($request->permission_authority as $key => $permission_authority) {
                    $permission = new MedicineRequisitionPermission();
                    $permission->requisition_id              = $requisition->id;
                    $permission->user_id                     = $request->permission_authority[$key];
                    $permission->permission_type             = $request->permission_type;
                    $permission->need_permission             = $request->need_permission;
                    $permission->status                      = 'Pending';
                    $permission->date                        = '';
                    $permission->comment                     = '';
                    $status = $permission->save();
                }
            }

            DB::commit();

            if ($status) {
                return redirect()->route('all-medicine-requisition-listing')->with('success', 'Requisition Added Sucessfully');
            } else {
                return redirect()->route('all-medicine-requisition-listing')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return redirect()->route('all-medicine-requisition-listing')->with('error', "Something Went Wrong");
        }
    }


    public function find_medicine_name_by_catagory_id(Request $request)
    {
        $medicine_name = Medicine::where('medicine_catagory', $request->catagory_id)->get();

        return response()->json($medicine_name);
    }

    public function find_medicine_name_by_medicine_name(Request $request)
    {
        $unit_name = Medicine::select('medicine_units.medicine_unit_name','medicine_units.id')->where('medicines.id', $request->medicineName_id)
            ->leftjoin('medicine_units', 'medicines.unit', '=', 'medicine_units.id')
            ->first();

        return response()->json($unit_name);
    }

    public function all_medicine_requisition_details($id)
    {
        $requisition_details = MedicineRequisition::where('id', $id)->first();

        $permisison_users = MedicineRequisitionPermission::where('requisition_id', $id)->get();

        $permisison_users_vendor = VendorPermission::where('req_id', $id)->get();

        $permisison_status_own_vendor = VendorPermission::select('status', 'comment')->where('req_id', $id)->where('user_id', Auth::id())->first();

        $permisison_status_own = MedicineRequisitionPermission::where('requisition_id', $id)->where('user_id', Auth::id())->first();

        $vendor_details =  DB::table('vendors')
            ->select('vendors.id', 'vendors.vendor_name', 'vendors.vendor_address', 'vendors.vendor_gst')
            ->whereNotIn('vendors.id', function ($query) use ($id) {
                $query->select('vendor_quatations.vendor_id')
                    ->from('vendor_quatations')
                    ->where('vendor_quatations.req_id', $id);
            })
            ->get();


        $sl_vender = VendorQuatation::where('req_id', $id)->get();

        $user_list = User::all();

        $show_for_permission = MedicineRequisitionPermission::where('requisition_id', $id)
            ->where('permission_type', 'Sequential')
            ->where('status', 'Pending')->orWhere('status', 'Need Clarification')
            ->orWhere('status', 'Rejected')
            ->first();

        $vendor_selected_quataion = VendorQuatation::where('req_id', $id)->where('status', 1)->get();

        $requisition_item = MedicineRequisitionDetails::where('requisition_id', $id)->get();

        return view('pharmacy.purchase.requisition.medicine-requisition-details', compact('requisition_details', 'permisison_users', 'permisison_users_vendor', 'permisison_status_own', 'vendor_details', 'sl_vender', 'user_list', 'show_for_permission', 'permisison_status_own_vendor', 'vendor_selected_quataion', 'requisition_item'));
    }

    public function given_approval(Request $req)
    {
        $general_details = DB::table('general_settings')->first();

        $permission_type = MedicineRequisitionPermission::select('permission_type')->where('requisition_id', $req->post('requisition_id'))->first();

        if ($permission_type->permission_type == 'Parallal') {

            $no_of_user_permission = MedicineRequisitionPermission::where('requisition_id', $req->post('requisition_id'))->count();


            $subhendu = $no_of_user_permission * ($general_details->req_permission_percentage / 100);


            $validator = $req->validate([
                'permission' => 'required',
            ]);


            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = MedicineRequisitionPermission::where('requisition_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $no_of_user_permission_given_approve = MedicineRequisitionPermission::where('requisition_id', $req->post('requisition_id'))->where('status', 'Approved')->count();

            $no_of_user_permission_given_reject = MedicineRequisitionPermission::where('requisition_id', $req->post('requisition_id'))->where('status', 'Rejected')->count();



            if ($no_of_user_permission_given_reject >= 1) {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 2]);
            }

            if ($no_of_user_permission_given_reject < 1 && $no_of_user_permission_given_approve >= $subhendu) {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 3]);
            }

            if ($status == 'Need Clarification' || $status == 'Pending') {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 1]);
            }
        } else {
            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = MedicineRequisitionPermission::where('requisition_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $permission = MedicineRequisitionPermission::select('permission_type', 'status')->where('requisition_id', $req->post('requisition_id'))->orderBy('id', 'DESC')->first();

            if ($permission->status == 'Approved') {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 3]);
            } elseif ($permission->status == 'Rejected') {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 2]);
            } else {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 1]);
            }
        }


        if ($data == true) {
            $req->session()->flash('success', 'Requisition Status Changed Successfully');
            // return redirect('/requisition-details/' . $requisition_id);
            return redirect()->route('medicine-requisition-details', ['id' => ($requisition_id)]);
        } else {
            return back()->withErrors(['error' => 'Unable to Changed, Try Again Later.']);
        }
    }

    public function add_vender_for_quatation(Request $req)
    {
        $req->validate([
            'vendor_name' => 'required',
        ]);

        $requatation_id = $req->post('req_id');
        $vandor_id = $req->post('vendor_name');

        $no_of = count($req->post('vendor_name'));

        for ($j = 0; $j < $no_of; $j++) {

            $data = array(
                'req_id' => $requatation_id,
                'vendor_id' => $vandor_id[$j],
                'vendor_quatation' => '',
                'status' => 0,
            );

            VendorQuatation::insertGetId($data);
        }

        $res = MedicineRequisition::where('id', $requatation_id)->where('status', '<', '4')->update(['status' => 4]);

        if ($res == true) {
            $req->session()->flash('success', 'Vendor Added Successfully.');
            // return redirect('/requisition-details/' . $req->post('req_id'));
            return redirect()->route('medicine-requisition-details', ['id' => ($req->post('req_id'))]);
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function vendor_quatation(Request $req)
    {
        $req_id = $req->post('req_id');
        $vendor_id = $req->post('vender_name');
        if ($req->hasfile('vendor_quatation')) {

            $file = $req->file('vendor_quatation');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/quatation/", $filename);
        }

        $res = VendorQuatation::where('req_id', $req_id)->where('vendor_id', $vendor_id)->update(['vendor_quatation' => $filename]);

        if ($res == true) {
            $req->session()->flash('success', 'Vendor Quatation Added Successfully');
            // return redirect('/requisition-details/' . $req->post('req_id'));
            return redirect()->route('medicine-requisition-details', ['id' => ($req->post('req_id'))]);
        } else {
            return back()->withErrors(['error' => 'Unable to Added Quatation, Try Again Later.']);
        }
    }

    public function vendor_select_for_po(Request $req)
    {
        // dd($req->all());
        $vendor_id = $req->post('vendor_id');
        $quatation_item = $req->post('item_quataion');
        $status = $req->post('selection');
        $req_id = $req->post('req_no');
        $comment = $req->post('note');
        $res =  VendorQuatation::where('req_id', $req_id)->where('vendor_id', $vendor_id)->update(['quatation_item' => $quatation_item, 'status' => $status, 'comment' => $comment]);
        if ($status == 1) {
            MedicineRequisition::where('id', $req_id)->update(['status' => 5]);
        }


        if ($res == true) {

            // return redirect('/requisition-details/' . $req_id)->with('success', 'Vendor Quatation Status Changed Successfully');
            return redirect()->route('medicine-requisition-details', ['id' => ($req_id)])->with('success', 'Vendor Quatation Status Changed Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Select Quatation, Try Again Later.']);
        }
    }

    public function add_vendor_permission(Request $req)
    {
        $permission_authority = $req->post('permission_authority');

        $no_of_permission_authority = count($req->post('permission_authority'));

        for ($j = 0; $j < $no_of_permission_authority; $j++) {

            $data = array(
                'req_id' => $req->post('req_id'),
                'user_id' => $permission_authority[$j],
                'permission_type' => $req->post('permission_type'),
                'comment'  => '',
                'status' => 'Pending',
                'date' => '',
            );

            VendorPermission::insertGetId($data);
        }

        $res = MedicineRequisition::where('id', $req->post('req_id'))->update(['status' => 6]);

        if ($res == true) {
            $req->session()->flash('success', ' Successfully Send for Permission.');
            // return redirect('/requisition-details/' . $req->post('req_id'));
            return redirect()->route('medicine-requisition-details', ['id' => ($req->post('req_id'))]);
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function give_approval_vendor(Request $req)
    {
        $general_details = DB::table('general_settings')->first();
        $permission_type = VendorPermission::select('permission_type')->where('req_id', $req->post('requisition_id'))->first();

        if ($permission_type->permission_type == 'Parallal') {

            $no_of_user_permission = VendorPermission::where('req_id', $req->post('requisition_id'))->count();


            $subhendu = $no_of_user_permission * ($general_details->req_permission_percentage / 100);


            $validator = $req->validate([
                'permission' => 'required',
            ]);


            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = VendorPermission::where('req_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $no_of_user_permission_given_approve = VendorPermission::where('req_id', $req->post('requisition_id'))->where('status', 'Approved')->count();

            $no_of_user_permission_given_reject = VendorPermission::where('req_id', $req->post('requisition_id'))->where('status', 'Rejected')->count();
            // dd($subhendu);


            if ($no_of_user_permission_given_reject >= 1) {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 8]);
            }

            if ($no_of_user_permission_given_reject < 1 && $no_of_user_permission_given_approve >= $subhendu) {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 9]);
            }

            if ($status == 'Need Clarification' || $status == 'Pending') {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 7]);
            }
        } else {
            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = VendorPermission::where('req_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $permission = VendorPermission::select('permission_type', 'status')->where('req_id', $req->post('requisition_id'))->orderBy('id', 'DESC')->first();

            if ($permission->status == 'Approved') {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 9]);
            } elseif ($permission->status == 'Rejected') {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 8]);
            } else {
                MedicineRequisition::where('id', $requisition_id)->update(['status' => 7]);
            }
        }


        if ($data == true) {
            $req->session()->flash('success', 'Requisition Status Changed Successfully');
            // return redirect('/requisition-details/' . $requisition_id);
            return redirect()->route('medicine-requisition-details', ['id' => ($requisition_id)]);
        } else {
            return back()->withErrors(['error' => 'Unable to Changed, Try Again Later.']);
        }
    }

    public function _printRequisition($id)
    {
        $requisition_details = MedicineRequisition::where('id', $id)->first();

        $requisition_requested_by = User::where('id', $requisition_details->generated_by)->first();

        $vendor_selected_quataion = VendorQuatation::where('req_id', $id)->where('status', 1)->get();

        $requisition_item = MedicineRequisitionDetails::select('medicine_requisition_details.id as requisition_details_id', 'medicine_requisition_details.quantity', 'medicine_catagories.medicine_catagory_name', 'medicine_units.medicine_unit_name', 'medicines.medicine_name', 'medicine_requisition_details.po_status')
            ->join('medicine_catagories', 'medicine_catagories.id', '=', 'medicine_requisition_details.medicine_catagory')
            ->join('medicine_units', 'medicine_units.id', '=', 'medicine_requisition_details.medicine_unit')
            ->join('medicines', 'medicines.id', '=', 'medicine_requisition_details.medicine_name')
            ->where('requisition_id', $id)
            ->get();

        $pdf = PDF::loadView('pharmacy.purchase.requisition.print._printReq', compact('requisition_details', 'requisition_requested_by', 'requisition_item', 'vendor_selected_quataion'));
        // return view('jiii');
        return $pdf->setPaper('a4')->setWarnings(false)->stream('myfile.pdf');

        // return redirect('/requisition-details/' . $id);
        return redirect()->route('medicine-requisition-details', ['id' => ($id)]);
    }

    public function delete_medicine_requisition_details($id)
    {
        $id = base64_decode($id);
        $res = MedicineRequisition::where('id', $id)->update(['is_delete' => 1]);
        if ($res == true) {
            return redirect()->route('all-medicine-requisition-listing')->with('success', "Requisition Delete Sucessfully");
        } else {

            return redirect()->route('all-medicine-requisition-listing')->with('error', "Something Went Wrong");
        }
    }

    public function allmedicine(Request $request)
    {

        $medicinedata = Medicine::whereIn('medicines.id', $request->seleteMedicine)
            ->select('medicine_catagories.medicine_catagory_name', 'medicine_units.medicine_unit_name', 'medicine_units.id', 'medicine_catagories.id as catagory_id', 'medicine_units.id as unit_id', 'medicines.id as medicine_id', 'medicines.medicine_name')
            ->join('medicine_catagories', 'medicine_catagories.id', '=', 'medicines.medicine_catagory')
            ->join('medicine_base_units', 'medicine_base_units.medicine_id', '=', 'medicines.id')
            ->join('medicine_units', 'medicine_units.id', '=', 'medicine_base_units.medicine_unit')
            ->get();

        $store_room_list = MedicineStoreRoom::where('is_active', '1')->get();
        $medicine_catagory = MedicineCatagory::all();
        $medicine = Medicine::all();
        $medicineUnit = MedicineUnit::all();
        $user_list = User::all();

        return view('pharmacy.purchase.requisition.add-medicine-requisition', compact('medicine_catagory', 'user_list', 'store_room_list', 'medicine', 'medicineUnit', 'medicinedata'));
    }
}
