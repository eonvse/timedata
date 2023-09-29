<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\Colors;
use App\Models\User;
use App\Models\TimeEvent;
use App\Models\Information;
use App\Models\ModelType;
use App\Models\Files;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Storage;

class TeamData
{

    /*------------------------------------
    -----------TEAM-----------------------
    ---------------------------------------*/

	public static function get($id)
	{

		return Team::find($id);

		//return Team::where('id','=',$id)->with('users')->first();
	}

	public static function getList()
	{
		return Team::orderBy('name')->get();
	}

	public static function indexWire($data)
	{	

        if (!empty($data['sortField'])) $teams=Team::orderBy($data['sortField'],$data['sortDirection']);
        else $teams = Team::orderBy('name');

        /*if(!empty($data['search'])){
           $users->orWhere('name','like',"%".$data['search']."%");
           $users->orWhere('surname','like',"%".$data['search']."%");
           $users->orWhere('patronymic','like',"%".$data['search']."%");
        }*/


		return $teams;
	}

	public static function create($data)
	{
		Team::create($data);
	}

	public static function update($id,$data)
	{
		$team = Team::find($id);
		$team->update($data);
	}

	public static function destroy($id)
	{
		$team = Team::find($id);
		$team->delete();
	}

	public static function getColorList()
	{
		return Colors::orderBy('color')->get();
	}

	public static function getUserList()
	{
		return User::orderBy('surname')->orderBy('name')->orderBy('patronymic')->get();
	}

	public static function getUserListForTeam($teamId)
	{

		$usersTeam = TeamUser::where('team_id',$teamId)->get('user_id')->toArray();

		return User::whereNotIn('id',$usersTeam)->orderBy('surname')->orderBy('name')->orderBy('patronymic')->get();
	}

    /*-------------------------------------
    -----------TEAM USERS------------------
    ---------------------------------------*/

	public static function getUsersTeam($teamId)
	{
		
		$usersTeam = TeamUser::where('team_id',$teamId)->get('user_id')->toArray();

		return User::whereIn('id',$usersTeam)->orderBy('surname')->orderBy('name')->orderBy('patronymic')->get();
	}

	public static function saveUserTeam($teamId,$userId)
	{

		TeamUser::create([
			'team_id' => $teamId,
			'user_id' => $userId
		]);
	}

	public static function deleteTeamUser($teamId,$userId)
	{
		$del = TeamUser::where('team_id','=',$teamId)->where('user_id','=',$userId)->first();
		$del->delete();
	}

	 /*------------------------------------
    ------TEAM UPCOMING EVENTS-------------
    ---------------------------------------*/

    public static function getUpcomingEvents($teamId,$count)
    {
    		return TimeEvent::whereDate('day','>=',date('Y-m-d'))->where('team_id','=',$teamId)->orderBy('day')->orderBy('start')->limit($count)->get();
    }

    public static function saveTeamEvent($data)
    {
    		$data['user_id'] = Auth::id();
    		TimeEvent::create($data);
    }

    public static function getTeamEventArray($eventId)
    {
    		return TimeEvent::where('id','=',$eventId)->get(['id','day','start','end','title'])->first()->toArray();
    }

    public static function deleteTeamEvent($eventId)
    {
    		TimeEvent::find($eventId)->delete();
    }

	 /*------------------------------------
    ------TEAM NOTES----------------------
    ---------------------------------------*/

    public static function getNotes($modelType, $modelId)
    {
    		$modelTypeId = modelType::where('model','=',$modelType)->get('id')->first()->id;

    		return Information::where('type_id','=',$modelTypeId)->where('item_id','=',$modelId)
    									->orderBy('created_at','desc');
    }

    public static function saveTeamNote($modelType,$data)
    {
    		$modelTypeId = modelType::where('model','=',$modelType)->get('id')->first()->id;
    		$data['type_id'] = $modelTypeId;
    		$data['autor_id'] = Auth::id();

    		Information::create($data);
    }

    public static function deleteTeamNote($noteId)
    {
    		$del=Information::find($noteId);
    		$del->delete();
    }

    public static function getTeamNoteArray($noteId)
    {
    		return Information::where('id','=',$noteId)->get(['id','note'])->first()->toArray();
    }

	 /*------------------------------------
    ------TEAM FILES----------------------
    ---------------------------------------*/

	public static function getFileListForTeam($modelType,$teamId)
	{
    	$modelTypeId = modelType::where('model','=',$modelType)->get('id')->first()->id;
    	return Files::where('type_id','=',$modelTypeId)->where('item_id','=',$teamId)
    									->orderBy('created_at','desc')->get(['id','name','url','location']);
	}

    public static function getFiles($modelType, $modelId)
    {
    		$modelTypeId = modelType::where('model','=',$modelType)->get('id')->first()->id;

    		return Files::where('type_id','=',$modelTypeId)->where('item_id','=',$modelId)
    									->orderBy('created_at','desc');
    }

    public static function saveTeamFile($modelType,$data)
    {

    		$modelTypeId = modelType::where('model','=',$modelType)->get('id')->first()->id;
    		$data['type_id'] = $modelTypeId;
    		$data['autor_id'] = Auth::id();

    		Files::create($data);
    }

    public static function deleteTeamFile($fileId)
    {
    		$del=Files::find($fileId);
    		Storage::disk('public')->delete($del->url);
    		$del->delete();
    }

    public static function getTeamFileArray($fileId)
    {
    		return Files::where('id','=',$fileId)->get(['id','name','url'])->first()->toArray();
    }

}

