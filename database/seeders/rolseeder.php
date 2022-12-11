<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           // Agrego los datos
           DB::table('roles')->insert([
            'nombre' => 'Cliente',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego los datos
        DB::table('roles')->insert([
            'nombre' => 'Admin',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

    }
}
