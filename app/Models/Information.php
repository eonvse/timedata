<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id','autor_id','type_id','item_id','week', 'year', 'note'];
    protected $primaryKey = 'id';

    public function getCreatedAttribute() 
    {
        return date('d.m.Y H:i', strtotime($this->created_at));
    }
}
