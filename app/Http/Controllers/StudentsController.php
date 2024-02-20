<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Rules\ArrayElementNotNull;
use App\Rules\MatchArraySize;
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
        if ($students->isEmpty()) return Inertia::render('Errors/Empty');
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
            'subjects'      => ['required', 'array', 'max:8', new MatchArraySize('teachers'), new ArrayElementNotNull()],
            'teachers'      => ['required', 'array', new MatchArraySize('subjects'), new ArrayElementNotNull()],
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

    public function student_career(int $id) {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');

        $academicData = $student->academicData->first();
        if (!$academicData) return response()->json('No academic data found for this student');

        $subject = $academicData->subject;
        if (!$subject) return response()->json('No subject found for this student');

        $career = $subject->career;
        if (!$career) return response()->json('No career found for this subject');

        return response()->json($career);
    }

    public function student_subjects(int $id) {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');

        $academicData = $student->academicData;
        if ($academicData->isEmpty()) return response()->json('No academic data found for this student');

        $subjects = [];
        foreach ($academicData as $data) {
            $subject = $data->subject;
            if ($subject) array_push($subjects, $subject);
        }

        if (empty($subjects)) return response()->json('No subjects found for this student');
        return response()->json($subjects);
    }

    public function student_teachers(int $id) {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');

        $academicData = $student->academicData;
        if ($academicData->isEmpty()) return response()->json('No academic data found for this student');

        $teachers = [];
        foreach ($academicData as $data) {
            $teacher = $data->teacher;
            $subject = $data->subject;
            if ($teacher && $subject) {
                if (array_key_exists($teacher->id, $teachers)) {// Si el profesor ya está en el array, añade la materia a su lista
                    $teachers[$teacher->id]['subjects'][] = $subject->name;
                } else {
                    $teachers[$teacher->id] = [// Si el profesor no está en el array, añádelo con su primera materia
                        'teacher' => $teacher,
                        'subjects' => [$subject->name]
                    ];
                }
            }
        }

        if (empty($teachers)) return response()->json('No teachers found for this student');
        return response()->json($teachers);
    }


    public function selectedTeachers(int $id){
        $teachers = AcademicData::where('student_id', $id)
            ->join('teachers', 'academic_data.teacher_id', '=', 'teachers.id')
            ->select('teachers.id as id', 'teachers.name as name', 'teachers.email as email')
            ->get();
        if ($teachers->isEmpty()) return response()->json('No teachers found for this student');
        return response()->json($teachers);
    }


    public function selectedSubjects(int $id){
        $subjects = AcademicData::where('student_id', $id)
            ->join('subjects', 'academic_data.subject_id', '=', 'subjects.id')
            ->select('subjects.id as id', 'subjects.name as name')
            ->get();
        if ($subjects->isEmpty()) return response()->json('No subjects found for this student');
        return response()->json($subjects);
    }

    public function show(int $id) : Response {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');
        return Inertia::render('Students/Show', [
            'student' => $student
        ]);
    }

    public function edit(int $id) : Response {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');
        return Inertia::render('Students/Update', [
            'student' => $student
        ]);
    }

    public function update(Request $request, int $id) {
        $student = Student::find($id);
        if (!$student) return Inertia::render('Errors/404');

        $request->validate([
            "name"          => "required|min:3|max:30",
            "last_name"     => "required|min:2|max:30",
            "email"         => "required|email|unique:students,email," . $id,
            'phone'         => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:students,phone,' . $id,
            'address'       => 'required|min:5|max:100|min:1',
            'subjects'      => ['required', 'array', 'max:8', new MatchArraySize('teachers'), new ArrayElementNotNull()],
            'teachers'      => ['required', 'array', new MatchArraySize('subjects'), new ArrayElementNotNull()],
        ]);

        $student->name      = $request->get('name');
        $student->last_name = $request->get('last_name');
        $student->email     = $request->get('email');
        $student->phone     = $request->get('phone');
        $student->address   = $request->get('address');
        $student->save();

        AcademicData::where('student_id', $student->id)->delete();

        foreach ($request->get('subjects') as $index => $subject_id) {
            $academicData = new AcademicData();
            $academicData->student_id = $student->id;
            $academicData->subject_id = $subject_id;
            $academicData->teacher_id = $request->get('teachers')[$index];
            $academicData->save();
        }

        return redirect()->route('students.index', ['arr' => Student::all()]);
    }



}
