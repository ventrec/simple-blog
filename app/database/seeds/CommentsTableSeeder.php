<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 100) as $index)
		{
			Comment::create([
				'text' => $faker->text,
				'user_id' => rand(1, 10),
				'blogpost_id' => rand(1, 20)
			]);
		}
	}

}