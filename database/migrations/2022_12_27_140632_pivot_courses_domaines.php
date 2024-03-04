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
        //
        Schema::create('courses_domaines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course')->nullable();
            $table->unsignedBigInteger('domaine')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('domaine')->references('id')->on('domaines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('pivot_courses_domaines');

    }
};
