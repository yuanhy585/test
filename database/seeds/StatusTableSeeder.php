<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            "name"=>"未激活",
            "tag"=>"PV",
        ]);
        Status::create([
            "name"=>"活动",
            "tag"=>"A",
        ]);
        Status::create([
            "name"=>"待审核",
            "tag"=>"PA",
        ]);
        Status::create([
            "name"=>"关闭",
            "tag"=>"C",
        ]);
    }
}
