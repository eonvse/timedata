<div class="mx-auto max-w-4xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">
    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        <div class="p-3">
            <x-button.create wire:click="create">{{ __('Add Users') }}</x-button.create>
        </div>

        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="relative overflow-x-auto shadow-md sm:rounded">
                <div class="flex-col space-y-4">
                 <x-table>
                    <x-slot name="header">
                        <x-table.head rowspan=2>id</x-table.head>
                        <x-table.head scope="col" 
                                        sortable 
                                        wire:click="sortBy('surname')" 
                                        :direction="$sortField === 'surname' ? $sortDirection : null">Фамилия</x-table.head>
                        <x-table.head rowspan=2 scope="col" 
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
                        <x-table.head>
                            <div class="flex">
                                <x-input.text wire:model.live="search" placeholder="Найти по ФИО..." />
                                @if (!empty($search))
                                <x-button.icon-cancel wire:click="$set('search', '')" title="Отменить" />
                                @endif
                            </div>    
                        </x-table.head>
                    </x-slot>
                    @foreach($users as $user)
                        <x-table.row wire:loading.class.delay="bg-red-500">
                            <x-table.cell>
                                {{ $user->id }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->surname ?? '' }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->name }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->patronymic ?? '' }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->birthday_format ?? '' }}
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <x-button.icon-edit wire:click="edit({{ $user }})" title="Редактировать"/>
                                    <x-button.icon-del wire:click="delete({{ $user }})" title="Удалить"/>
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

</div>