<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationType extends Model
{
    use HasFactory;
    protected $fillable = ['name','desc'];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
