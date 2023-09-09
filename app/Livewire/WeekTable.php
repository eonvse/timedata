<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

use App\Repositories\TimeEventData;

class WeekTable extends Component
{
    public $week, $year, $startWeek, $endWeek, $events_week, $addDate;

    public $showCreate;

    public function setWeekPeriod($weeknumber,$year)
    {
        $week_start = (new Carbon)->setISODate($year,$weeknumber)->format("Y-m-d H:i:s");
        
        $this->startWeek = Carbon::createFromFormat("Y-m-d H:i:s", $week_start);
        $this->startWeek->hour(0)->minute(0)->second(0);
        $this->endWeek = $this->startWeek->copy()->endOfWeek();
    }

    public function mount()
    {
        $this->week = date('W');
        $this->year = date('Y');

        $this->setWeekPeriod($this->week,$this->year);
        $this->events_week = TimeEventData::events_week($this->week,$this->year);

        $this->addDate = null;
        $this->showCreate = false;
    }

    public function updateData()
    {
        $this->setWeekPeriod($this->week,$this->year);
        $this->events_week = TimeEventData::events_week($this->week,$this->year);
    }

    public function prevWeek()
    {

        if ($this->week == 1) { 
            $this->year--;
            $this->week=52; 
        }else{
            $this->week--; 
        } 

        $this->updateData();

    }

    public function nextWeek()
    {

        if ($this->week == 52) {
            $this->year++;
            $this->week=1; 
        }else{
            $this->week++; 
        } 

        $this->updateData();

    }

    public function currentWeek()
    {
        $this->week = date('W');
        $this->year = date('Y');
        $this->updateData();
    }

    public function render()
    {
        return view('livewire.week-table');
    }
}
