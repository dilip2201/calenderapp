<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DMS extends Model
{
  	protected $table = 'dms';
  	protected $fillable = [
        'first_name', 'last_name', 'middle_name','email','mobile_no','role'
    ];

}
