<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stop_transport extends Model
{
    use HasFactory;
    protected $fillable = ['transport_id', 'stop_id'];
}
