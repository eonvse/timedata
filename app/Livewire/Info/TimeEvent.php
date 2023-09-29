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
    const UPCOMING_COUNT = 5;

    public $model, $usersTeam, $teams;
    public $modelTitle, $modelDay, $modelStart, $modelEnd, $modelTeamId;
    public $showEdit, $showAddUser;

    public $showAddEvent, $showDelEvent, $delEvent;
    public $upcomingEvents, $addEventDay, $addEventStart, $addEventEnd, $addEventTitle;

    public $showAddNote, $showDelNote, $delNote;
    public $addNote;
    
    public $showAddFile, $showDelFile;
    public $addFile;
    public $delFile;
    public $files;

    #[Lock]
    public $modelId, $addUserId;


    public function render()
    {
        return view('livewire.info.time-event');
    }
}
