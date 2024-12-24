<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        // Получаем учебный план, связанный с текущим авторизованным пользователем
        $user = Auth::user(); // Получаем текущего студента
        $courses = $user->courses()->get(); // Получаем первый учебный план студента через связь

        if (!$courses) {
            // Если учебный план не найден, сохраняем сообщение в сессии
            session()->flash('error', 'У вас немає привʼязаного навчального плану!');
        }

        // Отображаем страницу с учебным планом для студента
        return view('teacher', compact('courses'));

    }
}
