<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\AllHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllHeaderController extends Controller
{
   
    public function all_header_listing()
    {
        $allheader = AllHeader::all();
        return view('setup.all-header.all-header-listing',compact('allheader'));
    }

    public function all_header_details($id , Request $request)
    {
       $id =base64_decode($id);
       $allheader = AllHeader::where('id','=',$id)->first();
       return view('setup.all-header.add-header',compact('allheader'));
    }

    public function save_all_header_details(Request $req)
    {
        $validator = $req->validate([
            'header_name'=>'required',
        ]);
        $all_headers = AllHeader::first();
        try
        {
        DB::beginTransaction();
        if($req->hasfile('logo'))
        {
            $file = $req->file('logo');
            $filename = rand().'.'.$file->getClientOriginalExtension();
            $file->move("public/assets/images/header/",$filename);
        }
        else
        {
            $filename = $all_headers->logo;
        }
       

        $all_headers = array(
            'header_name' =>$req->header_name,
            'logo' =>$filename,
            
        );
        
        AllHeader::where('id',$req->id)->update($all_headers);
        DB::commit();
        // $req->session->flash('success','All Header Updated Successfully');
        return redirect('all-header-listing');
        }
        catch(\Throwable $th)
        {
           DB::rollback();
           return back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
