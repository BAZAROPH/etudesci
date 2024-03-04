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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('author')->nullable();
            $table->integer('price')->nullable();
            $table->float('reduction')->nullable();
            $table->integer('premium_price')->nullable();
            $table->string('script')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author')->references('id')->on('authors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
