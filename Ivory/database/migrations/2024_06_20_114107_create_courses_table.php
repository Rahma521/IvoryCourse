<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('main_section_id')->unsigned()->index();
            $table->bigInteger('sub_section_id')->nullable()->unsigned();
            $table->bigInteger('instructor_id')->unsigned()->index();
            $table->bigInteger('coordinator_id')->unsigned()->nullable()->index();
            $table->string('name_ar', 255);
            $table->string('name_en', 255);
            $table->integer('video_hosting');
            $table->string('intro_video_url', 255)->nullable();
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->longText('requirements_ar')->nullable();
            $table->longText('requirements_en')->nullable();
            $table->text('result_en')->nullable();
            $table->text('result_ar')->nullable();
            $table->integer('type');
            $table->integer('language');
            $table->string('location')->nullable();
            $table->integer('is_free')->default(2);
            $table->integer('is_discount')->default(1);
            $table->double('price')->nullable();
            $table->integer('is_purchase')->default(2);
            $table->double('discount_price')->nullable();
            $table->integer('level');
            $table->integer('duration_mints')->default(0)->nullable();
            $table->integer('duration_hours')->default(0)->nullable();
            $table->integer('expire_date')->nullable();
            $table->integer('domain')->default(2);
            $table->string('keywords', 255)->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_tags')->nullable();
            $table->integer('status')->default(1);
            $table->integer('is_active')->default(1);
            $table->integer('course_live_type')->nullable();
            $table->integer('student_numbers')->nullable();
            $table->integer('lesson_numbers')->nullable();
            $table->integer('max_student')->nullable();
            $table->boolean('is_special')->nullable();
            $table->integer('medical_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::drop('courses');
    }
}
