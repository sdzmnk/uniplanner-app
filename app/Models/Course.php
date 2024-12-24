<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'name',
        'credits',
        'type',
        'hours',
        'semester',
    ];

    protected function casts(): array
    {
        return [
            'credits' => 'integer',
            'hours' => 'integer',
            'semester' => 'integer',
            'type' => 'string',
        ];
    }

    /**
     * Get the study plan associated with the course.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(StudyPlan::class, 'plan_id');
    }

    public static function courseTypes(): array
    {
        return [
            'mandatory' => 'Обов\'язковий',
            'optional' => 'Виборчий',
        ];
    }

    public function studyPlans()
    {
        return $this->belongsToMany(StudyPlan::class, 'study_plan_courses');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

}
