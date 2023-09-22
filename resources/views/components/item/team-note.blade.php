@props (['item'])
<div class="grid grid-cols-3 items-center border-b text-xs hover:bg-gray-200">
	<div class="border-r p-1">{{ $item->created }}</div>
	<div class="border-r p-1">{!! nl2br(e($item->note)) !!}</div>
	<div class="p-1 flex items-center">
        <x-button.icon-del wire:click="deleteTeamNote({{ $item->id }})" title="Удалить"/>
	</div>
</div>