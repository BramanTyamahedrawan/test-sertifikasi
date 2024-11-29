<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            ['id' => 1, 'name' => 'Undangan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Pengumuman', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Nota Dinas', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Pemberitahuan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
