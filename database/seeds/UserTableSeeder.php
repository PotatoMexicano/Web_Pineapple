<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::create([
            'name' => 'Gabriel Cordeiro',
            'email' => 'potatomexicano006@yahoo.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
