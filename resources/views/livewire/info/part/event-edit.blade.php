        <div class="p-3 grid grid-cols-6 gap-2 items-center bg-neutral-200">
            <div class="text-gray-500 text-sm">{{ __('Event Day') }}</div>
            <div class="text-gray-500 text-sm">{{ __('Event Start') }}</div>
            <div class="text-gray-500 text-sm">{{ __('Event End') }}</div>
            <div class="text-gray-500 text-sm col-span-2">{{ __('Event Title') }}</div>
            <div class="text-center text-gray-500 text-sm">...</div>

            @if ($showEdit)
              <x-input.text type="date" wire:model.lazy="modelDay" required />
              <x-input.text type="time" wire:model.lazy="modelStart" required /> 
              <x-input.text type="time" wire:model.lazy="modelEnd" required /> 
              <x-input.text wire:model.lazy="modelTitle" class="col-span-2" />
              <div class="flex justify-center space-x-2 items-center">
                  <x-button.icon-ok wire:click="save" title="Сохранить" />
                  <x-button.icon-cancel @click="show = false" wire:click="cancelEdit" title="Отменить" />
              </div>
            @else
            <div class="text-black text-2xl text-neutral-900 font-bold">{{ $model->dayFormat }}</div>
            <div class="text-black text-2xl text-neutral-900 font-bold">{{ $model->startFormat }}</div>
            <div class="text-black text-2xl text-neutral-900 font-bold">{{ $model->endFormat }}</div>
            <div class="text-black text-lg text-neutral-900 font-bold col-span-2">{{ $modelTitle }}</div>
            <div class="flex justify-center items-center">
                <x-button.icon-edit wire:click="showEditMode" title="Редактировать" />
            </div>
            @endif
        </div>