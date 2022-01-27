<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Department;
class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
           'name' => 'Admin',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('admin'),
        ]);



    }

}
