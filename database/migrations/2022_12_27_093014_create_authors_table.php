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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('company')->nullable();
            $table->string('function')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type')->references('id')->on('author_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
};
