<?php

namespace App\Http\Controllers;

use App\Models\AcademicData;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Career;
use Inertia\Inertia;
use Inertia\Response;

class CareersController extends Controller
{
    public function getCareers() {
        $careers = Career::select('id', 'name')->get();
        return response()->json($careers);
    }

    public function create() : Response {
        return Inertia::render('Careers/Create');
    }

    public function store(Request $request) {
        $request->validate([
            "name"          => "required|min:3|max:30",
            "description"   => "required|min:5|max:100",
        ]);
        $career = new Career();
        $career->name = $request->get('name');
        $career->description = $request->get('description');
        $career->save();

        return redirect()->route('careers.create');
    }

    public function index() : Response {
        $careers = Career::all();
        return Inertia::render('Careers/Index', [
            'arr' => $careers,
        ]);
    }

    public function destroy(int $id) {
        $career = Career::find($id);
        if (!$career) return Inertia::render('Errors/404');
        Subject::where('career_id', $id)->delete();
        AcademicData::whereIn('subject_id', function($query) use ($id) {
            $query->select('id')->from('subjects')->where('career_id', $id);
        })->delete();
        $career->delete();
        return redirect()->route('careers.index');
    }

    public function confirmDelete(int $id) : Response {
        $career = Career::find($id);
        if (!$career) return Inertia::render('Errors/404');
        return Inertia::render('Careers/Confirm', [
            'obj' => $career,
            'deleteObj' => route('careers.destroy', ['id' => $id]),
            'cancel' => route('careers.index')
        ]);
    }
}
