<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id('oid');
            $table->string('position');
            $table->string('pp');
            $table->string('location');
            $table->string('brgname');
            $table->string('fname');
            $table->string('lname');
            $table->string('sex');
            $table->string('contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officials');
    }
};
