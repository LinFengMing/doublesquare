<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionAAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_exhibition_a_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('exhibition_id')->comment('ds_exhibition_id');
            $table->string('a_img_src', 256)->default('')->comment('a區圖片連結');
            $table->string('a_img_video', 256)->default('')->comment('a區影片連結');
            $table->boolean('a_img_form')->default(false)->comment('a區是否開啟表單');
            $table->text('a_desc_tw')->comment('a區簡述（中文）');
            $table->text('a_desc_en')->comment('a區簡述（英文）');
            $table->integer('a_order')->default(-1)->comment('a區顯示順序');
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
        Schema::dropIfExists('ds_exhibition_a_areas');
    }
}
