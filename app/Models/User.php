<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Department;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
        'employee_id',
        'role',
        'designation',
        'department',
        'specialist',
        'first_name',
        'last_name',
        'mother_name',
        'father_name',
        'gender',
        'marital_status',
        'blood_group',
        'date_of_birth',
        'date_of_joining',
        'phone_no',
        'whatsapp_no',
        'emg_phone_no',
        'email',
        'profile_image',
        'current_address',
        'permanent_address',
        'qualification',
        'experience',
        'specialization',
        'note',
        'pan_number',
        'identification_number',
        'identification_name',
        'bank_account_no',
        'bank_name',
        'ifsc_code',
        'bank_branch_name',
        'epf_no',
        'basic_salary',
        'contract_type',
        'casual_leave',
        'privilege_leave',
        'sick_leave',
        'maternity_leave',
        'paternity_leave',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function department_details()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }
    public function designation_details()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }
}
