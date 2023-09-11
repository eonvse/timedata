<div>
@php    
    $months = array( 1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' );

    $monthTxt = $months[$month];

    $rows = count($events_month)/7;   
@endphp

<div class="text-gray-700">
    <x-monthtab-wire :month="$monthTxt" :year="$year" >
        <x-slot name='buttons'>
            <x-monthtab-wire.switch-month />
        </x-slot>
        <x-slot name="navigation">
            @include('layouts.navigation-wire')
        </x-slot>

        <x-monthtab-wire.grid :rows="$rows">
            @foreach ($events_month as $events_day)
            
            @php
                $mDay = date('n',strtotime($events_day['date']));
                $Day = date('j',strtotime($events_day['date']));
                $monthTxt = '';
                if ($loop->iteration == 1 && $mDay != $month ) { $monthTxt = $months[$mDay]; }
                if ($Day == 1 ) { $monthTxt = $months[$mDay]; }
                if ($mDay!=$month) { $bgCell = 'bg-gray-300'; }
                elseif ($events_day['date']==date('d.m.Y')) { $bgCell='bg-orange-200'; }
                else { $bgCell='bg-white'; }
            @endphp
            
            <x-monthtab-wire.cell class="{{ $bgCell }}" :dateCell="$events_day['date']">
                {{ $Day }} {{ $monthTxt }}
                @if (!empty(count($events_day['events'])))
                <x-slot name='events'>
                    @foreach ($events_day['events'] as $event)
                    <x-monthtab-wire.event :id="$event['id']"
                                    :name="$event['time_id']"
                                    :start="date('H:i',strtotime($event['start']))"
                                    :end="date('H:i',strtotime($event['end']))" />
                    @endforeach
                </x-slot>
                @endif
            </x-monthtab-wire.cell>
            
            @endforeach
        </x-monthtab-wire.grid>
    </x-monthtab-wire>
</div>

    <x-modal-wire.dialog wire:model="showCreate" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Add event') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelCreate" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <div class="text-lg text-center mx-auto font-bold">{{date('d.m.Y',$addDate)}}</div>
                <form wire:submit.prevent="store" class="flex-col space-y-2">
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Название</x-input.label>
                        <x-input.text wire:model="newName" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>{{ __('Start') }}</x-input.label>
                        <div class="flex"> 
                            <x-input.text type='time' wire:model.blur="newStartTime" required />
                        </div>
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>{{ __('End') }}</x-input.label>
                        <div class="flex"> 
                            <x-input.text type='time' wire:model="newEndTime" required />
                        </div>
                    </div>
                    <x-button.create type="submit">{{ __('Add event') }}</x-button.create>
                    <x-button.secondary @click="show = false" wire:click="cancelCreate">{{ __('Cancel') }}</x-button.secondary>
                </form>
            </x-slot>
    </x-modal-wire.dialog>

</div>
