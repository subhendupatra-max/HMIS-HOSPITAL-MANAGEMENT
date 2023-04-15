<?php

namespace App\Http\Controllers;

use App\Models\Prefix;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrefixController extends Controller
{
    public function prefixList()
    {
        $allPrefix = prefix::all();
        return view('setup.prefix.prefixList', compact('allPrefix'));
    }
    
    public function addPrefix(Request $request)
    {

        $validate = $request->validate([
            'prefix_name'=>'required|unique:prefixes,name,{{ $request->name }}',
            'prefix'=>'required|',
            'year'=>'required|numeric',
        ]);

        $status = prefix::insert([
                    'name'=>$request->prefix_name,
                    'prefix'=>$request->prefix,
                    'year'=>$request->year,
                ]);

        if($status){
            return back()->with('success',"Prefix Added Sucessfully")  ;
        }else{
            return back()->with('error' ,"Something Went Wrong");
        }
    }

    public function deletePrefix(Request $request)
    {
        $validate = $request->validate([
            'prefix_id'=>'required|',
        ]);

        $id = base64_decode($request->prefix_id);
        $prefix = prefix::find($id);
        $prefix->delete();
        return redirect()->route('prefixList')->with('success','Prefix Removed Successfully');
    }

    public function prefixEdit($id)
    {
        $allPrefix = prefix::all();
        $prefix = prefix::find(base64_decode($id));
        return view('setup.prefix.prefixEdit', compact('allPrefix', 'prefix'));
    }
    
    public function prefixEditAction(Request $request)
    { 
        $validate = $request->validate([
            'prefix_name'=>'required',
            'prefix'=>'required|',
            'year'=>'required|numeric',
            'item_unit_id'=>'required|numeric',
        ]);

        $prefix = prefix::find($request->item_unit_id);
        
        $prefix->name	 = $request->prefix_name;
        $prefix->prefix	 = $request->prefix ;
        $prefix->year	 = $request->year;

        $status = $prefix->save();

        if($status){
            return redirect()->route('prefixList')->with('success','prefix Date Edited Sucessfully');
        }else{
            return redirect()->route('prefixList')->with('error' ,"Something Went Wrong");
        }


    }

}
