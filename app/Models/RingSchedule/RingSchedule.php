<?php

namespace App\Models\RingSchedule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RingSchedule extends Model
{
    use HasFactory;

    protected $table = "ring_schedule";

    protected $fillable = [
        'start_time',
        'end_time',
        'number',
        'ring_schedule_type_id',
    ];

    public function RingScheduleType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RingScheduleTypes::class);
    }
}
