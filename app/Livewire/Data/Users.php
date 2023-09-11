<?php

namespace App\Livewire\Data;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Hash;

use App\Repositories\UserData;


class Users extends Component
{
    use WithPagination;
    
    public $per_page;

    public $showCreate, $showEdit, $showDelete;
    public $newName, $newSurname, $newPatronymic, $newBirthday;
    public $editing;

    public $search, $sortField, $sortDirection;

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

    public function mount()
    {
        $this->showCreate = $this->showEdit = $this->showDelete = false;
        $this->newName = $this->newSurname = $this->newPatronymic = $this->newBirthday = '';
        $this->editing = null;
        
        $this->per_page = 20;

        $this->search = $this->sortField = $this->sortDirection = '';

    }

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
                            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
                            : 'asc';

        $this->sortField = $field;
        
    }

    public function create()
    {
        $this->showCreate = true;
    }

    public function cancelCreate()
    {
        $this->showCreate = false;
        $this->newName = $this->newSurname = $this->newPatronymic = $this->newBirthday = '';
    }

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

        }

        $this->cancelCreate();
    }


    public function render()
    {
        if (!empty($this->sortField)) $users=UserData::ordering($this->sortField,$this->sortDirection);
        else $users = UserData::indexWire();

        if(!empty($this->search)){
           $users->orWhere('name','like',"%".$this->search."%");
           $users->orWhere('surname','like',"%".$this->search."%");
           $users->orWhere('patronymic','like',"%".$this->search."%");
        }

        $users = $users->paginate($this->per_page);

        return view('livewire.data.users',['users'=>$users]);
    }
}


/*
    public $showCreate, $showEdit, $showDelete = false;
    public $unitsNoParent,$parents = null;
    public $newName = '';
    public $newFolder, $newParent = 0;
    public $editing = null;

    protected $rules = [
        'editing.name'=>'required',
        'editing.isParent'=>'required',
        'editing.parent_id'=>'required',
    ];


    private function updateData()
    {
        $this->unitsNoParent = UnitsRepository::noParents();
        $this->parents = UnitsRepository::parents();
    }

    public function render()
    {

        $this->updateData();
        return view('livewire.guide.unit');
    }

    public function create()
    {
        $this->showCreate = true;
    }

    public function edit($id)
    {
        $this->showEdit = true;
        $this->editing = UnitsRepository::get($id);

    }

    public function delete($id)
    {
        $this->showDelete = true;
        $this->editing = UnitsRepository::get($id);

    }

    public function cancelCreate()
    {
        $this->showCreate = false;
        $this->newName = '';
        $this->newFolder = $this->newParent = 0;
    }

    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->editing = null;
    }

    public function cancelDelete()
    {
        $this->showDelete = false;
        $this->editing = null;
    }


    public function store()
    {
        if (!empty($this->newName)) {

            if (!empty($this->newFolder)) {$this->newParent = 0;}

            UnitsRepository::create($this->newName,$this->newFolder,$this->newParent);

        }

        $this->updateData();

        $this->cancelCreate();
    }

    public function save()
    {
        UnitsRepository::save($this->editing);
        $this->updateData();
        $this->cancelEdit();
    }

    public function destroy()
    {
        UnitsRepository::destroy($this->editing);
        $this->updateData();
        $this->cancelDelete();
    }


*/