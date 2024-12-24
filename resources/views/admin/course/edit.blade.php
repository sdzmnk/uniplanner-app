@extends('layouts.admin')

@section('title', 'Редагувати курс')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редагувати курс: {{$course->name}}</h1>
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
                <form action="{{ route('course.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Назва курсу</label>
                            <input type="text" name="name" value="{{ $course->name }}" class="form-control" id="exampleInputEmail1" placeholder="Назва курсу">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputCredits">Кількість кредитів</label>
                            <input type="number" name="credits" value="{{ $course->credits }}" class="form-control" id="exampleInputCredits" placeholder="Кількість кредитів" min="1" step="1">
                        </div>

                        <div class="form-group">
                            <label>Тип курсу</label>
                            <select name="type" class="form-control">
                                @foreach (\App\Models\Course::courseTypes() as $key => $label)
                                    <option value="{{ $key }}" @if ($key == $course->type) selected @endif>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputHours">Години</label>
                            <input type="number" name="hours" value="{{ $course->hours }}" class="form-control" id="exampleInputHours" placeholder="Години" min="1" step="1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputSemester">Семестр</label>
                            <input type="number" name="semester" value="{{ $course->semester }}" class="form-control" id="exampleInputSemester" placeholder="Семестр" min="1" max="12" step="1">
                        </div>

                        <div class="form-group">
                            <label>Оберіть викладачів для навчального плану:</label>
                            <select name="user_ids[]" class="select2bs4" multiple="multiple" data-placeholder="Оберіть викладачів" style="width: 100%;">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher['id'] }}" @if (in_array($teacher['id'], $selectedTeachers)) selected @endif>
                                        {{ $teacher['name'] }} ({{ $teacher['email'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Зберегти зміни</button>
                        <a href="{{ route('course.index') }}" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
