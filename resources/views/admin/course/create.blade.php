@extends('layouts.admin')

@section('title', 'Створити курс')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Створити курс</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-times"></i> {{ $errors->first() }}</h4>
                </div>
            @endif

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('course.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="courseName">Назва курсу</label>
                            <input type="text" name="name" class="form-control" id="courseName" placeholder="Назва курсу">
                        </div>

                        <div class="form-group">
                            <label for="courseCredits">Кредити</label>
                            <input type="number" name="credits" class="form-control" id="courseCredits" placeholder="Кредити">
                        </div>

                        <div class="form-group">
                            <label for="courseType">Тип курсу</label>
                            <select name="type" class="form-control" id="courseType">
                                @foreach (\App\Models\Course::courseTypes() as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="courseHours">Кількість годин</label>
                            <input type="number" name="hours" class="form-control" id="courseHours" placeholder="Кількість годин">
                        </div>

                        <div class="form-group">
                            <label for="courseSemester">Семестр</label>
                            <input type="number" name="semester" class="form-control" id="courseSemester" placeholder="Семестр" min="1" max="12">
                        </div>

                        <div class="form-group">
                            <label>Оберіть викладачів для курсу: </label>
                            <select name="user_ids[]" class="select2bs4" multiple="multiple" data-placeholder="Оберіть викладачів"
                                    style="width: 100%;">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->name }} ({{ $teacher->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Створити курс</button>
                        <a href="{{ route('course.index') }}" class="btn btn-secondary">Назад</a>
                    </div>

                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
