<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->BigInteger('phone');
            $table->string('email');
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->integer('experience')->nullable();
            $table->string('education')->nullable();
            $table->string('degree')->nullable();
            $table->string('university')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
