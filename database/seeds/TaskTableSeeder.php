<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) {
            $faker = \Faker\Factory::create();
            \App\Task::create([
                'title' => $faker->sentence(1),
                'priority' => rand(0,1) == 0 ? 'low' : 'high'
            ]);
        }

    }
}
