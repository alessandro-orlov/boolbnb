<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++) {
            $new_user = new User();

            $new_user->name = $faker->firstName();
            $new_user->lastname = $faker->lastName();
            $new_user->birth_date = $faker->date();
            $new_user->email = $faker->email();
            $new_user->password = Hash::make($faker->password);
            
            $new_user->save();
        }
    }
}
