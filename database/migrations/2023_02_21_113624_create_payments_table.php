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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->text('references')->nullable();
            $table->text('invoice')->nullable();
            $table->unsignedBigInteger('user')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->tinyInteger('state')->nullable();
            $table->dateTime('pay_at')->nullable();
            $table->text('token')->nullable();
            $table->string('product_type')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
