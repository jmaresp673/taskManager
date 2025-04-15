<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Electrónica', 'color_code' => '#FF5733', 'description' => 'Dispositivos electrónicos y gadgets', 'parent_id' => null, 'position' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Teléfonos Móviles', 'color_code' => '#33FF57', 'description' => 'Smartphones y accesorios', 'parent_id' => 1, 'position' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Laptops', 'color_code' => '#5733FF', 'description' => 'Portátiles y ultrabooks', 'parent_id' => 1, 'position' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'name' => 'Tablets', 'color_code' => '#FF33A1', 'description' => 'Tablets y dispositivos híbridos', 'parent_id' => 1, 'position' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'name' => 'Accesorios para PC', 'color_code' => '#33A1FF', 'description' => 'Teclados, ratones y más', 'parent_id' => 1, 'position' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['id' => 6, 'name' => 'Moda', 'color_code' => '#FFC300', 'description' => 'Ropa, calzado y accesorios', 'parent_id' => null, 'position' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'name' => 'Ropa de Hombre', 'color_code' => '#C70039', 'description' => 'Moda masculina', 'parent_id' => 6, 'position' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'name' => 'Ropa de Mujer', 'color_code' => '#900C3F', 'description' => 'Moda femenina', 'parent_id' => 6, 'position' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'name' => 'Zapatos', 'color_code' => '#581845', 'description' => 'Calzado para todas las edades', 'parent_id' => 6, 'position' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'name' => 'Accesorios', 'color_code' => '#1ABC9C', 'description' => 'Bolsos, relojes, gafas de sol', 'parent_id' => 6, 'position' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['id' => 11, 'name' => 'Hogar y Cocina', 'color_code' => '#2ECC71', 'description' => 'Electrodomésticos y utensilios', 'parent_id' => null, 'position' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'name' => 'Electrodomésticos', 'color_code' => '#3498DB', 'description' => 'Neveras, hornos y más', 'parent_id' => 11, 'position' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'name' => 'Muebles', 'color_code' => '#9B59B6', 'description' => 'Sofás, mesas y sillas', 'parent_id' => 11, 'position' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'name' => 'Decoración', 'color_code' => '#E74C3C', 'description' => 'Cuadros, alfombras y adornos', 'parent_id' => 11, 'position' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'name' => 'Herramientas', 'color_code' => '#34495E', 'description' => 'Taladros, sierras y más', 'parent_id' => 11, 'position' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['id' => 16, 'name' => 'Deportes', 'color_code' => '#F39C12', 'description' => 'Equipamiento y ropa deportiva', 'parent_id' => null, 'position' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 17, 'name' => 'Fútbol', 'color_code' => '#D35400', 'description' => 'Balones, camisetas y botas', 'parent_id' => 16, 'position' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'name' => 'Gimnasio', 'color_code' => '#8E44AD', 'description' => 'Pesas, máquinas y ropa', 'parent_id' => 16, 'position' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 19, 'name' => 'Ciclismo', 'color_code' => '#27AE60', 'description' => 'Bicicletas y accesorios', 'parent_id' => 16, 'position' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 20, 'name' => 'Natación', 'color_code' => '#2980B9', 'description' => 'Trajes de baño y gafas', 'parent_id' => 16, 'position' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
