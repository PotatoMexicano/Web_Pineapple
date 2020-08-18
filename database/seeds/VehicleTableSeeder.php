<?php

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Vehicle::create([
            'license' => 'EJU-3232',
            'brand' => 'FORD',
            'model' => 'KA',
            'type' => 'hatch',
            'tags' => 'basic',
            'year' => '2010',
            'color' => 'cinza',
            'doors' => '2',
            'id_user' => '1'
        ]);
    }
}
