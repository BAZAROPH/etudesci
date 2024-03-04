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
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('slug')->nullable();
            $table->unsignedBigInteger('trainer')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->time('hour')->nullable();
            $table->text('script')->nullable();
            $table->string('type')->nullable();
            $table->text('code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trainer')->references('id')->on('trainers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_classes');
    }
};
