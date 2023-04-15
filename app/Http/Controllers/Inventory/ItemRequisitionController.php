<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryRequisition;
use App\Models\Inventory\InventoryRequisitionDetail;
use App\Models\InventoryPermissionAuthority;
use App\Models\InventoryVendorQuatation;
use App\Models\InventoryVendorPermission;
use App\Models\InventoryVendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ItemStoreRoom;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\ItemBrand;
use App\Models\Manufacture;
use App\Models\UnitOfItem;
use App\Models\Prefix;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use PDF;
use URL;




class ItemRequisitionController extends Controller
{
    public function inventory_requisition_listing()
    {
        $inventory_requisition = InventoryRequisition::where('is_delete', '0')
            ->orderBy('inventory_requisitions.id', 'DESC')
            ->get();

        return view('Inventory.requisition.inventory-requisition-listing', compact('inventory_requisition'));
    }

    public function add_inventory_requisition_details()
    {
        $stockroom = ItemStoreRoom::where('is_active', '1')->get();
        $brand_list = ItemBrand::get();
        $manufacturer_list = Manufacture::get();
        $user_list = User::where('is_active', '1')->get();
        $item_type_list = ItemType::all();

        return view('Inventory.requisition.add-inventory-requisition', compact('user_list', 'stockroom', 'brand_list', 'manufacturer_list', 'item_type_list'));
    }

