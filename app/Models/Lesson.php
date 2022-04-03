<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function LoadR(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Load::class);
    }

    public function Teacher(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function Timetable(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Timetable::class);
    }

}
