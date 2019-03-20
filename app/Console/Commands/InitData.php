<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\City;
use App\Attraction;

class InitData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Q1 d requirement';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private $cities_data = [
        [
            'name' => 'Kuala Lumpur',
        ],
        [
            'name' => 'Beijing',
        ],
        [
            'name' => 'Melbourne',
        ],
    ];
    private $attractions_data = [
        [
            'name' => 'Petronas Twin Towers',
            'city_id' => 1,
        ],
        [
            'name' => 'Forbidden City',
            'city_id' => 2,
        ],
        [
            'name' => 'Temple of Heaven',
            'city_id' => 2,
        ],
        [
            'name' => 'Great Ocean Road ',
            'city_id' => 3,
        ],
        [
            'name' => 'Yarra Valley',
            'city_id' => 3,
        ],
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach($this->cities_data as $cities_data) {
            $city = new City;
            $city->name = $cities_data['name'];
            $city->save();
            echo "City $city->name created successfully\n";
        }
        foreach($this->attractions_data as $attractions_data) {
            $attract = new Attraction;
            $attract->name = $attractions_data['name'];
            $attract->city_id = $attractions_data['city_id'];
            $attract->save();
            echo "Attraction $attract->name created successfully\n";
        }
    }
}
