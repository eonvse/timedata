<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use App\Repositories\TimeEventData;

class TimeEvents extends Component
{
    use WithPagination;

    //-------------------------    
    //-------ПЕРЕМЕННЫЕ--------
    //-------------------------    

    public $per_page;

    public $showCreate, $showEdit, $showDelete;
    public $newDay, $newStart, $newEnd, $newTeam, $newTitle;
    
    public $search, $sortField, $sortDirection;

    public $item;

    public $showDelEvent, $delEvent;

    public $filter;

    #[Locked] 
    public $idItem;

    //------------------------------------------------    
    //-------ДАТА-ВРЕМЯ ДЛЯ НОВЫХ СОБЫТИЙ-------------
    //------------------------------------------------    
    private function setDateTime() : void
    {
        $this->newDay = date('Y-m-d');
        $st = strtotime(date('H:i'));
        $et = Carbon::createFromTime(date('H',$st),0);
        $et->addHour();
        $this->newStart = $et->format('H:i');
        $et->addHour();
        $this->newEnd = $et->format('H:i');
    }

    //------------------------------------------------    
    //-------Монтирование-----------------------------
    //------------------------------------------------    
    public function mount()
    {
        $this->showCreate = $this->showEdit = $this->showDelete = false;
        
        $this->newDay = $this->newStart = $this->newEnd = $this->newTitle = '';
        $this->newTeam = 0;
        
        $this->item = array('day'=>'','start'=>'','end'=>'','team_id'=>'', 'user_id'=>'');
        $this->idItem = '';
        
        $this->per_page = 20;

        $this->search = $this->sortField = $this->sortDirection = '';

        $this->showDelEvent = false;
        $this->delEvent = array('id'=>null, 'day'=>null, 'start' =>null, 'end'=>null);

        $this->filter = array('team'=>0);
    }

    //------------------------------------------------    
    //-------Сортировка-------------------------------
    //------------------------------------------------    
    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
                            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
                            : 'asc';

        $this->sortField = $field;
        
    }

    //------------------------------------------------    
    //-------Добавление нового элемента---------------
    //------------------------------------------------    
    public function create()
    {
        $this->setDateTime();
        $this->showCreate = true;
    }

    public function cancelCreate()
    {
        $this->showCreate = false;
        $this->newTeam = 0;
        $this->newDay = $this->newStart = $this->newEnd = $this->newTitle = '';

    }

    //------------------------------------------------    
    //-------Редактирование элемента------------------
    //------------------------------------------------    
    public function edit($id)
    {
        $this->showEdit = true;
        $editing = TimeEventData::get($id);
        $this->item = array(
            'name'=>$editing->name ?? '',
            'surname'=>$editing->surname ?? '',
            'patronymic'=>$editing->patronymic ?? '',
            'birthday'=>$editing->birthday ?? '',
            );
        $this->idItem = $editing->id;

    }

    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->item = array('day'=>'','start'=>'','end'=>'','team_id'=>'', 'user_id'=>'');
        $this->idItem = '';
    }

    //------------------------------------------------    
    //-------Сохранение в БД--------------------------
    //------------------------------------------------    
    public function store()
    {
        if (!empty($this->newDay)) {

            $data=array(
                'day'=>$this->newDay,
                'start'=>$this->newStart,
                'end'=>$this->newEnd, 
                'team_id'=>$this->newTeam,
                'user_id'=>Auth::id(),
                'title'=>empty($this->newTitle) ? null : $this->newTitle
            );

            TimeEventData::create($data);
            
            $this->cancelCreate();
        }else{

            $data = array(
                'day'=>$this->item['day'],
                'start'=>$this->item['start'],
                'end'=>$this->item['end'], 
                'team_id'=>$this->item['team_id'],
            );

            //TimeEventData::update($this->idItem,$data);
            
            $this->cancelEdit();

        }


    }

    //------------------------------------------------    
    //-------Удаление элемента------------------------
    //------------------------------------------------    
    public function showDeleteEvent($eventId)
    {
        $this->delEvent = TimeEventData::getTeamEventArray($eventId);
        $this->showDelEvent = true;
    }

    public function cancelDelEvent() {

        $this->delEvent = array('id'=>null, 'day'=>null, 'start' =>null, 'end'=>null);
        $this->showDelEvent = false;
    }

    public function destroy($eventId)
    {
        TimeEventData::deleteTeamEvent($eventId);
        $this->cancelDelEvent();

    }

    //------------------------------------------------    
    //-------RENDER-----------------------------------
    //------------------------------------------------    
    public function render()
    {
        $data = array(
            'sortField'=> $this->sortField,
            'sortDirection'=> $this->sortDirection,
            'search'=> $this->search,
            'filter'=> $this->filter
        );

        $timeEvents = TimeEventData::indexWire($data);

        $timeEvents = $timeEvents->paginate($this->per_page);

        return view('livewire.time-events',['timeEvents'=>$timeEvents,'teams'=>TimeEventData::getTeamList()]);
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


}
