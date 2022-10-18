<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        DB::table('users')->insert([
            'username' => 'zecaes',
            'password' => Hash::make('12345'),
            'first_name' => 'Zé',
            'last_name' => 'dos Cães',
            'email' => 'zecao@hotmail.com'
        ]);
      

        DB::table('users')->insert([
            'username' => 'dudu',
            'password' => Hash::make('12345'),
            'first_name' => 'Dudu',
            'last_name' => 'dos Montes',
            'email' => 'dudinho@hotmail.com'
        ]);

        DB::table('users')->insert([
            'username' => 'buninho',
            'password' => Hash::make('12345'),
            'first_name' => 'Buninho',
            'last_name' => 'Cabeludo',
            'email' => 'ponytale@hotmail.com'
        ]);

        DB::table('users')->insert([
            'username' => 'fefe',
            'password' => Hash::make('12345'),
            'first_name' => 'Fefe',
            'last_name' => 'Oculinhos',
            'email' => 'fefe_glass@hotmail.com'
        ]);

        DB::table('posts')->insert([
            'title' => 'Farense é o maior da zona !!!!!',
            'content' => 'Do esforço se faz a vitória, Que no tempo nos trará saudade, Duma página bela de história, Escrita pla nossa vontade. Com os olhos postos no futuro, E a grandeza que o sonho nos traz, Mostraremos ao mundo as façanhas, De que a gente de faro é capaz. Cantaremos todos numa voz, À vitória farense, à vitória, Içaremos a tua bandeira, Brindaremos em tua memória, E para as gerações do futuro, À vitória farense, à vitória, Nunca mais murchará a semente, Do arrojo, da fama e da glória.',
            'id_user' => '4'
        ]);

        DB::table('posts')->insert([
            'title' => 'Private msg @buninho',
            'content' => 'Bora fumar mó !!!!',
            'id_user' => '1'
        ]);

        DB::table('posts')->insert([
            'title' => 'CABELO !!?!??!?',
            'content' => 'pah podem me dizer um cabeleireiro para eu cortar as pontas? atenção:cabeleireiro de mulheres porque os homens não sabem mexer no meu cabelinho',
            'id_user' => '3'
        ]);

        DB::table('posts')->insert([
            'title' => 'PUReza !!!',
            'content' => 'maltinha javascript puro é que é !!! o grau de pureza é extremamente elevado, O K !!!!!',
            'id_user' => '2'
        ]);

        DB::table('comments')->insert([
            'content' => 'nao gosto de futebol!!',
            'id_post' => '1',
            'id_user' => '1'
        ]);

        DB::table('comments')->insert([
            'content' => 'bora eu levo os filtros que andas a extorquir-me lol ',
            'id_post' => '2',
            'id_user' => '3'
        ]);

        DB::table('comments')->insert([
            'content' => 'vou falar com o dudu ele tem um bom cabeleireiro:P',
            'id_post' => '3',
            'id_user' => '4'
        ]);

        DB::table('comments')->insert([
            'content' => 'AHAHAHHA pureza foi aquilo que fumaste lol ',
            'id_post' => '4',
            'id_user' => '1'
        ]);

        DB::table('comments')->insert([
            'content' => 'Confirma-se tás todo apanhado :P ',
            'id_post' => '4',
            'id_user' => '3'
        ]);

    }
}
