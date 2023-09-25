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
    
    public $showAddFile, $showDelFile;
    public $addFile;
    public $delFile;
    public $files;

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

        $this->showAddFile = $this->showDelFile = false;
        $this->addFile = '';
        $this->delFile = array('id'=>null,'name'=>null, 'url'=>null);
        $this->files = TeamData::getFileListForTeam(self::MODEL_TYPE,$id);


        

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
        $this->files = TeamData::getFileListForTeam(self::MODEL_TYPE,$this->modelId);

    }

    public function showEditMode()
    {
        $this->showEdit = true;
        $this->cancelAddNote();
        $this->cancelAddUser();
        $this->cancelAddEvent();
        $this->cancelAddFile();
    }


    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->updateData();

    }

    public function save()
    {

       $this->model->update(['name'=>$this->modelName,'info'=>$this->modelInfo, 'color_id'=>$this->modelColorId]);
       $this->updateData();
       $this->cancelEdit();
    }

    /*------------------------------------
    -----------USERS-----------------------
    ---------------------------------------*/
    public function addUserTeam()
    {
        $this->showAddUser = true;
        $this->cancelAddNote();
        $this->cancelAddFile();
        $this->cancelAddEvent();
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
        $this->cancelAddNote();
        $this->cancelAddUser();
        $this->cancelAddFile();
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
        $this->cancelAddFile();
        $this->cancelAddUser();
        $this->cancelAddEvent();
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

    public function showDeleteNote($noteId)
    {
        $this->delNote = TeamData::getTeamNoteArray($noteId);
        $this->showDelNote = true;
    }

    public function deleteTeamNote($noteId)
    {
        if (!empty($noteId)) TeamData::deleteTeamNote($noteId);
        $this->updateData();
        $this->cancelDelNote();
    }

    public function cancelDelNote() {

        $this->delNote = array('id'=>null, 'note'=>null);
        $this->showDelNote = false;
    }


    /*------------------------------------
    -----------FILES----------------------
    ---------------------------------------*/
    public function addTeamFile()
    {
        $this->showAddFile = true;
        $this->cancelAddNote();
        $this->cancelAddUser();
        $this->cancelAddEvent();

    }

    public function cancelAddFile()
    {
        $this->showAddFile = false;
        $this->addFile = '';
    }

    public function saveTeamFile()
    {
        if (!empty($this->addFile)) {
            $patch = 'public/'.self::MODEL_TYPE.'/'.$this->modelId;

            $this->addFile->store($patch);
            
            $data = array(
                'name'=>null,
                'url'=>null,
                'autor_id'=>null,
                'type_id'=>null,
                'item_id'=>$this->modelId,
                'week'=>null, 
                'year'=>null,
                'location'=>'LOCAL');
            //TeamData::saveTeamFile(self::MODEL_TYPE,$data,$patch,$this->addFile);
        }
        //$this->cancelAddFile();
        $this->updateData();
    }

    public function showDeleteFile($fileId)
    {
        $this->delFile = TeamData::getTeamFileArray($fileId);
        $this->showDelFile = true;
    }

    public function deleteTeamFile($fileId)
    {
        if (!empty($noteId)) TeamData::deleteTeamFile($fileId);
        $this->updateData();
        $this->cancelDelFile();
    }

    public function cancelDelFile() {

        $this->delFile = array('id'=>null,'name'=>null, 'url'=>null);
        $this->showDelFile = false;
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
