<?php

namespace App\Livewire\Info;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use App\Repositories\UserData;

/*      'name',
        'email',
        'password',
        'surname',
        'patronymic',
        'birthday'
*/

class User extends Component
{
    use WithPagination, WithFileUploads;

    const MODEL_TYPE = 'users';
    const NOTES_PER_PAGE = 3;

    #[Lock]
    public $modelId;

    public $model;
    public $modelName, $modelSurname, $modelPatronymic, $modelBirthday;
    public $showEdit;

    public function mount($id,$edit=true)
    {
        $this->model = UserData::get($id);
        $this->modelId = $id;
        $this->modelName = $this->model->name;
        $this->modelSurname = $this->model->surname;
        $this->modelPatronymic = $this->model->patronymic;
        $this->modelBirthday = $this->model->birthday;

        $this->showEdit = $edit;
        
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

    }

    public function save()
    {

       /*$this->model->update(['name'=>$this->modelName,'info'=>$this->modelInfo, 'color_id'=>$this->modelColorId]);*/
       $this->updateData();
       $this->cancelEdit();
    }

    /*-------------------------------------
    -----------RENDER----------------------
    ---------------------------------------*/
    public function render()
    {
        return view('livewire.info.user');
    }
}
