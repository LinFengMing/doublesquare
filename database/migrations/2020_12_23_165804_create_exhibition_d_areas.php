<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionDAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_exhibition_d_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('exhibition_id')->comment('ds_exhibition_id');
            $table->longText('d_left_desc_tw')->comment('d區左側簡述（中文）');
            $table->longText('d_left_desc_en')->comment('d區左側簡述（英文）');
            $table->longText('d_middle_desc_tw')->comment('d區中間簡述（中文）');
            $table->longText('d_middle_desc_en')->comment('d區中間簡述（英文）');
            $table->longText('d_right_desc_tw')->comment('d區右側簡述（中文）');
            $table->longText('d_right_desc_en')->comment('d區右側簡述（英文）');
            $table->integer('d_order')->default(-1)->comment('d區顯示順序');
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
        Schema::dropIfExists('ds_exhibition_d_areas');
    }
}
