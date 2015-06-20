<?php


class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'first_name' => 'Vusumzi',
			'last_name'  => 'Belmont',
			'username'   => 'Vuszi',
			'email'      => 'D.O.GeeVz@gmail.com',
			'password'   => 'pellis'
			//'password'   =>  Hash::make('admin')
			]);
		}

	}
