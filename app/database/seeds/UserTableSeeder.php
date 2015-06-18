<?php


class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'first_name' => 'Cristal',
			'last_name'  => 'Robles Ortiz',
			'username'   => 'kristal',
			'email'      => 'cristal.ficom@gmail.com',
			'password'   => '1713'
			//'password'   =>  Hash::make('admin')
			]);
		}

	}
