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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('office')->nullable();
            $table->integer('price')->nullable();
            $table->float('reduction')->nullable();
            $table->integer('premium_price')->nullable();
            $table->integer('office_money')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('location_type')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->longText('description')->nullable();
            $table->string('objective')->nullable();
            $table->string('script')->nullable();
            $table->string('personalized_script')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('office')->references('id')->on('offices')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certifications');
    }
};
