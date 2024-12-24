@extends('layouts.admin')

@section('title', 'Деталі курсу')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Курс: {{ $course->name }}</h1>
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
                        Деталі курсу, включаючи інформацію про навчальний план, спеціальність, тип курсу та інше.
                    </div>

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-book"></i> {{ $course->name }}
                                    <small class="float-right">Дата створення: {{ $course->created_at->format('d.m.Y') }}</small>
                                </h4>
                            </div>
                        </div>
                        <!-- info row -->

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
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ \App\Models\Course::courseTypes()[$course->type] ?? 'Невідомо' }}</td>
                                        <td>{{ $course->credits }}</td>
                                        <td>{{ $course->hours }}</td>
                                        <td>{{ $course->semester }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Table row for teachers -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <h5>Викладачі, що відповідають за курс:</h5>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ім'я викладача</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($course->users as $teacher)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->email }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('course.index') }}" class="btn btn-secondary float-right">Назад</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.invoice -->
            </div>
        </div>
    </section>
@endsection
