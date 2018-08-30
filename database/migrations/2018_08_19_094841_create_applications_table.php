<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('candidate_id');
            $table->unsignedInteger('job_post_id');
            $table->boolean('is_seen');
            $table->unsignedInteger('candidate_cv');
            $table->unsignedInteger('cv_folder_id');
            $table->BigInteger('phone');
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->integer('experience')->nullable();
            $table->string('education')->nullable();
            $table->string('degree')->nullable();
            $table->string('university')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('job_post_id')->references('id')->on('job_posts');
            $table->foreign('candidate_cv')->references('id')->on('candidate_cvs');
            $table->foreign('cv_folder_id')->references('id')->on('cv_folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
