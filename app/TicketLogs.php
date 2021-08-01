<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketLogs extends Model
{
    protected $fillable = ['ticket_id','ticket_data','modified_by','description'];
    protected $casts=[
        'ticket_data'=>'array'
    ];
}
