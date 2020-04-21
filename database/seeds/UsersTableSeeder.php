<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * user = User::where('email','sirius@gmail.com')->first();
         * first for getting only one record
         * get() for getting all the record
         */
        $user = User::where('email','sirius@gmail.com')->first();
        if(!$user){
            User::create([
                'name'  => 'Friska Sianturi',
                'email' => 'sirius@gmail.com',
                'role'  => 'admin',
                'password'=> Hash::make('friska')

            ]);
        }
    }
}
