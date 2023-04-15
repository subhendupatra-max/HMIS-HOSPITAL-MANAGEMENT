<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->string('complain_type')->nullable();
            $table->string('source')->nullable();
            $table->string('complain_by')->nullable();
            $table->string('phone')->nullable();
            $table->date('date')->nullable();
            $table->string('description')->nullable();
            $table->string('action_taken')->nullable();
            $table->string('assigned')->nullable();
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
        Schema::dropIfExists('complains');
    }
}
