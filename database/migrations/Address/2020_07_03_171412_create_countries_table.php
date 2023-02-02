<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Address\Country;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('currency')->nullable();
            $table->string('currency_short_name')->nullable();
            $table->string('iso_code')->nullable();
            $table->string('country_code');
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
        DB::statement("SET foreign_key_checks=0");
        Schema::dropIfExists('countries');
        DB::statement("SET foreign_key_checks=1");
    }
}
