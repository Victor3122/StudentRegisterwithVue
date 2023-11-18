<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use illuminate\Support\Facades\File;

class StudentController extends Controller
{
    protected $student;
    public function __construct(){
        $this->student = new Student();
         
    }
 
    public function index()
    {
        return $this->student->all();
    }
 
    public function store(Request $request)
    {
        return $this->student->create($request->all());
    }
 
    public function show(string $id)
    {
        $student = $this->student->find($id);  
    }
 
    public function update(Request $request, string $id)
    {
        $student = $this->student->find($id);
        $student->update($request->all());
        return $student;
    }
 
    public function destroy(string $id)
    {
        $student = $this->student->find($id);
        return $student->delete();
    }
    public function updateStudent(Request $request, Student $student) {
        if($request->hasFile('file')){
        $file = $request->file('file'); 
        $fileName=$file->getClientOriginalName();
        $path='public/files/'.'fileName';
        Storage::disk('local')->put($path,file_get_contents($file));
        return response()->json("Uploaded!");
        }
        
    }
}
