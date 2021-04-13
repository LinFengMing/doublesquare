<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAsideColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ds_exhibitions', function (Blueprint $table) {
            $table->string('aside_right_en', 256)->default('')->comment('右側豎寫文字（英文）')->after('desc_en');
            $table->string('aside_right_tw', 256)->default('')->comment('右側豎寫文字（中文）')->after('desc_en');
            $table->string('aside_left_en', 256)->default('')->comment('左側豎寫文字（英文）')->after('desc_en');
            $table->string('aside_left_tw', 256)->default('')->comment('左側豎寫文字（中文）')->after('desc_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ds_exhibitions', function (Blueprint $table) {
            $table->dropColumn('aside_right_en');
            $table->dropColumn('aside_right_tw');
            $table->dropColumn('aside_left_en');
            $table->dropColumn('aside_left_tw');
        });
    }
}
