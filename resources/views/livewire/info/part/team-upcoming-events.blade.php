<div>
	<div class="grid grid-cols-2 items-center">
		<div><x-head.h2>{{ __('Team Upcoming Events') }}</x-head.h2></div>
		<div>
			<x-button.create class="w-full" wire:click="addTeamEvent()">{{ __('Add Team Event') }}</x-button.create>
            <x-modal-wire.dropdown wire:model="showAddEvent" maxWidth="sm">
            	<form wire:submit.prevent="saveTeamEvent" class="flex-col space-y-2">
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Дата</x-input.label>
                        <x-input.text type="date" wire:model.blur="addEventDay" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Начало</x-input.label>
                        <x-input.text type="time" wire:model.blur="addEventStart" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>Завершение</x-input.label>
                        <x-input.text type="time" wire:model.blur="addEventEnd" required />
                    </div>
                    <div class="sm:grid sm:grid-cols-[100px_minmax(0,_1fr)] items-center">
                        <x-input.label>{{ __('Time Event Title') }}</x-input.label>
                        <x-input.text wire:model.blur="addEventTitle" />
                    </div>
            		<x-button.create class="text-sm" type="submit">{{ __('Add') }}</x-button.create>
                    <x-button.secondary class="text-sm" wire:click="cancelAddEvent()">{{ __('Cancel') }}</x-button.secondary>
            	</form>
            </x-modal-wire.dropdown>
		</div>
	</div>
	@foreach($upcomingEvents as $event)
		<div><x-item.team-event :item="$event" /></div>
	@endforeach
    <x-modal-wire.dialog wire:model.defer="showDelEvent" type="warn" maxWidth="md">
            <x-slot name="title"><span class="grow">{{ __('Delete Event') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelEvent" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
            <x-slot name="content">
                <div class="flex-col space-y-2">
                    <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                    <div class="text-black">{{ $model->name }}: 
                        {{ date('d.m.Y',strtotime($delEvent['day'])) }}
                        {{ date('H:i',strtotime($delEvent['start'])) }}-{{ date('H:i',strtotime($delEvent['end'])) }}
                        {{ $delEvent['title'] ?? '' }}
                    </div>
                    <div class="text-red-600 shadow p-1">{{ __('Delete Event Message') }}</div>
                    </x-input.label>
                    <x-button.secondary @click="show = false" wire:click="cancelDelEvent">Отменить</x-button.secondary>
                    <x-button.danger wire:click="deleteTeamEvent({{ $delEvent['id'] }})">{{ __('Delete')}}</x-button.danger>
                </div>                            
            </x-slot>
    </x-modal-wire.dialog>

</div>