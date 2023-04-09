<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Schema\Blueprint;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prep1_student', function () {
    Schema::dropIfExists('student');
    if (!Schema::hasTable('student')) {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
        });
    }
    $timestamp = time();
    DB::insert('insert into student (id, name,email) 
        values (?, ?,?)', 
        [$timestamp, 'Student'.'_'.$timestamp,'student@gmail.com'.'_'.$timestamp]);
    $timestamp++;
    DB::insert('insert into student (id, name,email) 
        values (?, ?,?)', 
        [$timestamp, 'Student'.'_'.$timestamp,'student@gmail.com'.'_'.$timestamp]);
    $timestamp++;
    DB::insert('insert into student (id, name,email) 
        values (?, ?,?)', 
        [$timestamp, 'Student'.'_'.$timestamp,'student@gmail.com'.'_'.$timestamp]);
    $student = DB::select('select * from student');
    echo "init records:<br/>";
    foreach($student as $a_student)
    {
        echo "record:".$a_student->id."|".$a_student->name."|".$a_student->email."<br/>";
    }
});


Route::get('/prep2_student', function () {
    if (!Schema::hasTable('student')) {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
        });
    }
    $timestamp = time();
    DB::insert('insert into student (id, name,email) 
        values (?, ?,?)', 
        [$timestamp, 'Student'.'_'.$timestamp,'student@gmail.com'.'_'.$timestamp]);
    $timestamp++;
        DB::insert('insert into student (id, name,email) 
        values (?, ?,?)', 
        [$timestamp, 'Student'.'_'.$timestamp,'student@gmail.com'.'_'.$timestamp]);
    $timestamp++;
        DB::insert('insert into student (id, name,email) 
        values (?, ?,?)', 
        [$timestamp, 'Student'.'_'.$timestamp,'student@gmail.com'.'_'.$timestamp]);
    $student = DB::select('select * from student');
    echo "records:<br/>";
    foreach($student as $a_student)
    {
        echo "record:".$a_student->id."|".$a_student->name."|".$a_student->email."<br/>";
    }
});



Route::get('/prep3_student', function () {
    /* assume table exist*/
    /* assume table has data*/
    $timestamp = time();
    $record_found = DB::select('select * from student where name = ?', ['Student'.'_'.$timestamp]);
    //$record_found = DB::table('student')->where('name', '=', 'Student'.'_'.$timestamp)->first();
    if ($record_found)
    {
        echo "record exists:".'Student'.'_'.$timestamp."<br/>";
    }else{
        DB::insert('insert into student (id, name,email)
        values (?, ?,?)', 
        [$timestamp, 'Student'.'_'.$timestamp,'student@gmail.com'.'_'.$timestamp]);
    }
    $student = DB::select('select * from student');
    foreach($student as $a_student)
    {
        echo "record:".$a_student->id."|".$a_student->name."|".$a_student->email."<br/>";
    }
});


Route::get('/show_tables',function(){
    //$tables =  DB::select('SHOW TABLES'); 
    $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
    foreach($tables as $table){
        $arry =  (array) $table;
        foreach ($arry as $value) {
            echo $value."<br/>";
        }
    }
});