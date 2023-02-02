<?php

use App\Models\Property\TypeSpec;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('type_specs')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $now = Carbon::now();
        $specs=[
            [
                'type_id' => '1',
                'name' => 'عدد الحمامات',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'عمر البناء',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'الإتجاه',
                'has_multiple_option' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'الإطلالة',
                'has_multiple_option' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'مفروش',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'أكثر ما يميز منزلك',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'يوجد طاقة شمسية',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'تم تجديده من فترة قريبة',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'حالة التوصيلات الكهربائية',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '1',
                'name' => 'حالة التوصيلات الصحية',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '3',
                'name' => 'مستصلحة',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '3',
                'name' => 'مسورة',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '3',
                'name' => 'اشراف على طريق دولي',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '2',
                'name' => 'مفروش',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '2',
                'name' => 'منافع',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type_id' => '2',
                'name' => 'شارع رئيسي',
                'has_multiple_option' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];
        foreach ($specs as $spec)
        {
            DB::table('type_specs')->insert($spec);
        }
    }
}
