<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\AcademicData;

class StudentsController extends Controller
{
    public function create() : Response{
        return Inertia::render('Students/Create');
    }

    public function index() : Response {
        $students = Student::all();
        if ($students->isEmpty()) return Inertia::render('Pages/NotFound');
        return Inertia::render('Students/Index', [
            'arr' => $students,
        ]);
    }


    public function store(Request $request) {
        $request->validate([
            "name"          => "required|min:3|max:30",
            "last_name"     => "required|min:2|max:30",
            "email"         => "required|email|unique:students,email",
            'phone'         => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:students,phone',
            'address'       => 'required|min:5|max:100',
            'subjects'      => 'required|array|max:8',
            'teachers'      => 'required|array',
        ]);

        $student = new Student();
        $student->name      = $request->get('name');
        $student->last_name = $request->get('last_name');
        $student->email     = $request->get('email');
        $student->phone     = $request->get('phone');
        $student->address   = $request->get('address');
        $student->save();

        foreach ($request->get('subjects') as $index => $subject_id) {
            $academicData = new AcademicData();
            $academicData->student_id = $student->id;
            $academicData->subject_id = $subject_id;
            $academicData->teacher_id = $request->get('teachers')[$index];
            $academicData->save();
        }

        return redirect()->route('students.index', ['arr' => Student::all()]);
    }

    public function destroy(int $id) {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');
        AcademicData::where('student_id', $id)->delete();
        $student->delete();
        return redirect()->route('students.index', ['arr' => Student::all()]);
    }

    public function confirmDelete(int $id) {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');
        return Inertia::render('Students/Confirm', [
            'student' => $student,
            'deleteStudent' => route('students.destroy', ['id' => $id]),
            'cancel' => route('students.index')
        ]);
    }





}
