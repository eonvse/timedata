@props (['item'])
<div class="flex items-center border-b text-xs hover:bg-gray-200 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
	<a href="{{ $item->isLocal ? url('storage/'.$item->url) : $item->url }}" class="grow p-1" target="_blanc">{{ $item->name }}</a>
	<div class="p-1 flex items-center">
        <x-button.icon-del wire:click="showDeleteFile({{ $item->id }})" title="Удалить"/>
        <x-spinner wire:loading wire:target="showDeleteFile" />
	</div>
</div>