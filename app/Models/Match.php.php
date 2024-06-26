<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $primaryKey = 'match_id';

    protected $fillable = [
        'date',
        'time',
        'opponent',
        'venue',
        'result',
    ];
}
