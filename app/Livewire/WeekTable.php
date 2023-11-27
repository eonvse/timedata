<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Repositories\TimeEventData;

class WeekTable extends Component
{

    use WithPagination;

    const NOTES_PER_PAGE = 2;

    public $week, $year, $startWeek, $endWeek, $events_week, $addDate;

    public $showCreate;

    public $newStart, $newEnd, $newTeam, $newTitle;

    public $showAddNote, $showDelNote, $delNote;
    public $addNote;

    public $statistics;

    public $filter;


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

        $this->newStart = $this->newEnd = $this->newTitle = '';
        $this->newTeam = 0;

        $this->addDate = null;
        $this->showCreate = false;

        $this->showAddNote = $this->showDelNote = false;
        $this->addNote = '';
        $this->delNote = array('id'=>null, 'note'=>null);

        $this->statistics = TimeEventData::getWeekStatistics($this->week,$this->year);

        $this->filter = array('team'=>0);
    }

    private function updateData()
    {
        $this->setWeekPeriod($this->week,$this->year);
        $this->events_week = TimeEventData::events_week($this->week,$this->year);
        $this->statistics = TimeEventData::getWeekStatistics($this->week,$this->year);
    }

    public function prevWeek()
    {

        if ($this->week == 1) { 
            $this->year--;
            $this->week=52; 
        }else{
            $this->week--; 
        } 

        $this->resetPage();
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

        $this->resetPage();
        $this->updateData();

    }

    public function currentWeek()
    {
        $this->week = date('W');
        $this->year = date('Y');
        $this->resetPage();
        $this->updateData();
    }

    public function addEvent($dateAdd)
    {
        if ($dateAdd == 'weekNote'){
            $this->addNote();
        }else {
            $this->addDate = strtotime($dateAdd);
            $this->showCreate = true;
            $this->cancelAddNote();
        }
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
    }

    /*------------------------------------
    -----------NOTES-----------------------
    ---------------------------------------*/
    public function addNote()
    {
        $this->showAddNote = true;
        $this->cancelCreate();
    }

    public function cancelAddNote()
    {
        $this->showAddNote = false;
        $this->addNote = '';
    }

    public function saveNote()
    {
        if (!empty($this->addNote)) {
            $data = array(
                'autor_id'=>null,
                'type_id'=>null,
                'item_id'=>null,
                'week'=>$this->week, 
                'year'=>$this->year, 
                'note'=>$this->addNote,
            );
            TimeEventData::saveWeekNote($data);
        }
        $this->cancelAddNote();
        $this->updateData();
    }

    public function showDeleteNote($noteId)
    {
        $this->delNote = TimeEventData::getEventNoteArray($noteId);
        $this->showDelNote = true;
    }

    public function deleteNote($noteId)
    {
        if (!empty($noteId)) TimeEventData::deleteEventNote($noteId);
        $this->updateData();
        $this->cancelDelNote();
        $this->resetPage();
    }

    public function cancelDelNote() {

        $this->delNote = array('id'=>null, 'note'=>null);
        $this->showDelNote = false;
    }


    /*------------------------------------
    -----------RENDER-----------------------
    ---------------------------------------*/


    public function render()
    {
        $notes = TimeEventData::getWeekNotes($this->year, $this->week);
        return view('livewire.week-table',['teams'=>TimeEventData::getTeamList(),'notes'=>$notes->simplePaginate(self::NOTES_PER_PAGE)]);
    }
}
