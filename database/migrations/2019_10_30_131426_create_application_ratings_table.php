<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('job_post_id');
            $table->unsignedInteger('application_id');
            $table->unsignedInteger('job_post_rating_field');
            $table->unsignedInteger('comment_id');
            $table->tinyInteger('rate');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('job_post_id')->references('id')->on('job_posts');
            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('job_post_rating_field')->references('id')->on('job_post_rating_fields');
            $table->foreign('comment_id')->references('id')->on('application_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_ratings');
    }
}
