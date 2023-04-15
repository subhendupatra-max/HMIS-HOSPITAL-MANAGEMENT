<?php

namespace App\Http\Controllers\API\Master\ItemCategory;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemCategoryApi extends Controller
{
    public function itemCategoryViewApi()
    {
        $allItemCategory = ItemCategory::all();

        try {
            if ($allItemCategory != null) {

                return response([
                    'status' => true,
                    'message' => 'DATA FOUND',
                   'allItemCategory'=> $allItemCategory
                ],200); 
    
            }else{
    
                return response([
                    'status' => true,
                    'message' => 'NO DATA FOUND',
                ],404); 
            }

        } catch (\Throwable $th) {
            return response([
                'status' => true,
                'message' => $th->getMessage(),
            ],404); 
        }
         
    }
    
    public function itemCategoryViewByIdApi($id)
    {
        $allItemCategory = ItemCategory::find($id);

        try {
            if ($allItemCategory != null) {

                return response([
                    'status' => true,
                    'message' => 'DATA FOUND',
                   'allItemCategory'=> $allItemCategory
                ],200); 
    
            }else{
    
                return response([
                    'status' => true,
                    'message' => 'NO DATA FOUND',
                ],404); 
            }

        } catch (\Throwable $th) {
            return response([
                'status' => true,
                'message' => $th->getMessage(),
            ],404); 
        }
         
    }

    public function itemCategoryAddAction(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'item_category'=>'required|unique:item_categories,categories,{{$request->item_category}}',
        ]);

        if ($validator->fails()) {
            
            $errors = $validator->errors();

            return response([
                'status' => false,
                'message' => 'validation error',
                'errors' => $errors
            ]);

        }else{

            $itemCategoryStatus = ItemCategory::insert(['categories' => $request->item_category]);
            return response([
                'status' => true,
                'message' => 'Item Category Added Sucessfully',
            ]);
            if($itemCategoryStatus){
                
                return response([
                    'status' => true,
                    'message' => 'Item Category Added Sucessfully',
                ]);

            }else{

                return response([
                    'status' => true,
                    'message' => 'Something Went Wrong',
                ]);
                
            }

        }
            
    }
    
}
