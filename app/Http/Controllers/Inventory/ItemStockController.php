<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Inventory\InventoryItemIssue;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemStoreRoom;
use App\Models\Inventory\InventoryRequisition;
use App\Models\User;
use App\Models\Prefix;
use App\Models\ItemType;
use Auth;
use DB;
use App\Models\Inventory\InventoryItemStock;
use App\Models\Inventory\InventoryItemIssueDetail;
use App\Models\ItemCatagory;
use Google\Service\CloudAsset\Inventory;
use Google\Service\Dfareporting\InventoryItem;
use Google\Service\Dfareporting\Resource\InventoryItems;

class ItemStockController extends Controller
{
    public function item_stock_details()
    {
        $item_stock_list = Item::all();

        $workshops = ItemStoreRoom::all();
    
        return view('Inventory.item-stock-details', compact('workshops', 'item_stock_list'));
    }

    public function index()
    {
        $item_issue_list = InventoryItemIssue::all();


        return view('Inventory.item-issue.item-issue-list', compact('item_issue_list'));
    }

    public function add_item_issue()
    {
        $request_list = InventoryRequisition::where('is_delete', '0')->get();
        $workshop_list = ItemStoreRoom::where('is_active', '1')->get();
        $user_list = User::select('users.id', 'users.first_name', 'users.last_name')->get();
        $issue_by = User::where('role', 'inventory')->get();
        $item_type_list = ItemType::get();
        $department = Department::where('is_active', '1')->get();

        return view('Inventory.item-issue.add-item-issue', compact('user_list', 'workshop_list',  'item_type_list', 'request_list', 'issue_by', 'department'));
    }
    public function save_item_issue(Request $request)
    {
        // try {
        //     DB::beginTransaction();

        $validate = $request->validate([
            'issue_date'                      => 'required',

        ]);
        $prefix = Prefix::where('name', 'item_issue')->first();

        $issue_item = new InventoryItemIssue();
        $issue_item->issue_prefix               = $prefix->prefix;
        $issue_item->stock_room_id              = $request->workshop_id;
        $issue_item->department_id              = $request->department;
        $issue_item->issue_date                 = $request->issue_date;
        $issue_item->issued_by                  = $request->issue_by;
        $issue_item->issued_to                   = $request->issue_to;
        $issue_item->generated_by                = Auth::user()->id;
        $issue_item->note                         = $request->note;
        $issue_item->is_delete                     = '0';
        $issue_item->save();

        foreach ($request->item as $key => $items) {
            $issue_item_details = new InventoryItemIssueDetail();
            $issue_item_details->issue_id                    = $issue_item->id;
            $issue_item_details->item_id                     = $request->item[$key];
            $issue_item_details->unit_id                     = $request->unit[$key];
            $issue_item_details->quantity                    = $request->qty[$key];
            $status = $issue_item_details->save();
        }


        DB::commit();

        if ($status) {
            return redirect()->route('item-issue-listing-inventory')->with('success', 'Item Issue Added Sucessfully');
        } else {
            return redirect()->route('item-issue-listing-inventory')->with('error', "Something Went Wrong");
        }
        // } catch (\Throwable $th) {
        //     return redirect()->route('item-issue-listing-inventory')->with('error', "Something Went Wrong");
        // }
    }
    public function get_item_avi_qty(Request $req)
    {
        // dd($req->item_id); 8
        $item_id = $req->item_id;

        $stock_qty =  InventoryItemStock::where('item_id', $item_id)->sum('quantity');

        $issue_qty =  InventoryItemIssueDetail::where('item_id', $item_id)->sum('quantity');

        $avi_qty = $stock_qty - $issue_qty;
        // dd($avi_qty);

        return response()->json($avi_qty);
    }
    public function item_issue_details($issue_id)
    {
        $id = $issue_id;
        $item_issue = InventoryItemIssue::where('id', $id)->first();
        // dd($item_issue);

        $issue_item = InventoryItemIssueDetail::where('issue_id', $id)->get();

        return view('Inventory.item-issue.item-issue-details', compact('item_issue', 'issue_item'));
    }

    public function edit_item_issue($issue_id)
    {
        $id = base64_decode($issue_id);
        // dd($id);1
        $item_issue = InventoryItemIssue::where('id', $id)->first();
        // dd($item_issue);
        // $item_issue_details = InventoryItemIssueDetail::where('issue_id', $id)->get();

        $item_issue_details = InventoryItemIssueDetail::select('inventory_item_issue_details.id as inventory_requisition_details_id', 'inventory_item_issue_details.quantity', 'inventory_item_issue_details.item_id', 'items.item_name', 'items.product_code', 'items.item_description', 'item_units.units', 'item_brands.item_brand_name', 'manufactures.manufacture_name', 'item_types.id as item_type_id', 'items.id as item_id_no', 'item_types.item_type_name', 'inventory_item_issue_details.unit_id as item_unit_id', 'items.part_no')
            ->join('items', 'items.id', '=', 'inventory_item_issue_details.item_id')
            ->join('item_types', 'item_types.id', '=', 'items.item_type_id')
            ->join('item_units', 'item_units.id', '=', 'inventory_item_issue_details.unit_id')
            ->join('item_brands', 'item_brands.id', '=', 'items.brand_id')
            ->join('manufactures', 'manufactures.id', '=', 'items.manufacture')
            ->where('issue_id', $id)
            ->get();

        // dd($item_issue_details);
        $workshop_list = ItemStoreRoom::where('is_active', '1')->get();
        $user_list = User::select('users.id', 'users.first_name', 'users.last_name')->get();
        $item_type_list = ItemType::get();
        // dd($item_type_list);

        $department = Department::where('is_active', '1')->get();
        $issue_by = User::where('role', 'inventory')->get();
        return  view('Inventory.item-issue.edit-item-issue', compact('item_issue', 'workshop_list', 'user_list', 'item_issue_details', 'item_type_list', 'department', 'issue_by'));
    }

