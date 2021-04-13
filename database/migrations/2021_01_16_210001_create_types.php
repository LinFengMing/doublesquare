<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('tw', 50)->default('')->comment('展覽分類名（中文）');
            $table->String('en', 50)->default('')->comment('展覽分類名（英文）');
            $table->integer('order')->default(0)->comment('展覽分類順序');
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
        Schema::dropIfExists('ds_types');
    }
}
