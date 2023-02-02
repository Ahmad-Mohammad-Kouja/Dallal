<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        DB::statement("SET foreign_key_checks=0");
        DB::table('cities')->truncate();
        DB::statement("SET foreign_key_checks=1");

        //212

        $cities = [
            [
                'name' => 'حلب',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'دمشق',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'إدلب',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الحسكة',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'حماة',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'حمص',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'دير الزور',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'درعا',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'رقة',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'ريف دمشق',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'سويداء',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'طرطوس',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'القنيطرة',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'لاذقية',
                'country_id' => 212,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($cities as $city)
            DB::table('cities')->insert($city);

    }
}
