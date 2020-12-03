<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'hpchs_message';

    protected $fillable = ['id', 'name', 'phone', 'email', 'subject', 'message'];
}
