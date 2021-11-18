<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];
    public function stops() {
       return $this->belongsToMany(Stop::class);
    }
}
