@extends('layouts.admin')

@section('title', 'Всі курси')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Всі курси</h1>
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
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва курсу</th>
                            <th>Кредити</th>
                            <th>Тип курсу</th>
                            <th>Години</th>
                            <th>Семестр</th>
                            <th class="no-export">Дія</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course['id'] }}</td>
                                <td>{{ $course['name'] }}</td>
                                <td>{{ $course['credits'] }}</td>
                                <td>{{ \App\Models\Course::courseTypes()[$course['type']] ?? $course['type'] }}</td>
                                <td>{{ $course['hours'] }}</td>
                                <td>{{ $course['semester'] }}</td>

                                <td class="no-export">
                                    <a class="btn btn-info btn-sm" href="{{ route('course.edit', $course['id']) }}">
                                        <i class="fas fa-pencil-alt"></i> Редагувати
                                    </a>
                                    <a class="btn btn-info btn-warning btn-sm" href="{{ route('course.show', $course['id']) }}">
                                        <i class="fa-regular fa-eye"></i> Переглянути
                                    </a>
                                    <form action="{{ route('course.destroy', $course['id']) }}" method="POST"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-trash"></i> Видалити
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Назва курсу</th>
                            <th>Кредити</th>
                            <th>Тип курсу</th>
                            <th>Години</th>
                            <th>Семестр</th>
                            <th class="no-export">Дія</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
