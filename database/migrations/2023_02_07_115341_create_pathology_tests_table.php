<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathologyTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathology_tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('test_type')->nullable();
            $table->string('catagory_id')->nullable();
            $table->string('sub_catagory')->nullable();
            $table->string('method')->nullable();
            $table->string('report_days')->nullable();
            $table->string('charge_category')->nullable();
            $table->string('charge_sub_category')->nullable();
            $table->string('charge')->nullable();
            $table->string('tax')->nullable();
            $table->string('standard_charges')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('test_parameter_name')->nullable();
            $table->string('reference_range')->nullable();
            $table->string('unit')->nullable();
            $table->longText('test_details')->nullable();
            $table->string('ins_by')->default('ori');
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
        Schema::dropIfExists('pathology_tests');
    }
}
