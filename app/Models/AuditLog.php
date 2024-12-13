<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'user_id',
        'action',
    ];

    protected function casts(): array
    {
        return [
            'action' => 'string',
        ];
    }

    /**
     * Get the study plan associated with the audit log.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(StudyPlan::class, 'plan_id');
    }

    /**
     * Get the user associated with the audit log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
