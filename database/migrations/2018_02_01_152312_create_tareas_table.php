<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //{"id": -1, "name": "Gantta editor", "progress": 40, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 0, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 20, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},

        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('progress')->nullable();
            $table->string('description')->nullable();
            $table->string('code')->nullable();
            $table->string('level')->nullable();
            $table->enum('status', ['STATUS_ACTIVE', 'STATUS_DONE', 'STATUS_FAILED', 'STATUS_SUSPENDED', 'STATUS_UNDEFINED']);
            $table->string('depends')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('duration')->nullable();
            $table->integer('id_proyecto')->unsigned();
            $table->foreign('id_proyecto')->references('id')->on('proyectos')->onDelete('Cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