    public function get_item_details(Request $req)
    {
        $item_details = Item::select('item_brands.id as brand_id', 'brands.brand_name', 'item_types.id as item_type_id', 'items.item_description', 'items.id as item_id', 'items.item_name', 'item_types.item_type', 'manufactures.id as manufactures_id', 'manufactures.manufacture_name')
            ->join('item_types', 'item_types.id', '=', 'items.item_type_id')
            ->join('item_brands', 'item_brands.id', '=', 'items.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'items.manufacture')
            ->where('product_code', $req->post('item_code'))
            ->orwhere('part_no', $req->post('item_code'))
            ->first();

        $item_unit = UnitOfItem::select('item_units.id as unit_id', 'item_units.units')->join('item_units', 'item_units.id', '=', 'unit_of_items.unit_id')->where('unit_of_items.item_id', $item_details->item_id)->get();

        return response()->json(array('item_details' => $item_details, 'item_unit' => $item_unit));
    }

    public function get_item_ajax(Request $req)
    {
        $item_type = $req->post('item_type_id');
        $item = ItemType::join('items', 'item_types.id', '=', 'items.item_type_id')->leftjoin('item_brands', 'items.brand_id', '=', 'item_brands.id')->leftjoin('manufactures', 'items.manufacture', '=', 'manufactures.id')->select('items.item_name', 'items.id as item_id', 'manufactures.manufacture_name', 'item_brands.item_brand_name', 'items.item_description')->where('items.item_type_id', $item_type)->get();
        return response()->json($item);
    }

    public function get_item_brand_all(Request $req)
    {
        $item_id = $req->item_id;

        $item_unit = UnitOfItem::select('item_units.id as unit_id', 'item_units.units')
            ->join('item_units', 'item_units.id', '=', 'unit_of_items.unit_id')
            ->where('unit_of_items.item_id', $item_id)
            ->get();

        return response()->json(array('item_unit' => $item_unit));
    }

    public function save_inventory_requisition_details(Request $request)
    {
        try {
            DB::beginTransaction();
            $general_details = DB::table('general_settings')->first();

            $validate = $request->validate([
                'date'                      => 'required',

            ]);

            $permission = $request->post('need_permission');

            $prefix = Prefix::where('name', '=', 'Inventory_Requisition')->first();

            if ($permission == 'yes') {
                $requisition = new InventoryRequisition();
                $requisition->requisition_prefix               = $prefix->prefix;
                $requisition->stock_room                       = $request->stockroom;
                $requisition->date                             = $request->date;
                $requisition->checked_by                       = $request->checked_by;
                $requisition->requested_by                     = $request->requested_by;
                $requisition->genarated_by                     = Auth::user()->id;
                $requisition->status                           = 1;
                $status     =  $requisition->save();
            } else {
                $requisition = new InventoryRequisition();
                $requisition->requisition_prefix               = $prefix->prefix;
                $requisition->stock_room                       = $request->stockroom;
                $requisition->date                             = $request->date;
                $requisition->checked_by                       = $request->checked_by;
                $requisition->requested_by                     = $request->requested_by;
                $requisition->genarated_by                     = Auth::user()->id;
                $requisition->status                           = 3;
                $status     =  $requisition->save();
            }

            foreach ($request->item as $key => $items) {
                $requisition_details = new InventoryRequisitionDetail();
                $requisition_details->requisition_id              = $requisition->id;
                $requisition_details->item_id                     = $request->item[$key];
                $requisition_details->unit_id                     = $request->unit[$key];
                $requisition_details->quantity                    = $request->qty[$key];
                $status = $requisition_details->save();
            }


            if ($permission == 'yes') {
                foreach ($request->permission_authority as $key => $permission_authority) {
                    $permission = new InventoryPermissionAuthority();
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
                return redirect()->route('all-inventory-requisition-listing')->with('success', 'Requisition Added Sucessfully');
            } else {
                return redirect()->route('all-inventory-requisition-listing')->with('error', "Something Went Wrong");
            }
        } catch (\Throwable $th) {
            return redirect()->route('all-inventory-requisition-listing')->with('error', "Something Went Wrong");
        }
    }

    public function all_inventory_requisition_details($id)
    {
        //    dd($id);
        $requisition_details = InventoryRequisition::where('id', $id)->first();

        $permisison_users = InventoryPermissionAuthority::where('requisition_id', $id)->get();
        // dd($permisison_users);

        // $permisison_users = Requisition_permission::select('requisition_permissions.status', 'requisition_permissions.date', 'requisition_permissions.comment', 'users.name', 'requisition_permissions.user_id', 'requisition_permissions.permission_type as permission_type_user_all')->join('users', 'users.id', '=', 'requisition_permissions.user_id')->where('requisition_permissions.requisitions_id', $id)->get();


        $permisison_users_vendor = InventoryVendorPermission::where('req_id', $id)->get();
        $requisition_requested_by = User::select('users.first_name', 'users.last_name')->where('id', $requisition_details->requested_by)->first();
        $permisison_status_own_vendor = InventoryVendorPermission::select('status', 'comment')
            ->where('req_id', $id)
            ->where('user_id', Auth::id())
            ->first();
        $permisison_status_own = InventoryPermissionAuthority::where('requisition_id', $id)
            ->where('user_id', Auth::id())
            ->first();
        $vendor_details =  DB::table('inventory_vendors')
            ->select('inventory_vendors.id', 'inventory_vendors.vendor_name', 'inventory_vendors.vendor_address', 'inventory_vendors.vendor_gst')
            ->whereNotIn('inventory_vendors.id', function ($query) use ($id) {
                $query->select('inventory_vendor_quatations.vendor_id')
                    ->from('inventory_vendor_quatations')
                    ->where('inventory_vendor_quatations.req_id', $id);
            })
            ->get();
        $sl_vender = InventoryVendorQuatation::where('req_id', $id)->get();
        $user_list = User::all();
        $show_for_permission = InventoryPermissionAuthority::where('requisition_id', $id)
            ->where('permission_type', 'Sequential')
            ->where('status', 'Pending')->orWhere('status', 'Need Clarification')
            ->orWhere('status', 'Rejected')
            ->first();
        $vendor_selected_quataion = InventoryVendorQuatation::where('req_id', $id)->where('status', 1)->get();
        $requisition_item = InventoryRequisitionDetail::where('requisition_id', $id)->get();

        $requisition_item = InventoryRequisitionDetail::select('inventory_requisition_details.id as requisition_details_id', 'inventory_requisition_details.quantity', 'items.item_name', 'items.product_code', 'items.item_description', 'item_units.units', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'inventory_requisition_details.po_status', 'inventory_requisition_details.unit_id as item_unit_id')
            ->join('items', 'items.id', '=', 'inventory_requisition_details.item_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_requisition_details.unit_id')
            ->join('item_brands', 'item_brands.id', '=', 'items.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'items.manufacture')
            ->where('requisition_id', $id)
            ->get();

        return view('Inventory.requisition.inventory-requisition-details', compact('requisition_details', 'permisison_users', 'permisison_users_vendor', 'permisison_status_own', 'vendor_details', 'sl_vender', 'user_list', 'show_for_permission', 'permisison_status_own_vendor', 'vendor_selected_quataion', 'requisition_item', 'requisition_requested_by'));
    }

    public function add_inventory_vender_for_quatation(Request $req)
    {
        $requatation_id = $req->post('req_id');
        $vandor_id = $req->post('vendor_name');

        $general_details = DB::table('general_settings')->first();

        $requisition_details = InventoryRequisition::where('inventory_requisitions.id', $requatation_id)
            ->first();

        $requisition_requested_by = User::select('users.first_name', 'users.last_name')->where('id', $requisition_details->requested_by)->first();

        $requisition_item = InventoryRequisitionDetail::select('inventory_requisition_details.id as requisition_details_id', 'inventory_requisition_details.quantity', 'items.item_name', 'items.product_code', 'items.item_description', 'item_units.units', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'inventory_requisition_details.po_status')
            ->join('items', 'items.id', '=', 'inventory_requisition_details.item_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_requisition_details.unit_id')
            ->join('item_brands', 'item_brands.id', '=', 'items.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'items.manufacture')
            ->where('requisition_id', $requatation_id)
            ->get();

        $vendor_selected_quataion = InventoryVendorQuatation::where('req_id', $requatation_id)
            ->where('status', 1)
            ->get();

        $pdf = PDF::loadView('Inventory.requisition._print._printInventoryReq', compact('requisition_details', 'requisition_requested_by', 'requisition_item', 'vendor_selected_quataion'));

        $req->validate([
            'vendor_name' => 'required',
        ]);

        $no_of = count($req->post('vendor_name'));

        for ($j = 0; $j < $no_of; $j++) {

            $data = array(
                'req_id' => $requatation_id,
                'vendor_id' => $vandor_id[$j],
                'vendor_quatation' => '',
                'status' => 0,
            );
            InventoryVendorQuatation::insertGetId($data);
            //tithi

            $vendor_email = InventoryVendor::select('inventory_vendors.email')->where('id', $vandor_id[$j])->first();

            $content = $pdf->download()->getOriginalContent();
            Storage::put('inventory-req/' . $requatation_id . $vandor_id[$j] . '.pdf', $content);
            /*=================================Mail function=========================*/

            Mail::send('mail.inventory-req', ['req_id' => $requatation_id, 'vandor_id' => $vandor_id[$j]], function ($message) use ($general_details, $vendor_email) {
                $message->from($general_details->email);
                $message->to($vendor_email->email);
                $message->subject('Feedback');
            });
            /*=======================================================================*/
        }

        $res = InventoryRequisition::where('id', $requatation_id)->where('status', '<', '4')->update(['status' => 4]);

        if ($res == true) {
            return redirect()->route('all-inventory-requisition-details', ['id' => ($requatation_id)])->with('success', 'Vendor Added Successfully.');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function add_inventory_vendor_permission(Request $req)
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

            $user_details = DB::table('users')->first();

            InventoryVendorPermission::insertGetId($data);
            $link =  URL::to('/all-inventory-requisition-details/' . $req->post('req_id'));
            $general_details = DB::table('general_settings')->first();
            //tithi
            /*=================================Mail function=========================*/

            Mail::send('mail.permission_for_vender_approval_inventory', ['link' => $link], function ($message) use ($general_details, $user_details) {
                $message->from($general_details->email);
                $message->to($user_details->email);
                $message->subject('Feedback');
            });
            /*=======================================================================*/
        }

        $res = InventoryRequisition::where('id', $req->post('req_id'))->update(['status' => 6]);

        if ($res == true) {
            return redirect()->route('all-inventory-requisition-details', ['id' => ($req->post('req_id'))])->with('success', 'Successfully Send for Permission');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function given_approval_inventory(Request $req)
    {
        $general_details = DB::table('general_settings')->first();

        $permission_type = InventoryPermissionAuthority::select('permission_type')->where('requisition_id', $req->post('requisition_id'))->first();

        if ($permission_type->permission_type == 'Parallal') {

            $no_of_user_permission = InventoryPermissionAuthority::where('requisition_id', $req->post('requisition_id'))->count();


            $subhendu = $no_of_user_permission * ($general_details->req_permission_percentage / 100);


            $validator = $req->validate([
                'permission' => 'required',
            ]);


            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = InventoryPermissionAuthority::where('requisition_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $no_of_user_permission_given_approve = InventoryPermissionAuthority::where('requisition_id', $req->post('requisition_id'))->where('status', 'Approved')->count();

            $no_of_user_permission_given_reject = InventoryPermissionAuthority::where('requisition_id', $req->post('requisition_id'))->where('status', 'Rejected')->count();

            if ($no_of_user_permission_given_reject >= 1) {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 2]);
            }

            if ($no_of_user_permission_given_reject < 1 && $no_of_user_permission_given_approve >= $subhendu) {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 3]);
            }

            if ($status == 'Need Clarification' || $status == 'Pending') {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 1]);
            }
        } else {
            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = InventoryPermissionAuthority::where('requisition_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $permission = InventoryPermissionAuthority::select('permission_type', 'status')->where('requisition_id', $req->post('requisition_id'))->orderBy('id', 'DESC')->first();

            if ($permission->status == 'Approved') {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 3]);
            } elseif ($permission->status == 'Rejected') {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 2]);
            } else {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 1]);
            }
        }


        if ($data == true) {
            return redirect()->route('all-inventory-requisition-details', ['id' => ($requisition_id)])->with('success', 'Requisition Status Changed Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Changed, Try Again Later.']);
        }
    }

    public function give_approval_vendor_in_inventory(Request $req)
    {

        $general_details = DB::table('general_settings')->first();
        $permission_type = InventoryVendorPermission::select('permission_type')->where('req_id', $req->post('requisition_id'))->first();

        if ($permission_type->permission_type == 'Parallal') {

            $no_of_user_permission = InventoryVendorPermission::where('req_id', $req->post('requisition_id'))->count();

            $subhendu = $no_of_user_permission * ($general_details->req_permission_percentage / 100);

            $validator = $req->validate([
                'permission' => 'required',
            ]);

            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = InventoryVendorPermission::where('req_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $no_of_user_permission_given_approve = InventoryVendorPermission::where('req_id', $req->post('requisition_id'))->where('status', 'Approved')->count();

            $no_of_user_permission_given_reject = InventoryVendorPermission::where('req_id', $req->post('requisition_id'))->where('status', 'Rejected')->count();
            // dd($subhendu);

            if ($no_of_user_permission_given_reject >= 1) {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 8]);
            }

            if ($no_of_user_permission_given_reject < 1 && $no_of_user_permission_given_approve >= $subhendu) {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 9]);
            }

            if ($status == 'Need Clarification' || $status == 'Pending') {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 7]);
            }
        } else {
            $requisition_id = $req->post('requisition_id');
            $user_id = Auth::id();
            $date = date('Y-m-d h:m:s');

            $status = $req->post('permission');

            $data = InventoryVendorPermission::where('req_id', $requisition_id)->where('user_id', $user_id)->update(['date' => $date, 'status' => $req->post('permission'), 'comment' => $req->post('comment')]);

            $permission = InventoryVendorPermission::select('permission_type', 'status')->where('req_id', $req->post('requisition_id'))->orderBy('id', 'DESC')->first();

            if ($permission->status == 'Approved') {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 9]);
            } elseif ($permission->status == 'Rejected') {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 8]);
            } else {
                InventoryRequisition::where('id', $requisition_id)->update(['status' => 7]);
            }
        }


        if ($data == true) {
            return redirect()->route('all-inventory-requisition-details', ['id' => ($requisition_id)])->with('success', 'Requisition Status Changed Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Changed, Try Again Later.']);
        }
    }
    public function vendor_quatation_in_inventory(Request $req)
    {
        $req_id = $req->post('req_id');
        $vendor_id = $req->post('vender_name');
        if ($req->hasfile('vendor_quatation')) {

            $file = $req->file('vendor_quatation');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/inventory-quatation/", $filename);
        }

        $res = InventoryVendorQuatation::where('req_id', $req_id)->where('vendor_id', $vendor_id)->update(['vendor_quatation' => $filename]);

        if ($res == true) {
            return redirect()->route('all-inventory-requisition-details', ['id' => ($req->post('req_id'))])->with('success', 'Vendor Quatation Added Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Added Quatation, Try Again Later.']);
        }
    }
    public function vendor_select_for_po_in_inventory(Request $req)
    {
        $vendor_id = $req->post('vendor_id');
        $quatation_item = $req->post('item_quataion');
        $status = $req->post('selection');
        $req_id = $req->post('req_no');
        $comment = $req->post('note');
        $res =  InventoryVendorQuatation::where('req_id', $req_id)->where('vendor_id', $vendor_id)->update(['quatation_item' => $quatation_item, 'status' => $status, 'comment' => $comment]);
        if ($status == 1) {
            InventoryRequisition::where('id', $req_id)->update(['status' => 5]);
        }

        if ($res == true) {

            return redirect()->route('all-inventory-requisition-details', ['id' => ($req_id)])->with('success', 'Vendor Quatation Status Changed Successfully');
        } else {
            return back()->withErrors(['error' => 'Unable to Select Quatation, Try Again Later.']);
        }
    }
}
