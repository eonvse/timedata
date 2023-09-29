@props (['item'])
@php
    $weekDays = array( 1 => 'Пн' , 'Вт' , 'Ср' , 'Чт' , 'Пт' , 'Сб' , 'Вс' );
@endphp

<div class="grid grid-cols-3 items-center border-b text-sm hover:bg-gray-200">
	<div class="border-r">
		{{ $item->dayFormat }}. {{ $weekDays[date('N',strtotime($item->day))] }} 
	<span class="text-xs mx-1">{{ $item->title ?? '' }}</span>
	</div>
	<div class="border-r">{{ $item->startFormat }} - {{ $item->endFormat }}</div>
	<div class="flex items-center">
        <x-button.icon-del wire:click="showDeleteEvent({{ $item->id }})" title="Удалить"/>

	</div>
</div>