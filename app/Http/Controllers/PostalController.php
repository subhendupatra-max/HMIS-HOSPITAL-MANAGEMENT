<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostalReceive;
use Illuminate\Http\Request;

class PostalController extends Controller
{
    public function all_postal_receive_listing()
    {
        $receive = PostalReceive::all();
        return view('front-office.postal.receive-postal-listing', compact('receive'));
    }

    public function add_postal_receive_details()
    {
        return view('front-office.postal.add-receive-postal');
    }

    public function save_postal_receive_details(Request $request)
    {

        $request->validate([
            'from_title'              => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/postal-receive/", $filename);
        }

        $receive = new PostalReceive();
        $receive->from_title                     = $request->from_title;
        $receive->reference_no                   = $request->reference_no;
        $receive->date                           = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $receive->address                        = $request->address;
        $receive->note                           = $request->note;
        $receive->to_title                       = $request->to_title;
        $receive->attach_document                = $filename;

        $status = $receive->save();

        if ($status) {
            return redirect()->route('all-postal-receive-details')->with('success', " Receive Added Successfully");
        } else {
            return redirect()->route('all-postal-receive-details')->with('error', " Something Went Wrong");
        }
    }

    public function edit_postal_receive_details($id)
    {
        $editReceive = PostalReceive::where('id', $id)->first();

        return view('front-office.postal.edit-receive-postal', compact('editReceive'));
    }

    public function update_postal_receive_details(Request $request)
    {
        $request->validate([
            'from_title'              => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/postal-receive/", $filename);
        }

        $receive = PostalReceive::find($request->id);
        $receive->from_title                     = $request->from_title;
        $receive->reference_no                   = $request->reference_no;
        $receive->date                           = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $receive->address                        = $request->address;
        $receive->note                           = $request->note;
        $receive->to_title                       = $request->to_title;
        $receive->attach_document                = $filename;

        $status = $receive->save();

        if ($status) {
            return redirect()->route('all-postal-receive-details')->with('success', " Receive Updated Successfully");
        } else {
            return redirect()->route('all-postal-receive-details')->with('error', " Something Went Wrong");
        }
    }

    public function delete_postal_receive_details($id)
    {
        PostalReceive::find($id)->delete();
        return back()->with('success', "Receive Deleted Successfully");
    }
}
