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
        Schema::create('users_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user')->nullable();
            $table->unsignedBigInteger('module')->nullable();
            $table->smallInteger('state')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('module')->references('id')->on('modules')->onDelete('cascade');
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
        Schema::dropIfExists('pivot_users_modules');
    }
};
