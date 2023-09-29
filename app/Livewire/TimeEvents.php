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
                'title'=>$this->newTitle ?? null
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
    public function delete($id)
    {
        $this->showDelete = true;
        $editingUser = TimeEventData::get($id);
        $this->item = array(
            'name'=>$editingUser->name ?? '',
            'surname'=>$editingUser->surname ?? '',
            'patronymic'=>$editingUser->patronymic ?? '',
            'birthday'=>$editingUser->birthday ?? '',
            );
        $this->idItem = $editingUser->id;

    }

    public function cancelDelete()
    {
        $this->showDelete = false;
        $this->item = array('name'=>'','surname'=>'','patronymic'=>'','birthday'=>'');
        $this->idItem = '';
    }


    public function destroy()
    {
        TimeEventData::destroy($this->idItem);
        $this->cancelDelete();
    }


    //------------------------------------------------    
    //-------RENDER-----------------------------------
    //------------------------------------------------    
    public function render()
    {
        $data = array(
            'sortField'=> $this->sortField,
            'sortDirection'=> $this->sortDirection,
            'search'=> $this->search
        );

        $timeEvents = TimeEventData::indexWire($data);

        $timeEvents = $timeEvents->paginate($this->per_page);

        return view('livewire.time-events',['timeEvents'=>$timeEvents,'teams'=>TimeEventData::getTeamList()]);
    }


}
