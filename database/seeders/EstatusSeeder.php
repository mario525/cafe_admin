<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Agrego los datos
        DB::table('estado_pedidos')->insert([
            'nombre' => 'PENDIENTE',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego los datos
        DB::table('estado_pedidos')->insert([
            'nombre' => 'ACCEPTADO',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego los datos
        DB::table('estado_pedidos')->insert([
            'nombre' => 'PREPARANDO',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego los datos
        DB::table('estado_pedidos')->insert([
            'nombre' => 'LISTO PARA ENTREGA',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego los datos
        DB::table('estado_pedidos')->insert([
            'nombre' => 'ENTREGADO',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);

        // Agrego los datos
        DB::table('estado_pedidos')->insert([
            'nombre' => 'CANCELADO',
            'estatus' => 'ACTIVO',
            'created_by' => 'SEEDER',
            'updated_by' => 'SEEDER',
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
        ]);
    }
}
