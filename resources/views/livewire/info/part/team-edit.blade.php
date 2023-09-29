        <div class="p-3 grid grid-cols-7 gap-2 items-center">
            <div class="row-span-2">
                <x-head.page-wire>
                    {{ __('Team')}}
                    <br /><a href="{{ url()->previous() }}" class="text-xs text-gray-500">Назад</a>
                </x-head.page-wire>
            </div>
            <div class="text-gray-500 text-sm col-span-2">{{ __('Team Name') }}</div>
            <div class="text-gray-500 text-sm col-span-2">{{ __('Team Info') }}</div>
            <div class="text-gray-500 text-sm">
                {{ __('Team Color') }}
                <span class="{{ $model->color->color }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="text-center text-gray-500 text-sm">...</div>
            @if ($showEdit)

                <x-input.text wire:model.lazy="modelName" required class="col-span-2" />
                <x-input.text wire:model.lazy="modelInfo" required class="col-span-2" /> 
                <x-input.select-color :items="$colors->toArray()" class="inline-block" wire:model.lazy="modelColorId"/>
                <div class="flex justify-center space-x-2 items-center">
                    <x-button.icon-ok wire:click="save" title="Сохранить" />
                    <x-button.icon-cancel @click="show = false" wire:click="cancelEdit" title="Отменить" />
                </div>
            @else
            <div class="relative col-span-2">
                {{ $modelName }}
            </div>        
            <div class="relative col-span-2">
                {{ $modelInfo }}
            </div>        
            <div class="relative">
                {{ $model->color->color }}
            </div>
            <div class="flex justify-center items-center">
                <x-button.icon-edit wire:click="showEditMode" title="Редактировать" />
            </div>
            @endif
        </div>