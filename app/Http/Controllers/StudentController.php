<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyPlan;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        // Получаем учебный план, связанный с текущим авторизованным пользователем
        $user = Auth::user(); // Получаем текущего студента
        $studyPlan = $user->studyPlans()->first(); // Получаем первый учебный план студента через связь

        if (!$studyPlan) {
            // Если учебный план не найден, сохраняем сообщение в сессии
            session()->flash('error', 'У вас немає привʼязаного навчального плану!');
        }

        // Отображаем страницу с учебным планом для студента
        return view('student', compact('studyPlan'));

    }
}
