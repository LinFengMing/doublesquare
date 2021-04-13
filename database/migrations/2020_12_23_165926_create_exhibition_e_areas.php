<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionEAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_exhibition_e_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('exhibition_id')->comment('ds_exhibition_id');
            $table->longText('e_desc_tw')->comment('e區簡述（中文）');
            $table->longText('e_desc_en')->comment('e區簡述（英文）');
            $table->integer('e_order')->default(-1)->comment('e區顯示順序');
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
        Schema::dropIfExists('ds_exhibition_e_areas');
    }
}
