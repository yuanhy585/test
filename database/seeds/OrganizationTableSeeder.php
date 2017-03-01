<?php

use App\Organization;
use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
            "parent_id"=>"0",
            "name"=>"集团",
            "tag"=>"db",
        ]);
    }
}
