<?php

namespace Database\Seeders;

use App\Models\EstadoPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(User::class);
        $this->call(Config::class);
        $this->call(EstatusSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(rolseeder::class);
    }
}
