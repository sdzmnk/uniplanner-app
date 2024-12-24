@extends('layouts.admin')

@section('title', 'Створити навчальний план')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редагувати навчальний план: {{$studyPlan->name}}</h1>
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
                <form action="{{route('study_plan.update', $studyPlan->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Назва плану</label>
                            <input type="text" name="name" value = "{{ $studyPlan->name}}" class="form-control" id="exampleInputEmail1" placeholder="Назва плану">
                        </div>

                        <!-- select -->
                        <div class="form-group">
                            <label>Спеціальність</label>
                            <select name="major_id" class="form-control">
                                @foreach ($majors as $major)
                                    <option value="{{ $major['id'] }}" @if ($major['id'] == $studyPlan['major_id']) selected
                                @endif> {{ $major['code'] }} - {{ $major['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div><!--/.select -->

                        <!-- select -->
                        <div class="form-group">
                            <label>Рівень ступеню освіти</label>
                            <select name="degree_level" class="form-control">
                                @foreach ($degreeLevels as $key => $label)
                                    <option value="{{ $key }}" @if ($key == $studyPlan['degree_level']) selected
                                        @endif> {{ $label }}
                                    </option>
                                @endforeach

                            </select>
                        </div><!--/.select -->

                        <div class="form-group">
                            <label>Оберіть предмети для навчального плану:</label>
                            <select name="course_ids[]" class="select2bs4" multiple="multiple" data-placeholder="Оберіть предмети" style="width: 100%;">
                                @foreach ($courses as $course)
                                    <option value="{{ $course['id'] }}" @if (in_array($course['id'], $selectedCourses)) selected @endif>
                                        {{ $course['name'] }} - {{ \App\Models\Course::courseTypes()[$course['type']] ?? $course['type'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Рік</label>
                            <input type="number" value="{{ $studyPlan->year}}" name="year" class="form-control" min="2024" max="2026" step="1" id="exampleInputEmail1" placeholder="Рік">
                        </div>

                    </div>
                    <!-- /.card-body -->


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Відредагувати</button>
                        <a href="{{ route('study_plan.index') }}" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
