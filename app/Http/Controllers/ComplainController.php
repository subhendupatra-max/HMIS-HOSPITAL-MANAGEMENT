<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use Illuminate\Http\Request;


class ComplainController extends Controller
{
    public function all_complain_listing()
    {
        $complain = Complain::all();
        return view('front-office.complain.complain-listing', compact('complain'));
    }

    public function add_complain_details()
    {
        return view('front-office.complain.add-complain');
    }

    public function save_complain_details(Request $request)
    {

        $request->validate([
            'complain_type'              => 'required',
            'complain_by'                => 'required',
            'phone'                      => 'required',
            'source'                     => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/complains/", $filename);
        }

        $complain = new Complain();
        $complain->complain_type                  = $request->complain_type;
        $complain->source                         = $request->source;
        $complain->date                           = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $complain->complain_by                    = $request->complain_by;
        $complain->phone                          = $request->phone;
        $complain->description                    = $request->description;
        $complain->action_taken                   = $request->action_taken;
        $complain->assigned                       = $request->assigned;
        $complain->attach_document                = $filename;
        $complain->note                           = $request->note;
        $status = $complain->save();

        if ($status) {
            return redirect()->route('all-complain-details')->with('success', " Complain Added Successfully");
        } else {
            return redirect()->route('all-complain-details')->with('error', " Something Went Wrong");
        }
    }

    public function edit_complain_details($id)
    {
        $editComplain = Complain::where('id', $id)->first();

        return view('front-office.complain.edit-complain', compact('editComplain'));
    }

    public function update_complain_details(Request $request)
    {
        $request->validate([
            'complain_type'              => 'required',
            'complain_by'                => 'required',
            'phone'                      => 'required',
            'source'                     => 'required',
        ]);

        $filename = '';
        if ($request->hasfile('attach_document')) {
            $file = $request->file('attach_document');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $fileSave =  $file->move("public/assets/images/complains/", $filename);
        }

        $complain = Complain::find($request->id);
        $complain->complain_type                  = $request->complain_type;
        $complain->source                         = $request->source;
        $complain->date                           = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $complain->complain_by                    = $request->complain_by;
        $complain->phone                          = $request->phone;
        $complain->description                    = $request->description;
        $complain->action_taken                   = $request->action_taken;
        $complain->assigned                       = $request->assigned;
        $complain->attach_document                = $filename;
        $complain->note                           = $request->note;
        $status = $complain->save();

        if ($status) {
            return redirect()->route('all-complain-details')->with('success', " Complain Updated Successfully");
        } else {
            return redirect()->route('all-complain-details')->with('error', " Something Went Wrong");
        }
    }

    public function delete_complain_details($id)
    {
        Complain::find($id)->delete();
        return back()->with('success', "Complain Deleted Successfully");
    }
}
