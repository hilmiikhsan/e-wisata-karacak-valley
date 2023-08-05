<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $data = [
            [
                'name' => 'Super Admin',
                'username' => 'super_admin',
                'password' => Hash::make('super_admin'),
                'role' => 'super_admin'
            ],
            [
                'name' => 'Staff Karyawan',
                'username' => 'staff',
                'password' => Hash::make('staff'),
                'role' => 'staff'
            ],
            [
                'name' => 'Member A',
                'username' => 'member_a',
                'password' => Hash::make('member_a'),
                'role' => 'member'
            ],
            [
                'name' => 'Member B',
                'username' => 'member_b',
                'password' => Hash::make('member_b'),
                'role' => 'member'
            ]
        ];

        DB::table('users')->insert($data);
    }
}
