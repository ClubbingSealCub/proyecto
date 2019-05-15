<?php

use Illuminate\Database\Seeder;

class FamiliasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('familias')->insert([
            'nombre'=>'Informática',
            'descripcion'=>'Ordenadores, accesorios y más',
        ]);
    }
}
