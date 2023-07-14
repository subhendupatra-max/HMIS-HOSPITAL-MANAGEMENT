<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HouseKeepingWork;
use App\Models\HouseKeepingUser;
use DB;

class HouseKeepingController extends Controller
{
    public function work_list()
    {
        $house_keeping_work = HouseKeepingWork::get();
        $user_list = User::where('role','House-Keeping')->get();
        return view('house-keeping.work-list',compact('house_keeping_work','user_list'));
    }
    public function add_new_house_keeping_working()
    {
        $assign_keeper = User::where('role','House-Keeping')->get();
        return view('house-keeping.add-new-work',compact('assign_keeper'));
    }
    public function save_new_work(Request $request)
    {
        // try {
        //     DB::beginTransaction();
            $validator = $request->validate([
                'work_details' => 'required',
                'date' => 'required',
                'assign_house_keeper' => 'required',
            ]);

            $house_keeping_work = new HouseKeepingWork();
            $house_keeping_work->working_details = $request->work_details;
            $house_keeping_work->date = $request->date;
            $house_keeping_work->status = 'incomplete';
            $house_keeping_work->save();

            foreach($request->assign_house_keeper as $key=>$value)
            {
                $house_keeping_user = new HouseKeepingUser();
                $house_keeping_user->user_id = $value;
                $house_keeping_user->house_keeping_id = $house_keeping_work->id;
                $house_keeping_user->save();
            }
          //  DB::commit();
            return redirect()->route('house-keeping')->with('success', "New work Added Successfully");
            
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', "Something Went Wrong");
        // }
        }
        public function assign_house_keeper(Request $request)
        {
            foreach($request->house_keeper as $key=>$value)
            {
                $house_keeping_user = new HouseKeepingUser();
                $house_keeping_user->user_id = $value;
                $house_keeping_user->house_keeping_id = $request->work_id;
                $house_keeping_user->save();
            }
            return redirect()->route('house-keeping')->with('success', "House keeper Added Successfully");
        }
        public function change_status_houseing_allowence($status,$work_id)
        {
            try {
            DB::beginTransaction();
            $house_keeping_work = HouseKeepingWork::where('id',$work_id)->first();
            $house_keeping_work->status = $status;
            $house_keeping_work->save();
            DB::commit();
            return redirect()->route('house-keeping')->with('success', "Status Change Successfully");
            } catch (\Throwable $th) {
                DB::rollback();
                return back()->withErrors(['error' => $th->getMessage()]);
            }

        }
        public function edit_new_house_keeping_working($id)
        {
            $work_id = base64_decode($id);
            $house_keeping_work = HouseKeepingWork::where('id',$work_id)->first();
            $house_keeping_user = HouseKeepingUser::where('house_keeping_id',$work_id)->get();
            $assign_keeper = User::where('role','House-Keeping')->get();
            return view('house-keeping.edit-new-work',compact('assign_keeper','house_keeping_user','house_keeping_work','work_id'));

        }
        public function update_new_work(Request $request)
        {
            $house_keeping_work = HouseKeepingWork::where('id',$request->work_id)->first();
            $house_keeping_work->working_details = $request->work_details;
            $house_keeping_work->date = $request->date;
            $house_keeping_work->save();

            HouseKeepingUser::where('house_keeping_id',$request->work_id)->delete();
            foreach($request->assign_house_keeper as $key=>$value)
            {
                $house_keeping_user = new HouseKeepingUser();
                $house_keeping_user->user_id = $value;
                $house_keeping_user->house_keeping_id = $house_keeping_work->id;
                $house_keeping_user->save();
            }
            return redirect()->route('house-keeping')->with('success', "New work Updated Successfully");
        }
        public function delete_new_house_keeping_working($workId)
        {

            $work_id = base64_decode($workId);
            HouseKeepingWork::where('id',$work_id)->delete();
            HouseKeepingUser::where('house_keeping_id',$work_id)->delete();
            if(true){
                return redirect()->route('house-keeping')->with('success', "Work Deleted Successfully");
            }
            else{
                return redirect()->route('house-keeping')->with('error', "There is some error! try again later");
            }
        }
    
}
 