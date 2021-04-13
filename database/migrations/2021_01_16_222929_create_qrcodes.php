<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrcodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_qrcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('icon_dark', 256)->default('')->comment('暗版icon圖片連結');
            $table->String('icon_light', 256)->default('')->comment('亮版icon圖片連結');
            $table->String('link', 256)->default('')->comment('連結');
            $table->boolean('qr')->default(false)->comment('是否啟用QRcode');
            $table->integer('order')->default(0)->comment('順序');
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
        Schema::dropIfExists('ds_qrcodes');
    }
}
