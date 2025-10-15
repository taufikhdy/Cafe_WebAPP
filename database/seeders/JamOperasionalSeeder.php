<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JamOperasionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $datas = [
            ['hari' => 'Monday', 'jam_buka' => '08:00:00', 'jam_tutup' => '22:00:00', 'status' => 1],
            ['hari' => 'Tuesday', 'jam_buka' => '08:00:00', 'jam_tutup' => '22:00:00', 'status' => 1],
            ['hari' => 'Wednesday', 'jam_buka' => '08:00:00', 'jam_tutup' => '22:00:00', 'status' => 1],
            ['hari' => 'Thursday', 'jam_buka' => '08:00:00', 'jam_tutup' => '22:00:00', 'status' => 1],
            ['hari' => 'Friday', 'jam_buka' => '08:00:00', 'jam_tutup' => '22:00:00', 'status' => 1],
            ['hari' => 'Saturday', 'jam_buka' => '08:00:00', 'jam_tutup' => '22:00:00', 'status' => 1],
            ['hari' => 'Sunday', 'jam_buka' => '08:00:00', 'jam_tutup' => '22:00:00', 'status' => 0],
        ];

        DB::table('jam_operasional')->insert($datas);
    }
}
