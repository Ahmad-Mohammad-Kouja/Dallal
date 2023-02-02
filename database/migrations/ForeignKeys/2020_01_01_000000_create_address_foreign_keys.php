<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Address\City;
use App\Models\Address\Area;

class CreateAddressForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->foreignId('country_id')->constrained();
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->foreignId('city_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities',function(Blueprint $table) {
            $table->dropForeign('cities_country_id_foreign');
            $table->dropColumn('country_id');
        });

        Schema::table('areas',function(Blueprint $table) {
            $table->dropForeign('areas_city_id_foreign');
            $table->dropColumn('city_id');
        });
        }
}
