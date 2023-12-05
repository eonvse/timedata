<div>
@php
    $order = array(1,5,2,6,3,7,4);
    $weekDays = array( 1 => 'Пн' , 'Вт' , 'Ср' , 'Чт' , 'Пт' , 'Сб' , 'Вс' );

@endphp

<div class="text-gray-700 w-screen h-screen p-2">
<x-weektab-wire :week="$week" :year="$year" :start="$startWeek->format('d.m')" :end="$endWeek->format('d.m')">
        <x-slot:buttons>
            <x-weektab-wire.switch-week />
        </x-slot>

        <x-slot:filter>
            <x-input.select-filter :items="$teams" allTxt="По всем группам" wire:model.live="filter.team" />
            <x-spinner wire:loading wire:target="filter.team" />
        </x-slot:filter>

        <x-slot:navigation>
            @include('layouts.navigation-wire')
        </x-slot>
        <x-weektab-wire.grid>
            @for ($i=0; $i<7; $i++)
            @php
                $bgCell='bg-white';
                $events_day = $events_week[$order[$i]];
                if ($events_day['date']==date('d.m.Y')) { $bgCell='bg-amber-200 dark:bg-yellow-800'; }
            @endphp
            <x-weektab-wire.cell class="{{ $bgCell }}" :dateCell="$events_day['date']" >
                {{ $weekDays[date('N',strtotime($events_day['date']))] }} 
                {{ date('d.m',strtotime($events_day['date'])) }}
                @if (!empty(count($events_day['events'])))
                <x-slot name='events'>
                    @foreach ($events_day['events'] as $event)
                    <x-weektab-wire.event :time_event="$event" />
                    @endforeach
                </x-slot>
                @endif
            </x-weektab-wire.cell>
            
            @endfor

            <x-weektab-wire.cell class="bg-white" dateCell="weekNote">
                <div class="grid grid-cols-2 items-top">
                    <div>
                        <x-head.h2>Статистика</x-head.h2>
                        @forelse ($statistics as $stat)
                            <div class="flex border-b hover:bg-gray-300 mr-2">
                                <span class="grow text-gray-500">{{ __('event_sum') }}:</span> 
                                <span class="px-3">{{ $stat->event_sum }}</span>
                            </div>
                            <div class="flex border-b hover:bg-gray-300 mr-2">
                                <span class="grow text-gray-500">{{ __('teams_count') }}:</span>
                                <span class="px-3">{{ $stat->teams_count }}</span>
                            </div>
                            <div class="flex border-b hover:bg-gray-300 mr-2">
                                <span class="grow text-gray-500">{{ __('users_sum') }}:</span>
                                <span class="px-3">{{ $stat->users_sum }}</span>
                            </div>
                            <div class="flex border-b hover:bg-gray-300 mr-2">
                                <span class="grow text-gray-500">{{ __('visits_procent_missing') }}:</span>
                                @php
                                    $percent = round(100-($stat->visits_missing/$stat->visits_plan*100),1);
                                    $percent_class = 'bg-green-600 text-white';
                                    if ($percent<80) $percent_class = 'bg-yellow-300';
                                    if ($percent<40) $percent_class = 'bg-red-600 text-white';
                                @endphp 
                                <x-tooltip.absolute-bottom class="px-2 {{ $percent_class }}">
                                    {{ $percent }}% 
                                    <x-slot name='tooltip'>
                                        Из {{ $stat->visits_plan }} запланированных посещений: посетили - {{ $stat->visits_plan-$stat->visits_missing }}; пропустили - {{ $stat->visits_missing }}. 
                                    </x-slot>   
                                </x-tooltip.absolute-bottom>
                            </div>
                        @empty
                            <div class="text-gray-500">На неделе нет занятий</div>
                        @endforelse
                    </div>
                    <div>
                        <x-head.h2>{{ __('Event Notes') }}</x-head.h2>
                        @foreach($notes as $note)
                        <div><x-item.week-note :item="$note" /></div>
                        @endforeach
                        {{ $notes->links() }}
                    </div>
                </div>
            </x-weektab-wire.cell>
        </x-weektab-wire.grid>

</x-weektab-wire>
</div>
    <x-modal-wire.dialog wire:model.defer="showCreate" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Add Time Events') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelCreate" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="store" class="flex-col space-y-2">
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Дата</x-input.label>
                        <x-input.label class="font-bold text-xl">{{ date('d.m.Y',$addDate) }}</x-input.label>
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
            </x-slot>
    </x-modal-wire.dialog>

    <x-modal-wire.dialog wire:model.defer="showAddNote" maxWidth="sm">
            <x-slot name="title"><span class="grow">{{ __('Add Week Note') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelAddNote" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="saveNote" class="flex-col space-y-2">
                    <div><x-input.textarea wire:model.blur="addNote" required /></div>
                    <x-button.create class="text-sm" type="submit">{{ __('Add') }}</x-button.create>
                    <x-button.secondary class="text-sm" wire:click="cancelAddNote()">{{ __('Cancel') }}</x-button.secondary>
                </form>
                <x-spinner wire:loading wire:target="saveNote" />
            </x-slot>
    </x-modal-wire.dialog>

    <x-modal-wire.dialog wire:model.defer="showDelNote" type="warn" maxWidth="md">
        <x-slot name="title"><span class="grow">{{ __('Delete Note') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelNote" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
        <x-slot name="content">
            <div class="flex-col space-y-2">
                <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                    <div class="text-black">{{ $delNote['note'] }}</div>
                </x-input.label>
                <x-button.secondary @click="show = false" wire:click="cancelDelNote">Отменить</x-button.secondary>
                <x-button.danger wire:click="deleteNote({{ $delNote['id'] }})">{{ __('Delete')}}</x-button.danger>
                <x-spinner wire:loading wire:target="deleteNote" />
            </div>                            
        </x-slot>
    </x-modal-wire.dialog>



</div>
