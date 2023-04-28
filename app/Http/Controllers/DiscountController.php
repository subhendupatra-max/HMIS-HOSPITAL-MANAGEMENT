<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
USE Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function discount_list()
    {
        $discountList = Discount::all();
        return view('discount.discount_list', compact('discountList'));
    }

    public function discount_details($discount_id)
    {
        $discountId = base64_decode($discount_id);
        $discount = Discount::where('id', $discountId)->first();
        $discount_details = DiscountDetails::where('discount_id', $discountId)->get();
        return view('discount.discount_details', compact('discount_details', 'discount', 'discountId'));
    }

    public function given_discount(Request $request)
    {
        try {
            DB::beginTransaction();
            $discountId = $request->discount_id;
            $discount_details = Discount::find($discountId);
            $discount_details->discount_status = $request->given_discount_status;
            $discount_details->given_discount_amount = $request->given_discount_amount;
            $discount_details->given_discount_type = $request->given_discount_type;
            $discount_details->discount_given_by = Auth::user()->id;
            $discount_details->given_discount_time = date('Y-m-d h:m:s');
            $discount_details->remark = $request->remark;
            $discount_details->save();
            DB::commit();
            return redirect()->route('view-discount-details', ['discount_id' => base64_encode($discountId)])->with('success', " Successful !!!");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
