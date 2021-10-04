<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date'
    ];

    public function getStatusColorAttribute()
    {
        return [
            'processing' => 'indigo',
            'success' => 'green',
            'failed' => 'red'
        ][$this->status] ?? 'cool-gray';
    }

    public function getDateForHumenAttribute()
    {
        return $this->date->format('M, d Y');
    }
}
