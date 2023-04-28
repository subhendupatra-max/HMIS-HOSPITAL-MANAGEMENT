<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_type')->nullable(); // flat discount/percentage
            $table->string('asking_discount_amount')->nullable();
            $table->string('given_discount_type')->nullable(); // flat discount/percentage
            $table->string('given_discount_amount')->nullable();
            $table->string('discount_status')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('section')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('discount_given_by')->nullable();
            $table->string('asking_discount_time')->nullable();
            $table->string('given_discount_time')->nullable();
            $table->longText('remark')->nullable();
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
        Schema::dropIfExists('discounts');
    }
}
