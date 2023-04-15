<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use DB;

class SettingController extends Controller
{
    public function general_setting_details()
    {
       $general_details = GeneralSetting::first();
       return view('general_setting.general-setting',compact('general_details'));
    }

    public function save_general_setting(Request $req)
    {
        $validator = $req->validate([
            'software_name'=>'required',
        ]);
        $general_details = GeneralSetting::first();
        try
        {
        DB::beginTransaction();
        if($req->hasfile('logo'))
        {
            $file = $req->file('logo');
            $filename = rand().'.'.$file->getClientOriginalExtension();
            $file->move("public/assets/images/brand/",$filename);
        }
        else
        {
            $filename = $general_details->logo;
        }
        if($req->hasfile('small_logo'))
        {
            $file = $req->file('small_logo');
            $filename_small_logo = rand().'.'.$file->getClientOriginalExtension();
            $file->move("public/assets/images/brand/",$filename_small_logo);
        }
        else
        {
            $filename_small_logo = $general_details->small_logo;
        }

        $general_details = array(
            'software_name' =>$req->software_name,
            'email' =>$req->email,
            'address' =>$req->address,
            'hf_id' =>$req->hf_id,
            'hmis_id' =>$req->hmis_id,
            'phone_no' =>$req->phone_no,
            'logo' =>$filename,
            'small_logo' =>$filename_small_logo,
            'req_permission_percentage' =>$req->po_permission_percentage,
            'po_permission_percentage' =>$req->rfq_permission_percentage,
            'puc_alert_days' =>$req->puc_alert_days,
        );
        
        GeneralSetting::where('id',$req->id)->update($general_details);
        DB::commit();
        $req->session->flash('success','Setting Updated Successfully');
        return redirect('general_setting_details');
        }
        catch(\Throwable $th)
        {
           DB::rollback();
           return back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}

