@extends('layouts.student')

@section('title', 'Мої курси')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Мої курси</h1>
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
                    <!-- Примечание для студента -->
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Примітка:</h5>
                        Деталі ваших курсів, включаючи інформацію про викладачів, тип курсу та інше.
                    </div>

                    <!-- Курсы -->
                    <div class="invoice p-3 mb-3">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-book"></i> Ваші курси
                                    <small class="float-right">Дата отримання курсів: {{ now()->format('d.m.Y') }}</small>
                                </h4>
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <h5>Деталі курсу:</h5>
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
                                    @foreach($courses as $course)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ \App\Models\Course::courseTypes()[$course->type] ?? 'Невідомо' }}</td>
                                            <td>{{ $course->credits }}</td>
                                            <td>{{ $course->hours }}</td>
                                            <td>{{ $course->semester }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('student.index') }}" class="btn btn-secondary float-right">Назад</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div>
        </div>
    </section>
@endsection
