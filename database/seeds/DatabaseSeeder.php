<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
           TypeSeeder::class,
           TypeSpecSeeder::class,
           TypeOptionSeeder::class,
           CountrySeeder::class,
           CitySeeder::class,
           AreaSeeder::class,
        ]);

    }
}
