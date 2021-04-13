<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionCAreaElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_exhibition_c_area_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('c_area_id')->comment('ds_exhibition_c_areas_id');
            $table->string('c_img_src', 256)->default('')->comment('c區圖片連結');
            $table->string('c_img_video', 256)->default('')->comment('c區影片連結');
            $table->boolean('c_img_form')->default(false)->comment('c區是否開啟表單');
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
        Schema::dropIfExists('ds_exhibition_c_area_elements');
    }
}
