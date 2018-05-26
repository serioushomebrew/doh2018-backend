<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('skill_user', function (Blueprint $table) {
            $table->unsignedInteger('skill_id')->nullable();
            $table->foreign('skill_id')->references('id')->on('skills');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('challenge_skill', function (Blueprint $table) {
            $table->unsignedInteger('challenge_id')->nullable();
            $table->foreign('challenge_id')->references('id')->on('challenges');
            $table->unsignedInteger('skill_id')->nullable();
            $table->foreign('skill_id')->references('id')->on('skills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
}
