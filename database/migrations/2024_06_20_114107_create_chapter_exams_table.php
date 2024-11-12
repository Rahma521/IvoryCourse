<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterExamsTable extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_exams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chapter_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_exams');
    }
}
