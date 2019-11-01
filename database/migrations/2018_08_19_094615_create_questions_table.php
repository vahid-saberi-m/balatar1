<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('sort')->nullable();
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('job_post_id');
            $table->string('question','200');
            $table->string('answer_1','60');
            $table->boolean('value_1');
            $table->string('answer_2','60')->nullable();
            $table->boolean('value_2')->nullable();
            $table->string('answer_3','60')->nullable();
            $table->boolean('value_3')->nullable();
            $table->string('answer_4','60')->nullable();
            $table->boolean('value_4');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('job_post_id')->references('id')->on('job_posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
