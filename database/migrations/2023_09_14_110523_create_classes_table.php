<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('description');
            $table->string('style');
            $table->string('level');
            $table->string('instructor');
            $table->string('enrollment_mode');
            $table->dateTime('datetime')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price', 4, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
