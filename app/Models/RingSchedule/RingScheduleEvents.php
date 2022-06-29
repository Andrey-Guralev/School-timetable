<?php

namespace App\Models\RingSchedule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RingScheduleEvents extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ring_schedule_type_id',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function RingScheduleType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RingScheduleTypes::class, 'ring_schedule_type_id');
    }
}
