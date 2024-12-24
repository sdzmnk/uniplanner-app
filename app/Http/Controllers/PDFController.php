<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyPlan;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF($studyPlanId)
    {
        // Получаем учебный план по ID
        $studyPlan = StudyPlan::with('courses', 'major', 'user')->find($studyPlanId);


        // Подготавливаем данные для отображения в PDF
        $data = [
            'studyPlan' => $studyPlan,
            'degreeLevel' => StudyPlan::degreeLevels()[$studyPlan->degree_level] ?? 'Невідомо',
            'courseTypes' => \App\Models\Course::courseTypes(),
        ];

        $pdf = Pdf::loadView('admin.study_plan.pdf', $data)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setOption('font', 'DejaVu Sans') // Указание шрифта
            ->setOption('isHtml5ParserEnabled', true);

        return $pdf->download('study_plan_' . $studyPlan->id . '.pdf');
    }
}
