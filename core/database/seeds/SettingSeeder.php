<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Setting::create([
        'comission'=> 3,
        'trans_bonus'=>2,
        'charge'=>3,
        'signup_bonus'=>300,
        'currency'=>'BDT',
        'bonusall'=>0,

    ]);
    }
}
