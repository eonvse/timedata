@props (['item'])
<div class="grid grid-cols-6 items-center border-b text-xs hover:bg-gray-200">
	<div class="border-r p-1 col-span-2">{{ $item->created }}</div>
	<div class="border-r p-1 col-span-3">{!! nl2br(e($item->note)) !!}</div>
	<div class="p-1 flex items-center">
        <x-button.icon-del wire:click="showDeleteNote({{ $item->id }})" title="Удалить"/>
	</div>
</div>