<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'letter'
    ];

    public function Announcement(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Announcements::class);
    }

    public function Timetable(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Timetable::class);
    }

    public function Students(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Students::class);
    }
}
