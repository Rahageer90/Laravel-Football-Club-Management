<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    use HasFactory;

    protected $primaryKey = 'training_session_id';

    protected $fillable = [
        'coach_id',
        'date',
        'time',
        'location',
        'focus_areas',
    ];

    public function coach()
    {
        return $this->belongsTo(Account::class, 'coach_id', 'account_id');
    }
}
