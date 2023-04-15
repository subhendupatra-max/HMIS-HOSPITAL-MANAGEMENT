<?php

namespace App\Imports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Http\Request;

class PatientImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = request()->all();
        return new Patient([
            'prefix' => $row[0],
            'first_name' => $row[1],
            'middle_name' => $row[2],
            'last_name' => $row[3],
            'guardian_name' => $row[4],
            'guardian_name_realation' => $row[5],
            'marital_status' => $row[6],
            'blood_group' => $row[7],
            'gender' => $row[8],
            'date_of_birth' => date('Y-m-d',strtotime($row[9])),
            'year' => $row[10],
            'month' => $row[11],
            'day' => $row[12],
            'phone' => $row[13],
            'email' => $row[14],
            'address' => $row[15],
            'state' => $request['state'],
            'district' => $request['district'],
            'pin_no' => $row[16],
            'identification_name' => $row[17],
            'identification_number' => $row[18],
            'remarks' => $row[19],
            'known_allergies' => $row[20],
        ]);
    }
}
