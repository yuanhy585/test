<?php

use App\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            "name"=>"中文",
            "tag"=>"ch",
        ]);
        Language::create([
            "name"=>"English",
            "tag"=>"en",
        ]);
    }
}
