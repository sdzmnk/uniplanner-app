
@extends('layouts.admin')

@section('title', 'Всі навчальні плани')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Всі навчальні плани</h1>
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
                <div class="card-header">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва плану</th>
                            <th>Спеціальність</th>
                            <th>Рівень освіти</th>
                            <th>Рік</th>
                            <th>Створено користувачем</th>
                            <th class="no-export">Дія</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($studyPlans as $studyPlan)
                            <tr>
                                <td>{{ $studyPlan['id'] }}</td>
                                <td>{{ $studyPlan['name'] }}</td>
                                <td>{{$studyPlan->major->name }}</td>
                                <td>{{ $studyPlan['degree_level'] }}</td>
                                <td>{{ $studyPlan['year'] }}</td>
                                <td>{{ $studyPlan->user->name }}</td>

                            <td class="no-export">
                                    <a class="btn btn-info btn-sm" href="{{ route('study_plan.edit', $studyPlan['id']) }}">
                                        <i class="fas fa-pencil-alt"></i> Редагувати
                                    </a>
                                    <form action="{{ route('study_plan.destroy', $studyPlan['id']) }}" method="POST"
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
                            <th>Назва плану</th>
                            <th>Спеціальність</th>
                            <th>Рівень освіти</th>
                            <th>Рік</th>
                            <th>Створено користувачем</th>
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
