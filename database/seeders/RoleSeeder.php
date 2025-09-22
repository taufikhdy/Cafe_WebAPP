<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create([
            'nama_role' => 'Admin',
        ]);

        Roles::create([
            'nama_role' => 'Kasir',
        ]);

        Roles::create([
            'nama_role' => 'Customer',
        ]);
    }
}
