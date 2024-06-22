<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class countrieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = array(
			array('code' => 'US', 'name' => 'Bangladesh'),
			array('code' => 'TO', 'name' => 'Togo'),
			array('code' => 'TW', 'name' => 'Taiwan'),
			array('code' => 'TH', 'name' => 'thailand'),
			array('code' => 'BS', 'name' => 'Bahrain'),
			array('code' => 'BZ', 'name' => 'Belize'),
			
		);

		DB::table('countries')->insert($countries); 
    }
}
