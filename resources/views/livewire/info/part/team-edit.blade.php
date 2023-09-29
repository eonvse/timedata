        <div class="p-3 grid grid-cols-7 gap-2 items-center bg-neutral-200">
            <div>
                <a href="{{ url()->previous() }}" class="text-xs text-gray-500">Назад</a>
            </div>
            <div class="text-gray-500 text-sm col-span-2">{{ __('Team Name') }}</div>
            <div class="text-gray-500 text-sm col-span-2">{{ __('Team Info') }}</div>
            <div class="text-gray-500 text-sm">
                {{ __('Team Color') }}
                <span class="{{ $model->color->color }} border border-indigo-800">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="text-center text-gray-500 text-sm">...</div>
            <div>
                <x-head.page-wire>
                    {{ __('Team') }}
                </x-head.page-wire>
            </div>
            @if ($showEdit)

                <x-input.text wire:model.lazy="modelName" required class="col-span-2" />
                <x-input.text wire:model.lazy="modelInfo" required class="col-span-2" /> 
                <x-input.select-color :items="$colors->toArray()" class="inline-block" wire:model.lazy="modelColorId"/>
                <div class="flex justify-center space-x-2 items-center">
                    <x-button.icon-ok wire:click="save" title="Сохранить" />
                    <x-button.icon-cancel @click="show = false" wire:click="cancelEdit" title="Отменить" />
                </div>
            @else
            <div class="relative col-span-2 text-lg text-indigo-900 font-bold {{ $model->color->color }}">
                {{ $modelName }}
            </div>        
            <div class="relative col-span-2 text-lg text-indigo-900 font-bold">
                {{ $modelInfo }}
            </div>        
            <div class="relative text-lg text-indigo-900 font-bold">
                {{ $model->color->color }}
            </div>
            <div class="flex justify-center items-center text-indigo-900 font-bold">
                <x-button.icon-edit wire:click="showEditMode" title="Редактировать" />
            </div>
            @endif
        </div>