    public function update_item_issue(Request $request)
    {
        // try {
        //     DB::beginTransaction();

        $validate = $request->validate([
            'issue_date'                      => 'required',

        ]);
        $prefix = Prefix::where('name', 'item_issue')->first();

        $issue_item = InventoryItemIssue::where('id', $request->item_issue_id)->first();
        $issue_item->issue_prefix               = $prefix->prefix;
        $issue_item->stock_room_id              = $request->workshop_id;
        $issue_item->department_id              = $request->department;
        $issue_item->issue_date                 = $request->issue_date;
        $issue_item->issued_by                  = $request->issue_by;
        $issue_item->issued_to                   = $request->issue_to;
        $issue_item->generated_by                = Auth::user()->id;
        $issue_item->note                         = $request->note;
        $issue_item->is_delete                     = '0';
        $issue_item->save();


        InventoryItemIssueDetail::where('issue_id', $issue_item->id)->delete();

        foreach ($request->item as $key => $items) {
            $issue_item_details = new InventoryItemIssueDetail();
            $issue_item_details->issue_id                    = $issue_item->id;
            $issue_item_details->item_id                     = $request->item[$key];
            $issue_item_details->unit_id                     = $request->unit[$key];
            $issue_item_details->quantity                    = $request->qty[$key];
            $status = $issue_item_details->save();
        }


        DB::commit();

        if ($status) {
            return redirect()->route('item-issue-listing-inventory')->with('success', 'Item Issue Updated Sucessfully');
        } else {
            return redirect()->route('item-issue-listing-inventory')->with('error', "Something Went Wrong");
        }
        // } catch (\Throwable $th) {
        //     return redirect()->route('item-issue-listing-inventory')->with('error', "Something Went Wrong");
        // }
    }

    public function delete_item_issue($issue_id)
    {
        $id = base64_decode($issue_id);
        InventoryItemIssue::where('id', $id)->first()->delete();
        InventoryItemIssueDetail::where('issue_id', $id)->get()->delete();

        return redirect()->route('item-issue-listing-inventory')->with('success', 'Item Issue Deleted Sucessfully');
    }

    public function get_issue_to_by_department(Request $request)
    {
        $issue_to = User::where('department', $request->get_departement_id)->get();
        return response()->json($issue_to);
    }


    public function update_inventory_stock($item_id)
    {
        $item_details = Item::find($item_id);
        $item = Item::all();
        $store_room = ItemStoreRoom::all();
        $item_catagory = ItemCatagory::all();
        return view('Inventory.stock-update.update-stock-inventory', compact('item_details', 'item', 'store_room', 'item_catagory'));
    }

    public function save_update_inventory_stock(Request $request)
    {

        // $validate = $request->validate([
        //     'item_name'                 => 'required',
        //     'item_category'             => 'required',
        //     'stored_room'               => 'required',
        //     'part_no'                   => 'required',
        //     'quantity'                  => 'required',
        //     'purchase_price'            => 'required',
        //     'amount'                    => 'required',

        // ]);

        // try {
        //     DB::beginTransaction();
            $inventory_stock = new InventoryItemStock();
            $inventory_stock->grm_id         =  '';
            $inventory_stock->workshop_id =  $request->stored_room;
            $inventory_stock->catagory =  $request->item_catagory;
            $inventory_stock->unit_id =  $request->unit;
            $inventory_stock->item_id =  $request->item_name;
            $inventory_stock->part_no =  $request->part_no;
            $inventory_stock->quantity =  $request->quantity;
            $inventory_stock->rate =  $request->rate;
            $inventory_stock->discount =  $request->discount;
            $inventory_stock->p_rate =  $request->purchase_price;
            $inventory_stock->cgst =  $request->cgst;
            $inventory_stock->cgst_value =  $request->cgst_value;
            $inventory_stock->sgst =  $request->sgst;
            $inventory_stock->sgst_value =  $request->sgst_value;
            $inventory_stock->igst =  $request->igst;
            $inventory_stock->igst_value =  $request->igst_value;
            $inventory_stock->amount =  $request->amount;
            $inventory_stock->status =  'stock_update_direct';
            $status = $inventory_stock->save();

            DB::commit();
            if ($status) {
                return redirect()->route('item-stock-listing')->with('success', 'Stock Updated Sucessfully');
            } else {
                return redirect()->route('item-stock-listing')->with('error', "Something Went Wrong");
            }
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('item-stock-listing')->with('error', "Something Went Wrong");
        // }
    }
}
