<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEvent extends Model
{
    use HasFactory;
    protected $fillable = ['day','start','end','team_id','user_id'];
    protected $primaryKey = 'id';
}
