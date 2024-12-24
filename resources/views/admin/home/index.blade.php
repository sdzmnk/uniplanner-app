@extends('layouts.admin')

@section('title', 'Головна сторінка')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Головна сторінка</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Инструкция по использованию сайта UniPlanner -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-info text-white">
                            <h4>Інструкція по використанню сайту UniPlanner</h4>
                        </div>
                        <div class="card-body">
                            <!-- Callout для Керування користувачами -->
                            <div class="callout callout-info">
                                <h5><strong>Керування користувачами:</strong></h5>
                                <p>Додайте, редагуйте або видаляйте користувачів системи. Користувачі можуть мати різні ролі, такі як студент чи викладач.</p>
                            </div>

                            <!-- Callout для Управління навчальними планами -->
                            <div class="callout callout-success">
                                <h5><strong>Управління навчальними планами:</strong></h5>
                                <p>Створюйте, редагуйте і видаляйте навчальні плани. У кожному навчальному плані ви можете вказати дисципліни та розклад.</p>
                            </div>

                            <!-- Callout для Дисциплін -->
                            <div class="callout callout-warning">
                                <h5><strong>Дисципліни:</strong></h5>
                                <p>Додайте та редагуйте дисципліни, які входять до навчальних планів. Ви можете вказати кількість годин, форму контролю та інші важливі деталі.</p>
                            </div>

                            <!-- Callout для Статистики -->
                            <div class="callout callout-danger">
                                <h5><strong>Статистика:</strong></h5>
                                <p>Переглядайте статистику про кількість користувачів, планів та дисциплін. Це допоможе вам краще контролювати процес навчання.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- Количество пользователей -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-gradient-primary text-white shadow-sm hover-shadow-lg">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>
                            <p>Кількість користувачів</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{route('user.index')}}" class="small-box-footer text-white">Більше інформації <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Количество навчальних планів -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-gradient-success text-white shadow-sm hover-shadow-lg">
                        <div class="inner">
                            <h3>{{ $studyPlanCount }}</h3>
                            <p>Кількість навчальних планів</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="{{route('study_plan.index')}}" class="small-box-footer text-white">Більше інформації <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Количество дисциплін -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-gradient-warning text-white shadow-sm hover-shadow-lg">
                        <div class="inner">
                            <h3>{{ $disciplineCount }}</h3>
                            <p>Кількість дисциплін</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bookmark"></i>
                        </div>
                        <a href="{{route('course.index')}}" class="small-box-footer text-white">Більше інформації <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
