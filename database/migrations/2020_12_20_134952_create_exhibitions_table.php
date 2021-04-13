<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_exhibitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('date')->default(0)->comment('展覽日期時間戳（秒）');
            $table->string('title_tw', 256)->default('')->comment('展覽名（中文）');
            $table->string('title_en', 256)->default('')->comment('展覽名（英文）');
            $table->string('artist_tw', 50)->default('')->comment('藝術家名字（中文）');
            $table->string('artist_en', 50)->default('')->comment('藝術家名字（英文）');
            $table->string('banner_pc', 256)->default('')->comment('展覽頂部banner PC版連結');
            $table->string('banner_mobile', 256)->default('')->comment('展覽頂部banner mobile版連結');
            $table->text('desc_tw')->comment('展覽簡述（中文）');
            $table->text('desc_en')->comment('展覽簡述（英文）');
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
        Schema::dropIfExists('ds_exhibitions');
    }
}
