@extends('layouts.admin')

@section('title', "Деталі користувача: {{ $user->name }}")

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Деталі користувача: {{ $user->name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Основная карточка -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.5rem;">Інформація про користувача</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Основная информация о пользователе -->
                        <div class="col-12 col-md-8">
                            <div class="mb-3">
                                <strong class="text-primary" style="font-size: 1.2rem;">Ім'я:</strong> <span style="font-size: 1.1rem;">{{ $user->name }}</span>
                            </div>
                            <div class="mb-3">
                                <strong class="text-primary" style="font-size: 1.2rem;">Email:</strong> <span style="font-size: 1.1rem;">{{ $user->email }}</span>
                            </div>
                            <div class="mb-3">
                                <strong class="text-primary" style="font-size: 1.2rem;">Ролі:</strong> <span style="font-size: 1.1rem;">{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</span>
                            </div>

                            <!-- Курси для викладача або плани для студента -->
                            @if ($user->hasRole('teacher'))
                                <div class="mt-4">
                                    <strong class="text-info" style="font-size: 1.2rem;">Курси, які викладає:</strong>
                                    @forelse ($courses as $course)
                                        <ul class="list-unstyled" style="font-size: 1.1rem;">
                                            <li>
                                                <a href="{{ route('course.show', $course->id) }}" class="badge badge-light text-dark" style="font-size: 1.1rem;">
                                                    {{ $course->name }}
                                                </a>
                                            </li>
                                        </ul>
                                    @empty
                                        <p class="text-muted" style="font-size: 1.1rem;">Курси не знайдено</p>
                                    @endforelse
                                </div>
                            @elseif ($user->hasRole('student'))
                                <div class="mt-4">
                                    <strong class="text-info" style="font-size: 1.2rem;">Плани студента:</strong>
                                    @forelse ($studyPlans as $plan)
                                        <ul class="list-unstyled" style="font-size: 1.1rem;">
                                            <li>
                                                <a href="{{ route('study_plan.show', $plan->id) }}" class="badge badge-light text-dark" style="font-size: 1.1rem;">
                                                    {{ $plan->name }}
                                                </a>
                                            </li>
                                        </ul>
                                    @empty
                                        <p class="text-muted" style="font-size: 1.1rem;">Плани не знайдено</p>
                                    @endforelse
                                </div>
                            @endif
                        </div>

                        <!-- Дополнительная информация (например, роль или описание) -->
                        <div class="col-12 col-md-4">
                            <h5 class="text-primary" style="font-size: 1.2rem;"><i class="fas fa-user-tag"></i> Роль: <span style="font-size: 1.1rem;">{{ $user->roles->first()->name }}</span></h5>
                            <p class="text-muted" style="font-size: 1.1rem;">
                                Це користувач з роллю <strong>{{ $user->roles->first()->name }}</strong>, який активно бере участь у навчальному процесі або в якості студента, адміністратора, чи викладача.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Кнопка назад -->
                <div class="card-footer">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Назад</a>
                </div>
            </div>
        </div>
    </section>
@endsection
