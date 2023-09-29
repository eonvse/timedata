@props (['item'])
<div class="grid grid-cols-3 items-center border-b text-xs hover:bg-gray-200">
	<div class="border-r p-1"><a href="{{ url('storage/'.$item->url) }}">{{ $item->name }}</a></div>
	<div class="border-r p-1">{{ $item->location }}</div>
	<div class="p-1 flex items-center">
        <x-button.icon-del wire:click="showDeleteFile({{ $item->id }})" title="Удалить"/>
	</div>
</div>