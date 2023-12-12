@props (['item','model'])
<div class="flex flex-row border-b dark:border-gray-600 p-1">
	<x-spinner wire:loading wire:target="delVisit" />
	<x-spinner wire:loading wire:target="addVisit" />
	<div class="mx-1 px-1">
		@if ($item->timeEvent_id == $model->id)
		<div class="grid grid-cols-2 items-center">
			<div class="flex items-center">
				<x-button.icon-minus wire:click="delVisit({{ $item->id }})" />
			</div>
			<div class="bg-neutral-300 dark:bg-neutral-600 text-center font-bold text-green-700 dark:text-green-500">Б</div>
		</div>
		@else
		<div class="grid grid-cols-2 items-center">
			<div class="flex items-center">
				<x-button.icon-plus wire:click="addVisit({{ $item->id }})" />
			</div>
			<div class="bg-neutral-300 dark:bg-neutral-600 text-center font-bold text-red-700 dark:text-red-500">Н</div>
		</div>
		@endif
	</div>
	<a href="{{ route('info.user',['id'=>$item->id, 'edit'=>0])}}">
		<div class="hover:bg-neutral-200 dark:hover:bg-neutral-700 dark:text-gray-300 after:content-['_↗']">{{ $item->surname }} {{ $item->name }}</div> 
	</a>
</div>