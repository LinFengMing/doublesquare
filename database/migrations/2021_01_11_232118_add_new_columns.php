<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ds_exhibitions', function (Blueprint $table) {
            $table->integer('type')->default(0)->comment('展覽分類id')->after('id');
        });

        Schema::table('ds_exhibition_a_areas', function (Blueprint $table) {
            $table->string('a_img_media_en', 256)->default('')->comment('媒體（英文）')->after('a_img_form');
            $table->string('a_img_media_tw', 256)->default('')->comment('媒體（中文）')->after('a_img_form');
            $table->string('a_img_size_en', 256)->default('')->comment('尺寸（英文）')->after('a_img_form');
            $table->string('a_img_size_tw', 256)->default('')->comment('尺寸（中文）')->after('a_img_form');
            $table->string('a_img_year', 256)->default('')->comment('年份')->after('a_img_form');
            $table->string('a_img_artist_en', 256)->default('')->comment('作者名（英文）')->after('a_img_form');
            $table->string('a_img_artist_tw', 256)->default('')->comment('作者名（中文）')->after('a_img_form');
            $table->string('a_img_name_en', 256)->default('')->comment('作品名（英文）')->after('a_img_form');
            $table->string('a_img_name_tw', 256)->default('')->comment('作品名（中文）')->after('a_img_form');
        });

        Schema::table('ds_exhibition_b_areas', function (Blueprint $table) {
            $table->string('b_left_img_media_en', 256)->default('')->comment('媒體（英文）')->after('b_left_img_form');
            $table->string('b_left_img_media_tw', 256)->default('')->comment('媒體（中文）')->after('b_left_img_form');
            $table->string('b_left_img_size_en', 256)->default('')->comment('尺寸（英文）')->after('b_left_img_form');
            $table->string('b_left_img_size_tw', 256)->default('')->comment('尺寸（中文）')->after('b_left_img_form');
            $table->string('b_left_img_year', 256)->default('')->comment('年份')->after('b_left_img_form');
            $table->string('b_left_img_artist_en', 256)->default('')->comment('作者名（英文）')->after('b_left_img_form');
            $table->string('b_left_img_artist_tw', 256)->default('')->comment('作者名（中文）')->after('b_left_img_form');
            $table->string('b_left_img_name_en', 256)->default('')->comment('作品名（英文）')->after('b_left_img_form');
            $table->string('b_left_img_name_tw', 256)->default('')->comment('作品名（中文）')->after('b_left_img_form');
        });

        Schema::table('ds_exhibition_c_area_elements', function (Blueprint $table) {
            $table->string('c_img_media_en', 256)->default('')->comment('媒體（英文）')->after('c_img_form');
            $table->string('c_img_media_tw', 256)->default('')->comment('媒體（中文）')->after('c_img_form');
            $table->string('c_img_size_en', 256)->default('')->comment('尺寸（英文）')->after('c_img_form');
            $table->string('c_img_size_tw', 256)->default('')->comment('尺寸（中文）')->after('c_img_form');
            $table->string('c_img_year', 256)->default('')->comment('年份')->after('c_img_form');
            $table->string('c_img_artist_en', 256)->default('')->comment('作者名（英文）')->after('c_img_form');
            $table->string('c_img_artist_tw', 256)->default('')->comment('作者名（中文）')->after('c_img_form');
            $table->string('c_img_name_en', 256)->default('')->comment('作品名（英文）')->after('c_img_form');
            $table->string('c_img_name_tw', 256)->default('')->comment('作品名（中文）')->after('c_img_form');
        });

        Schema::table('ds_exhibition_d_area_left_elements', function (Blueprint $table) {
            $table->string('d_left_img_media_en', 256)->default('')->comment('媒體（英文）')->after('d_left_img_form');
            $table->string('d_left_img_media_tw', 256)->default('')->comment('媒體（中文）')->after('d_left_img_form');
            $table->string('d_left_img_size_en', 256)->default('')->comment('尺寸（英文）')->after('d_left_img_form');
            $table->string('d_left_img_size_tw', 256)->default('')->comment('尺寸（中文）')->after('d_left_img_form');
            $table->string('d_left_img_year', 256)->default('')->comment('年份')->after('d_left_img_form');
            $table->string('d_left_img_artist_en', 256)->default('')->comment('作者名（英文）')->after('d_left_img_form');
            $table->string('d_left_img_artist_tw', 256)->default('')->comment('作者名（中文）')->after('d_left_img_form');
            $table->string('d_left_img_name_en', 256)->default('')->comment('作品名（英文）')->after('d_left_img_form');
            $table->string('d_left_img_name_tw', 256)->default('')->comment('作品名（中文）')->after('d_left_img_form');
        });

        Schema::table('ds_exhibition_d_area_middle_elements', function (Blueprint $table) {
            $table->string('d_middle_img_media_en', 256)->default('')->comment('媒體（英文）')->after('d_middle_img_form');
            $table->string('d_middle_img_media_tw', 256)->default('')->comment('媒體（中文）')->after('d_middle_img_form');
            $table->string('d_middle_img_size_en', 256)->default('')->comment('尺寸（英文）')->after('d_middle_img_form');
            $table->string('d_middle_img_size_tw', 256)->default('')->comment('尺寸（中文）')->after('d_middle_img_form');
            $table->string('d_middle_img_year', 256)->default('')->comment('年份')->after('d_middle_img_form');
            $table->string('d_middle_img_artist_en', 256)->default('')->comment('作者名（英文）')->after('d_middle_img_form');
            $table->string('d_middle_img_artist_tw', 256)->default('')->comment('作者名（中文）')->after('d_middle_img_form');
            $table->string('d_middle_img_name_en', 256)->default('')->comment('作品名（英文）')->after('d_middle_img_form');
            $table->string('d_middle_img_name_tw', 256)->default('')->comment('作品名（中文）')->after('d_middle_img_form');
        });

        Schema::table('ds_exhibition_d_area_right_elements', function (Blueprint $table) {
            $table->string('d_right_img_media_en', 256)->default('')->comment('媒體（英文）')->after('d_right_img_form');
            $table->string('d_right_img_media_tw', 256)->default('')->comment('媒體（中文）')->after('d_right_img_form');
            $table->string('d_right_img_size_en', 256)->default('')->comment('尺寸（英文）')->after('d_right_img_form');
            $table->string('d_right_img_size_tw', 256)->default('')->comment('尺寸（中文）')->after('d_right_img_form');
            $table->string('d_right_img_year', 256)->default('')->comment('年份')->after('d_right_img_form');
            $table->string('d_right_img_artist_en', 256)->default('')->comment('作者名（英文）')->after('d_right_img_form');
            $table->string('d_right_img_artist_tw', 256)->default('')->comment('作者名（中文）')->after('d_right_img_form');
            $table->string('d_right_img_name_en', 256)->default('')->comment('作品名（英文）')->after('d_right_img_form');
            $table->string('d_right_img_name_tw', 256)->default('')->comment('作品名（中文）')->after('d_right_img_form');
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
            $table->dropColumn('type');
        });

        Schema::table('ds_exhibition_a_areas', function (Blueprint $table) {
            $table->dropColumn('a_img_media_en');
            $table->dropColumn('a_img_media_tw');
            $table->dropColumn('a_img_size_en');
            $table->dropColumn('a_img_size_tw');
            $table->dropColumn('a_img_year');
            $table->dropColumn('a_img_artist_en');
            $table->dropColumn('a_img_artist_tw');
            $table->dropColumn('a_img_name_en');
            $table->dropColumn('a_img_name_tw');
        });

        Schema::table('ds_exhibition_b_areas', function (Blueprint $table) {
            $table->dropColumn('b_left_img_media_en');
            $table->dropColumn('b_left_img_media_tw');
            $table->dropColumn('b_left_img_size_en');
            $table->dropColumn('b_left_img_size_tw');
            $table->dropColumn('b_left_img_year');
            $table->dropColumn('b_left_img_artist_en');
            $table->dropColumn('b_left_img_artist_tw');
            $table->dropColumn('b_left_imgname_en');
            $table->dropColumn('b_left_img_name_tw');
        });

        Schema::table('ds_exhibition_c_area_elements', function (Blueprint $table) {
            $table->dropColumn('c_img_media_en');
            $table->dropColumn('c_img_media_tw');
            $table->dropColumn('c_img_size_en');
            $table->dropColumn('c_img_size_tw');
            $table->dropColumn('c_img_year');
            $table->dropColumn('c_img_artist_en');
            $table->dropColumn('c_img_artist_tw');
            $table->dropColumn('c_img_name_en');
            $table->dropColumn('c_img_name_tw');
        });

        Schema::table('ds_exhibition_d_area_left_elements', function (Blueprint $table) {
            $table->dropColumn('d_left_img_media_en');
            $table->dropColumn('d_left_img_media_tw');
            $table->dropColumn('d_left_img_size_en');
            $table->dropColumn('d_left_img_size_tw');
            $table->dropColumn('d_left_img_year');
            $table->dropColumn('d_left_img_artist_en');
            $table->dropColumn('d_left_img_artist_tw');
            $table->dropColumn('d_left_img_name_en');
            $table->dropColumn('d_left_img_name_tw');
        });

        Schema::table('ds_exhibition_d_area_middle_elements', function (Blueprint $table) {
            $table->dropColumn('d_middle_img_media_en');
            $table->dropColumn('d_middle_img_media_tw');
            $table->dropColumn('d_middle_img_size_en');
            $table->dropColumn('d_middle_img_size_tw');
            $table->dropColumn('d_middle_img_year');
            $table->dropColumn('d_middle_img_artist_en');
            $table->dropColumn('d_middle_img_artist_tw');
            $table->dropColumn('d_middle_img_name_en');
            $table->dropColumn('d_middle_img_name_tw');
        });

        Schema::table('ds_exhibition_d_area_right_elements', function (Blueprint $table) {
            $table->dropColumn('d_right_img_media_en');
            $table->dropColumn('d_right_img_media_tw');
            $table->dropColumn('d_right_img_size_en');
            $table->dropColumn('d_right_img_size_tw');
            $table->dropColumn('d_right_img_year');
            $table->dropColumn('d_right_img_artist_en');
            $table->dropColumn('d_right_img_artist_tw');
            $table->dropColumn('d_right_img_name_en');
            $table->dropColumn('d_right_img_name_tw');
        });
    }
}
