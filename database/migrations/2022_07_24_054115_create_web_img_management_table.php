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
        Schema::create('web_img_management', function (Blueprint $table) {
            $table->id();
            $table->string('start_image')->nullable();
            $table->string('splash_image1')->nullable();
            $table->string('splash_image2')->nullable();
            $table->string('splash_image3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_img_management');
    }
};
