<?php

namespace App\Imports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Http\Request;

class MedicineImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = request()->all();
        dd($request);
        return new Medicine([
            'medicine_name' => $row[0],
            'medicine_company' => $row[1],
            'medicine_composition' => $row[2],
            'medicine_group' => $row[3],
            'unit' => $row[4],
            'min_level' => $row[5],
            're_order_level' => $row[6],
            'tax' => $row[7],
            'unit_packing' => $row[8],
            'vat_ac' => $row[9],
            'note' => $row[10],
            'medicine_catagory' => $request['medicine_catagory'],
        ]);
    }
}
