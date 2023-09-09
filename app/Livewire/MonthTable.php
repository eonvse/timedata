<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

use App\Repositories\TimeEventData;

class MonthTable extends Component
{
    
    public $month, $year, $events_month, $addDate;

    public $showCreate;

    public $newName, $newStartTime, $newEndTime;

    public function mount()
    {
        $this->month = date('n');
        $this->year = date('Y');
        $this->events_month = TimeEventData::events_month($this->month,$this->year);

        $this->addDate = null;
        $this->showCreate = false;
    }

    public function updateData()
    {
        $this->events_month = TimeEventData::events_month($this->month,$this->year);
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
        $this->reset('newName', 'newStartTime','newEndTime');
    }

    public function store()
    {
        if (!empty($this->newName)) {

            TimeEventData::create($this->newName,$this->newStartTime,$this->newEndTime, $this->addDate);

            $this->updateData();

            $this->cancelCreate();
        }

    }

    public function updated($property)
    {
        // $property: The name of the current property that was updated
 
       if ($property === 'newStartTime') {

            $st = strtotime($this->newStartTime);
            $dateEnd = Carbon::createFromTime(date('H',$st),date('i',$st));
            $dateEnd->addHour();

            $this->newEndTime = $dateEnd->format('H:i');
        }
    }

    public function render()
    {
        return view('livewire.month-table');
    }
}
