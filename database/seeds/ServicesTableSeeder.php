<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $services = [
            'WiFi' => '<i class="fas fa-wifi"></i>',
            'Posto Macchina' => '<i class="fas fa-parking"></i>', 
            'Piscina' => '<i class="fas fa-swimmer"></i>',
            'Portineria'=> '<i class="fas fa-concierge-bell"></i>',
            'Sauna' => '<i class="fas fa-hot-tub"></i>',
            'Vista Mare' => '<i class="fas fa-water"></i>',
        ];

        foreach ($services as $name => $icon) {

            $new_service = new Service();

            $new_service->name = $name;
            $new_service->icon = $icon;

            $new_service->save();
        }

    }
}
