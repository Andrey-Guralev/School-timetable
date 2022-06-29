<?php

namespace App\Models\RingSchedule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RingScheduleTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shift',
        'type'
    ];

    public function RingScheduleEvents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RingScheduleEvents::class, 'ring_schedule_type_id');
    }

    public function RingSchedule(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RingSchedule::class, 'ring_schedule_type_id');
    }

}
