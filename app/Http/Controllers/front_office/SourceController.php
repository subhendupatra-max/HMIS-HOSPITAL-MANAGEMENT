<?php

namespace App\Http\Controllers\front_office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\front_office\Source;

class SourceController extends Controller
{
    public function add_source_details()
    {
        $source = Source::all();
        return view('setup.front-office.source.add-source', compact('source'));
    }

    public function save_source_front_office(Request $request)
    {
        $request->validate([
            'source' => 'required',
        ]);

        $source = new Source();
        $source->source = $request->source;
        $source->description = $request->description;
        $status = $source->save();

        if ($status) {
            return back()->with('success', "Source Added Succesfully ");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_source_in_front_office($id)
    {
        $id = base64_decode($id);
        $source = Source::all();
        $editSource = Source::where('id', $id)->first();

        return view('setup.front-office.source.edit-source', compact('source', 'editSource'));
    }

    public function update_source_front_office(Request $request)
    {
        $request->validate([
            'source' => 'required',
        ]);

        $source = Source::where('id', $request->id)->first();
        $source->source = $request->source;
        $source->description = $request->description;
        $status = $source->save();

        if ($status) {
            return redirect()->route('add-source-in-front-office')->with('success', " Source Updated Successfully");
        } else {
            return redirect()->route('add-source-in-front-office')->with('error', "Something Went Wrong");
        }
    }

    public function delete_source_in_front_office($id)
    {
        $id = base64_decode($id);
        Source::where('id', $id)->first()->delete();

        return back()->with('success', "Source Deleted Successfully");
    }
}
