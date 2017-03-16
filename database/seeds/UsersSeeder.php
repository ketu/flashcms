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

        $groups = \App\Models\Auth\Group::all();
        $insertData = [];
        \App\Models\Auth\User::chunk(200, function ($users) use ($faker, $groups, &$insertData) {
            foreach($users as $user) {
                $group = $groups->random(); //$faker->randomElement($groups->toArray());
                $insertData[] = [
                    'user_id'=> $user->id,
                    'group_id'=> $group->id,
                ];
            }
        });

        DB::table('user_group_idx')->insert($insertData);
    }
}


