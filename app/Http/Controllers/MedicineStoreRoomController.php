<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MedicineStoreRoom;
use Illuminate\Http\Request;

class MedicineStoreRoomController extends Controller
{
    public function medicine_store_room_listing()
    {
        $allStoreRoom = MedicineStoreRoom::all();

        return view('setup.pharmacy.store-room.store-room-listing', compact('allStoreRoom'));
    }

    public function save_medicine_store_room(Request $request)
    {
        $validate = $request->validate([
            'name'       => 'required',
            'address'    => 'required',
        ]);

        $status = MedicineStoreRoom::insert([
            'name'       => $request->name,
            'address'    => $request->address,
            'desc'       => $request->desc,
            'is_active'  => 1,
        ]);

        if ($status) {
            return back()->with('success', "Store Room Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete_medicine_store_room(Request $request)
    {
        $allStoreRoom = MedicineStoreRoom::find($request->store_room_id);
        $allStoreRoom->delete();
        return redirect()->route('medicine-store-room-details')->with('success', 'Store Room Removed Successfully');
    }

    public function edit_medicine_store_room($id)
    {
        $allStoreRoom = MedicineStoreRoom::all();
        $editStoreRoom = MedicineStoreRoom::find(base64_decode($id));

        return view('setup.pharmacy.store-room.edit-store-room', compact('allStoreRoom', 'editStoreRoom'));
    }

    public function update_medicine_store_room(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $Workshop = MedicineStoreRoom::find($request->store_room_id);

        $Workshop->name         = $request->name;
        $Workshop->address      = $request->address;
        $Workshop->desc         = $request->desc;
        $status = $Workshop->save();

        if ($status) {
            return redirect()->route('medicine-store-room-details')->with('success', 'Store Room Edited Sucessfully');
        } else {
            return redirect()->route('medicine-store-room-details')->with('error', "Something Went Wrong");
        }
    }
}
