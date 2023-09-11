<?php

namespace App\Repositories;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;


class UserData
{


	public static function all($sortField, $sortDirection)
	{
		if (!empty($sortField)) return User::orderBy($sortField,$sortDirection);
		else return User::orderBy('surname')->orderBy('name')->orderBy('patronymic');
	}

	public static function ordering($sortField,$sortDirection)
	{
		return User::orderBy($sortField,$sortDirection);
	}

	public static function indexWire()
	{
		return User::orderBy('surname')->orderBy('name')->orderBy('patronymic');
	}

	public static function create($data)
	{
		User::create($data);
	}


}

