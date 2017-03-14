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
        $groups = factory(App\Models\Auth\Group::class, 10)->create();
        var_dump(array_rand($groups));
    /*    factory(App\Models\Auth\User::class, 50)->create()->each(function ($u) {
            $u->groups()->save();
            //$u->posts()->save(factory(App\Post::class)->make());
        });*/
    }
}


