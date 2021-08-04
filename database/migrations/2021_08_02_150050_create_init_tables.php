<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
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
            $table->string('website');

            $table->timestamps();
        });
        Artisan::call('db:seed', array('--class' => 'MarketSeeder', '--force' => true));

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });
        Artisan::call('db:seed', array('--class' => 'CurrencySeeder', '--force' => true));

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });
        Artisan::call('db:seed', array('--class' => 'CountrySeeder', '--force' => true));

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
