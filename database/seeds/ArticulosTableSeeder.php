<?php

use Illuminate\Database\Seeder;

class ArticulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articulos')->insert([
            'nombre'=> 'Teclado Logitech G11',
            'descripcion'=> 'Un teclado gaming con teclas para macro',
            'id_vendedor'=> 1,
            'id_familia'=> 1,
            'precio'=> 100,
            'created_at'=> date("Y-m-d H:i:s"),
            'ends_at' => date("Y-m-d")." 18:30:00",
        ]);
    }
}
