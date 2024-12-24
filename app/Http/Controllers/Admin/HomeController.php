<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyPlan;
use App\Models\Course;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
    {
        $userCount = User::count();
        $studyPlanCount = StudyPlan::count();
        $disciplineCount = Course::count();
        return view('admin.home.index', compact('userCount', 'studyPlanCount', 'disciplineCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
