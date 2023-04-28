<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\District;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'guardian_name',
        'guardian_name_realation',
        'marital_status',
        'blood_group',
        'gender',
        'date_of_birth',
        'year',
        'month',
        'day',
        'phone',
        'email',
        'address',
        'state',
        'district',
        'pin_no',
        'identification_name',
        'identification_number',
        'remarks',
        'known_allergies',
    ];
    public function _country()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function _state()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }

    public function _district()
    {
        return $this->belongsTo(District::class, 'district', 'id');
    }
    public function local_state()
    {
        return $this->belongsTo(State::class, 'state_local', 'id');
    }
    public function local_district()
    {
        return $this->belongsTo(District::class, 'district_local', 'id');
    }
    public function local_country()
    {
        return $this->belongsTo(Country::class, 'country_local', 'id');
    }
}

