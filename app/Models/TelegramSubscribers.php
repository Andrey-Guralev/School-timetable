<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramSubscribers extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'chat_id',
    ];

    public function Class(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
