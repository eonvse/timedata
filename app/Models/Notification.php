<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['operation_id','autor_id','model_type_id','model_item_id','message','week', 'year'];
    protected $primaryKey = 'id';
}
