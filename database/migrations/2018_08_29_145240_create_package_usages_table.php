<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_usages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('package_id');
            $table->integer('daily_cv_view')->nullable();
            $table->integer('monthly_cv_view')->nullable();
            $table->integer('active_job_post_count')->nullable();
            $table->date('expiration_date')->nullable();//days
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_usages');
    }
}
