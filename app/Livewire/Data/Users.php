<?php

namespace App\Livewire\Data;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Hash;

use App\Repositories\UserData;

class Users extends Component
{
    use WithPagination;

    //-------------------------    
    //-------ПЕРЕМЕННЫЕ--------
    //-------------------------    

    public $per_page;

    public $showCreate, $showEdit, $showDelete;
    public $newName, $newSurname, $newPatronymic, $newBirthday;
    
    public $search, $sortField, $sortDirection;

    public $item;
    #[Locked] 
    public $idItem;


    //------------------------------------------------    
    //-------Транслитерация для заглушки email--------
    //------------------------------------------------    

    private function translit($value)
    {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
     
            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
            'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
            'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
            'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
            'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
            'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
            'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
        );
     
        $value = strtr($value, $converter);
        return $value;
    }

    //------------------------------------------------    
    //-------Монтирование-----------------------------
    //------------------------------------------------    
    public function mount()
    {
        $this->showCreate = $this->showEdit = $this->showDelete = false;
        $this->newName = $this->newSurname = $this->newPatronymic = $this->newBirthday = '';
        $this->item = array('name'=>'','surname'=>'','patronymic'=>'','birthday'=>'');
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
        $this->showCreate = true;
    }

    public function cancelCreate()
    {
        $this->showCreate = false;
        $this->newName = $this->newSurname = $this->newPatronymic = $this->newBirthday = '';
    }

    //------------------------------------------------    
    //-------Редактирование элемента------------------
    //------------------------------------------------    
    public function edit($id)
    {
        $this->showEdit = true;
        $editingUser = UserData::get($id);
        $this->item = array(
            'name'=>$editingUser->name ?? '',
            'surname'=>$editingUser->surname ?? '',
            'patronymic'=>$editingUser->patronymic ?? '',
            'birthday'=>$editingUser->birthday ?? '',
            );
        $this->idItem = $editingUser->id;

    }

    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->item = array('name'=>'','surname'=>'','patronymic'=>'','birthday'=>'');
        $this->idItem = '';
    }

    //------------------------------------------------    
    //-------Сохранение в БД--------------------------
    //------------------------------------------------    
    public function store()
    {
        if (!empty($this->newName)) {

            $data=array(
                'name'=>$this->newName,
                'surname'=>$this->newSurname ?: NULL,
                'patronymic'=>$this->newPatronymic ?: NULL, 
                'birthday'=>$this->newBirthday ?: NULL,
                'email'=>$this->translit($this->newName).'@'.uniqid(),
                'password'=>Hash::make('password')
            );

            UserData::create($data);
            
            $this->cancelCreate();
        }else{

            $data = array(
                'name'=>$this->item['name'],
                'surname'=>$this->item['surname'] ?: NULL,
                'patronymic'=>$this->item['patronymic'] ?: NULL, 
                'birthday'=>$this->item['birthday'] ?: NULL,
            );

            UserData::update($this->idItem,$data);
            
            $this->cancelEdit();

        }


    }

    //------------------------------------------------    
    //-------Удаление элемента------------------------
    //------------------------------------------------    
    public function delete($id)
    {
        $this->showDelete = true;
        $editingUser = UserData::get($id);
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
        UserData::destroy($this->idItem);
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

        $users = UserData::indexWire($data);

        $users = $users->paginate($this->per_page);

        return view('livewire.data.users',['users'=>$users,'active'=>'data.users']);
    }
}