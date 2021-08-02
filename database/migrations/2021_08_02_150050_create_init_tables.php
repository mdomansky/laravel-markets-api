<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');

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
        Schema::dropIfExists('markets');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('countries');
    }
}
