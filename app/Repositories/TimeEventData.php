<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use Carbon\Carbon;

use App\Models\TimeEvent;

use App\Repositories\TeamData;

class TimeEventData
{
	const PER_PAGE = 8;


    public static function events_month($month,$year) {
        function getEventsMonthDay($day)
        {
            
            return $users = DB::table('time_events')
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

    public static function events_week($week, $year) {
        $events_week = array();
        $timeEvents = null;
        $week_start = (new Carbon())->setISODate($year,$week)->format("Y-m-d H:i:s");

        $start = Carbon::createFromFormat("Y-m-d H:i:s", $week_start);
        $start->hour(0)->minute(0)->second(0);


        for ($i = 1; $i <= 7; $i++) {
            $date = $start->format('d.m.Y');
            $timeEvents = TimeEvent::whereDate('start','=',$start->format('Y-m-d'))->orderBy('start')->get(['id', 'team_id','start','end'])->toArray();
            $events_week[$i] = ['date'=>$date, 'events'=>$timeEvents];
            $start->addDay();
        }

        return $events_week;
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

	public static function getTeamList()
    {
        return TeamData::getList()->toArray();
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