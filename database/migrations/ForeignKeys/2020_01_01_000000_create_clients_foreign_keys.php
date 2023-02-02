<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Clients\Favorite;

class CreateClientsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('property_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('favorites',function(Blueprint $table) {
            $table->dropForeign('favorites_user_id_foreign');
            $table->dropColumn('user_id');

            $table->dropForeign('favorites_property_id_foreign');
            $table->dropColumn('property_id');
        });

    }
}
