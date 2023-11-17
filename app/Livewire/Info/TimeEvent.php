<?php

namespace App\Livewire\Info;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

//use Livewire\Attributes\Locked;

use Illuminate\Support\Str;

use App\Repositories\TimeEventData;

class TimeEvent extends Component
{
    use WithPagination, WithFileUploads;

    const MODEL_TYPE = 'time_events';
    const NOTES_PER_PAGE = 3;
    const UPCOMING_COUNT = 5;
    const PREV_COUNT = 2;

    public $model, $usersTeam;
    public $modelTitle, $modelDay, $modelStart, $modelEnd;
    public $showEdit;

    public $upcomingEvents, $previousEvents;
    
    public $showAddNote, $showDelNote, $delNote;
    public $addNote;
    
    public $showAddFile, $showDelFile, $isLocalFile;
    public $addFileEvent, $webName, $webUrl;
    public $delFileEvent;
    public $files;

    public $mini_month;

    public $showDelEvent, $delEvent;
    
    #[Locked]
    public $modelId, $modelTeamId;

    public function mount($id,$edit=true)
    {
        $this->model = TimeEventData::get($id);
        $this->modelId = $id;
        $this->modelTeamId = $this->model->team_id;
        $this->usersTeam = TimeEventData::getTimeEventUsers($this->modelTeamId,$this->modelId);
        $this->modelTitle = $this->model->title;
        $this->modelDay = $this->model->day;
        $this->modelStart = $this->model->start;
        $this->modelEnd = $this->model->end;

        $this->showEdit = $edit;

        $this->upcomingEvents = TimeEventData::getUpcomingEvents($this->modelId,$this->modelTeamId,self::UPCOMING_COUNT);
        $this->previousEvents = TimeEventData::getPreviousEvents($this->modelId,$this->modelTeamId,self::PREV_COUNT);
        
        $this->showAddNote = $this->showDelNote = false;
        $this->addNote = '';
        $this->delNote = array('id'=>null, 'note'=>null);

        $this->showAddFile = $this->showDelFile = false;
        $this->addFileEvent = '';
        $this->delFileEvent = array('id'=>null,'name'=>null, 'url'=>null);
        $this->files = TimeEventData::getFileListForEvent(self::MODEL_TYPE,$id);
        $this->isLocalFile = true;
        $this->webName = $this->webUrl = '';

        $this->mini_month = TimeEventData::mini_month($this->modelDay);
        
        $this->showDelEvent = false;
        $this->delEvent = array('id'=>null, 'day'=>null, 'start' =>null, 'end'=>null);

    }

    /*------------------------------------
    -----------EVENT-----------------------
    ---------------------------------------*/

    private function updateData()
    {
        $this->model = TimeEventData::get($this->modelId);
        $this->usersTeam = TimeEventData::getTimeEventUsers($this->modelTeamId,$this->modelId);
        $this->modelTitle = $this->model->title;
        $this->modelDay = $this->model->day;
        $this->modelStart = $this->model->start;
        $this->modelEnd = $this->model->end;

        $this->upcomingEvents = TimeEventData::getUpcomingEvents($this->modelId,$this->modelTeamId,self::UPCOMING_COUNT);
        $this->previousEvents = TimeEventData::getPreviousEvents($this->modelId,$this->modelTeamId,self::PREV_COUNT);

        $this->files = TimeEventData::getFileListForEvent(self::MODEL_TYPE,$this->modelId);
        $this->mini_month = TimeEventData::mini_month($this->modelDay);
    }

