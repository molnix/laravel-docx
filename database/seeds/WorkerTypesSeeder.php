<?php

use Illuminate\Database\Seeder;

class WorkerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('worker_types')->insert([
            'name'=>'Председатель',
        ]);
        DB::table('worker_types')->insert([
            'name'=>'Заместитель председателя',
        ]);
        DB::table('worker_types')->insert([
            'name'=>'Секретарь',
        ]);
        DB::table('worker_types')->insert([
            'name'=>'Сотрудник',
        ]);
    }
}
