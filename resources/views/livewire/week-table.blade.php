<div>
@php
    $order = array(1,5,2,6,3,7,4);
    $weekDays = array( 1 => 'Пн' , 'Вт' , 'Ср' , 'Чт' , 'Пт' , 'Сб' , 'Вс' );

@endphp

<div class="text-gray-700 w-screen h-screen p-2">
<x-weektab-wire :week="$week" :year="$year" :start="$startWeek->format('d.m')" :end="$endWeek->format('d.m')">
        <x-slot name='buttons'>
            <x-weektab-wire.switch-week />
        </x-slot>
        <x-slot name="navigation">
            @include('layouts.navigation-wire')
        </x-slot>
        <x-weektab-wire.grid>
            @for ($i=0; $i<7; $i++)
            @php
                $bgCell='bg-white';
                $events_day = $events_week[$order[$i]];
                if ($events_day['date']==date('d.m.Y')) { $bgCell='bg-orange-100'; }
            @endphp
            <x-weektab-wire.cell class="{{ $bgCell }}">
                {{ $weekDays[date('N',strtotime($events_day['date']))] }} 
                {{ date('d.m',strtotime($events_day['date'])) }}
                @if (!empty(count($events_day['events'])))
                <x-slot name='events'>
                    @foreach ($events_day['events'] as $event)
                    <x-weektab-wire.event :id="$event['id']"
                                    :name="$event['name']"
                                    :start="date('H:i',strtotime($event['start']))"
                                    :end="date('H:i',strtotime($event['end']))" />
                    @endforeach
                </x-slot>
                @endif
            </x-weektab-wire.cell>
            
            @endfor

            <x-weektab-wire.cell class="bg-white">
                Сообщения, статистика
                <x-slot name='events'>
                 Блок заметок по неделе и статистика по приходу и посещениям    
                </x-slot>
            </x-weektab-wire.cell>
        </x-weektab-wire.grid>

</x-weektab-wire>
</div>

</div>
