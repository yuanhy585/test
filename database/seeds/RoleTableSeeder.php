<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name"=>"学员",
            "tag"=>"S",
        ]);
        Role::create([
            "name"=>"教师",
            "tag"=>"I",
        ]);
        Role::create([
            "name"=>"管理员",
            "tag"=>"A",
        ]);
        Role::create([
            "name"=>"超级管理员",
            "tag"=>"SA",
        ]);
    }
}
