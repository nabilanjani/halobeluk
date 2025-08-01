<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar pengguna yang akan di-seed
        $users = [
            [
                'usertype' => 'adminbeluk',
                'name' => 'Admin',
                'email' => 'adminbeluk@gmail.com',
                'password' => 'admin123',
            ]
        ];

        foreach ($users as $user) {
            // Meng-hash password
            $user['password'] = Hash::make($user['password']);
            
            // Update atau buat data berdasarkan email, menghindari duplikat
            User::updateOrCreate(
                ['email' => $user['email']], // Kondisi pencarian berdasarkan email
                ['name' => $user['name'], 'usertype' => $user['usertype'], 'password' => $user['password']] // Data yang ingin diupdate atau dibuat
            );
        }
    }
}