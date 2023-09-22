<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;
    protected $fillable = ['timeEvent_id','user_id','autor_id'];
    protected $primaryKey = 'id';
}
