<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemAttribute;
use App\Models\ItemAttributeValue;
use App\Models\ItemCatagory;
use App\Models\ItemType;
use App\Models\Manufacture;
use App\Models\UnitOfItem;
use App\Models\ItemBrand;
use App\Models\ItemUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validator;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function item_list()
    {
        $items = Item::where('is_active', '1')->get();

        return view('setup.Inventory.item.item-listing', compact('items'));
    }

    public function add_item_list()
    {
        $item_type          = ItemType::all();
        $item_category      = ItemCatagory::all();
        $item_attribute     = ItemAttribute::all();
        $manufacturer       = Manufacture::all();
        $brand              = ItemBrand::all();
        $units              = ItemUnit::all();
        return view('setup.Inventory.item.add-item', compact('item_category', 'item_type', 'item_attribute', 'manufacturer', 'brand', 'units'));
    }

    public function save_item_list(Request $req)
    {
        $req->validate([
            'item_type_id' => 'required',
            'item_categoris' => 'required',
            'item_name' => 'required',
            'loworder_level' => 'required',
            'hsn_or_sac_no' => 'required',
            'item_pic' => 'max:2048',
            'manufacturer' => 'required',
            'part_no' => 'required|unique:items',

        ]);

        // try {
        //     DB::beginTransaction();

        $item_description = "";
        if (isset($req->item_attribute)) {
            for ($i = 0; $i < count($req->item_attribute); $i++) {

                $item_description =  $item_description . $req->item_attribute[$i] . ':' . $req->attribute_value[$i] . ',';
            }
        }

        $itemCategoris = "";
        if (isset($req->item_categoris)) {
            for ($i = 0; $i < count($req->item_categoris); $i++) {

                $itemCategoris =  $itemCategoris . $req->item_categoris[$i] . ',';
            }
        }

        $filename = '';
        if ($req->hasfile('item_pic')) {
            $file = $req->file('item_pic');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/item_picture/", $filename);
        }


        $item = new Item();
        $item->item_type_id = $req->item_type_id;
        $item->item_name = $req->item_name;
        $item->part_no = $req->part_no;
        $item->item_catagory_id = $itemCategoris;
        $item->loworder_level = $req->loworder_level;
        $item->item_description = $item_description;
        $item->hsn_or_sac_no = $req->hsn_or_sac_no;
        $item->product_code = $req->product_code;
        $item->stored = $req->stored;
        $item->item_picture = $filename;
        $item->uses = $req->uses;
        $item->brand_id = $req->brand_id;
        $item->unit_id = $req->unit;
        $item->manufacture = $req->manufacturer;
        $item->created_by = Auth::user()->id;
        $item->updated_by = 0;

        $item->save();
        $item_id = $item->id;
        if (isset($req->item_attribute)) {
            for ($j = 0; $j < count($req->item_attribute); $j++) {

                $attr = new ItemAttributeValue();
                $attr->item_id = $item_id;
                $attr->attribute_name = $req->item_attribute[$j];
                $attr->attribute_value = $req->attribute_value[$j];
                $attr->created_by = Auth::id();
                $attr->updated_by =  Auth::id();
                $attr->save();
            }
        }

        // for ($i = 0; $i < count($req->unit); $i++) {

        //     $unit = new UnitOfItem();
        //     $unit->item_id =  $item_id;
        //     $unit->unit_id = $req->unit[$i];
        //     $unit->save();
        // }

        DB::commit();
        $req->session()->flash('success', 'Added Successfully.');
        return redirect()->route('inventory-item-list');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return back()->withErrors(['error' => $th->getMessage()]);
        // }
    }

    public function edit_item_list($id)
    {
        $id = base64_decode($id);
        $item_attribute = ItemAttribute::all();
        $item = Item::find($id);
        $item_unit = UnitOfItem::where('item_id', $id)->get();
        $item_description = ItemAttributeValue::where('item_id', $id)->get();
        $item_category = ItemCatagory::all();
        $item_type = ItemType::all();
        $brand = ItemBrand::all();
        $manufacturer = Manufacture::all();
        $cate =  explode(',', $item->item_catagory_id);
        $units              = ItemUnit::all();

        return view('setup.Inventory.item.edit-item', compact('item', 'item_type', 'brand', 'manufacturer',  'item_attribute', 'item_description', 'item_category', 'cate', 'units', 'item_unit'));
    }

    public function update_item_list(Request $req)
    {

        $req->validate([
            'brand_id' => 'required',
            'manufacturer' => 'required',
            'item_name' => 'required',
            'item_categoris' => 'required',
            'part_no' => ['required', Rule::unique('items')->ignore($req->id)],
            'item_type_id' => 'required',
            'loworder_level' => 'required',
            'item_pic' => 'max:2048',
            'hsn_or_sac_no' => 'required',
            'product_code' => 'required',

        ]);

        ItemAttributeValue::where('item_id', $req->id)->delete();

        $item_description = "";
        for ($i = 0; $i < count($req->item_attribute); $i++) {

            $item_description =  $item_description . $req->item_attribute[$i] . ':' . $req->attribute_value[$i] . ',';
        }
        $itemCategoris = "";
        if (isset($req->item_categoris)) {
            for ($i = 0; $i < count($req->item_categoris); $i++) {

                $itemCategoris =  $itemCategoris . $req->item_categoris[$i] . ',';
            }
        }
        $item_pic_d = Item::where('id', $req->id)->first();
        if ($req->hasfile('item_pic')) {
            $file = $req->file('item_pic');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move("public/item_picture/", $filename);
        } else {
            $filename = $item_pic_d->item_picture;
        }

        $item = Item::find($req->id);
        $item->item_name        = $req->item_name;
        $item->item_type_id     = $req->item_type_id;
        $item->loworder_level   = $req->loworder_level;
        $item->item_catagory_id = $itemCategoris;
        $item->part_no          = $req->part_no;
        $item->stored           = $req->stored;
        $item->uses             = $req->uses;
        $item->item_picture     = $filename;
        $item->hsn_or_sac_no    = $req->hsn_or_sac_no;
        $item->product_code     = $req->product_code;
        $item->item_description = $item_description;
        $item->brand_id         = $req->brand_id;
        $item->unit_id          = $req->unit;
        $item->manufacture     = $req->manufacturer;

        $item->save();
        $it_id = $item->id;

        for ($j = 0; $j < count($req->item_attribute); $j++) {

            $attr = new ItemAttributeValue();
            $attr->item_id = $it_id;
            $attr->attribute_name = $req->item_attribute[$j];
            $attr->attribute_value = $req->attribute_value[$j];
            $attr->created_by = Auth::id();
            $attr->updated_by =  Auth::id();
            $attr->save();
        }


        if ($it_id != null) {
            $req->session()->flash('success', 'Updated Successfully.');
            return redirect()->route('inventory-item-list');
        } else {
            return back()->withErrors(['error' => 'Unable to added, Try Again Later.']);
        }
    }

    public function delete_item_list($id)
    {
        $id = base64_decode($id);
        Item::find($id)->update(['is_active' => '0']);

        return back()->with('success', "Item Deleted Successfully");
    }
}
