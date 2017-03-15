<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        //$post_ids = \App\Post::lists('id')->toArray();
        $insertData = [];
        foreach (range(1, 10) as $key => $value) {
            $insertData[] = [
                'name' =>  $faker->userName ,
//                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
//                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ];
        }
        DB::table('user_groups')->insert($insertData);

        $insertData = [];


        foreach (range(1, 1000) as $key => $value) {
            $insertData[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('secret'),
                'remember_token' => str_random(10),
                'created_at'=> $faker->dateTime
            ];
        }
        DB::table('users')->insert($insertData);

        $groupIds = \App\Models\Auth\Group::query('id')->toArray();
        $userIds = \App\Models\Auth\User::query('id')->toArray();

        Flight::chunk(200, function ($flights) {
            foreach ($flights as $flight) {
                //
            }
        });
        $insertData = [];
        foreach($userIds as $id) {
            $insertData[] = [
                'user_id'=> $id,
                'group_id'=> $faker->randomElement($groupIds)
            ];
        }

        DB::table('user_group_idx')->insert($insertData);
    }
}


