<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Usertable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            [
                'username' => 'JuanPablo',
                'name' => 'Juan Navarro Cabiativa',
                'email' => 'juan.navarro@corprogreso.com',
                'password' => bcrypt('N4v13mbr3123*-*'), // password
            ],
            [
                'username' => 'JQuintero',
                'name' => 'Jose Manuel Quintero',
                'email' => 'govedo3769@exitings.com',
                'password' => bcrypt('ba2E46C7wn6K'), // password
            ],
            [
                'username' => 'JAyala',
                'name' => 'Jose Francisco Ayala',
                'email' => 'gracreippojiyou-5205@yopmail.com',
                'password' => bcrypt('Y3Fu6J1KNI4E'), // password
            ],
            [
                'username' => 'AGalindo',
                'name' => 'Anibal Galindo',
                'email' => 'yardosukni@gufum.com',
                'password' => bcrypt('YLP92Ia5M7uH'), // password
            ]];

        DB::table('users')->insert($datos);
    }
}
