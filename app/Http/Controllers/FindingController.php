<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FindingCategory;
use App\Models\Finding;

class FindingController extends Controller
{
    public function add()
    {
        $finding_category =  FindingCategory::get();
        return view('setup.finding.category.add', compact('finding_category'));
    }
    public function save(Request $request)
    {
        $validate = $request->validate([
            'category_name' => 'required',
        ]);

        $status = FindingCategory::insert([
            'category_name' => $request->category_name,
        ]);
        if ($status) {
            return back()->with('success', "Finding Category Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function delete($id)
    {
        $status = FindingCategory::where('id',$id)->delete();
        if ($status) {
            return back()->with('success', "Finding Category Deleted Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
    public function edit($id)
    {
        $finding_category_edit =  FindingCategory::find($id);
        $finding_category =  FindingCategory::get();
        return view('setup.finding.category.edit', compact('finding_category','finding_category_edit'));
    }
    public function update(Request $request)
    {
        $validate = $request->validate([
            'category_name' => 'required',
        ]);

        $status = FindingCategory::where('id',$request->id)->update([
            'category_name' => $request->category_name,
        ]);
        if ($status) {
            return redirect()->route('finding-category-add')->with('success', "Finding Category Updated Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function add_finding()
    {
        $finding =  Finding::get();
        $finding_category =  FindingCategory::get();
        return view('setup.finding.finding.add', compact('finding','finding_category'));
    }
    public function save_finding(Request $request)
    {
        $validate = $request->validate([
            'finding_name' => 'required',
            'finding_category' => 'required',
        ]);

        $status = Finding::insert([
            'finding_name' => $request->finding_name,
            'finding_category_id' => $request->finding_category,
            'description' => $request->description,
        ]);
        if ($status) {
            return back()->with('success', "Finding Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }
    public function delete_finding($id)
    {
        $status = Finding::where('id',$id)->delete();
        if ($status) {
            return back()->with('success', "Finding Deleted Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_finding($id)
    {
        $finding =  Finding::get();
        $finding_edit =  Finding::find($id);
        $finding_category =  FindingCategory::get();
        return view('setup.finding.finding.edit', compact('finding','finding_category','finding_edit'));
    }
    public function update_finding(Request $request)
    {
        $validate = $request->validate([
            'finding_name' => 'required',
            'finding_category' => 'required',
        ]);

        $status = Finding::where('id',$request->id)->update([
            'finding_name' => $request->finding_name,
            'finding_category_id' => $request->finding_category,
            'description' => $request->description,
        ]);
        if ($status) {
            return back()->with('success', "Finding Updated Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }


}
