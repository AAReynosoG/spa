<?php

namespace App\Http\Controllers;

use App\Models\AcademicData;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SubjectsController extends Controller
{
    public function getSubjects($careerId){
        $subjects = Subject::select('id', 'name')->where('career_id', $careerId)->get();
        if ($subjects->isEmpty()) return response()->json(['message' => 'No subjects found'], 404);
        return response()->json($subjects);
    }

    public function create() : Response {
        return Inertia::render('Subjects/Create');
    }

    public function index() : Response {
        $subjects = Subject::all()->load('career');
        return Inertia::render('Subjects/Index', [
            'arr' => $subjects,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            "name"          => "required|min:3|max:30",
            "career_id"     => "required|exists:careers,id",
        ]);
        $subject = new Subject();
        $subject->name      = $request->get('name');
        $subject->career_id = $request->get('career_id');
        $subject->save();

        return redirect()->route('subjects.create');
    }

    public function destroy(int $id) {
        $subject = Subject::find($id);
        if (!$subject) return Inertia::render('Errors/404');
        AcademicData::where('subject_id', $id)->delete();
        $subject->delete();
        return redirect()->route('subjects.index');
    }

    public function confirmDelete(int $id) : Response {
        $subject = Subject::find($id);
        if (!$subject) return Inertia::render('Errors/404');
        return Inertia::render('Subjects/Confirm', [
            'obj' => $subject,
            'deleteObj' => route('subjects.destroy', ['id' => $id]),
            'cancel' => route('subjects.index')
        ]);
    }
}
