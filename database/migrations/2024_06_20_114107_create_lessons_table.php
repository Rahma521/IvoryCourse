<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('chapter_id')->unsigned();
            $table->string('name_ar', 255)->nullable();
            $table->string('name_en', 255)->nullable();
            $table->integer('video_hosting');
            $table->integer('duration')->nullable();
            $table->integer('is_active')->default(1);
            $table->string('video_url', 255)->nullable();
            $table->string('video_file', 255)->nullable();
            $table->string('description_ar', 255)->nullable();
            $table->string('description_en')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::drop('lessons');
    }
}
