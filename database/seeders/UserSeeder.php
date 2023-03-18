<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'pangkat' => 'Guru',
            'jabatan' => 'Guru',
            'satuan_organisasi' => 'Guru',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'nip' => '1234567890',
            'saldo_cuti' => 12,
            'level' => 'admin',
            'active' => 1,
        ]);
        User::create([
            'name' => 'Guru',
            'pangkat' => 'Guru',
            'jabatan' => 'Guru',
            'satuan_organisasi' => 'Guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'),
            'nip' => '1212121212',
            'saldo_cuti' => 12,
            'level' => 'guru',
            'active' => 1,
        ]);
        User::create([
            'name' => 'Kepala Sekolah',
            'pangkat' => 'Guru',
            'jabatan' => 'Guru',
            'satuan_organisasi' => 'Guru',
            'email' => 'kpsekolah@gmail.com',
            'password' => Hash::make('password'),
            'nip' => '1313131313',
            'saldo_cuti' => 12,
            'level' => 'kepala sekolah',
            'active' => 1,
        ]);
    }
}
