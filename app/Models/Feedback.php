<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'second_name',
        'class_id',
        'text',
        'status'
    ];

    public function Class()
    {
        return $this->belongsTo(CLasses::class);
    }


}
