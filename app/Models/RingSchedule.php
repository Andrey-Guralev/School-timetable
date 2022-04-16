<?php

namespace App\Models;

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
        'type',
        'shift',
        'weekday',
        'asc_xml_id'
    ];
}
