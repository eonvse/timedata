@props (['item'])
<div class="flex items-center text-sm border-b dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600">
	<a href="{{ route('info.user',['id'=>$item->id, 'edit'=>0])}}" class="">
		<div class="p-1 after:content-['_↗'] dark:text-gray-300">{{ $item->FIO }}</div>
	</a>
	<div class="grow p-1 border-r dark:border-gray-600 dark:text-gray-300 text-right">info</div>
	<x-button.icon-del wire:click="deleteTeamUser({{ $item->id }})" title="Удалить из группы"/>
	<x-spinner wire:loading wire:target="deleteTeamUser" />
</div>