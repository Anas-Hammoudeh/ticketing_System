<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable=[
        'ticket_id',
        'emp_name',
        'reply'
    ];
}
