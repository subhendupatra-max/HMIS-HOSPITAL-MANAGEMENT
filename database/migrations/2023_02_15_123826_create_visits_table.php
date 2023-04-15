<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('purpose')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('id_card')->nullable();
            $table->string('visit_to')->nullable();
            $table->string('visit_to_name')->nullable();
            $table->string('number_of_person')->nullable();
            $table->date('date')->nullable();
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->string('note')->nullable();
            $table->string('attach_document')->nullable();
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
        Schema::dropIfExists('visits');
    }
}
