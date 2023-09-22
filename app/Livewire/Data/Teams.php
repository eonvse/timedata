<?php

namespace App\Livewire\Data;

use Livewire\Component;
use Livewire\WithPagination;

use App\Repositories\TeamData;

class Teams extends Component
{
    use WithPagination;

    //-------------------------    
    //-------ПЕРЕМЕННЫЕ--------
    //-------------------------    

    public $per_page;

    public $showCreate, $showEdit, $showDelete;
    public $newName, $newColor, $newInfo;
    
    public $sortField, $sortDirection;

    public $item;
    #[Locked] 
    public $idItem;


    //------------------------------------------------    
    //-------Монтирование-----------------------------
    //------------------------------------------------    
    public function mount()
    {
        $this->showCreate = $this->showEdit = $this->showDelete = false;
        $this->newName = $this->newInfo = '';
        $this->newColor = 1; //colors id = clean
        $this->item = array('name'=>'','color_id'=>1,'info'=>'');
        $this->idItem = '';
        
        $this->per_page = 20;

        $this->sortField = $this->sortDirection = '';

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
        $this->newName = $this->newInfo = '';
        $this->newColor = 1; //colors id = clean

    }

    //------------------------------------------------    
    //-------Редактирование элемента------------------
    //------------------------------------------------    
    public function edit($id)
    {
        $this->showEdit = true;
        $itemTeam = TeamData::get($id);
        $this->item = array(
            'name'=>$itemTeam->name ?? '',
            'color_id'=>$itemTeam->color_id ?? 1,
            'info'=>$itemTeam->info ?? ''
            );
        $this->idItem = $itemTeam->id;

    }

    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->item = array('name'=>'','color_id'=>1,'info'=>'');
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
                'color_id'=>$this->newColor ?: 1,
                'info'=>$this->newInfo ?: NULL
            );

            TeamData::create($data);
            
            $this->cancelCreate();
        }else{

            $data = array(
                'name'=>$this->item['name'],
                'color_id'=>$this->item['color_id'] ?: 1,
                'info'=>$this->item['info'] ?: NULL 
            );

            TeamData::update($this->idItem,$data);
            
            $this->cancelEdit();

        }


    }

    //------------------------------------------------    
    //-------Удаление элемента------------------------
    //------------------------------------------------    
    public function delete($id)
    {
        $this->showDelete = true;
        $itemTeam = TeamData::get($id);
        $this->item = array(
            'name'=>$itemTeam->name ?? '',
            'color_id'=>$itemTeam->color_id ?? '',
            'info'=>$itemTeam->info ?? ''
        );
        $this->idItem = $itemTeam->id;

    }

    public function cancelDelete()
    {
        $this->showDelete = false;
        $this->item = array('name'=>'','color_id'=>1,'info'=>'');
        $this->idItem = '';
    }


    public function destroy()
    {
        TeamData::destroy($this->idItem);
        $this->cancelDelete();
    }


    //------------------------------------------------    
    //-------RENDER-----------------------------------
    //------------------------------------------------    
    public function render()
    {
        $data = array(
            'sortField'=> $this->sortField,
            'sortDirection'=> $this->sortDirection
        );

        $teams = TeamData::indexWire($data);

        $teams = $teams->paginate($this->per_page);

        $colors = TeamData::getColorList();

        return view('livewire.data.teams',['teams'=>$teams,'colors'=>$colors->toArray()]);
    }

}
