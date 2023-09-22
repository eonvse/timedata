<?php

namespace App\Repositories;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;


class UserData
{

	public static function get($id)
	{
		return User::find($id);
	}

	public static function indexWire($data)
	{	

        if (!empty($data['sortField'])) $users=User::orderBy($data['sortField'],$data['sortDirection']);
        else $users = User::orderBy('surname')->orderBy('name')->orderBy('patronymic');

        if(!empty($data['search'])){
           $users->orWhere('name','like',"%".$data['search']."%");
           $users->orWhere('surname','like',"%".$data['search']."%");
           $users->orWhere('patronymic','like',"%".$data['search']."%");
        }


		return $users;
	}

	public static function create($data)
	{
		User::create($data);
	}

	public static function update($id,$data)
	{
		$user = User::find($id);
		$user->update($data);
	}

	public static function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
	}

}

