<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'letter',
        'alias',
        'shift',
        'asc_xml_id'
    ];

    public function Announcement(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Announcements::class);
    }

    public function Timetable(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Timetable::class);
    }

    public function LoadRel(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Load::class);
    }

    public function ClassroomTeacher(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    public function TelegramSubscriber(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TelegramSubscribers::class);
    }

    public function Groups(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function getFullName(): string
    {
        return ($this->number ?? "Ошибка") . ($this->letter ?? '');
    }
}
