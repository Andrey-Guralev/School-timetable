<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'type',
        'author_id',
        'class_id'
    ];

    public function Classes() {
        return $this->belongsTo(Classes::class);
    }

    public function Author() {
        return $this->belongsTo(User::class);
    }
}
