<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UserSeeder::class);
         $this->call(userTableSeeder::class);

         factory('App\ModelPage', 5)->create();
         factory('App\Brand', 5)->create();
         factory('App\Item', 100)->create();

    }
}
