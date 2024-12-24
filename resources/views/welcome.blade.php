<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/svg+xml" href="/landingPage/image/file-lines-regular.svg">
    <meta name="generator" content="Hugo 0.48" />
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>UniPlanner Головна</title>
    <meta name="keywords" content="yeo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,400,700" rel="stylesheet">
    <link rel="stylesheet" href="/landingPage/css/spectre.css">
    <link rel="stylesheet" href="/landingPage/css/spectre-icons.css">
    <link rel="stylesheet" href="/landingPage/css/spectre-exp.css">
    <link rel="stylesheet" href="/landingPage/css/yeo.css">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="">
    <meta property="og:type" content="product">
    <meta property="og:image" content="">
</head>

<body>
<div class="yeo-slogan">
    <div class="container yeo-header">
        <div class="columns">
            <div class="column col-12">
                <header class="navbar">
                    <section class="navbar-section">
                        <a class="navbar-brand logo" href="{{route('welcome')}}">
                            <img class="logo-img" src="/landingPage/images/file-lines-regular.svg" alt=""><span>UniPlanner</span>
                        </a>
                    </section>
                    @if (Route::has('login'))
                    <section class="navbar-section hide-sm">
                            <a class="btn btn-link" href="#we-do">Можливості</a>
                            <a class="btn btn-link" href="#we-work">Приєднуйтесь</a>
                            <a class="btn btn-link" href="#price">Про нас</a>
                            <a class="btn btn-link" href="{{route('login')}}">Увійти</a>
                        @if (Route::has('register'))
                            <a class="btn btn-primary btn-hire-me" href="{{route('register')}}" >Зареєструватися</a>
                        @endif

                    </section>
                    @endif
                </header>
            </div>
        </div>
    </div>
    <div class="container slogan">
        <div class="columns">
            <div class="column col-7 col-sm-12">
                <div class="slogan-content">
                    <h1>
                        <span class="slogan-bold">UniPlanner</span>
                        <span style="font-family: 'PT Sans', sans-serif">Керування навчальними планами кафедри</span>
                    </h1>
                    <p >Спрощуйте процес планування та управління курсами з UniPlanner</p>
                    <a class="btn btn-primary btn-lg btn-start" target="_blank" href="{{route('register')}}">Спробувати зараз!</a>

                </div>
            </div>
            <div class="column col-5 hide-sm">
                <img class="slogan-img" src="/landingPage/images/yeo-feature-1.svg" alt="">
            </div>
        </div>
    </div>
</div>
<div class="yeo-do" id="we-do">
    <div class="container yeo-body">
        <div class="columns">
            <div class="column col-12">
                <h2 class="feature-title">Можливості UniPlanner</h2>
            </div>
            <div class="column col-4 col-sm-12">
                <div class="yeo-do-content">
                    <img src="/landingPage/images/what-we-do-1.svg" alt="">
                    <h3>Створення та редагування навчальних планів</h3>
                    <p>Створюйте і оновлюйте навчальні плани кафедри за кілька кліків. Додавайте курси, визначайте кількість годин для лекцій, практичних та семінарських занять, а також інші важливі характеристики.</p>
                </div>
            </div>
            <div class="column col-4 col-sm-12">
                <div class="yeo-do-content">
                    <img src="/landingPage/images/what-we-do-2.svg" alt="">
                    <h3>Зручне управління курсами</h3>
                    <p>Легко редагуйте курси, змінюйте їх структуру або викладачів, додавайте нові курси до навчального плану або видаляйте непотрібні предмети.</p>
                </div>
            </div>
            <div class="column col-4 col-sm-12">
                <div class="yeo-do-content">
                    <img src="/landingPage/images/what-we-do-3.svg" alt="">
                    <h3>Експорт навчальних планів у зручному форматі</h3>
                    <p>UniPlanner дозволяє експортувати навчальні плани у популярні формати, такі як PDF, Excel або CSV. Це дає змогу зручно зберігати, друкувати або передавати плани іншим відділам або організаціям.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="yeo-work" id="we-work">
    <div class="container yeo-body">
        <div class="columns">
            <div class="column col-12 col-sm-12">
                <h2 class="feature-title">Приєднуйтесь до UniPlanner вже сьогодні!</h2>
            </div>
            <div class="column col-10 col-sm-12 centered">
                <h2 class="yeo-work-feature">
                    Не витрачайте час на складне планування вручну. З <span class="yeo-work-feature-bold">UniPlanner</span> ви зможете керувати навчальними планами ефективно та без зайвих зусиль.
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="yeo-open-source">
    <div class="container yeo-body">
        <div class="columns">
            <div class="column col-12">
                <h2 class="feature-title">Про нас</h2>
            </div>
            <div class="column col-10 centered col-sm-12">
                <img style="height: 50px; width: auto" src="/landingPage/images/File-Report--Streamline-Core-Neon.png" alt="">
                    <h3>UniPlanner — це інноваційний веб-додаток, який допомагає кафедрам автоматизувати управління навчальними планами,
                        зберігати важливу інформацію та ефективно розподіляти ресурси. Завдяки інтуїтивно зрозумілому інтерфейсу та потужному функціоналу,
                        UniPlanner дозволяє вам легко керувати програмами навчальних курсів, розкладом занять та іншими важливими аспектами
                        академічного процесу.
                    </h3>
                <a href="{{route('register')}}" class="btn btn-lg btn-open-source">Зареєструватися</a>
            </div>
        </div>
    </div>
</div>
<div class="yeo-footer">
    <div class="container">
        <div class="columns">
            <div class="column col-3 col-sm-6">
{{--                <div class="yeo-footer-content">--}}
{{--                    <h4>Copyright</h4>--}}
{{--                    <ul class="nav">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="http://www.streamlineicons.com/?ref=lapaninja">Free Streamline Icons</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="https://ui8.net/products/illustration-pack-vol-03?ref=lapaninja">Buy Illustration Pack by Nimart1</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/06de7d069f.js" crossorigin="anonymous"></script>
</html>
