<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePropertiesForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
                $table->foreignId('property_id')->constrained();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');

            $table->foreignId('user_id')->constrained();
            $table->foreignId('type_id')->constrained();
        });

        Schema::table('property_options', function (Blueprint $table) {
        $table->foreignId('property_spec_id')->constrained()->onDelete('cascade');
        $table->foreignId('type_option_id')->constrained();
        });



        Schema::table('property_specs', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained();
            $table->foreignId('type_spec_id')->constrained();
        });

        Schema::table('type_options', function (Blueprint $table) {
            $table->foreignId('type_spec_id')->constrained();
        });

        Schema::table('type_specs', function (Blueprint $table) {
            $table->foreignId( 'type_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images',function(Blueprint $table){
            $table->dropForeign('images_property_id_foreign');
            $table->dropColumn('property_id');
        });

        Schema::table('properties',function(Blueprint $table){
            $table->dropForeign('properties_area_id_foreign');
            $table->dropColumn('area_id');

            $table->dropForeign('properties_user_id_foreign');
            $table->dropColumn('user_id');

            $table->dropForeign('properties_type_id_foreign');
            $table->dropColumn('type_id');
        });

        Schema::table('property_options',function(Blueprint $table){
            $table->dropForeign('property_options_type_option_id_foreign');
            $table->dropColumn('type_option_id');

            $table->dropForeign('property_options_property_spec_id_foreign');
            $table->dropColumn('property_spec_id');
        });

        Schema::table('property_specs',function(Blueprint $table){
            $table->dropForeign('property_specs_property_id_foreign');
            $table->dropColumn('property_id');

            $table->dropForeign('property_specs_type_spec_id_foreign');
            $table->dropColumn('type_spec_id');
        });

        Schema::table('type_specs',function(Blueprint $table){
            $table->dropForeign('type_specs_type_id_foreign');
            $table->dropColumn('type_id');
        });

        Schema::table('type_options',function(Blueprint $table){
            $table->dropForeign('type_options_type_spec_id_foreign');
            $table->dropColumn('type_spec_id');
        });

    }
}
