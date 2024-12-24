<?php

namespace App\Exports;

use App\Models\StudyPlan;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudyPlanExport implements FromCollection, WithHeadings
{
    protected $studyPlanId;

    public function __construct($studyPlanId)
    {
        $this->studyPlanId = $studyPlanId;
    }

    public function collection()
    {
        // Получаем учебный план и его курсы
        $studyPlan = StudyPlan::with('courses', 'major', 'user')->find($this->studyPlanId);

        // Проверяем, существует ли учебный план
        if (!$studyPlan) {
            return collect([['error' => 'Навчальний план не знайдено']]);
        }

        // Собираем данные для экспорта
        $data = [];

        // Добавляем основную информацию
        $data[] = [
            'Назва навчального плану' => $studyPlan->name,
            'Відповідальний' => $studyPlan->user->name ?? 'Невідомо',
            'Email' => $studyPlan->user->email ?? 'Невідомо',
            'Спеціальність' => $studyPlan->major->name,
            'Код спеціальності' => $studyPlan->major->code,
            'Рівень освіти' => StudyPlan::degreeLevels()[$studyPlan->degree_level] ?? 'Невідомо',
            'Рік' => $studyPlan->year,
        ];

        // Добавляем курсы
        $data[] = ['Інформація про курси'];
        $data[] = [
            'ID курсу',
            'Назва курсу',
            'Кредити',
            'Тип курсу',
            'Години',
            'Семестр',
        ];

        foreach ($studyPlan->courses as $course) {
            $data[] = [
                $course->id,
                $course->name,
                $course->credits,
                Course::courseTypes()[$course->type] ?? 'Невідомо',
                $course->hours,
                $course->semester,
            ];
        }

        // Добавляем итоговую информацию
        $data[] = ['Загальна інформація'];
        $data[] = [
            'Загальна кількість курсів',
            'Загальна кількість кредитів',
        ];

        $data[] = [
            $studyPlan->courses->count(),
            $studyPlan->courses->sum('credits'),
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Назва навчального плану',
            'Відповідальний',
            'Email',
            'Спеціальність',
            'Код спеціальності',
            'Рівень освіти',
            'Рік',
        ];
    }
}
