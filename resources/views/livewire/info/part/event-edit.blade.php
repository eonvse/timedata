<div>
    <div class="p-3 grid grid-cols-4 gap-2 items-center bg-neutral-600 text-white relative">
        <div class="absolute top-0 right-0">
            <x-tooltip.top>
                <x-button.icon-month href="{{ route('month-table') }}" />
                <x-slot:tooltip>Месяц</x-slot>
            </x-tooltip.top>
            <x-tooltip.bottom>
                <x-button.icon-week href="{{ route('week-table') }}" />
                <x-slot:tooltip>Неделя</x-slot>
            </x-tooltip.bottom>
        </div>
        <div class="text-gray-300 text-sm col-span-3">{{ __('Event Title') }}</div>
        <div class="text-center text-gray-300 text-sm row-span-2">...</div>
        <div class="text-gray-300 text-sm text-center">{{ __('Event Day') }}</div>
        <div class="text-gray-300 text-sm text-center">{{ __('Event Start') }}</div>
        <div class="text-gray-300 text-sm text-center">{{ __('Event End') }}</div>
        @if ($showEdit)
            <x-input.text wire:model.blur="modelTitle" class="col-span-3 text-black" />
            <div class="flex justify-center space-x-2 items-center row-span-2">
                <x-button.icon-ok wire:click="save" title="Сохранить" />
                <x-button.icon-cancel @click="show = false" wire:click="cancelEdit" title="Отменить" />
            </div>
            <x-input.text type="date" class="text-black" wire:model.blur="modelDay" required />
            <x-input.text type="time" class="text-black" wire:model.blur="modelStart" required /> 
            <x-input.text type="time" class="text-black" wire:model.blur="modelEnd" required /> 
        @else
            <div class="text-black text-lg text-indigo-900 bg-white p-1 font-bold col-span-3">{{ $modelTitle }}</div>
            <div class="flex justify-center items-center row-span-2">
                <x-button.icon-edit wire:click="showEditMode" title="Редактировать событие" />
                <x-button.icon-del wire:click="showDeleteEvent({{ $model->id }})" title="Удалить событие" />
            </div>
            <div class="text-black text-2xl text-white font-bold tabular-nums text-center">{{ $model->dayFormat }}</div>
            <div class="text-black text-2xl text-white font-bold tabular-nums text-center">{{ $model->startFormat }}</div>
            <div class="text-black text-2xl text-white font-bold tabular-nums text-center">{{ $model->endFormat }}</div>

        @endif
    </div>
    <x-modal-wire.dialog wire:model.defer="showDelEvent" type="warn" maxWidth="md">
        <x-slot name="title">
            <span class="grow">{{ __('Delete Event') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelEvent" class="text-gray-700 hover:text-white dark:hover:text-white" />
        </x-slot>
        <x-slot name="content">
            <div class="flex-col space-y-2">
                <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                    <div class="text-black">
                        {{ date('d.m.Y',strtotime($delEvent['day'])) }}
                        {{ date('H:i',strtotime($delEvent['start'])) }}-{{ date('H:i',strtotime($delEvent['end'])) }}
                        {{ $delEvent['title'] ?? '' }}
                    </div>
                    <div class="text-red-600 shadow p-1">{{ __('Delete Event Message') }}</div>
                </x-input.label>
                <x-button.secondary @click="show = false" wire:click="cancelDelEvent">{{ __('Cancel') }}</x-button.secondary>
                <x-button.danger wire:click="destroy({{ $delEvent['id'] }})">{{ __('Delete')}}</x-button.danger>
            </div>                            
        </x-slot>
    </x-modal-wire.dialog>
</div>