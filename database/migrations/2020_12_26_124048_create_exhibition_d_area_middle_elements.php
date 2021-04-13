<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionDAreaMiddleElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_exhibition_d_area_middle_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('d_area_id')->comment('ds_exhibition_d_areas_id');
            $table->string('d_middle_img_src', 256)->default('')->comment('d區middle圖片連結');
            $table->string('d_middle_img_video', 256)->default('')->comment('d區middle影片連結');
            $table->boolean('d_middle_img_form')->default(false)->comment('d區middle是否開啟表單');
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
        Schema::dropIfExists('ds_exhibition_d_area_middle_elements');
    }
}
