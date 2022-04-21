<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel',
        'message',
        'time',
        'email',
        'sent_at',
        'failed_at'
    ];

    protected $casts = [
        'time' => 'datetime',
        'sent_at' => 'datetime',
        'failed_at' => 'datetime'
    ];

    public function scopeReady(Builder $query)
    {
        $query->whereNull('sent_at')->whereDate('time', '<=', now());
    }
}
