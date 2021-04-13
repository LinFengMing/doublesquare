<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds_parms', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name', 50)->default('')->comment('參數名稱');
            $table->String('title', 50)->default('')->comment('參數標題');
            $table->longText('value')->comment('值');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ds_parms');
    }
}
