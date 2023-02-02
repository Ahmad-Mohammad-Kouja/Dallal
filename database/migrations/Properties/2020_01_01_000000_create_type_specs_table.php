<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Property\TypeSpec;

class CreateTypeSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_specs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('has_multiple_option')->default(false);
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
        Schema::dropIfExists('type_specs');
        DB::statement("SET foreign_key_checks=1");
    }
}
