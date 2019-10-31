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
            $table->unsignedInteger('job_post_id');
            $table->unsignedInteger('application_id');
            $table->unsignedInteger('job_post_rating_field');
            $table->tinyInteger('rate');
            $table->softDeletes();
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
        Schema::dropIfExists('application_ratings');
    }
}
