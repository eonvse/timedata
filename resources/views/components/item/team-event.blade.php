@props (['item'])
@php
    $weekDays = array( 1 => 'Пн' , 'Вт' , 'Ср' , 'Чт' , 'Пт' , 'Сб' , 'Вс' );
@endphp

<div class="flex text-sm hover:bg-gray-600 hover:text-white border-b dark:border-gray-600 space-y-1 items-center dark:text-gray-300 dark:hover:bg-gray-300 dark:hover:text-black">
		<a href="{{ route('info.time-event',['id'=>$item->id, 'edit'=>0])}}" 
			class="w-full flex space-x-2 px-1 items-center grow after:content-['_↗'] ">
			<span class="tabular-nums flex-none">{{ $item->dayFormat }}</span>
			<span class="tabular-nums flex-none">{{ $item->startFormat }} - {{ $item->endFormat }}</span>
			<span class="grow">{{ $item->title ?? '' }}</span>
		</a>
		<div class="">
	        <x-button.icon-del wire:click="showDeleteEvent({{ $item->id }})" title="Удалить"/>
            <x-spinner wire:loading wire:target="showDeleteEvent" />
		</div>
</div>