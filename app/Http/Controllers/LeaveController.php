<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\leaveApplication;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeavePermission;
use App\Models\UserLeave;
use App\Models\prefix;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function leave_list($id)
    {
        $user_id = base64_decode($id);
        $my_leave = leaveApplication::where('user_id', $user_id)->get();
        $leave = leaveApplication::where('user_id', $user_id)->latest()->first();

        $startDate =  Carbon::parse($leave->from_date);
        $endDate =  Carbon::parse($leave->to_date);
        $dateRange = [];

        while ($startDate->lte($endDate)) {
            $dateRange[] = $startDate->toDateString();
            $startDate->addDay();
        }

        $date = Carbon::now()->format('Y-m-d');
        if (in_array($date, $dateRange)) {
            $value = 'present';
        } else {
            $value = 'not_present';
        }

        return view('appPages.Users.leave.leave-list', compact('my_leave', 'user_id', 'value'));
    }
    public function create_leave()
    {
        $user_list = User::where('is_active', '1')->get();
        return view('appPages.Users.leave.leave-create', compact('user_list'));
    }

    public function apply_leave_application(Request $request)
    {
        $request->validate([
            'apply_date' => "required",
            'leave_type' => "required",
            'purpose' => "required",
            'resume_duty_on' => "required",
            'permission_authority' => "required",
        ]);


        try {
            DB::beginTransaction();
            if ($request->single_day_multiple_day == 'single_day') {
                $from_date = $request->singleDate;
                $to_date = $request->singleDate;
                $half_day_full_day = $request->half_day_full_day;
            }
            if ($request->single_day_multiple_day == 'multiple_day') {
                $from_date = $request->from_date;
                $to_date = $request->to_date;
                $half_day_full_day = 'full_day';
            }
            $leave_application = new leaveApplication();
            $leave_application->user_id = Auth::user()->id;
            $leave_application->apply_date = $request->apply_date;
            $leave_application->leave_type = $request->leave_type;
            $leave_application->single_day_multiple_day = $request->single_day_multiple_day;
            $leave_application->from_date = $from_date;
            $leave_application->to_date = $to_date;
            $leave_application->half_day_full_day = $half_day_full_day;
            $leave_application->purpose = $request->purpose;
            $leave_application->resume_duty_on = $request->resume_duty_on;
            $leave_application->leave_status = 'Pending';


            $user_id =  Auth::user()->id;
            $days = '';

            if ($request->single_day_multiple_day == 'single_day') {
                if ($request->half_day_full_day == 'half_day') {
                    $days = .5;
                } elseif ($request->half_day_full_day == 'full_day') {
                    $days = 1;
                }
            } elseif ($request->single_day_multiple_day == 'multiple_day') {
                $fromDate = Carbon::parse($request->from_date);
                $toDate = Carbon::parse($request->to_date);
                $numberOfDays = $toDate->diffInDays($fromDate);
                $days = $numberOfDays + 1;
            }

            if ($request->leave_type == 'Sick Leave') {

                $user_sick = UserLeave::where('user_id', $user_id)->where('leave_type', 'Sick Leave')->first();
                $availableLeave = $user_sick->leave_no;
                if ($availableLeave  >= $days) {
                    $result =    $leave_application->save();
                } else {
                    return redirect()->back()->with('error', 'Insufficient Leave. Available Leave is : ' . $availableLeave . '.');
                }
            } elseif ($request->leave_type == 'Causal Leave') {

                $user_sick = UserLeave::where('user_id', $user_id)->where('leave_type', 'Causal Leave')->first();
                $availableLeave = $user_sick->leave_no;
                if ($availableLeave  >= $days) {
                    $result =    $leave_application->save();
                } else {
                    return redirect()->back()->with('error', 'Insufficient Leave. Available Leave is : ' . $availableLeave . '.');
                }
            } else {

                $user_sick = UserLeave::where('user_id', $user_id)->where('leave_type', 'Earn Leave')->first();
                $availableLeave = $user_sick->leave_no;

                if ($availableLeave  >= $days) {
                    $result =    $leave_application->save();
                } else {

                    return redirect()->back()->with('error', 'Insufficient Leave. Available Leave is : ' . $availableLeave . '.');
                }
            }


            foreach ($request->permission_authority as $key => $value) {
                $LeavePermission = new LeavePermission();
                $LeavePermission->user_id = $value;
                $LeavePermission->leave_status = 'Pending';
                $LeavePermission->approve_date = '';
                $LeavePermission->leave_id = $leave_application->id;
                $LeavePermission->save();
            }

            DB::commit();
            if ($result) {
                return redirect()->route('leave-list', ['id' => base64_encode($leave_application->user_id)])->with('success', 'Leave Apply Successfully');
            } else {
                return redirect()->back()->with('errors', 'Something went wrong, please try again.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', 'Something went wrong, please try again.');
        }
    }

    public function edit_leave($id)
    {
        $user_list = User::where('is_active', '1')->get();
        $edit_leave = LeaveApplication::where('id', $id)->first();
        $permisison_users = LeavePermission::where('leave_id', $id)->get();

        return view('appPages.Users.leave.edit-leave', compact('user_list', 'edit_leave', 'permisison_users'));
    }

    public function update_leave_application(Request $request)
    {
        $request->validate([
            'apply_date' => "required",
            'leave_type' => "required",
            'purpose' => "required",
            'resume_duty_on' => "required",
            'permission_authority' => "required",
        ]);

        try {
            DB::beginTransaction();
            if ($request->single_day_multiple_day == 'single_day') {
                $from_date = $request->singleDate;
                $to_date = $request->singleDate;
                $half_day_full_day = $request->half_day_full_day;
            }
            if ($request->single_day_multiple_day == 'multiple_day') {
                $from_date = $request->from_date;
                $to_date = $request->to_date;
                $half_day_full_day = 'full_day';
            }
            $leave_application = LeaveApplication::where('id', $request->leave_id)->first();
            $leave_application->user_id = Auth::user()->id;
            $leave_application->apply_date = $request->apply_date;
            $leave_application->leave_type = $request->leave_type;
            $leave_application->single_day_multiple_day = $request->single_day_multiple_day;
            $leave_application->from_date = $from_date;
            $leave_application->to_date = $to_date;
            $leave_application->half_day_full_day = $half_day_full_day;
            $leave_application->purpose = $request->purpose;
            $leave_application->resume_duty_on = $request->resume_duty_on;
            $leave_application->leave_status = 'Pending';
            $result =    $leave_application->save();


            LeavePermission::where('leave_id', $leave_application->id)->delete();

            foreach ($request->permission_authority as $key => $value) {
                $LeavePermission = new LeavePermission();
                $LeavePermission->user_id = $value;
                $LeavePermission->leave_status = 'Pending';
                $LeavePermission->approve_date = '';
                $LeavePermission->leave_id = $leave_application->id;
                $LeavePermission->save();
            }
            DB::commit();
            if ($result) {
                return redirect()->route('leave-list')->with('success', 'Leave Updated Successfully');
            } else {
                return redirect()->back()->with('errors', 'Something went wrong, please try again.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', 'Something went wrong, please try again.');
        }
    }

    public function hr_create_leave()
    {
        $user_list = User::get();
        return view('appPages.Users.leave-request.hr-leave-create', compact('user_list'));
    }

    public function leave_details($id)
    {
        $leave_details = leaveApplication::where('id', $id)->first();
        $permission_details = LeavePermission::where('leave_id', $id)->get();
        $permisison_status_own = LeavePermission::where('leave_id', $id)->first();

        return view('appPages.Users.leave.leave-detaills', compact('leave_details', 'permission_details', 'permisison_status_own'));
    }

    public function leave_request_list()
    {
        $user_id = Auth::id();
        $user = LeavePermission::where('user_id', $user_id)->get();

        $my_leave = LeaveApplication::where('leave_applications.leave_status', 'Pending')
            ->get();

        $leave_prefix = prefix::where('name', 'leave')->first();

        return view('appPages.Users.leave-request.request-leave-list', compact('my_leave', 'leave_prefix'));
    }

    public function leave_request_details($id)
    {

        $leave_details = leaveApplication::where('id', $id)->first();

        $permission_details = LeavePermission::where('leave_id', $id)->get();

        $permisison_status_own = LeavePermission::where('leave_id', $id)->first();

        $user_leaves = UserLeave::where('user_id', $leave_details->user_id)->get();

        $permisison_users = LeavePermission::select('leave_permissions.leave_status')->where('leave_permissions.leave_id', $id)->get();

        return view('appPages.Users.leave-request.request-leave-details', compact('leave_details', 'permission_details', 'permisison_status_own', 'user_leaves', 'permisison_users'));
    }


    public function given_approval_leave(Request $request)
    {
        $no_of_user_permission = LeavePermission::where('leave_id', $request->leave_id)->count();

        $validator = $request->validate([
            'permission' => 'required',
        ]);

        $leave_id = $request->leave_id;
        $user_id = Auth::id();
        $date = date('d-m-Y');

        $status = $request->permission;

        $data = LeavePermission::where('leave_id', $leave_id)->where('user_id', $user_id)->update(['approve_date' => $date, 'leave_status' => $request->permission, 'comment' => $request->comment]);

        $no_of_user_permission_given_approve = LeavePermission::where('leave_id', $request->leave_id)->where('leave_status', 'Approved')->count();

        $no_of_user_permission_given_reject = LeavePermission::where('leave_id', $request->leave_id)->where('leave_status', 'Rejected')->count();


        if ($no_of_user_permission_given_reject >= $no_of_user_permission) {
            leaveApplication::where('id', $leave_id)->update(['leave_status' => 'Rejected']);
        }

        if ($no_of_user_permission_given_approve >= $no_of_user_permission) {
            leaveApplication::where('id', $leave_id)->update(['leave_status' => 'Approved']);
        }


        $leave_application =  leaveApplication::where('id', $leave_id)->first();
        $user = $leave_application->user_id;

        $fromDate = Carbon::parse($leave_application->from_date);
        $toDate = Carbon::parse($leave_application->to_date);

        $numberOfDays = $toDate->diffInDays($fromDate);

        if ($leave_application->single_day_multiple_day  == 'single_day') {
            if ($leave_application->half_day_full_day == 'half_day' && $leave_application->single_day_multiple_day  == 'single_day') {
                if ($leave_application->leave_type == 'Sick Leave') {

                    $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Sick Leave')->first();
                    $days = $user_sick->leave_no;
                    $halfDayHours = 12;
                    $hours = $days * 24;
                    $total_hours = $hours -   $halfDayHours;
                    $cal = $total_hours;
                    $hulftime = $cal / 24;

                    UserLeave::where('user_id', $user)->where('leave_type', 'Sick Leave')->update(['leave_no' => $hulftime]);
                } elseif ($leave_application->leave_type == 'Causal Leave' && $leave_application->single_day_multiple_day  == 'single_day') {

                    $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Causal Leave')->first();
                    $days = $user_sick->leave_no;
                    $halfDayHours = 12;
                    $hours = $days * 24;
                    $total_hours = $hours -   $halfDayHours;
                    $cal = $total_hours;
                    $hulftime = $cal / 24;

                    UserLeave::where('user_id', $user)->where('leave_type', 'Causal Leave')->update(['leave_no' => $hulftime]);
                } elseif ($leave_application->leave_type == 'Earn Leave' && $leave_application->single_day_multiple_day  == 'single_day') {

                    $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Earn Leave')->first();
                    $days = $user_sick->leave_no;
                    $halfDayHours = 12;
                    $hours = $days * 24;
                    $total_hours = $hours -   $halfDayHours;
                    $cal = $total_hours;
                    $hulftime = $cal / 24;

                    UserLeave::where('user_id', $user)->where('leave_type', 'Earn Leave')->update(['leave_no' => $hulftime]);
                }
            } elseif ($leave_application->half_day_full_day == 'full_day' &&  $leave_application->single_day_multiple_day  == 'single_day') {
                if ($leave_application->leave_type == 'Sick Leave' && $leave_application->single_day_multiple_day  == 'single_day') {

                    $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Sick Leave')->first();

                    $days = $user_sick->leave_no;
                    $oneDay =  $days - 1;

                    UserLeave::where('user_id', $user)->where('leave_type', 'Sick Leave')->update(['leave_no' => $oneDay]);
                } elseif ($leave_application->leave_type == 'Causal Leave' && $leave_application->single_day_multiple_day  == 'single_day') {
                    // dd('5');
                    $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Causal Leave')->first();
                    $days =  $user_sick->leave_no;

                    $oneDay =  $days - 1;

                    UserLeave::where('user_id', $user)->where('leave_type', 'Causal Leave')->update(['leave_no' => $oneDay]);
                } elseif ($leave_application->leave_type == 'Earn Leave' && $leave_application->single_day_multiple_day  == 'single_day') {

                    $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Earn Leave')->first();

                    $days =  $user_sick->leave_no;

                    $oneDay =  $days - 1;

                    UserLeave::where('user_id', $user)->where('leave_type', 'Earn Leave')->update(['leave_no' => $oneDay]);
                }
            }
        } elseif ($leave_application->single_day_multiple_day  == 'multiple_day' && $leave_application->half_day_full_day == 'full_day') {
            if ($leave_application->leave_type == 'Sick Leave' && $leave_application->half_day_full_day == 'full_day') {

                $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Sick Leave')->first();
                $days = $numberOfDays + 1;
                $sick_leave = $user_sick->leave_no;
                $multipleDay =  $sick_leave - $days;
                UserLeave::where('user_id', $user)->where('leave_type', 'Sick Leave')->update(['leave_no' => $multipleDay]);
            } elseif ($leave_application->leave_type == 'Causal Leave' && $leave_application->half_day_full_day == 'full_day') {

                $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Causal Leave')->first();

                $days = $numberOfDays + 1;
                $sick_leave = $user_sick->leave_no;
                $multipleDay =  $sick_leave - $days;

                UserLeave::where('user_id', $user)->where('leave_type', 'Causal Leave')->update(['leave_no' => $multipleDay]);
            } elseif ($leave_application->leave_type == 'Earn Leave' && $leave_application->half_day_full_day == 'full_day') {

                $user_sick = UserLeave::where('user_id', $user)->where('leave_type', 'Earn Leave')->first();

                $days = $numberOfDays + 1;
                $sick_leave = $user_sick->leave_no;
                $multipleDay =  $sick_leave - $days;

                UserLeave::where('user_id', $user)->where('leave_type', 'Earn Leave')->update(['leave_no' => $multipleDay]);
            }
        }


        return redirect()->back()->with('success', 'Leave Status Changed Successfully');
    }

    public function hr_leave_application(Request $request)
    {
        $request->validate([
            'user_id' => "required",
            'apply_date' => "required",
            'leave_type' => "required",
            'purpose' => "required",
            'resume_duty_on' => "required",
            'permission_authority' => "required",
        ]);

        try {
            DB::beginTransaction();
            if ($request->single_day_multiple_day == 'single_day') {
                $from_date = $request->singleDate;
                $to_date = $request->singleDate;
                $half_day_full_day = $request->half_day_full_day;
            }
            if ($request->single_day_multiple_day == 'multiple_day') {
                $from_date = $request->from_date;
                $to_date = $request->to_date;
                $half_day_full_day = 'full_day';
            }

            $leave_application = new leaveApplication();
            $leave_application->user_id = $request->user_id;
            $leave_application->apply_date = $request->apply_date;
            $leave_application->leave_type = $request->leave_type;
            $leave_application->single_day_multiple_day = $request->single_day_multiple_day;
            $leave_application->from_date = $from_date;
            $leave_application->to_date = $to_date;
            $leave_application->half_day_full_day = $half_day_full_day;
            $leave_application->purpose = $request->purpose;
            $leave_application->resume_duty_on = $request->resume_duty_on;
            $leave_application->leave_status = 'Pending';

            $user_id =   $request->user_id;

            $leave = leaveApplication::where('user_id', $user_id)->latest()->first();
            $startDate =  Carbon::parse($leave->from_date);
            $endDate =  Carbon::parse($leave->to_date);
            $dateRange = [];

            while ($startDate->lte($endDate)) {
                $dateRange[] = $startDate->toDateString();
                $startDate->addDay();
            }

            $date = Carbon::now()->format('Y-m-d');
            if (in_array($date, $dateRange)) {
                return redirect()->back()->with('error', 'User is Already In Leave.');
            } else {
                $days = '';

                if ($request->single_day_multiple_day == 'single_day') {
                    if ($request->half_day_full_day == 'half_day') {
                        $days = .5;
                    } elseif ($request->half_day_full_day == 'full_day') {
                        $days = 1;
                    }
                } elseif ($request->single_day_multiple_day == 'multiple_day') {
                    $fromDate = Carbon::parse($request->from_date);
                    $toDate = Carbon::parse($request->to_date);
                    $numberOfDays = $toDate->diffInDays($fromDate);
                    $days = $numberOfDays + 1;
                }

                if ($request->leave_type == 'Sick Leave') {

                    $user_sick = UserLeave::where('user_id', $user_id)->where('leave_type', 'Sick Leave')->first();
                    $availableLeave = $user_sick->leave_no;
                    if ($availableLeave  >= $days) {
                        $result =    $leave_application->save();
                    } else {
                        return redirect()->back()->with('error', 'Insufficient Leave. Available Leave is : ' . $availableLeave . '.');
                    }
                } elseif ($request->leave_type == 'Causal Leave') {

                    $user_sick = UserLeave::where('user_id', $user_id)->where('leave_type', 'Causal Leave')->first();
                    $availableLeave = $user_sick->leave_no;
                    if ($availableLeave  >= $days) {
                        $result =    $leave_application->save();
                    } else {
                        return redirect()->back()->with('error', 'Insufficient Leave. Available Leave is : ' . $availableLeave . '.');
                    }
                } else {

                    $user_sick = UserLeave::where('user_id', $user_id)->where('leave_type', 'Earn Leave')->first();
                    $availableLeave = $user_sick->leave_no;

                    if ($availableLeave  >= $days) {
                        $result =    $leave_application->save();
                    } else {

                        return redirect()->back()->with('error', 'Insufficient Leave. Available Leave is : ' . $availableLeave . '.');
                    }
                }

                foreach ($request->permission_authority as $key => $value) {
                    $LeavePermission = new LeavePermission();
                    $LeavePermission->user_id = $value;
                    $LeavePermission->leave_status = 'Pending';
                    $LeavePermission->approve_date = '';
                    $LeavePermission->leave_id = $leave_application->id;
                    $LeavePermission->save();
                }
            }

            DB::commit();
            if ($result) {
                return redirect()->route('user-leave-request-list')->with('success', 'Leave Apply Successfully');
            } else {
                return redirect()->back()->with('errors', 'Something went wrong, please try again.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', 'Something went wrong, please try again.');
        }
    }

    public function leave_delete($id)
    {
        $leave = leaveApplication::where('id', $id)->delete();
        $leave_permission = LeavePermission::where('leave_id', $id)->delete();

        if ($leave_permission) {
            return redirect()->route('user-leave-request-list')->with('success', 'Leave Deleted Successfully');
        } else {
            return redirect()->back()->with('errors', 'Something went wrong, please try again.');
        }
    }
}
