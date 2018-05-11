<?php namespace App\Http\Controllers\Gantt;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Tarea;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
//use Barryvdh\DomPDF\PDF;
//use Barryvdh\DomPDF;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Response;


class GanttController extends Controller{


    public function getGantt(){
      // $ret = {"tasks":    [
      //   {"id": -1, "name": "Gantta editor", "progress": 40, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 0, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 20, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
      //   {"id": -2, "name": "coding", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 10, "end": 1398203999999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
      //   {"id": -3, "name": "gantt part", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 2, "end": 1397167199999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      //   {"id": -4, "name": "editor part", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "3", "canWrite": true, "start": 1397167200000, "duration": 4, "end": 1397685599999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      //   {"id": -5, "name": "testing", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "STATUS_SUSPENDED", "depends": "2:5", "canWrite": true, "start": 1398981600000, "duration": 5, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
      //   {"id": -6, "name": "test on safari", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "", "canWrite": true, "start": 1398981600000, "duration": 2, "end": 1399327199999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      //   {"id": -7, "name": "test on ie", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 3, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      //   {"id": -8, "name": "test on chrome", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 2, "end": 1399499999999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false}
      // ], "selectedRow": 2, "deletedTaskIds": [],
      //   "resources": [
      //   {"id": "tmp_1", "name": "Resource 1"},
      //   {"id": "tmp_2", "name": "Resource 2"},
      //   {"id": "tmp_3", "name": "Resource 3"},
      //   {"id": "tmp_4", "name": "Resource 4"}
      // ],
      //   "roles":       [
      //   {"id": "tmp_1", "name": "Project Manager"},
      //   {"id": "tmp_2", "name": "Worker"},
      //   {"id": "tmp_3", "name": "Stakeholder"},
      //   {"id": "tmp_4", "name": "Customer"}
      // ], "canWrite":    true, "canDelete":true, "canWriteOnParent": true, "zoom": "w3"};

        $users = User::get();
       //  $ret = ['ok' => true,
       //  'project' => [
       //    'tasks'  =>  [
       //    ['id'=> -1, 'name'=> 'Pablo', 'progress'=> 40, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> 'MR', 'level'=> 0, 'status'=> 'STATUS_ACTIVE', 'depends'=> '', 'canWrite'=> true, 'start'=> 1396994400000, 'duration'=> 20, 'end'=> 1399586399999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> true],
       //    ['id'=> -2, 'name'=> 'Niurka', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 1, 'status'=> 'STATUS_ACTIVE', 'depends'=> '', 'canWrite'=> true, 'start'=> 1396994400000, 'duration'=> 10, 'end'=> 1398203999999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> true],
       //    ['id'=> -3, 'name'=> 'gantt part', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_ACTIVE', 'depends'=> '', 'canWrite'=> true, 'start'=> 1396994400000, 'duration'=> 2, 'end'=> 1397167199999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
       //    ['id'=> -4, 'name'=> 'editor part', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '3', 'canWrite'=> true, 'start'=> 1397167200000, 'duration'=> 4, 'end'=> 1397685599999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
       //    ['id'=> -5, 'name'=> 'testing', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 1, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '2=>5', 'canWrite'=> true, 'start'=> 1398981600000, 'duration'=> 5, 'end'=> 1399586399999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> true],
       //    ['id'=> -6, 'name'=> 'test on safari', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '', 'canWrite'=> true, 'start'=> 1398981600000, 'duration'=> 2, 'end'=> 1399327199999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
       //    ['id'=> -7, 'name'=> 'test on ie', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '6', 'canWrite'=> true, 'start'=> 1399327200000, 'duration'=> 3, 'end'=> 1399586399999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
       //    ['id'=> -8, 'name'=> 'Asopotamadre', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '6', 'canWrite'=> true, 'start'=> 1399327200000, 'duration'=> 2, 'end'=> 1399499999999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false]
       //  ], 'selectedRow'=> 2, 'deletedTaskIds'=> [],
       //    'resources'=> [
       //    ['id'=> 'tmp_1', 'name'=> 'Resource 1'],
       //    ['id'=> 'tmp_2', 'name'=> 'Resource 2'],
       //    ['id'=> 'tmp_3', 'name'=> 'Resource 3'],
       //    ['id'=> 'tmp_4', 'name'=> 'Resource 4']
       //  ],
       //    'roles'=>       [
       //    ['id'=> 'tmp_1', 'name'=> 'Project Manager'],
       //    ['id'=> 'tmp_2', 'name'=> 'Worker'],
       //    ['id'=> 'tmp_3', 'name'=> 'Stakeholder'],
       //    ['id'=> 'tmp_4', 'name'=> 'Customer']
       //  ], 'canWrite'=>    true, 'canDelete'=>true, 'canWriteOnParent'=> true, 'zoom'=> 'w3']
       // ];
        $id_proyecto = '1';
        $tareas = Tarea::where('id_proyecto', $id_proyecto)
                ->get();
        $ret = ['ok' => true];
        $p = [];
        $pp = [];
        foreach ($tareas as $t) {
          $i = ['id' => $t->id, 'progress' => $t->progress, 'name' => $t->name, 'progressByWorklog' => false, 'relevance' => 0, 'type' => '', 'typeId' => '',
          'description' => $t->description, 'code' => $t->code, 'level' => $t->level, 'status' => $t->status, 'depends' => $t->depends, 'canWrite' => true, 'start'=> $t->start,
          'duration'=> $duracion = $t->duration, 'end'=> $t->end, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> true];
          //$h = $this->array_push_assoc($h, 'id', $t->id);
          array_push($p, $i);
        }
        foreach ($users as $u) {
          $i = ['id' => $u->id, 'name' => $u->name];
          //$h = $this->array_push_assoc($h, 'id', $t->id);
          array_push($pp, $i);
        }

        //USUARIOS POR DEFECTO
        $rr = [['id' => "tmp_1", 'name' => "Resource 1"],
                ['id' => "tmp_2", 'name' => "Resource 2"]];
        $roles = [['id' => '1', 'name' => 'Director Ejecutivo'],
                  ['id' => '2', 'name' => 'Coordinador de Programa']];
        $ret['project'] = ['tasks' => $p, 'selectedRow' => 2, 'deletedTaskIds' => [], 'resources' => $rr, 'roles' => $roles,
      "canWrite" => true, "canDelete" => true, "canWriteOnParent" => true, "zoom" => "w3", 'id_proyecto' => $id_proyecto];
        //dd($h);
        return response()->json($ret);
    }
    public function saveGantt(Request $request){

      $id = $request->id_proyecto;

      $tareas = Tarea::where('id_proyecto', $id)
                ->get();
      foreach ($tareas as $t) {
        $t->delete();
      }
      $tasks = $request->tasks;
      foreach ($tasks as $t) {

        try {
          $tarea = new Tarea();
          $tarea->name = $t['name'];
          $tarea->progress = $t['progress'];
          $tarea->description = $t['description'];
          $tarea->code = $t['code'];
          $tarea->level = $t['level'];
          $tarea->status = $t['status'];
          $tarea->depends = $t['depends'];
          $tarea->start = $t['start'];
          $tarea->end = $t['end'];
          $tarea->duration = $t['duration'];
          $tarea->id_proyecto = $id;
          $tarea->save();
            } catch (\Illuminate\Database\QueryException $exception) {

            return $exception;
          }
      }


      return 'ok';
      //return response()->json($ret);
      //return response()->json(['message' => 'This is get method', 'ok' => true, 'project' => $request]);
    }
}
