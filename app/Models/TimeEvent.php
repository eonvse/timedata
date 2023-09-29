<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEvent extends Model
{
    use HasFactory;
    protected $fillable = ['day','start','end','team_id','user_id','title'];
    protected $primaryKey = 'id';

    public function getDayFormatAttribute() 
    {
        if(!empty($this->day)) return date('d.m.Y', strtotime($this->day));
        else return '';
    }
    public function getStartFormatAttribute() 
    {
        if(!empty($this->start)) return date('H:i', strtotime($this->start));
        else return '';
    }
    public function getEndFormatAttribute() 
    {
        if(!empty($this->end)) return date('H:i', strtotime($this->end));
        else return '';
    }


    public function team()
    {
        return $this->hasOne(Team::class,'id','team_id');
    }


}
