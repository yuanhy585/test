<?php

use App\Gender;
use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create([
            "name"=>"女",
            "tag"=>"F",
        ]);
        Gender::create([
            "name"=>"男",
            "tag"=>"M",
        ]);
    }
}
