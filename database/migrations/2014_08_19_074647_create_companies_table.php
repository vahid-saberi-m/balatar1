<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('company_size');
            $table->string('slogan');
            $table->string('website')->nullable();
            $table->string('logo');
            $table->string('message_title')->nullable();
            $table->text('message_content')->nullable();
            $table->string('main_photo')->nullable();
            $table->longText('about_us')->nullable();
            $table->longText('why_us')->nullable();
            $table->longText('recruiting_steps')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('phone_number');
            $table->string('location')->nullable();
            $table->unsignedInteger('package_id');
            $table->boolean('is_live')->default('0');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('companies');
    }
}
