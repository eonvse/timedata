<div>
<x-head.page-nav>
    @include('layouts.navigation-wire')
</x-head.page-nav>
<div class="mx-auto max-w-4xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        <div class="p-3 grid grid-cols-2 items-center">
            <x-head.h1>{{ __('users') }}</x-head.h1>
            <x-button.create calss="w-full" wire:click="create">{{ __('Add Users') }}</x-button.create>
            <x-spinner wire:loading wire:target="create" />
        </div>

        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="relative overflow-x-auto shadow-md sm:rounded">
                <div class="flex-col space-y-4">
                <x-spinner wire:loading wire:target="sortBy" />    
                 <x-table>
                    <x-slot name="header">
                        <x-table.head rowspan=2>id</x-table.head>
                        <x-table.head scope="col" 
                                        sortable 
                                        wire:click="sortBy('surname')" 
                                        :direction="$sortField === 'surname' ? $sortDirection : null">Фамилия</x-table.head>
                        <x-table.head scope="col" 
                                        sortable 
                                        wire:click="sortBy('name')" 
                                        :direction="$sortField === 'name' ? $sortDirection : null">Имя</x-table.head>
                        <x-table.head rowspan=2 scope="col" 
                                        sortable 
                                        wire:click="sortBy('patronymic')" 
                                        :direction="$sortField === 'patronymic' ? $sortDirection : null">Отчество</x-table.head>
                        <x-table.head rowspan=2 scope="col">День рождения</x-table.head>
                        <x-table.head rowspan="2" >...</x-table.head>

                    </x-slot>
                    <x-slot name="searching">
                        <x-spinner wire:loading wire:target="search" />
                        <x-table.head colspan=2>
                            <div class="flex">
                                <x-input.text class="py-0 px-1 text-sm" wire:model.live="search" placeholder="Найти по ФИО..." />
                                @if (!empty($search))
                                <x-button.icon-cancel wire:click="$set('search', '')" title="Отменить" />
                                @endif
                            </div>    
                        </x-table.head>
                    </x-slot>
                    @foreach($users as $user)
                        <x-table.row wire:loading.class.delay="bg-red-500" wire:key="{{ $user->id }}">
                            <x-table.cell>
                                {{ $user->id }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->surname ?? '' }}
                            </x-table.cell>
                            <x-table.cell>
                                <a href="{{ route('info.user',['id'=>$user->id,'edit'=>0]) }}" class="underline">{{ $user->name }}</a>
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->patronymic ?? '' }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->birthday_format ?? '' }}
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <x-button.icon-edit :href="route('info.user',['id'=>$user->id])" title="Редактировать"/>
                                    <x-button.icon-del wire:click="delete({{ $user->id }})" title="Удалить"/>
                                    <x-spinner wire:loading wire:target="delete" />
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table>
                <div>
                @if (empty($search))
                    {{ $users->links() }}
                @else
                    <x-input.label class="text-gray-500">Найдено записей: {{ $users->count() }}</x-input.label>
                @endif
                </div>                  
                </div>
            </div>
        </div>
    </div>

    <x-modal-wire.dialog wire:model.defer="showCreate" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Add Users') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelCreate" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <x-spinner wire:loading wire:target="store" />
                <x-spinner wire:loading wire:target="cancelCreate" />
                <form wire:submit.prevent="store" class="flex-col space-y-2">
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Фамилия</x-input.label>
                        <x-input.text wire:model.blur="newSurname" />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Имя</x-input.label>
                        <x-input.text wire:model.blur="newName" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Отчество</x-input.label>
                        <x-input.text wire:model.blur="newPatronymic" />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>День рождения</x-input.label>
                        <x-input.text type="date" wire:model.blur="newBirthday" />
                    </div>
                    <x-button.create type="submit">{{ __('Add User') }}</x-button.create>
                    <x-button.secondary @click="show = false" wire:click="cancelCreate">{{ __('Cancel') }}</x-button.secondary>
                </form>
            </x-slot>
    </x-modal-wire.dialog>

   <x-modal-wire.dialog wire:model.defer="showDelete" type="warn" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Delete Users') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelete" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
            <x-slot name="content">
                <x-spinner wire:loading wire:target="destroy" />
                <x-spinner wire:loading wire:target="cancelDelete" />
                <div class="flex-col space-y-2">
                    <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                        <div class="text-black dark:text-white">{{ $item['surname'] ?? '' }} {{ $item['name'] ?? '' }} {{ $item['patronymic'] ?? '' }}</div>
                        <div class="text-red-600 dark:text-red-200 shadow p-1">{{ __('Delete User Message') }}</div>
                    </x-input.label>
                    <x-button.secondary @click="show = false" wire:click="cancelDelete">Отменить</x-button.secondary>
                    <x-button.danger wire:click="destroy">{{ __('Delete')}}</x-button.danger>
                </div>                            
            </x-slot>
    </x-modal-wire.dialog>

</div>
</div>