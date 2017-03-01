<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            "name"=>"E001",
            "role_id"=>"4",
            "status_id"=>"2",
            "language_id"=>"1",
            "department_id"=>"1",
            "email"=>"111@163.com",
            "password"=>bcrypt('123456'),
        ]);

        Profile::create([
            'user_id' => intval( $admin->id ),
        ]);
    }
}
