<?php

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    static $deeper = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dateTime = new \DateTime();

        $roles = [
            [
                'name'=> 'ROLE_USER',
                'display_name'=> 'Registered',
                'created_at'=> $dateTime->format('Y-m-d H:i:s')
            ],
            [
                'name'=> 'ROLE_ADMIN',
                'display_name'=> 'Administrator',
                'created_at'=> $dateTime->format('Y-m-d H:i:s')
            ],
            [
                'name'=> 'ROLE_SUPER_ADMIN',
                'display_name'=> 'Super administrator',
                'created_at'=> $dateTime->format('Y-m-d H:i:s')
            ],
        ];

        DB::table('roles')->insert($roles);

        $configs = [

        ];
    }

}