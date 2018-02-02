<?php namespace App\Http\Controllers\Gantt;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Tarea;
// use App\User;
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
        $tareas = Tarea::get();
        dd($tareas);
        $ret = ['ok' => true,
        'project' => [
          'tasks'  =>  [
          ['id'=> -1, 'name'=> 'Pablo', 'progress'=> 40, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 0, 'status'=> 'STATUS_ACTIVE', 'depends'=> '', 'canWrite'=> true, 'start'=> 1396994400000, 'duration'=> 20, 'end'=> 1399586399999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> true],
          ['id'=> -2, 'name'=> 'Niurka', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 1, 'status'=> 'STATUS_ACTIVE', 'depends'=> '', 'canWrite'=> true, 'start'=> 1396994400000, 'duration'=> 10, 'end'=> 1398203999999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> true],
          ['id'=> -3, 'name'=> 'gantt part', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_ACTIVE', 'depends'=> '', 'canWrite'=> true, 'start'=> 1396994400000, 'duration'=> 2, 'end'=> 1397167199999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
          ['id'=> -4, 'name'=> 'editor part', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '3', 'canWrite'=> true, 'start'=> 1397167200000, 'duration'=> 4, 'end'=> 1397685599999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
          ['id'=> -5, 'name'=> 'testing', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 1, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '2=>5', 'canWrite'=> true, 'start'=> 1398981600000, 'duration'=> 5, 'end'=> 1399586399999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> true],
          ['id'=> -6, 'name'=> 'test on safari', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '', 'canWrite'=> true, 'start'=> 1398981600000, 'duration'=> 2, 'end'=> 1399327199999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
          ['id'=> -7, 'name'=> 'test on ie', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '6', 'canWrite'=> true, 'start'=> 1399327200000, 'duration'=> 3, 'end'=> 1399586399999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false],
          ['id'=> -8, 'name'=> 'Asopotamadre', 'progress'=> 0, 'progressByWorklog'=> false, 'relevance'=> 0, 'type'=> '', 'typeId'=> '', 'description'=> '', 'code'=> '', 'level'=> 2, 'status'=> 'STATUS_SUSPENDED', 'depends'=> '6', 'canWrite'=> true, 'start'=> 1399327200000, 'duration'=> 2, 'end'=> 1399499999999, 'startIsMilestone'=> false, 'endIsMilestone'=> false, 'collapsed'=> false, 'assigs'=> [], 'hasChild'=> false]
        ], 'selectedRow'=> 2, 'deletedTaskIds'=> [],
          'resources'=> [
          ['id'=> 'tmp_1', 'name'=> 'Resource 1'],
          ['id'=> 'tmp_2', 'name'=> 'Resource 2'],
          ['id'=> 'tmp_3', 'name'=> 'Resource 3'],
          ['id'=> 'tmp_4', 'name'=> 'Resource 4']
        ],
          'roles'=>       [
          ['id'=> 'tmp_1', 'name'=> 'Project Manager'],
          ['id'=> 'tmp_2', 'name'=> 'Worker'],
          ['id'=> 'tmp_3', 'name'=> 'Stakeholder'],
          ['id'=> 'tmp_4', 'name'=> 'Customer']
        ], 'canWrite'=>    true, 'canDelete'=>true, 'canWriteOnParent'=> true, 'zoom'=> 'w3']
       ];
        return response()->json($ret);
    }
}
