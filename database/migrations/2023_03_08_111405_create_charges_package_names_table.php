<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesPackageNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges_package_names', function (Blueprint $table) {
            $table->id();
            $table->string('charge_package_catagory_id');
            $table->string('charge_package_sub_catagory_id');
            $table->string('package_name');
            $table->string('tax');
            $table->string('total_amount');
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
        Schema::dropIfExists('charges_package_names');
    }
}
