<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyPlan;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudyPlanUpdateRequest;


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
        $degreeLevels = StudyPlan::degreeLevels();
        $majors = Major::orderBy('code', 'asc')->get();
        return view('admin.study_plan.create', compact('majors'), compact('degreeLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudyPlanUpdateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        StudyPlan::create($data);

        return redirect()->back()->withSuccess('Навчальни план успішно додано!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyPlan $studyPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyPlan $studyPlan)
    {
        $degreeLevels = StudyPlan::degreeLevels();
        $majors = Major::orderBy('code', 'asc')->get();
        return view('admin.study_plan.edit', compact('studyPlan', 'majors', 'degreeLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudyPlanUpdateRequest $request, StudyPlan $studyPlan)
    {
        $studyPlan['user_id'] = auth()->id();
        $studyPlan->update($request->validated());

        return redirect()->route('study_plan.index')->withSuccess('Навчальний план успішно оновлено!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyPlan $studyPlan)
    {
        $studyPlan->delete();
        return redirect()->back()->withSuccess('Навчальний план було успішно видалено!');
    }
}
