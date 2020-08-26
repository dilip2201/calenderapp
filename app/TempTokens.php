<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempTokens extends Model
{
    protected $table = 'temp_tokens';
  	protected $fillable = [
        'random'
    ];
}
