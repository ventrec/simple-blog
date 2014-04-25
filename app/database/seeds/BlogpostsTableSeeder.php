<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BlogpostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $index)
		{
			$title = $faker->sentence;

			Blogpost::create([
				'title' => $title,
				'slug' => Str::slug($title, '_'),
				'text' => $faker->text,
				'user_id' => rand(1,10)
			]);
		}
	}

}