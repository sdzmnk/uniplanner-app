<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyPlanCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'study_plan_id',
        'course_id',
    ];

    public function study_plan(): BelongsTo
    {
        return $this->belongsTo(StudyPlan::class);
    }


    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
