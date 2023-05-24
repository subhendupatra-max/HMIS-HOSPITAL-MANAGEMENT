<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_issues', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('blood_id');
            $table->string('blood_group_id');
            $table->dateTime('issue_date');
            $table->string('issed_by');
            $table->string('reference_name');
            $table->string('technician');
            $table->string('blood_group');
            $table->string('bag');
            $table->string('payment_amount');
            $table->string('blood_qty');
            $table->string('note');
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
        Schema::dropIfExists('blood_issues');
    }
}
