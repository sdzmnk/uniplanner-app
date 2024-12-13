<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'plan_id',
        'enrolled_at',
    ];
    protected function casts(): array
    {
        return [
            'enrolled_at' => 'date',
        ];
    }

    /**
     * Get the user associated with the enrollment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the study plan associated with the enrollment.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(StudyPlan::class, 'plan_id');
    }
}
