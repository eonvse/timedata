<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*use Illuminate\Database\Eloquent\Relations\HasManyThrough;*/

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name','color_id','info'];
    protected $primaryKey = 'id';

    public function color()
    {
        return $this->hasOne(Colors::class,'id','color_id');
    }

/*    public function users(): HasManyThrough
    {
        return $this->HasManyThrough(
            User::class,
            TeamUser::class,
            'user_id',
            'id',
            'id',
            'team_id'
        );
    }*/
}
