<?php

namespace App\Livewire\Info;

use Livewire\Component;
use Livewire\WithPagination;

use App\Repositories\TeamData;

class Team extends Component
{
    use WithPagination;

    const MODEL_TYPE = 'teams';
    const NOTES_PER_PAGE = 3;
    const UPCOMING_COUNT = 5;

    public $model, $usersTeam;
    public $colors,$users;
    public $modelName, $modelInfo, $modelColorId;
    public $disabledFields;
    public $showEdit, $showAddUser;

    public $showAddEvent, $showDelEvent, $delEvent;
    public $upcomingEvents, $addEventDay, $addEventStart, $addEventEnd;

    public $showAddNote, $showDelNote, $delNote;
    public $addNote;

    #[Lock]
    public $modelId, $addUserId;

    public function mount($id,$edit=true)
    {
        $this->model = TeamData::get($id);
        $this->modelId = $id;
        $this->colors = TeamData::getColorList();
        $this->users = TeamData::getUserListForTeam($id);
        $this->usersTeam = TeamData::getUsersTeam($id);
        $this->modelName = $this->model->name;
        $this->modelInfo = $this->model->info;
        $this->modelColorId = $this->model->color_id;

        $this->showEdit = $edit;
        
        $this->showAddUser = false;
        $this->addUserId = 0;

        $this->showAddEvent = $this->showDelEvent = false;
        $this->addEventDay = $this->addEventStart = $this->addEventEnd = '';
        $this->upcomingEvents = TeamData::getUpcomingEvents($id,self::UPCOMING_COUNT);
        $this->delEvent = array('id'=>null, 'day'=>null, 'start' =>null, 'end'=>null);

        $this->showAddNote = $this->showDelNote = false;
        $this->addNote = '';
        $this->delNote = array('id'=>null, 'note'=>null);

        

    }


    /*------------------------------------
    -----------TEAM-----------------------
    ---------------------------------------*/

    private function updateData()
    {
        $this->model = TeamData::get($this->modelId);
        $this->usersTeam = TeamData::getUsersTeam($this->modelId);
        $this->users = TeamData::getUserListForTeam($this->modelId);
        $this->modelName = $this->model->name;
        $this->modelInfo = $this->model->info;
        $this->modelColorId = $this->model->color_id;
        $this->upcomingEvents = TeamData::getUpcomingEvents($this->modelId,self::UPCOMING_COUNT);

    }

    public function showEditMode()
    {
        $this->showEdit = true;
    }


    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->updateData();

    }

    public function save()
    {

       $this->model->update(['name'=>$this->modelName]);
       $this->updateData();
       $this->cancelEdit();
    }

    /*------------------------------------
    -----------USERS-----------------------
    ---------------------------------------*/
    public function addUserTeam()
    {
        $this->showAddUser = true;
    }

    public function cancelAddUser()
    {
        $this->showAddUser = false;
        $this->addUserId = 0;
    }

    public function saveUserTeam()
    {
        if (!empty($this->addUserId)) TeamData::saveUserTeam($this->modelId,$this->addUserId);
        $this->cancelAddUser();
        $this->updateData();
    }

    public function deleteTeamUser($userId)
    {
        if (!empty($userId)) TeamData::deleteTeamUser($this->modelId,$userId);
        $this->updateData();
    }

    /*------------------------------------
    -----------UPCOMING EVENTS--------------
    ---------------------------------------*/
    public function addTeamEvent()
    {
        $this->showAddEvent = true;
    }

    public function cancelAddEvent()
    {
        $this->showAddEvent = false;
        $this->addEventDay = $this->addEventStart = $this->addEventEnd = '';
    }

    public function saveTeamEvent()
    {
        if (!empty($this->addEventDay)) {
            $data = array(
                'team_id'=>$this->modelId,
                'day'=>$this->addEventDay,
                'start'=>$this->addEventStart,
                'end'=>$this->addEventEnd,
                'user_id'=>0,
            );
            TeamData::saveTeamEvent($data);
        }
        $this->cancelAddEvent();
        $this->updateData();
    }

    public function showDeleteEvent($eventId)
    {
        $this->delEvent = TeamData::getTeamEventArray($eventId);
        $this->showDelEvent = true;
    }

    public function deleteTeamEvent($eventId)
    {
        if (!empty($eventId)) TeamData::deleteTeamEvent($eventId);
        $this->updateData();
        $this->cancelDelEvent();
    }

    public function cancelDelEvent() {

        $this->delEvent = array('id'=>null, 'day'=>null, 'start' =>null, 'end'=>null);
        $this->showDelEvent = false;
    }

    /*------------------------------------
    -----------NOTES----------------------
    ---------------------------------------*/
    public function addTeamNote()
    {
        $this->showAddNote = true;
    }

    public function cancelAddNote()
    {
        $this->showAddNote = false;
        $this->addNote = '';
    }

    public function saveTeamNote()
    {
        if (!empty($this->addNote)) {
            $data = array(
                'autor_id'=>null,
                'type_id'=>null,
                'item_id'=>$this->modelId,
                'week'=>null, 
                'year'=>null, 
                'note'=>$this->addNote,
            );
            TeamData::saveTeamNote(self::MODEL_TYPE,$data);
        }
        $this->cancelAddNote();
        $this->updateData();
    }

    public function showDeleteNote($eventId)
    {
        $this->delEvent = TeamData::getTeamEventArray($eventId);
        $this->showDelEvent = true;
    }

    public function deleteTeamNote($eventId)
    {
        if (!empty($eventId)) TeamData::deleteTeamEvent($eventId);
        $this->updateData();
        $this->cancelDelEvent();
    }

    public function cancelDelNote() {

        $this->delEvent = array('id'=>null, 'day'=>null, 'start' =>null, 'end'=>null);
        $this->showDelEvent = false;
    }


    /*------------------------------------
    -----------RENDER----------------------
    ---------------------------------------*/
    public function render()
    {
        $notes = TeamData::getNotes(self::MODEL_TYPE, $this->modelId);
        return view('livewire.info.team',['notes'=>$notes->simplePaginate(self::NOTES_PER_PAGE)]);
    }
}
