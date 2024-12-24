<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $studyPlan->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<h1>Навчальний план: {{ $studyPlan->name }}</h1>
<p><strong>Відповідальний:</strong> {{ $studyPlan->user->name ?? 'Невідомо' }}</p>
<p><strong>Email:</strong> {{ $studyPlan->user->email ?? 'Невідомо' }}</p>
<p><strong>Спеціальність:</strong> {{ $studyPlan->major->name }}</p>
<p><strong>Код спеціальності:</strong> {{ $studyPlan->major->code }}</p>
<p><strong>Рівень освіти:</strong> {{ $degreeLevel }}</p>
<p><strong>Рік:</strong> {{ $studyPlan->year }}</p>

<h2>Інформація про курси</h2>
<table>
    <thead>
    <tr>
        <th>ID курсу</th>
        <th>Назва курсу</th>
        <th>Кредити</th>
        <th>Тип курсу</th>
        <th>Години</th>
        <th>Семестр</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($studyPlan->courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->credits }}</td>
            <td>{{ $courseTypes[$course->type] ?? 'Невідомо' }}</td>
            <td>{{ $course->hours }}</td>
            <td>{{ $course->semester }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h3>Загальна інформація</h3>
<p><strong>Загальна кількість курсів:</strong> {{ $studyPlan->courses->count() }}</p>
<p><strong>Загальна кількість кредитів:</strong> {{ $studyPlan->courses->sum('credits') }}</p>
</body>
</html>
