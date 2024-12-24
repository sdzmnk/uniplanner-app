@extends('layouts.admin')

@section('title', 'Всі користувачі')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Всі користувачі</h1>
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
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12 d-flex align-items-center">
                                        <!-- Иконка или аватар пользователя -->
                                        <div class="mr-3">
                                            <i class="fas fa-user-circle fa-3x text-muted"></i>
                                            <!-- Если у пользователя есть аватар, можно заменить на изображение -->
                                            <!-- <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="img-fluid rounded-circle" width="50"> -->
                                        </div>
                                        <div>
                                            <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                            <p class="text-muted text-sm"><b>Email: </b> {{ $user->email }}</p>
                                            <p class="text-muted text-sm"><b>Створено: </b> {{ $user->created_at->format('d.m.Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye"></i> Переглянути
                                    </a>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-pencil-alt"></i> Редагувати
                                    </a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i> Видалити
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
