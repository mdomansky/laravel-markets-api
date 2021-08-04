<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('ticker');
            $table->string('name')->nullable();
            $table->string('long_name')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->on('currencies')->references('id');
            $table->string('isin');
            $table->date('listing_start_date_at')->nullable();
            $table->date('listing_end_date_at')->nullable();
            $table->integer('papers_in_lot');

            $table->timestamps();
        });

        Schema::create('assets_markets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreign('asset_id')->on('assets')->references('id')->cascadeOnDelete();
            $table->unsignedBigInteger('market_id')->unique();
            $table->foreign('market_id')->on('markets')->references('id')->cascadeOnDelete();
        });

        Schema::create('assets_countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreign('asset_id')->on('assets')->references('id')->cascadeOnDelete();
            $table->unsignedBigInteger('country_id')->unique();
            $table->foreign('country_id')->on('countries')->references('id')->cascadeOnDelete();
        });

        Schema::create('assets_currencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreign('asset_id')->on('assets')->references('id')->cascadeOnDelete();
            $table->unsignedBigInteger('currency_id')->unique();
            $table->foreign('currency_id')->on('currencies')->references('id')->cascadeOnDelete();
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreign('asset_id')->on('assets')->references('id')->cascadeOnDelete();

            $table->string('type')->nullable();

            $table->timestamps();
        });

        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreign('asset_id')->on('assets')->references('id')->cascadeOnDelete();

            $table->date('utility_at')->nullable();
            $table->double('sum')->nullable();
            $table->integer('payments_per_year')->nullable();

            $table->timestamps();
        });

        Schema::create('etfs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreign('asset_id')->on('assets')->references('id')->cascadeOnDelete();

            $table->string('service_company')->nullable();
            $table->double('commission')->nullable();
            $table->string('follow_index')->nullable();
            $table->unsignedBigInteger('birth_country_id')->nullable();
            $table->foreign('birth_country_id')->on('countries')->references('id');

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
        Schema::dropIfExists('assets_markets');
        Schema::dropIfExists('assets_countries');
        Schema::dropIfExists('assets_currencies');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('bonds');
        Schema::dropIfExists('etfs');
        Schema::dropIfExists('assets');
    }
}
