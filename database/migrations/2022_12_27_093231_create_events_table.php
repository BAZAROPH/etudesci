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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('organizer')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->integer('price')->nullable();
            $table->integer('office_money')->nullable();
            $table->float('reduction')->nullable();
            $table->integer('premium_price')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('email')->nullable();
            $table->string('place_type')->nullable();
            $table->string('place')->nullable();
            $table->string('personalized_link')->nullable();
            $table->string('registration_link')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->softDeletes();

            $table->timestamps();
            $table->foreign('organizer')->references('id')->on('organizers')->onDelete('cascade');
            $table->foreign('type')->references('id')->on('event_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
