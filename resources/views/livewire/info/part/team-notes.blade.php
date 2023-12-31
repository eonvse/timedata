<div>
	<div class="sm:grid sm:grid-cols-2 items-center mb-2">
		<div><x-head.h2>{{ __('Team Notes') }}</x-head.h2></div>
		<div>
            <x-spinner wire:loading wire:target="addTeamNote" />
            <x-spinner wire:loading wire:target="saveTeamNote" />
            <x-spinner wire:loading wire:target="cancelAddNote" />
			<x-button.create class="w-full" wire:click="addTeamNote()">{{ __('Add Team Note') }}</x-button.create>
            <x-modal-wire.dropdown wire:model="showAddNote" maxWidth="sm">
            	<form wire:submit.prevent="saveTeamNote" class="flex-col space-y-2">
                    <div><x-input.textarea wire:model.blur="addNote" required /></div>
            		<x-button.create class="text-sm" type="submit">{{ __('Add') }}</x-button.create>
                    <x-button.secondary class="text-sm" wire:click="cancelAddNote()">{{ __('Cancel') }}</x-button.secondary>
            	</form>
            </x-modal-wire.dropdown>
		</div>
	</div>
	@foreach($notes as $note)
        <div><x-item.team-note :item="$note" /></div>
	@endforeach
    {{ $notes->links() }}
    <x-modal-wire.dialog wire:model.defer="showDelNote" type="warn" maxWidth="md">
        <x-slot name="title"><span class="grow">{{ __('Delete Note') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelNote" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
        <x-slot name="content">
            <div class="flex-col space-y-2">
                <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                    <div class="text-black dark:text-gray-200">{!! nl2br(e($delNote['note'])) !!}</div>
                </x-input.label>
                <x-button.secondary @click="show = false" wire:click="cancelDelNote">Отменить</x-button.secondary>
                <x-button.danger wire:click="deleteTeamNote({{ $delNote['id'] }})">{{ __('Delete')}}</x-button.danger>
                <x-spinner wire:loading wire:target="deleteTeamNote" />
                <x-spinner wire:loading wire:target="cancelDelNote" />
            </div>                            
        </x-slot>
    </x-modal-wire.dialog>

</div>