<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $fillable = ['name','url','autor_id','type_id','item_id','week', 'year','isLocal'];
    protected $primaryKey = 'id';
}
