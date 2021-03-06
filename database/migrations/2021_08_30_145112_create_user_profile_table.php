<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->integer('desire_score');
            $table->date('exam_date');
            $table->string('reminder_phone');
            $table->string('reminder_email');
            $table->integer('lesson_length')->default(90);
            $table->string('learning_style')->nullable();
            $table->string('tutor_match')->nullable();
            $table->string('math_score')->nullable();
            $table->string('grammar_score')->nullable();
            $table->string('reading_score')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('user_profile');
    }
}
