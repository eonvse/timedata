<?php

namespace App\Livewire\Info;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use App\Repositories\TimeEventData;

class TimeEvent extends Component
{
    use WithPagination, WithFileUploads;

    const MODEL_TYPE = 'time_events';
    const NOTES_PER_PAGE = 3;

    public $model, $usersTeam;
    public $modelTitle, $modelDay, $modelStart, $modelEnd;
    public $showEdit;

    public $showAddNote, $showDelNote, $delNote;
    public $addNote;
    
    public $showAddFile, $showDelFile;
    public $addFile;
    public $delFile;
    public $files;

    #[Lock]
    public $modelId, $modelTeamId;

    public function mount($id,$edit=true)
    {
        $this->model = TimeEventData::get($id);
        $this->modelId = $id;
        $this->modelTeamId = $this->model->team_id;
        $this->usersTeam = 'TeamData::getUsersTeam($id)';
        $this->modelTitle = $this->model->title;
        $this->modelDay = $this->model->day;
        $this->modelStart = $this->model->start;
        $this->modelEnd = $this->model->end;

        $this->showEdit = $edit;
        
        $this->showAddNote = $this->showDelNote = false;
        $this->addNote = '';
        $this->delNote = array('id'=>null, 'note'=>null);

        $this->showAddFile = $this->showDelFile = false;
        $this->addFile = '';
        $this->delFile = array('id'=>null,'name'=>null, 'url'=>null);
        $this->files = 'TimeEventData::getFileListForEvent(self::MODEL_TYPE,$id)';


        

    }

    public function render()
    {
        return view('livewire.info.time-event');
    }
}
