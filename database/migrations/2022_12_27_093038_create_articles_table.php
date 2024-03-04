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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->text('text')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->tinyInteger('vertical_slide')->nullable();
            $table->tinyInteger('horizontal_slide')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type')->references('id')->on('article_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
