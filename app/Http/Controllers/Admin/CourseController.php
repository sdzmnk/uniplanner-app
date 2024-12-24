<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\User;
use App\Models\StudyPlan;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Відображення форми для створення курсу.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses = Course::all();
        $teachers = User::role('teacher')->get();
        return view('admin.course.create', compact('courses', 'teachers'));
    }

    /**
     * Збереження нового курсу.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
            'type' => 'required|in:mandatory,optional',
            'hours' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1|max:12',
            'user_ids' => 'required|array',  // Добавляем валидацию для преподавателей
        ]);

        // Создание курса
        $course = Course::create($validated);

        // Привязываем преподавателей к курсу
        $course->users()->attach($request->user_ids); // Добавление преподавателей

        return redirect()->route('course.index')->with('success', 'Курс успішно створений!');
    }

    /**
     * Показати список всіх курсів.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Отримуємо всі курси
        $courses = Course::all();

        // Повертаємо вигляд зі списком курсів
        return view('admin.course.index', compact('courses'));
    }

    public function show(Course $course)
    {
        // Повертаємо вигляд з даними для перегляду
        return view('admin.course.show', compact('course'));
    }

    /**
     * Відображення сторінки редагування курсу.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function edit(Course $course)
    {

        $teachers = User::role('teacher')->orderBy('name', 'asc')->get();
        $selectedTeachers = $course->users->pluck('id')->toArray();
        return view('admin.course.edit', compact('course', 'teachers', 'selectedTeachers'));
    }

    /**
     * Оновлення інформації про курс.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Course $course)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
            'type' => 'required|in:mandatory,optional',
            'hours' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1|max:12',
            'user_ids' => 'required|array',  // Обработка преподавателей
        ]);

        // Обновляем информацию о курсе
        $course->update($validated);

        // Обновляем привязку преподавателей
        $course->users()->sync($request->user_ids);  // Используем sync для обновления связей

        return redirect()->route('course.index')->with('success', 'Курс успішно оновлений!');
    }
    /**
     * Видалення курсу.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Course $course)
    {
        // Видаляємо курс
        $course->delete();

        // Перенаправляємо з повідомленням про успішне видалення
        return redirect()->route('course.index')->with('success', 'Курс успішно видалений!');
    }
}
