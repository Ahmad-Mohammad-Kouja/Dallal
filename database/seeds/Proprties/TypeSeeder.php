<?php

use App\Models\Property\Type;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('types')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $now = Carbon::now();
        $types=[
            [
                'name' => 'منزل',
                'img' => '11',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'محل تجاري',
                'img' => '11',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'أرض',
                'img' => '11',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        foreach ($types as $type)
        DB::table('types')->insert($type);
    }
}
