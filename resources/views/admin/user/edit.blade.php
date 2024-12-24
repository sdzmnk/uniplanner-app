@extends('layouts.admin')

@section('title', 'Редагувати користувача')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редагувати користувача: {{ $user->name }}</h1>
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
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName">Ім'я користувача</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" value="{{ $user->name }}" placeholder="Ім'я користувача">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail" value="{{ $user->email }}" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label>Ролі</label>
                            <select name="roles[]" class="select2bs4" multiple="multiple" data-placeholder="Оберіть ролі" style="width: 100%;">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if(in_array($role->name, $userRoles)) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Conditionally show study plan field if user is a student -->
                        @if ($user->hasRole('student'))
                            <div class="form-group">
                                <label for="studyPlan">Прив'язати до плану</label>
                                <select name="study_plan_id" id="studyPlan" class="form-control">
                                    <option value="">Оберіть план</option>
                                    @foreach ($studyPlans as $plan)
                                        <option value="{{ $plan->id }}" @if(old('study_plan_id', $user->studyPlans->first()->id ?? '') == $plan->id) selected @endif>
                                            {{ $plan->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Оновити</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
