<?php

use Illuminate\Database\Seeder;
use App\Bond;

class BondsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = new Bond();
        $student->bond = 'Aluno de Graduação';
        $student->save();

        $postgraduate = new Bond();
        $postgraduate->bond = 'Aluno de Pós Graduação';
        $postgraduate->save();

        $teacher = new Bond();
        $teacher->bond = 'Docente';
        $teacher->save();

        $technician = new Bond();
        $technician->bond = 'Técnico Administrativo';
        $technician->save();

        $visitor = new Bond();
        $visitor->bond = 'Visitante';
        $visitor->save();
    }
}
