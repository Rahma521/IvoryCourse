<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnrollmentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned()->index();
        });
    }

    public function down(): void
    {
        Schema::drop('enrollments');
    }
}
