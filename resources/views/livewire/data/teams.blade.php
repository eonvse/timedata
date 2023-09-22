<div class="mx-auto max-w-4xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        @include('layouts.navigation-wire')
        <div class="p-3 grid grid-cols-2 items-center">
            <x-head.page-wire>{{ __('teams') }}</x-head.page-wire>
            <x-button.create wire:click="create">{{ __('Add Teams') }}</x-button.create>
        </div>
<div>
</div>
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="relative overflow-x-auto shadow-md sm:rounded">
                <div class="flex-col space-y-4">
                 <x-table>
                    <x-slot name="header">
                        <x-table.head>id</x-table.head>
                        <x-table.head scope="col" 
                                        sortable 
                                        wire:click="sortBy('name')" 
                                        :direction="$sortField === 'name' ? $sortDirection : null">Название</x-table.head>
                        <x-table.head scope="col" colspan="3" >Инфо</x-table.head>
                        <x-table.head  scope="col" >Цвет</x-table.head>
                        <x-table.head>...</x-table.head>

                    </x-slot>
                    @foreach($teams as $team)
                        <x-table.row wire:loading.class.delay="bg-red-500" wire:key="{{ $team->id }}">
                            <x-table.cell>
                                {{ $team->id }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $team->name }}
                            </x-table.cell>
                            <x-table.cell colspan="3" >
                                {{ $team->info ?? '' }}
                            </x-table.cell>
                            <x-table.cell class="{{ $team->color->color ?? '' }}"></x-table.cell>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <x-button.icon-edit :href="route('info.team',['id'=>$team->id])" title="Редактировать"/>
                                    <x-button.icon-del wire:click="delete({{ $team->id }})" title="Удалить"/>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table>
                </div>
            </div>
        </div>
    </div>

    <x-modal-wire.dialog wire:model.defer="showCreate" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Add Teams') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelCreate" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="store" class="flex-col space-y-2">
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Название</x-input.label>
                        <x-input.text wire:model.blur="newName" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Доп. информация</x-input.label>
                        <x-input.text wire:model.blur="newInfo" />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        @php 
                            $colorBg = '';
                            foreach ($colors as $color)
                                if ($color['id']==$newColor) $colorBg = $color['color'];
                        @endphp
                        <x-input.label class="flex items-center">
                            Цвет 
                            <div class="{{ $colorBg }} w-full m-2">&nbsp;</div>
                        </x-input.label>
                        <x-input.select-color :items="$colors" wire:model.live="newColor"/>
                    </div>
                    <x-button.create type="submit">{{ __('Add Team') }}</x-button.create>
                    <x-button.secondary @click="show = false" wire:click="cancelCreate">{{ __('Cancel') }}</x-button.secondary>
                </form>
            </x-slot>
    </x-modal-wire.dialog>

    <x-modal-wire.dialog wire:model.defer="showEdit" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Edit Team') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelEdit" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="store" class="flex-col space-y-2">
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Название</x-input.label>
                        <x-input.text wire:model="item.name" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Доп. информация</x-input.label>
                        <x-input.text wire:model="item.info" />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        @php 
                            $colorBg = '';
                            foreach ($colors as $color)
                                if ($color['id']==$item['color_id']) $colorBg = $color['color'];
                        @endphp
                        <x-input.label class="flex items-center">
                            Цвет 
                            <div class="{{ $colorBg }} w-full m-2">&nbsp;</div>
                        </x-input.label>
                        <x-input.select-color :items="$colors" wire:model.live="item.color_id"/>
                    </div>

                    <x-button.create type="submit">{{ __('Save') }}</x-button.create>
                    <x-button.secondary @click="show = false" wire:click="cancelCreate">{{ __('Cancel') }}</x-button.secondary>
                </form>
            </x-slot>
    </x-modal-wire.dialog>

   <x-modal-wire.dialog wire:model.defer="showDelete" type="warn" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Delete Teams') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelete" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
            <x-slot name="content">
                <div class="flex-col space-y-2">
                    <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                        <div class="text-black">{{ $item['name'] ?? '' }} {{ $item['info'] ?? '' }}</div>
                    </x-input.label>
                    <x-button.secondary @click="show = false" wire:click="cancelDelete">Отменить</x-button.secondary>
                    <x-button.danger wire:click="destroy">{{ __('Delete')}}</x-button.danger>
                </div>                            
            </x-slot>
    </x-modal-wire.dialog>

</div>