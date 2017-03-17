<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $users = \App\Models\Auth\User::all();
        $pages = [
            'home',
            'about',
            'contact',
            'faq',
            'policy',
            'sitemap',
            '404',
            '503',
            '403'
        ];
        $insertData = [];
        foreach ($pages as $page) {
            $insertData[] = [
                'name' => $faker->word,
                'slug' => $page,
                'content' => $faker->text,
                'first_create_user' => $users->random()->id,
                'last_update_user' => $users->random()->id,
                'created_at' => $faker->dateTime

            ];
        }

        DB::table('cms_page')->truncate();
        DB::table('cms_page')->insert($insertData);

        $insertData = [];
        foreach (range(0, 100) as $key => $value) {
            $insertData[] = [
                'name' => $faker->word,
                'slug' => $faker->slug,
                'content' => $faker->text,
                'status' => $faker->boolean,
                'first_create_user' => $users->random()->id,
                'last_update_user' => $users->random()->id,
                'created_at' => $faker->dateTime
            ];

        }
        DB::table('cms_block')->truncate();
        DB::table('cms_block')->insert($insertData);
    }
}


