<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudyPlan;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudyPlanUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudyPlanExport;


class StudyPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyPlans = StudyPlan::orderBy('id', 'desc')->with('major')->with('user')->get();
        return view('admin.study_plan.index', compact('studyPlans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::orderBy('name', 'asc')->get();
        $degreeLevels = StudyPlan::degreeLevels();
        $majors = Major::orderBy('code', 'asc')->get();
        return view('admin.study_plan.create', compact('majors'), compact('degreeLevels', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudyPlanUpdateRequest $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'major_id' => 'required|exists:majors,id',
            'degree_level' => 'required|string',
            'year' => 'required|integer|min:2024|max:2026',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        // Создаём учебный план
        $studyPlan = StudyPlan::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'major_id' => $request->major_id,
            'degree_level' => $request->degree_level,
            'year' => $request->year,
        ]);

        // Связываем курсы с учебным планом
        $studyPlan->courses()->attach($request->course_ids);

        return redirect()->route('study_plan.index')->with('success', 'Навчальний план створено успішно!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyPlan $studyPlan)
    {
        $studyPlan->load('courses', 'major');

        return view('admin.study_plan.show', compact('studyPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyPlan $studyPlan)
    {
        $degreeLevels = StudyPlan::degreeLevels();
        $majors = Major::orderBy('code', 'asc')->get();
        $courses = Course::orderBy('name', 'asc')->get();
        $selectedCourses = $studyPlan->courses->pluck('id')->toArray();

        return view('admin.study_plan.edit', compact('studyPlan', 'majors', 'degreeLevels', 'courses', 'selectedCourses'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyPlan $studyPlan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'major_id' => 'required|exists:majors,id',
            'degree_level' => 'required|string',
            'year' => 'required|integer|min:2024|max:2026',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        // Обновление данных учебного плана
        $studyPlan->update([
            'name' => $request->name,
            'major_id' => $request->major_id,
            'degree_level' => $request->degree_level,
            'year' => $request->year,
        ]);

        // Синхронизация курсов с учебным планом
        $studyPlan->courses()->sync($request->course_ids);

        return redirect()->route('study_plan.index')->with('success', 'Навчальний план успішно оновлено!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyPlan $studyPlan)
    {
        $studyPlan->delete();
        return redirect()->back()->withSuccess('Навчальний план було успішно видалено!');
    }

    public function export($id)
    {
        return Excel::download(new StudyPlanExport($id), 'study_plan_' . $id . '.xlsx');
    }
}
