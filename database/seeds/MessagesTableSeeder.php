<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;
use App\Apartment;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $apartments = Apartment::all();

        for ($i=0; $i < 20; $i++) {

            $new_message = new Message();

            $new_message->apartment_id = $faker->numberBetween(1,20);
            $new_message->sender_name = $faker->name;
            $new_message->sender_mail = $faker->email;
            $new_message->message = $faker->text(300);
            $new_message->read = $faker->boolean(false);

            $new_message->save();
        }
    }
}
