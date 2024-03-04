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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('comment')->nullable();
            $table->integer('note')->nullable();
            $table->unsignedBigInteger('user')->nullable();
            $table->unsignedBigInteger('course')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
};
