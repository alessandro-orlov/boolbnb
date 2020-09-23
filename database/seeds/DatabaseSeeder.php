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
            UsersTableSeeder::class,
            ApartmentsTableSeeder::class,
            ImagesTableSeeder::class,
            MessagesTableSeeder::class,
            ServicesTableSeeder::class,
            SponsorshipsTableSeeder::class,
            VisitsTableSeeder::class,
        ]);
    }
}
