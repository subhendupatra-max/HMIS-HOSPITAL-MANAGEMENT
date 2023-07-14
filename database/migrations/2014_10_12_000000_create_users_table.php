<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('password')->nullable();
            $table->string('role')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('specialist')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('blood_group')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->bigInteger('whatsapp_no')->nullable();
            $table->bigInteger('phone_no')->nullable();
            $table->bigInteger('emg_phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('profile_image')->nullable();
            $table->longText('current_address')->nullable();
            $table->longText('permanent_address')->nullable();
            $table->longText('qualification')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('specialization')->nullable();
            $table->longText('note')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('identification_name')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('epf_no')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('casual_leave')->nullable();
            $table->string('privilege_leave')->nullable();
            $table->string('sick_leave')->nullable();
            $table->string('maternity_leave')->nullable();
            $table->string('paternity_leave')->nullable();
            $table->enum('is_active',['1','0'])->default('1');
            $table->enum('is_delete',['1','0'])->default('0');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
