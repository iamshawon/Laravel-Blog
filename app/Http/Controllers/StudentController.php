<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    //index = 1
    public function index(){
        $student = Student::all();
        // return response()->json($student);
        return view('student/index', compact('student'));
    }
    //create = 2
    public function create(){
        return view('student/create');
    }
    //store = 3
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:25|min:4',
            'email' => 'required|unique:students',
            'phone' => 'required|unique:students|max:12|min:9',
        ]);

        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        // return response()->json($student);
        $student->save();
        $notification=array(
            'message'=> 'Successfully Student Inserted',
            'alert-type'=> 'success'
        );
        return Redirect()->back()->with($notification);
    }

    //show = 4
    public function show($id){
        $student = Student::find($id);
        // return response()->json($student);
        // print_r($student);
        return view('pages/student', compact('student'));
    }
    //edit = 5
    public function edit($id){
        $student = Student::findorfail($id);
        return view('student/edit', compact('student'));
    }
    //update = 6
    public function update(Request $request, $id){
        $student = Student::findorfail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        $student->save();
        $notification=array(
            'message'=> 'Successfully Student Updated!',
            'alert-type'=> 'info'
        );
        return Redirect()->route('all.student')->with($notification);
    }
    //destroy = 7
    public function destroy($id){
        $student = Student::findorfail($id);
        $student->delete();
        $notification=array(
            'message'=> 'Successfully Student Deleted!',
            'alert-type'=> 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
