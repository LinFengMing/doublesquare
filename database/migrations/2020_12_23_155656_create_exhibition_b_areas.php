<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionBAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_exhibition_b_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('exhibition_id')->comment('ds_exhibition_id');
            $table->string('b_left_img_src', 256)->default('')->comment('b區左側圖片連結');
            $table->string('b_left_img_video', 256)->default('')->comment('b區左側影片連結');
            $table->boolean('b_left_img_form')->default(false)->comment('b區左側是否開啟表單');
            $table->string('b_right_img_src', 256)->default('')->comment('b區右側圖片連結');
            $table->text('b_right_desc_tw')->comment('b區右側簡述（中文）');
            $table->text('b_right_desc_en')->comment('b區右側簡述（英文）');
            $table->integer('b_order')->default(-1)->comment('b區顯示順序');
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
        Schema::dropIfExists('ds_exhibition_b_areas');
    }
}
