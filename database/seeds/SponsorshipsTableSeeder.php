<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sponsorships = [
            [
                'name' => 'basic',
                'price' => 2.99,
                'duration' => 24,
            ],
            [
                'name' => 'advanced',
                'price' => 5.99,
                'duration' => 72,
            ],
            [
                'name' => 'premium',
                'price' => 9.99,
                'duration' => 144,
            ]
        ];

        foreach($sponsorships as $sponsorship) {
            
            $new_sponsorship = new Sponsorship();

            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->duration = $sponsorship['duration'];

            $new_sponsorship->save();

        }
    }
}
