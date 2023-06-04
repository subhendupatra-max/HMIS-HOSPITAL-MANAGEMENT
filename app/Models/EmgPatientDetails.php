<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\EmgDetails;

class EmgPatientDetails extends Model
{
    use HasFactory;

    public function patient_department_details()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function emg_details_data()
    {
        return $this->belongsTo(EmgDetails::class, 'emg_details_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'cons_doctor', 'id');
    }

    public function TpaManagement()
    {
        return $this->belongsTo(TpaManagement::class, 'tpa_organization', 'id');
    }
}
