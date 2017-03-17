<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    static $deeper = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categories = [
            [
                'name' => $faker->word,
                'children' => [
                    [
                        'name' => $faker->word,

                    ],
                    [
                        'name' => $faker->word,
                    ],
                    [
                        'name' => $faker->word,
                    ],
                    [
                        'name' => $faker->word,
                    ],
                    [
                        'name' => $faker->word,
                        'children' => [
                            [
                                'name' => $faker->word,
                            ],
                            [
                                'name' => $faker->word
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => $faker->word,
            ],
            [
                'name' => $faker->word,
            ],
            [
                'name' => $faker->word
            ],
            [
                'name' => $faker->word,
                'children' => [
                    [
                        'name' => $faker->word,
                    ],
                    [
                        'name' => $faker->word
                    ]
                ]
            ]

        ];


    }

    private function loop(array $categories, $lft = 1, $rgt =2)
    {
        $result = [];
        $width = $rgt - $lft + 1 ;
        foreach($categories as $key=> $value) {
            $result[] = "UPDATE tags SET lpos = lpos + :width WHERE lpos >= :newpos";
            if ($value['children']) {
                $this->loop($value['children']);
            }
        }
    }

}