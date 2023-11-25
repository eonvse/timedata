<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\TeamUser;
use App\Models\Team;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        
        Storage::disk('public')->deleteDirectory('/users/'.$id);
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

    /*------------------------------------------------------
    -------------------TEAMS--------------------------------
    --------------------------------------------------------*/

    public static function getTeams($userId)
    {
            return $teams = DB::table('UserTeams')
            ->where('id','=',$userId)
            ->whereNotNull('tid')
            ->select('tid', 'tname', 'tinfo','color')
            ->orderBy('tname')
            ->get()->toArray();
    }

    public static function getTeamsForAdd($userId)
    {
        $teamsUser = TeamUser::where('user_id',$userId)->get('team_id')->toArray();

        return Team::whereNotIn('id',$teamsUser)->orderBy('name')->get(['id','name'])->toArray();

    }

    public static function addUserInTeams($userId,$addTeams)
    {
        TeamUser::create(['user_id'=>$userId,'team_id'=>$addTeams]);
    }

    /*------------------------------------------------------
    ---------------UPCOMING EVENTS--------------------------
    --------------------------------------------------------*/
    public static function getUpcomingEvents($userId,$countEvents)
    {
        return DB::select('CALL UserUpcomingEvents(?,?,?)',array($userId,date('Y-m-d'),$countEvents));
    }
}

