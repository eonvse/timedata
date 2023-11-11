<?php

namespace App\Livewire\Info;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Livewire\Attributes\Rule;
//use Livewire\Attributes\Locked;

use Illuminate\Support\Str;

use App\Repositories\UserData;

class User extends Component
{
    use WithPagination, WithFileUploads;

    const MODEL_TYPE = 'users';
    const NOTES_PER_PAGE = 3;
    const UPCOMING_COUNT = 5;

    #[Locked]
    public $modelId;

    public $model;
    
    #[Rule('required', message: 'Не может быть пустым')]
    public $modelName;

    public $modelSurname, $modelPatronymic, $modelBirthday;
    public $showEdit;


    public $showAddFile, $showDelFile, $isLocalFile;
    
    public $addFileUser;

    #[Rule('required', message: 'Не может быть пустым')]
    public $webName; 

    #[Rule('url', message: 'Неправильная ссылка')]
    public $webUrl;
    
    public $delFileUser;
    public $files;

    public $showAddNote, $showDelNote, $delNote;
    public $addNote;

    public $teams, $upcomingEvents;


    public function mount($id,$edit=true)
    {
        $this->model = UserData::get($id);
        $this->modelId = $id;
        $this->modelName = $this->model->name;
        $this->modelSurname = $this->model->surname;
        $this->modelPatronymic = $this->model->patronymic;
        $this->modelBirthday = $this->model->birthday;

        $this->showEdit = $edit;

        $this->showAddFile = $this->showDelFile = false;
        $this->addFileUser = '';
        $this->delFileUser = array('id'=>null,'name'=>null, 'url'=>null);
        $this->files = UserData::getFileListForUser(self::MODEL_TYPE,$this->modelId);
        $this->isLocalFile = true;
        $this->webName = $this->webUrl = '';
        
        $this->showAddNote = $this->showDelNote = false;
        $this->addNote = '';
        $this->delNote = array('id'=>null, 'note'=>null);

        $this->teams = UserData::getTeams($this->modelId);
        $this->upcomingEvents = UserData::getUpcomingEvents($this->modelId,self::UPCOMING_COUNT);

    }

    /*------------------------------------
    -----------USER-----------------------
    ---------------------------------------*/

    private function updateData()
    {
        $this->model = UserData::get($this->modelId);
        $this->modelName = $this->model->name;
        $this->modelSurname = $this->model->surname;
        $this->modelPatronymic = $this->model->patronymic;
        $this->modelBirthday = $this->model->birthday;
        
        $this->files = UserData::getFileListForUser(self::MODEL_TYPE,$this->modelId);

        $this->teams = UserData::getTeams($this->modelId);
        $this->upcomingEvents = UserData::getUpcomingEvents($this->modelId,self::UPCOMING_COUNT);
    }

    public function showEditMode()
    {
        $this->showEdit = true;
        /*$this->cancelAddNote();
        $this->cancelAddUser();
        $this->cancelAddEvent();
        $this->cancelAddFile();*/
    }


    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->updateData();
        $this->resetValidation('modelName');
        $this->resetErrorBag('modelName');

    }

    public function save()
    {

        $this->validate(['modelName'=>'required']);
        $this->model->update(['name'=>$this->modelName,'surname'=>$this->modelSurname, 'patronymic'=>$this->modelPatronymic, 'birthday'=>$this->modelBirthday ]);  
       
        $this->updateData();
        $this->cancelEdit();
    }

    /*------------------------------------
    -----------FILES----------------------
    ---------------------------------------*/
    public function addUserFile()
    {
        $this->showAddFile = true;
        $this->cancelAddNote();
        $this->cancelEdit();

    }

    public function cancelAddFile()
    {
        $this->showAddFile = false;
        $this->reset('addFileUser'); //?????????????????????
        $this->isLocalFile = true;
        $this->webName = $this->webUrl = '';
    }

    public function saveUserFile()
    {

        $noError = true;
        if (!empty($this->addFileUser) && $this->isLocalFile) {
            $patch = ''.self::MODEL_TYPE.'/'.$this->modelId;
            $filename = Str::random(3).'_'.$this->addFileUser->getClientOriginalName();
            $url = $patch.'/'.$filename;
            $this->addFileUser->storeAs($patch,$filename,'public');

        }elseif (!$this->isLocalFile) {

            $this->validate();

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
            UserData::saveUserFile(self::MODEL_TYPE,$data);        
        }

        $this->cancelAddFile();
        $this->updateData();
    }

    public function showDeleteFile($fileId)
    {
        $this->delFileUser = UserData::getUserFileArray($fileId);
        $this->showDelFile = true;
    }

    public function deleteUserFile($fileId)
    {
        if (!empty($fileId)) UserData::deleteUserFile($fileId);
        $this->updateData();
        $this->cancelDelFile();
    }

    public function cancelDelFile() {

        $this->delFileUser = array('id'=>null,'name'=>null, 'url'=>null);
        $this->showDelFile = false;
    }

    /*------------------------------------
    -----------NOTES-----------------------
    ---------------------------------------*/
    public function addUserNote()
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

    public function saveUserNote()
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
            UserData::saveUserNote(self::MODEL_TYPE,$data);
        }
        $this->cancelAddNote();
        $this->updateData();
        $this->resetPage();
    }

    public function showDeleteNote($noteId)
    {
        $this->delNote = UserData::getUserNoteArray($noteId);
        $this->showDelNote = true;
    }

    public function deleteUserNote($noteId)
    {
        if (!empty($noteId)) UserData::deleteUserNote($noteId);
        $this->updateData();
        $this->cancelDelNote();
        $this->resetPage();
    }

    public function cancelDelNote() {

        $this->delNote = array('id'=>null, 'note'=>null);
        $this->showDelNote = false;
    }


    /*-------------------------------------
    -----------RENDER----------------------
    ---------------------------------------*/

    public function render()
    {
        $notes = UserData::getNotes(self::MODEL_TYPE, $this->modelId);
        return view('livewire.info.user',['notes'=>$notes->simplePaginate(self::NOTES_PER_PAGE)]);
    }
}
