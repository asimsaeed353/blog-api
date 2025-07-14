<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    function list()
    {
        return Student::all();
    }

    function addStudent(Request $request){

        // validate incoming data before storing in database

        $rules = array(
            'name' => 'required | min:2 | max:10',
            'email' => 'required | email',
            'phone' => 'required'
        );

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            return $validation->errors();
        }

        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        if($student->save()){
            return ['result' => 'Student Added'];
        }

        return ['result' => 'Operation Failed'];
    }

    function updateStudent(Request $request){

        $student = Student::find($request->id);

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        if($student->save()){
            return ['result' => 'Student Updated'];
        }

        return ['result' => 'Student Updation Failed'];
    }

    function deleteStudent($id){

        $student = Student::find($id);

        if(! $student){
            return ['result' => 'Student not found'];
        }

        $student->delete();

        return ['result' => 'Student Deleted'];
    }

    // search in the database
    function searchStudent($name){
        $name = trim($name);

        $student = Student::where('name', 'like', '%' . $name . '%')->get();

        // or ::where('name', 'like', "%{$name}%")->get();

        if($student->isEmpty()){
            return ['result' => 'Student not found!'];
        }
        else{
            return ['result' => $student];
        }
    }
}

