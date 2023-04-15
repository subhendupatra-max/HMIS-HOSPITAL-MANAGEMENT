<?php

namespace App\Http\Controllers\bloodBank;

use App\Http\Controllers\Controller;
use App\Models\bloodBank\BloodBankProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_details()
    {
        $product = BloodBankProduct::all(); 
       
        return view('setup.blood-bank.product.product-listing', compact('product'));
    }

    public function save_product_details(Request $request)
    {
        $validate = $request->validate([
            'product_name' => 'required',
            'product_type' => 'required',
            
        ]);

        $status = BloodBankProduct::insert([
            'product_name' => $request->product_name,
            'product_type' => $request->product_type,
                       
        ]);

        if ($status) {
            return back()->with('success', "Product Added Sucessfully");
        } else {
            return back()->with('error', "Something Went Wrong");
        }
    }

    public function edit_product_details($id, Request $request)
    {
        $product = BloodBankProduct::all();
        $editProduct = BloodBankProduct::find($id);
      
        return view('setup.blood-bank.product.edit-product', compact('product', 'editProduct'));
    }

    public function update_product_details(Request $request)
    {
        $validate = $request->validate([
            'product_name' => 'required',
            'product_type' => 'required',
        ]);

        $product = BloodBankProduct::find($request->id);
        $product->product_name    = $request->product_name;
        $product->product_type    = $request->product_type;
      
      
        $status = $product->save();

        if ($status) {
            return redirect()->route('blood-bank-product-details')->with('success', 'Product Updated Sucessfully');
        } else {
            return redirect()->route('blood-bank-product-details')->with('error', "Something Went Wrong");
        }
    }

    public function delete_product_details($id)
    {
        BloodBankProduct::where('id',$id)->delete();

        return redirect()->route('blood-bank-product-details')->with('success', 'Product Deleted Sucessfully');
    }
}
