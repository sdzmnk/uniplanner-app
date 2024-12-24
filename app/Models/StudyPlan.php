<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'major_id',
        'degree_level',
        'year',
        'user_id',
    ];

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function degreeLevels(): array
    {
        return [
            'bachelor' => 'Бакалавр',
            'master' => 'Магістр',
            'doctorate' => 'Доктор наук',
        ];
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'study_plan_courses');
    }
}
