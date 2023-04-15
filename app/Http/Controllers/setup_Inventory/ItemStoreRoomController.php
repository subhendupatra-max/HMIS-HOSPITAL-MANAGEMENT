<?php

namespace App\Http\Controllers\setup_Inventory;

use App\Http\Controllers\Controller;
use App\Models\ItemStoreRoom;
use Illuminate\Http\Request;

class ItemStoreRoomController extends Controller
{
    public function item_item_store_room_details()
    {
        $itemStoreRoom = ItemStoreRoom::all();

        return view('setup.Inventory.item-store-room.item-store-room-details', compact('itemStoreRoom'));
    }

    public function save_item_item_store_room(Request $request)
    {
        $request->validate([
            'item_store_room' => 'required',
        ]);

        $status = ItemStoreRoom::Insert([
            'item_store_room' => $request->item_store_room,
        ]);

        if ($status) {
            return back()->with('success', "Item Store Room Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_item_item_store_room($id)
    {
        $id = base64_decode($id);
        $itemStoreRoom = ItemStoreRoom::all();
        $editItemStoreRoom = ItemStoreRoom::where('id', $id)->first();

        return view('setup.Inventory.item-store-room.edit-item-store-room', compact('itemStoreRoom', 'editItemStoreRoom'));
    }

    public function update_item_item_store_room(Request $request)
    {
        $request->validate([
            'item_store_room' => 'required',
        ]);

        $itemStoreRoom = ItemStoreRoom::find($request->id);
        $itemStoreRoom->item_store_room = $request->item_store_room;
        $status = $itemStoreRoom->save();

        if ($status) {
            return redirect()->route('add-inventory-item-store-room')->with('success', " Item Store Room Updated Successfully");
        } else {
            return redirect()->route('add-inventory-item-store-room')->with('error', "Something Went Wrong");
        }
    }

    public function delete_item_item_store_room($id)
    {
        $id = base64_decode($id);
        ItemStoreRoom::find($id)->delete();

        return back()->with('success', "Item Store Room Deleted Successfully");
    }
}
