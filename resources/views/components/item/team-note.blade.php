@props (['item'])
<div class="grid grid-cols-5 items-center border-b text-xs hover:bg-gray-200 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
	<div class="p-1 col-span-1 tabular-nums">{{ $item->created }}</div>
	<div class="p-1 col-span-4 flex justify-center">
		<div class="grow">{!! nl2br(e($item->note)) !!}</div>
		<div class="p-1 flex items-center">
    	    <x-button.icon-del wire:click="showDeleteNote({{ $item->id }})" title="Удалить"/>
    	    <x-spinner wire:loading wire:target="showDeleteNote" />	
		</div>
	</div>
</div>
