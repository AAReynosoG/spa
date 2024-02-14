<?php

namespace App\Http\Controllers;

use App\Models\AcademicData;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeachersController extends Controller
{
    public function getTeachers() {
        $teachers = Teacher::select('id', 'name', 'email')->get();
        return response()->json($teachers);
    }

    public function create() : Response {
        return Inertia::render('Teachers/Create');
    }

    public function store(Request $request) {
        $request->validate([
            "name"          => "required|min:3|max:30",
            "last_name"     => "required|min:2|max:30",
            'phone'         => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:students,phone',
            'address'       => 'required|min:5|max:100',
            "email"         => [
                'required',
                'email',
                'unique:App\Models\Teacher,email',
            ],
        ]);
        $teacher = new Teacher();
        $teacher->name         = $request->get('name') ;
        $teacher->last_name    = $request->get('last_name');
        $teacher->phone        = $request->get('phone');
        $teacher->address      = $request->get('address');
        $teacher->email        = $request->get('email');
        $teacher->save();

        return redirect()->route('students.index');
    }

    public function index() : Response {
        $teachers = Teacher::all();
        return Inertia::render('Teachers/Index', [
            'arr' => $teachers,
        ]);
    }

    public function destroy(int $id) {
        $teacher = Teacher::find($id);
        if (!$teacher) return Inertia::render('Errors/404');
        AcademicData::where('teacher_id', $id)->delete();
        $teacher->delete();
        return redirect()->route('teachers.index');
    }

    public function confirmDelete(int $id) : Response {
        $teacher = Teacher::find($id);
        if (!$teacher) return Inertia::render('Errors/404');
        return Inertia::render('Teachers/Confirm', [
            'prof' => $teacher,
            'deleteTeacher' => route('teachers.destroy', ['id' => $teacher->id]),
            'cancel' => route('teachers.index')
        ]);
    }
}
