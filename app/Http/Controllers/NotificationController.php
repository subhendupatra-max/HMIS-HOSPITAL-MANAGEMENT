<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function get_notification_all(){
        $all_notification = Notification::limit(5)->orderBy('id','DESC')->get();
        // $no_of_notification = Notification::where('date','like','%'.date('Y-m-d').'%')->count();
        return response()->json(['all_notification'=>$all_notification]);
    }
    public function view_all_notification(){
        $all_notification = Notification::get();
        return view('notification-list',compact('all_notification'));
    }
}
