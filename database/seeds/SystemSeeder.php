<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configGroup = [
            'system'=> [
                'maintenanceMode'=> false,
                'baseUrl'=> url()->to('/'),
            ],
            'cms'=> [
                'homePage'=> null,
                'notFoundPage'=> null,
                'maintenancePage'=> null,

            ],
            'product'=>[

            ],
            'menu'=> [

            ],
            'slider'=> [

            ],
            'image'=> [
                'uploadDir'=> '',
                'maxSize'=> 3,
                'allowedExtention'=> [
                    'jpg',
                    'png',
                    'gif'
                ]
            ],
            'user'=> [
                'validateEmail'=> true,
                'allowRegister'=> true,
            ],
            'email'=> [
                'port'=> '',
                'address'=> '',
                'username'=> '',
                'password'=> ''

            ]
        ];
        $insertData = [];
        foreach($configGroup as $group=> $configs) {
            foreach ($configs as $path=> $value) {
                $insertData[] = [
                    'group' => $group,
                    'path' => $path,
                    'value'=> is_array($value)? \json_encode($value): $value
                ];
            }
        }
        DB::table('system_config')->truncate();
        DB::table('system_config')->insert($insertData);
    }
}


