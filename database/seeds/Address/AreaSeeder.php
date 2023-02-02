<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('areas')->truncate();
        DB::statement("SET foreign_key_checks=1");
        $now = \Carbon\Carbon::now();

        $areas = [
            [
                'name' => 'الشهباء',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'المحافظة',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'سيف الدولة',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'حلب الجديدة',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'السريان',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الأعظمية',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الصالحين',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'العزيزية',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الفرقان',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'جمعية المهندسين',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الحمدانية',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الجميلية',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الأشرفية',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'الإسماعيلية',
                'city_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($areas as $area)
            DB::table('areas')->insert($area);
    }
}
