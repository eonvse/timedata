<div>
<x-head.page-nav>
    @include('layouts.navigation-wire')
</x-head.page-nav>
<div class="mx-auto max-w-7xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        <div class="p-3 grid grid-cols-3 items-center">
                <div class="flex">
                    <x-head.h1 class="grow">
                        {{ __('time-events') }}
                    </x-head.h1>
                    <div class="px-2 py-1 dark:text-gray-300">Фильтр</div>
                </div>
            <div class="items-left mr-10">
                <x-input.select-filter :items="$teams" allTxt="По всем группам" wire:model.live="filter.team" />
                <x-spinner wire:loading wire:target="filter.team" />
            </div>
            <x-button.create wire:click="create">{{ __('Add Time Events') }}</x-button.create>
            <x-spinner wire:loading wire:target="create" />
        </div>
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="relative overflow-x-auto shadow-md sm:rounded">
                <div class="flex-col space-y-4">
                 <x-table>
                    <x-slot name="header">
                        <x-table.head scope="col" 
                                        sortable 
                                        wire:click="sortBy('day')" 
                                        :direction="$sortField === 'day' ? $sortDirection : null">Дата</x-table.head>
                        <x-table.head scope="col" >Время</x-table.head>
                        <x-table.head scope="col">Группа</x-table.head>
                        <x-table.head scope="col">{{ __('Time Event Title') }}</x-table.head>
                        <x-table.head >...</x-table.head>

                    </x-slot>
                    @forelse($timeEvents as $timeEvent)
                        <x-table.row wire:loading.class.delay="bg-red-500" wire:key="{{ $timeEvent->id }}">
                            <x-table.cell>
                                <a href="{{ route('info.time-event',['id'=>$timeEvent->id,'edit'=>0]) }}" class="underline">{{ $timeEvent->day_format }}</a>
                            </x-table.cell>
                            <x-table.cell>
                                {{ $timeEvent->start_format }} - {{ $timeEvent->end_format }}
                            </x-table.cell>
                            <x-table.cell>
                                <span class="{{ $timeEvent->team->color->color }} dark:{{ $timeEvent->team->color->dark }}">&nbsp;&nbsp;</span>
                                {{ $timeEvent->team->name }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $timeEvent->title ?? '' }}
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <x-button.icon-edit :href="route('info.time-event',['id'=>$timeEvent->id])" title="Редактировать"/>
                                    <x-button.icon-del wire:click="showDeleteEvent({{ $timeEvent->id }})" title="Удалить"/>
                                    <x-spinner wire:loading wire:target="showDeleteEvent" />    
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan=6 class="text-center">
                            Найдено записей: {{ $timeEvents->count() }}
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-table>
                <div>
                @if (empty($search))
                    {{ $timeEvents->links() }}
                @else
                    <x-input.label class="text-gray-500">Найдено записей: {{ $timeEvents->count() }}</x-input.label>
                @endif
                </div>                  
                </div>
            </div>
        </div>
    </div>

    <x-modal-wire.dialog wire:model.defer="showCreate" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Add Time Events') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelCreate" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="store" class="flex-col space-y-2">
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Дата</x-input.label>
                        <x-input.text type="date" wire:model.blur="newDay" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Начало</x-input.label>
                        <x-input.text type="time" wire:model.blur="newStart" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Завершение</x-input.label>
                        <x-input.text type="time" wire:model.blur="newEnd" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Группа</x-input.label>
                        <x-input.select wire:model.blur="newTeam" :items="$teams" noneTxt="Выберите группу" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>{{ __('Time Event Title') }}</x-input.label>
                        <x-input.text wire:model.blur="newTitle" />
                    </div>
                    <x-button.create type="submit">{{ __('Add Time Event') }}</x-button.create>
                    <x-button.secondary @click="show = false" wire:click="cancelCreate">{{ __('Cancel') }}</x-button.secondary>
                </form>
                <x-spinner wire:loading wire:target="store" />
                <x-spinner wire:loading wire:target="cancelCreate" />

            </x-slot>
    </x-modal-wire.dialog>

    <x-modal-wire.dialog wire:model.defer="showDelEvent" type="warn" maxWidth="md">
        <x-slot name="title"><span class="grow">{{ __('Delete Event') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelEvent" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
        <x-slot name="content">
            <div class="flex-col space-y-2">
                <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                    <div class="text-black dark:text-gray-200">
                        {{ date('d.m.Y',strtotime($delEvent['day'])) }}
                        {{ date('H:i',strtotime($delEvent['start'])) }}-{{ date('H:i',strtotime($delEvent['end'])) }}
                        {{ $delEvent['title'] ?? '' }}
                    </div>
                    <div class="text-red-600 dark:text-red-200 shadow p-1">{{ __('Delete Event Message') }}</div>
                </x-input.label>
                <x-button.secondary @click="show = false" wire:click="cancelDelEvent">{{ __('Cancel') }}</x-button.secondary>
                <x-button.danger wire:click="destroy({{ $delEvent['id'] }})">{{ __('Delete')}}</x-button.danger>
            </div> 
            <x-spinner wire:loading wire:target="destroy" />
            <x-spinner wire:loading wire:target="cancelDelEvent" />
                           
        </x-slot>
    </x-modal-wire.dialog>
</div>
</div>