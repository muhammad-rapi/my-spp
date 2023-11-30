<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => (string)Str::uuid(),
                'name' => 'operator',
                'email' => 'operator@myspp.com',
                'password' => Hash::make('password'),
                'phone' => '',
                'gender' => 'Pria',
                'role' => 'operator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => (string)Str::uuid(),
                'name' => 'head master',
                'email' => 'headmaster@myspp.com',
                'password' => Hash::make('password'),
                'phone' => '',
                'gender' => 'Pria',
                'role' => 'headmaster',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];


        DB::table('users')->insert($data);
    }
}
