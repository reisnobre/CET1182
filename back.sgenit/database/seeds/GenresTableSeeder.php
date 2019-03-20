<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Genre();
        $admin->name = "staff";
        $admin->description = "Comissão Organizadora";
        $admin->save();

        $sudo = new Genre();
        $sudo->name = "monitor";
        $sudo->description = "Monitor";
        $sudo->save();

        $user = new Genre();
        $user->name = "listener";
        $user->description = "Ouvinte";
        $user->save();
    }
}
