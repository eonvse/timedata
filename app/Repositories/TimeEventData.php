<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Str;

use Carbon\Carbon;

use App\Models\TimeEvent;
use App\Models\User;
use App\Models\TeamUser;
use App\Models\Visits;
use App\Models\Information;
use App\Models\ModelType;

use App\Repositories\TeamData;

class TimeEventData
{
	const PER_PAGE = 8;

    public static function get($id)
    {
        return TimeEvent::find($id);
    }

    public static function events_month($month,$year) {
        function getEventsMonthDay($day)
        {
            
            return $events = DB::table('time_events')
            ->leftJoin('teams', 'time_events.team_id', '=', 'teams.id')
            ->leftJoin('colors', 'colors.id', '=', 'teams.color_id')
            ->whereDate('day','=',$day)
            ->select('time_events.id','time_events.title','time_events.day','time_events.start','time_events.end', 'teams.name', 'colors.color')
            ->orderBy('start')
            ->get()->toArray();

        }

        $events_month = array();

        //Сетка в проекте из 35 (5*7) ячеек
        $countDay = 35;

        $firstDay = Carbon::create($year, $month, 1);
        $lastDay = Carbon::create($year, $month, date('t', mktime(23, 59, 59, $month, 1, $year)),23,59,59);

        //Номера дней недели первого и последнего дня месяца
        $firstNum = date('N',strtotime($firstDay)); 
        $lastNum = date('N',strtotime($lastDay));

        //Сколько дней необходимо добавить перед первым днём и после последнего, чтобы вписать в сетку 5*7
        //иногда нужна сетка 6*7
        $firstDelta = $firstNum == 1 ? 0 : $firstNum - 1;
        $lastDelta = $lastNum == 7 ? 0 : 7-$lastNum;

        $firstDay->subDay($firstDelta);
        $lastDay->addDay($lastDelta);

        $timeEvents = null;

        for ($i = 1; $i <= $countDay; $i++) {
            $date = $firstDay->format('d.m.Y');

            $timeEvents = getEventsMonthDay($firstDay->format('Y-m-d'));

            $events_month[$i] = ['date'=>$date, 'events'=>$timeEvents];
            $firstDay->addDay();
        }
        if ($firstDay<$lastDay) {
            for ($i=1; $i <=7 ; $i++) { 
                $date = $firstDay->format('d.m.Y');
                $timeEvents = getEventsMonthDay($firstDay->format('Y-m-d'));
                $events_month[$i+35] = ['date'=>$date, 'events'=>$timeEvents];
                $firstDay->addDay();
            }
        }

        return $events_month;
    }

    public static function mini_month($day) {


        $month = date('n',strtotime($day));
        $year = date('Y',strtotime($day));
        //Сетка в проекте из 35 (5*7) ячеек
        $countDay = 35;
        $mini_month = array();

        $firstDay = Carbon::create($year, $month, 1);
        $lastDay = Carbon::create($year, $month, date('t', mktime(23, 59, 59, $month, 1, $year)),23,59,59);

        //Номера дней недели первого и последнего дня месяца
        $firstNum = date('N',strtotime($firstDay)); 
        $lastNum = date('N',strtotime($lastDay));

        //Сколько дней необходимо добавить перед первым днём и после последнего, чтобы вписать в сетку 5*7
        //иногда нужна сетка 6*7
        $firstDelta = $firstNum == 1 ? 0 : $firstNum - 1;
        $lastDelta = $lastNum == 7 ? 0 : 7-$lastNum;

        $firstDay->subDay($firstDelta);
        $lastDay->addDay($lastDelta);

        for ($i = 1; $i <= $countDay; $i++) {
            $date = $firstDay->format('d.m.Y');


            $mini_month[$i] = ['date'=>$date];
            $firstDay->addDay();
        }
        if ($firstDay<$lastDay) {
            for ($i=1; $i <=7 ; $i++) { 
                $date = $firstDay->format('d.m.Y');
                $mini_month[$i+35] = ['date'=>$date];
                $firstDay->addDay();
            }
        }

        return $mini_month;
    }

    public static function events_week($week, $year) {
        function getWeekEventsDay($day)
        {
            
            return $events = DB::table('EventInfoWeek')
            ->whereDate('day','=',$day)
            ->select('id', 'title', 'day', 'start', 'end', 'name', 'all_u', 'b_u', 'n_u', 'last_note', 'color','notes','files')
            ->orderBy('start')
            ->get()->toArray();

        }        

        $events_week = array();
        $timeEvents = null;
        $week_start = (new Carbon())->setISODate($year,$week)->format("Y-m-d H:i:s");

        $start = Carbon::createFromFormat("Y-m-d H:i:s", $week_start);
        $start->hour(0)->minute(0)->second(0);


        for ($i = 1; $i <= 7; $i++) {
            $date = $start->format('d.m.Y');
            $timeEvents = getWeekEventsDay($start->format('Y-m-d'));
            $events_week[$i] = ['date'=>$date, 'events'=>$timeEvents];
            $start->addDay();
        }

        return $events_week;
    }

    public static function getWeekStatistics($week,$year)
    {
        $week_start = (new Carbon())->setISODate($year,$week);
        $dateStart = $week_start->format("Y-m-d");
        $week_start->addDays(7);
        $dateEnd = $week_start->format("Y-m-d");

        return DB::select('CALL getEventStatisticsForPeriod(?,?)',array($dateStart,$dateEnd));

    }

