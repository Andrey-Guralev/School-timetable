<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'teacher_id',
        'class_id',
        'group_id',
        'load_id',
        'number',
        'weekday',
        'rooms',
        'asc_xml_id'
    ];

    protected $table = 'timetable';

    protected $casts = [
        'rooms' => 'array'
    ];

    public function Lesson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function Teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function Class(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function LoadR(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Load::class);
    }

    public function Group()
    {
        return $this->belongsTo(Group::class);
    }
}
