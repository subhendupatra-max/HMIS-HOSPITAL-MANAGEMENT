<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->string('bed_name');
            $table->string('bedType_id')->nullable();
            $table->string('bedWard_id');
            $table->string('bedGroup_id')->nullable();
            $table->string('bedUnit_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('is_used')->default('no');
            $table->string('is_active')->default(1);
            $table->string('is_delete')->default(0);
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
        Schema::dropIfExists('beds');
    }
}