    public static function indexWire($data)
    {
        $timeEvents = TimeEvent::orderBy('day','desc')->orderBy('start','asc');
        
        return $timeEvents;
    }


   	public static function create($data): void
	{
            TimeEvent::create($data);


	}

    public static function deleteTeamEvent($eventId)
    {

            TeamData::deleteTeamEvent($eventId);
    }

	public static function getTeamEventArray($eventId)
    {
        return TeamData::getTeamEventArray($eventId);
    }

    public static function getTeamList()
    {
        return TeamData::getList()->toArray();
    }

    public static function getTimeEventUsers($teamId,$eventId)
    {
        
        $usersTeam = TeamUser::where('team_id',$teamId)->get('user_id')->toArray();
        $userTeamId = '';
        foreach ($usersTeam as $user)
        {
            $userTeamId .= $user['user_id'].',';
        }
        $userTeamId = substr($userTeamId,0,-1);

        if (empty($userTeamId)) $users = array();
        else $users     = DB::select('select id, surname, name, max(timeEvent_id) as timeEvent_id
                                        from UsersInfoEvent 
                                        where (timeEvent_id='.$eventId.' or timeEvent_id = 0) 
                                        and id in ('.$userTeamId.')
                                        GROUP BY id, surname,name
                                        order by surname,name');
        return $users;
    }

    public static function addVisit($data)
    {
        $data['autor_id'] = Auth::id();
        Visits::create($data);
    }

    public static function delVisit($eventId,$userId)
    {
        
        Visits::where('timeEvent_id','=',$eventId)->where('user_id','=',$userId)->get()->first()->delete();

    }

    public static function getUpcomingEvents($eventId,$teamId, $count)
    {
        $event_day = TimeEvent::where('id','=',$eventId)->get()->first()->day;

        return TimeEvent::where('team_id','=',$teamId)->where('id','<>',$eventId)->whereDate('day','>=',$event_day)
                            ->orderBy('day')->orderBy('start')
                            ->limit($count)
                            ->get();
    }

    public static function getPreviousEvents($eventId,$teamId, $count)
    {
        $event_day = TimeEvent::where('id','=',$eventId)->get()->first()->day;

        return TimeEvent::where('team_id','=',$teamId)->where('id','<>',$eventId)->whereDate('day','<',$event_day)
                            ->orderBy('day', 'desc')->orderBy('start')
                            ->limit($count)
                            ->get();
    }

     /*------------------------------------
    ------EVENT NOTES----------------------
    ---------------------------------------*/

    public static function getNotes($modelType, $modelId)
    {
        return TeamData::getNotes($modelType, $modelId);
    }

    public static function saveEventNote($modelType,$data)
    {
        TeamData::saveTeamNote($modelType,$data);
    }

    public static function deleteEventNote($noteId)
    {
        TeamData::deleteTeamNote($noteId);
    }

    public static function getEventNoteArray($noteId)
    {
            return TeamData::getTeamNoteArray($noteId);
    }

    public static function getWeekNotes($year, $week)
    {
            $modelTypeId = modelType::where('model','=','week')->get('id')->first()->id;

            return Information::where('type_id','=',$modelTypeId)
                                    ->where('week','=',$week)
                                    ->where('year','=',$year)
                                    ->orderBy('created_at','desc');
    }

    public static function saveWeekNote($data)
    {
            $modelTypeId = modelType::where('model','=','week')->get('id')->first()->id;
            $data['type_id'] = $modelTypeId;
            $data['autor_id'] = Auth::id();

            Information::create($data);
    }


    /*------------------------------------
    ------EVENT FILES----------------------
    ---------------------------------------*/

    public static function getFileListForEvent($modelType,$teamId)
    {
        return TeamData::getFileListForTeam($modelType,$teamId);
    }

    public static function getFiles($modelType, $modelId)
    {
        return TeamData::getFiles($modelType, $modelId);
    }

    public static function saveEventFile($modelType,$data)
    {
        TeamData::saveTeamFile($modelType,$data);
    }

    public static function deleteEventFile($fileId)
    {
        TeamData::deleteTeamFile($fileId);
    }

    public static function getEventFileArray($fileId)
    {
        return TeamData::getTeamFileArray($fileId);
    }



	/*public static function get($id)
	{
		return guideUnit::find($id);
	}

	public static function dashboard()
	{
		return guideUnit::parents()->orWhere->noParents()
                            ->orderBy('isParent')->orderby('name')
                            ->get();
	}

	public static function parents()
	{
		return guideUnit::parents()->get();
	}

	public static function noParents()
	{
		return guideUnit::noParents()->get();
	}


	public static function create($newName,$newFolder,$newParent): void
	{
        $unit = guideUnit::create([
            'name' => $newName,
            'isParent' => $newFolder ?? 0,
            'parent_id' => $newParent ?? 0,
            'autor_id' => Auth::user()->id,
            'updater_id' => Auth::user()->id
        ]);


        UnitsCreate::dispatch($unit);


	}

	public static function save(guideUnit $item)
	{
        $item->updater_id = Auth::user()->id;
        $item->save();

	}

	public static function destroy(guideUnit $item)
	{
        $item->delete();

	}*/


}