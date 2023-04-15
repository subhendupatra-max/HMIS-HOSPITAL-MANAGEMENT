<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    public function all_postal_dispatch_listing()
    {
        $dispatch = Dispatch::all();
        return view('front-office.dispatch.dispatch-listing', compact('dispatch'));
    }

    public function add_postal_dispatch_details()
    {
        return view('front-office.dispatch.add-dispatch');
    }

    public function save_postal_dispatch_details(Request $request)
    {

        $request->validate([
            'from_title'              => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/postal-dispatch/", $filename);
        }

        $receive = new Dispatch();
        $receive->from_title                     = $request->from_title;
        $receive->reference_no                   = $request->reference_no;
        $receive->date                           = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $receive->address                        = $request->address;
        $receive->note                           = $request->note;
        $receive->to_title                       = $request->to_title;
        $receive->attach_document                = $filename;

        $status = $receive->save();

        if ($status) {
            return redirect()->route('all-postal-dispatch-details')->with('success', " Dispatch Added Successfully");
        } else {
            return redirect()->route('all-postal-dispatch-details')->with('error', " Something Went Wrong");
        }
    }

    public function edit_postal_dispatch_details($id)
    {
        $editDispatch = Dispatch::where('id', $id)->first();

        return view('front-office.dispatch.edit-dispatch', compact('editDispatch'));
    }

    public function update_postal_dispatch_details(Request $request)
    {
        $request->validate([
            'from_title'              => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/postal-dispatch/", $filename);
        }

        $dispatch = Dispatch::find($request->id);
        $dispatch->from_title                     = $request->from_title;
        $dispatch->reference_no                   = $request->reference_no;
        $dispatch->date                           = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $dispatch->address                        = $request->address;
        $dispatch->note                           = $request->note;
        $dispatch->to_title                       = $request->to_title;
        $dispatch->attach_document                = $filename;

        $status = $dispatch->save();

        if ($status) {
            return redirect()->route('all-postal-dispatch-details')->with('success', " Dispatch Updated Successfully");
        } else {
            return redirect()->route('all-postal-dispatch-details')->with('error', " Something Went Wrong");
        }
    }

    public function delete_postal_dispatch_details($id)
    {
        Dispatch::find($id)->delete();
        return back()->with('success', "Dispatch Deleted Successfully");
    }
}
