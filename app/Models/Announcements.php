<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Announcements extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'type',
        'author_id',
        'class_id'
    ];

    public function Classes() {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function Author() {
        return $this->belongsTo(User::class);
    }
}
