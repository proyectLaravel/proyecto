<?php


class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'first_name' => 'Alicia',
			'last_name'  => 'Guzman',
			'username'   => 'alicia.guzman',
			'email'      => 'ezeezegg@gmail.com',
			'password'   => 'admin'
			//'password'   =>  Hash::make('admin')
			]);
		}
		
		
	}
