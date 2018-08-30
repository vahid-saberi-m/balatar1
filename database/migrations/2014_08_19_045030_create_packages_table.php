<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->integer('daily_cv_view')->nullable();
            $table->integer('monthly_cv_view')->nullable();
            $table->integer('per_job_post_cv_view')->nullable();
            $table->integer('active_job_post_limit')->nullable();
            $table->integer('question_per_job_post_limit')->nullable();
            $table->integer('package_lifetime')->nullable();//days
            $table->integer('job_post_lifetime_limit')->nullable();//days
            $table->integer('price')->nullable();//thousand Tomans
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
        Schema::dropIfExists('packages');
    }
}
