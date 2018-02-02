<?php

use Illuminate\Database\Seeder;

class TareaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
      $table->string('name');
      $table->integer('progress');
      $table->string('description');
      $table->string('code');
      $table->integer('level');
      $table->enum('status', ['STATUS_ACTIVE', 'STATUS_DONE', 'STATUS_FAILED', 'STATUS_SUSPENDED', 'STATUS_UNDEFINED']);
      $table->string('depends');
      $table->string('start');
      $table->string('end');
      $table->string('duration');
      */
      DB::table('tareas')->insert([
        ['name'=> 'Pablo', 'progress'=> 40, 'description'=> '', 'code'=> '', 'level'=> 0, 'status'=> 'STATUS_ACTIVE',
        'depends' => '', 'start'=> 1396994400000, 'duration'=> 20, 'end'=> 1399586399999],
        ['name'=> 'Niurka', 'progress'=> 0, 'description'=> '', 'code'=> '', 'level'=> 1, 'status'=> 'STATUS_ACTIVE',
        'depends'=> '', 'start'=> 1396994400000, 'duration'=> 10, 'end'=> 1398203999999],
        ['name'=> 'gantt part', 'progress'=> 0, 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_ACTIVE',
        'depends'=> '', 'start'=> 1396994400000, 'duration'=> 2, 'end'=> 1397167199999],
        ['name'=> 'editor part', 'progress'=> 0, 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED',
        'depends'=> '3', 'start'=> 1397167200000, 'duration'=> 4, 'end'=> 1397685599999],
        ['name'=> 'testing', 'progress'=> 0, 'description'=> '', 'code'=> '', 'level'=> 1, 'status'=> 'STATUS_SUSPENDED',
        'depends'=> '2=>5', 'start'=> 1398981600000, 'duration'=> 5, 'end'=> 1399586399999],
        ['name'=> 'test on safari', 'progress'=> 0, 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED',
         'depends'=> '', 'start'=> 1398981600000, 'duration'=> 2, 'end'=> 1399327199999],
        ['name'=> 'test on ie', 'progress'=> 0, 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED',
        'depends'=> '6', 'start'=> 1399327200000, 'duration'=> 3, 'end'=> 1399586399999],
        ['name'=> 'Asopotamadre', 'progress'=> 0, 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED',
        'depends'=> '6', 'start'=> 1399327200000, 'duration'=> 2, 'end'=> 1399499999999]
      ]);


    }
}
