<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			User::create([
				'username' => $faker->firstName,
				'password' => Hash::make($faker->word),
				'access_level' => 0
			]);
		}

		User::create([
			'username' => 'admin',
			'password' => Hash::make('admin'),
			'access_level' => 10
			]);

		User::create([
			'username' => 'user',
			'password' => Hash::make('user'),
			'access_level' => 1
		]);
	}

}