<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use App\Repositories\TimeEventData;

class MonthTable extends Component
{
    
    public $month, $year, $events_month, $addDate;

    public $showCreate;

    public $newStart, $newEnd, $newTeam, $newTitle;

    public $filter;

    public function mount()
    {
        $this->month = date('n');
        $this->year = date('Y');
        $this->filter = array('team'=>0);
        $this->events_month = TimeEventData::events_month($this->month,$this->year);

        $this->newStart = $this->newEnd = $this->newTitle = '';
        $this->newTeam = $this->filter['team'];

        $this->addDate = null;
        $this->showCreate = false;
    }

    private function updateData()
    {
        $this->events_month = TimeEventData::events_month($this->month,$this->year,$this->filter['team']);
    }

    public function prevMonth()
    {

        if ($this->month == 1) { 
            $this->year--;
            $this->month=12; 
        }else{
            $this->month--; 
        } 

        $this->updateData();

    }

    public function nextMonth()
    {

        if ($this->month == 12) {
            $this->year++;
            $this->month=1; 
        }else{
            $this->month++; 
        } 

        $this->updateData();

    }

    public function currentMonth()
    {
        $this->month = date('n');
        $this->year = date('Y');
        $this->updateData();
    }

    public function addEvent($dateAdd)
    {
        $this->addDate = strtotime($dateAdd);
        $this->showCreate = true;
    }

    public function cancelCreate()
    {
        $this->showCreate = false;
        $this->newStart = $this->newEnd = $this->newTitle = '';
        $this->newTeam = 0;
    }


    public function store()
    {
        if (!empty($this->newTeam)) {

            $data=array(
                'day'=>date('Y-m-d',$this->addDate),
                'start'=>$this->newStart,
                'end'=>$this->newEnd, 
                'team_id'=>$this->newTeam,
                'user_id'=>Auth::id(),
                'title'=>empty($this->newTitle) ? null : $this->newTitle
            );

            TimeEventData::create($data);
            
            $this->updateData();

            $this->cancelCreate();
        }

    }

    public function updated($property)
    {
        // $property: The name of the current property that was updated
 
       if ($property === 'newStart') {

            $st = strtotime($this->newStart);
            $dateEnd = Carbon::createFromTime(date('H',$st),date('i',$st));
            $dateEnd->addHour();

            $this->newEnd = $dateEnd->format('H:i');
        }
        if ($property === 'newEnd') {

            $st = strtotime($this->newStart);
            $end = strtotime($this->newEnd);
            if ($end <= $st) {
                $dateEnd = Carbon::createFromTime(date('H',$st),date('i',$st));
                $dateEnd->addHour();
    
                $this->newEnd = $dateEnd->format('H:i');
            }
        }
        if ($property === 'filter.team') {
            $this->newTeam = $this->filter['team'];
            $this->updateData();
        }


    }

    public function render()
    {
        return view('livewire.month-table',['teams'=>TimeEventData::getTeamList()]/*,['debug'=>var_export($this->events_month)]*/);
    }
}