    public function showEditMode()
    {
        $this->showEdit = true;
        $this->cancelAddNote();
        //$this->cancelAddUser();
        //$this->cancelAddEvent();
        $this->cancelAddFile();
    }


    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->updateData();

    }

    public function save()
    {

       $this->model->update(['title'=>$this->modelTitle,'day'=>$this->modelDay, 'start'=>$this->modelStart, 'end'=>$this->modelEnd]);
       $this->updateData();
       $this->cancelEdit();
    }

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
        $this->redirect('/timedata/public/teams/'.$this->modelTeamId.'/0');

    }

    /*------------------------------------
    -----------VISIT-----------------------
    ---------------------------------------*/

    public function addVisit($userId)
    {
        $data = array(
            'timeEvent_id'=>$this->modelId,
            'user_id'=>$userId,
            'autor_id'=>''
        );

        TimeEventData::addVisit($data);
        $this->updateData();
    }   

    public function delVisit($userId)
    {

        TimeEventData::delVisit($this->modelId,$userId);
        $this->updateData();
    }   

    /*------------------------------------
    -----------NOTES-----------------------
    ---------------------------------------*/
    public function addEventNote()
    {
        $this->showAddNote = true;
        $this->cancelEdit();
        $this->cancelAddFile();
        //$this->cancelAddUser();
        //$this->cancelAddEvent();
    }

    public function cancelAddNote()
    {
        $this->showAddNote = false;
        $this->addNote = '';
    }

    public function saveEventNote()
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
            TimeEventData::saveEventNote(self::MODEL_TYPE,$data);
        }
        $this->cancelAddNote();
        $this->updateData();
        $this->resetPage();
    }

    public function showDeleteNote($noteId)
    {
        $this->delNote = TimeEventData::getEventNoteArray($noteId);
        $this->showDelNote = true;
    }

    public function deleteEventNote($noteId)
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
    -----------FILES----------------------
    ---------------------------------------*/
    public function addEventFile()
    {
        $this->showAddFile = true;
        $this->cancelAddNote();
        $this->cancelEdit();

    }

    public function cancelAddFile()
    {
        $this->showAddFile = false;
        $this->reset('addFileEvent'); //?????????????????????
        $this->isLocalFile = true;
        $this->webName = $this->webUrl = '';
    }

    public function saveEventFile()
    {
        $noError = true;
        if (!empty($this->addFileEvent) && $this->isLocalFile) {
            $patch = ''.self::MODEL_TYPE.'/'.$this->modelId;
            $filename = Str::random(3).'_'.$this->addFileEvent->getClientOriginalName();
            $url = $patch.'/'.$filename;
            $this->addFileEvent->storeAs($patch,$filename,'public');

        }elseif (!$this->isLocalFile) {

            if (!empty($this->webName)&& !empty($this->webUrl)) {
                $filename = $this->webName;
                $url = $this->webUrl;
            }else $noError = false;

        }else $noError = false;

        if ($noError) {
            $data = array(
                'name'=>$filename,
                'url'=>$url,
                'autor_id'=>null,
                'type_id'=>null,
                'item_id'=>$this->modelId,
                'week'=>null, 
                'year'=>null,
                'isLocal'=>$this->isLocalFile ?? 0 );
            TimeEventData::saveEventFile(self::MODEL_TYPE,$data);        
        }

        $this->cancelAddFile();
        $this->updateData();
    }

    public function showDeleteFile($fileId)
    {
        $this->delFileEvent = TimeEventData::getEventFileArray($fileId);
        $this->showDelFile = true;
    }

    public function deleteEventFile($fileId)
    {
        if (!empty($fileId)) TimeEventData::deleteEventFile($fileId);
        $this->updateData();
        $this->cancelDelFile();
    }

    public function cancelDelFile() {

        $this->delFileEvent = array('id'=>null,'name'=>null, 'url'=>null);
        $this->showDelFile = false;
    }

    /*------------------------------------
    -----------RENDER-----------------------
    ---------------------------------------*/

    public function render()
    {
        $notes = TimeEventData::getNotes(self::MODEL_TYPE, $this->modelId);
        return view('livewire.info.time-event',['notes'=>$notes->simplePaginate(self::NOTES_PER_PAGE)]);
    }
}
