<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use App\Visit;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i = 0; $i < 20; $i++) {
            $new_visit = new Visit();

            $new_visit->apartment_id = $faker->numberBetween(1,20);
            $new_visit->date = Carbon::now()->format('Y-m-d H:i:s');
            $new_visit->save();
        }

    }
}
