<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;

    protected $primaryKey = 'injury_id';

    protected $fillable = [
        'player_id',
        'description',
        'date_of_injury',
        'status',
    ];

    public function player()
    {
        return $this->belongsTo(Account::class, 'player_id', 'account_id');
    }
}
