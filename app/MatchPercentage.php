<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchPercentage extends Model
{
    protected $table = 'match_percentage';

    protected $fillable = [
        'division',
        'age',
        'timezone',
    ];
}
