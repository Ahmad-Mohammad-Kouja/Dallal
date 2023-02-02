<?php

use App\Enums\Properties\PropertyUseTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Property\Property;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('description')->nullable();
            $table->string('img');
            $table->double('price')->unsigned()->default(0.0);
            $table->string('space');
            $table->timestamp('sold_at')->nullable();
            $table->enum('use_type',PropertyUseTypes::getValues())->default(PropertyUseTypes::sell);
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
        DB::statement("SET foreign_key_checks=0");
        Schema::dropIfExists('properties');
        DB::statement("SET foreign_key_checks=1");
    }
}
