<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\StudyPlan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign roles
        $user->assignRole($validated['roles']);

        return redirect()->route('user.index')->with('success', 'Користувач успішно створений.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();

        // Only pass study plans if the user is a student
        $studyPlans = $user->hasRole('student') ? StudyPlan::all() : null;

        return view('admin.user.edit', compact('user', 'roles', 'userRoles', 'studyPlans'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
            'study_plan_id' => 'nullable|exists:study_plans,id', // Если это студент, то проверяем наличие учебного плана
        ]);

        // Обновляем основные данные пользователя
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Получаем ID ролей из базы и обновляем их
        $roles = Role::whereIn('name', $validated['roles'])->pluck('id')->toArray();
        $user->roles()->sync($roles); // Здесь происходит обновление ролей пользователя

        // Если пользователь — студент, привязываем его к учебному плану
        if ($user->hasRole('student') && isset($validated['study_plan_id'])) {
            // Вставка с датой текущего времени для enrolled_at
            $user->studyPlans()->syncWithoutDetaching([
                $validated['study_plan_id'] => ['enrolled_at' => now()] // Привязываем план с датой записи
            ]);
        }

        // Возвращаем ответ с успешным обновлением
        return redirect()->route('user.index')->with('success', 'Користувач успішно оновлений!');
    }



    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Користувач успішно видалений.');
    }

    public function show(User $user)
    {
        $courses = $user->hasRole('teacher') ? $user->courses : null;
        $enrollments = $user->hasRole('student') ? $user->enrollments : null;
        $studyPlans = $user->hasRole('student') ? $user->studyPlans : null;

        return view('admin.user.show', compact('user', 'courses', 'enrollments', 'studyPlans'));
    }
}
