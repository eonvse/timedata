@props (['item'])
<div class="xl:grid xl:grid-cols-5 items-center border-b dark:border-gray-600 text-xs hover:bg-gray-200 dark:hover:bg-gray-700">
	<div class="border-r dark:border-gray-600 p-1 col-span-1">{{ $item->created2 }}</div>
	<div class="border-r dark:border-gray-600 p-1 col-span-4 flex justify-center">
		<div class="grow">{!! nl2br(e($item->note)) !!}</div>
		<div class="p-1 flex items-center">
    	    <x-button.icon-del wire:click="showDeleteNote({{ $item->id }})" title="Удалить"/>
    	    <x-spinner wire:loading wire:target="showDeleteNote" />
		</div>
	</div>
</div>