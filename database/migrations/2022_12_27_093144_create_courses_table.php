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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('youtube');
            $table->unsignedBigInteger('office')->nullable();
            $table->unsignedBigInteger('trainer')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('office')->references('id')->on('offices')->onDelete('cascade');
            $table->foreign('trainer')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
