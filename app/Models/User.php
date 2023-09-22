<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'patronymic',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getCreatedForHumansAttribute() {
            
            return date('d.m.Y h:i', strtotime($this->created_at));

    }

    public function getBirthdayFormatAttribute() {
            
            if(!empty($this->birthday)) return date('d.m.Y', strtotime($this->birthday));
            else return '';

    }

    public function getFIOAttribute($patronymic=false) 
    {

            $fio = '';
            if (!empty($this->surname)) $fio .= $this->surname.' ';
            if (!empty($this->name)) $fio .= $this->name;
            if ($patronymic) if (!empty($this->patronymic)) $fio .= ' '.$this->patronymic.' ';

            return $fio;
    }


}
