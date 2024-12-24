@extends('layouts.admin')

@section('title', 'Деталі навчального плану')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Навчальний план: {{ $studyPlan->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Примітка:</h5>
                        Деталі навчального плану, включаючи інформацію про курси, спеціальність та інше.
                    </div>

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-book"></i> {{ $studyPlan->name }}
                                    <small class="float-right">Дата створення: {{ $studyPlan->created_at->format('d.m.Y') }}</small>
                                </h4>
                            </div>
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Відповідальний
                                <address>
                                    <strong>{{ $studyPlan->user->name ?? 'Невідомо' }}</strong><br>
                                    Email: {{ $studyPlan->user->email ?? 'Невідомо' }}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Спеціальність
                                <address>
                                    <strong>{{ $studyPlan->major->name }}</strong><br>
                                    Код: {{ $studyPlan->major->code }}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Рівень освіти:</b> {{ \App\Models\StudyPlan::degreeLevels()[$studyPlan->degree_level] ?? 'Невідомо' }}<br>
                                <b>Рік:</b> {{ $studyPlan->year }}<br>
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <h5>Курси, що входять до плану:</h5>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Назва курсу</th>
                                        <th>Тип</th>
                                        <th>Кредити</th>
                                        <th>Години</th>
                                        <th>Семестр</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($studyPlan->courses as $index => $course)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ \App\Models\Course::courseTypes()[$course->type] ?? 'Невідомо' }}</td>
                                            <td>{{ $course->credits }}</td>
                                            <td>{{ $course->hours }}</td>
                                            <td>{{ $course->semester }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Курси не додані до цього навчального плану.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Summary row -->
                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Інформація:</p>
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Навчальний план розроблений для студентів спеціальності {{ $studyPlan->major->name }} на рівні {{ \App\Models\StudyPlan::degreeLevels()[$studyPlan->degree_level] ?? 'Невідомо' }}.
                                    Загальна кількість курсів: {{ $studyPlan->courses->count() }}.
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="lead">Загальні дані:</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Кількість курсів:</th>
                                            <td>{{ $studyPlan->courses->count() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Сума кредитів:</th>
                                            <td>{{ $studyPlan->courses->sum('credits') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('study_plan.index') }}" class="btn btn-secondary float-right">Назад</a>
                            </div>
                        </div>

                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="fas fa-print"></i> Друк
                        </button>
                        <a class="btn btn-danger" href="{{ route('study_plan.generate_pdf', $studyPlan->id) }}">
                            <i class="fa-regular fa-file-pdf"></i> Експорт у PDF
                        </a>
                        <a class="btn btn-success" href="{{ route('study_plan.export', $studyPlan->id) }}">
                            <i class="fa-regular fa-file-excel"></i> Експорт у Excel
                        </a>

                    </div>
                </div>
                <!-- /.invoice -->
            </div>
        </div>
    </section>
@endsection
