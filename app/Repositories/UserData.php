<?php

namespace App\Repositories;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;

use App\Repositories\TeamData;


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

   public static function saveUserFile($modelType,$data)
   {
       TeamData::saveTeamFile($modelType,$data);
   }
   public static function getFileListForUser($modelType,$modelId)
   {
       return TeamData::getFileListForTeam($modelType,$modelId);
   }

   public static function deleteUserFile($fileId)
    {
        TeamData::deleteTeamFile($fileId);
    }

   public static function getUserFileArray($fileId)
    {
        return TeamData::getTeamFileArray($fileId);
    }

    /*------------------------------------------------------
    -------------------NOTES--------------------------------
    --------------------------------------------------------*/

    public static function getNotes($modelType, $modelId)
    {
    	return TeamData::getNotes($modelType, $modelId);
    }

   	public static function saveUserNote($modelType,$data)
   	{
   		TeamData::saveTeamNote($modelType,$data);
   	}

	public static function getUserNoteArray($noteId)
	{
		return TeamData::getTeamNoteArray($noteId);
	}

	public static function deleteUserNote($noteId)
	{
		TeamData::deleteTeamNote($noteId);
	}


}

