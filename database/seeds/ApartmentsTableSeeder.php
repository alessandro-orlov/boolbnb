<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;
use App\User;


class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $users = User::all();

        for($i = 0; $i < 20; $i++) {

            $new_apartment = new Apartment();

            $new_apartment->user_id = rand(1,2);
            $new_apartment->title = $faker->sentence();
            $new_apartment->num_rooms = $faker->numberBetween(1, 10);
            $new_apartment->num_beds = $faker->numberBetween(1, 7);
            $new_apartment->num_baths = $faker->numberBetween(1, 4);
            $new_apartment->mq = $faker->numberBetween(50, 700);
            $new_apartment->address = $faker->address;
            $new_apartment->latitude = $faker->latitude(-90, 90);
            $new_apartment->longitude = $faker->longitude(-180,180);
            $new_apartment->city = $faker->city;
            $new_apartment->region = $faker->state;
            $new_apartment->description = $faker->text(900);
            $new_apartment->main_img = $faker->imageUrl();
            $new_apartment->price = $faker->randomFloat(2, 100, 5000);

            $new_apartment->save();

        }
    }
}
