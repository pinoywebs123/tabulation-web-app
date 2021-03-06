<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'f_name'	=> 'Jason',
        	'm_name'	=> 'Marz',
        	'l_name'	=> 'Marz',
        	'email'		=> 'admin@yahoo.com',
        	'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        	'role_id'	=> 1
        ]);

        User::create([
        	'f_name'	=> 'Judge',
        	'm_name'	=> 'Marz',
        	'l_name'	=> 'Mentol',
        	'email'		=> 'judge@yahoo.com',
        	'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        	'role_id'	=> 2
        ]);

        User::create([
        	'f_name'	=> 'True',
        	'm_name'	=> 'Marz',
        	'l_name'	=> 'Emcee',
        	'email'		=> 'emcee@yahoo.com',
        	'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        	'role_id'	=> 3
        ]);

    }
}
