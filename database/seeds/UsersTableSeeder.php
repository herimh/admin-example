<?php
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder, inserta usuarios de prueba a la BD, para el ambiente de desarrollo.
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com> at <>
 * @Date 2016-02-18
 * @Copyright Copyright (c) 2016 - famsa.com
 */

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('demo'),
        ]);
    }
}
