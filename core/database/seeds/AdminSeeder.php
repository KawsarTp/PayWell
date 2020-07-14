<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Admin::create([
        'username'=>'admin',
        'email'=>'admin@example.com',
        'password'=>bcrypt('password'),
    ]);
    }
}
