<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $location1 = Location::create([
            'city' => 'kathmandu',
            'city_type' => 'main',
            'status' => 'enable'
        ]);

        $location2 = Location::create([
            'city' => 'pokhara',
            'city_type' => 'main',
            'status' => 'enable'
        ]);

        $location3 = Location::create([
            'city' => 'sub location 1',
            'city_type' => 'sub',
            'status' => 'enable'
        ]);

        $location4 = Location::create([
            'city' => 'sub location 2',
            'city_type' => 'sub',
            'status' => 'enable'
        ]);

        $route = Route::create([
            'from' => $location1->id,
            'to' => $location2->id,
            'status' => 'enable'
        ]);

        DB::table('route_sub_location')->insert([
            [
                'route_id' => $route->id,
                'sub_location_id' => $location3->id,
                'status' => 'enable'
            ],
            [
                'route_id' => $route->id,
                'sub_location_id' => $location4->id,
                'status' => 'enable'
            ]
        ]);
    }
}
