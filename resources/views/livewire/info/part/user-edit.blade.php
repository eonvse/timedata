        <div class="p-3 grid grid-cols-6 gap-2 items-center bg-neutral-200 dark:bg-neutral-700">
        <x-spinner wire:loading wire:target="save" />
        <x-spinner wire:loading wire:target="cancelEdit" />
        <x-spinner wire:loading wire:target="showEditMode" />
            <div>
                <a href="{{ url()->previous() }}" class="text-xs text-gray-500">Назад</a>
            </div>
            <div class="text-gray-500 dark:text-gray-300 text-sm  px-2">{{ $showEdit ? __('Surname') : 'ФИО' }}</div>
            <div class="text-gray-500 dark:text-gray-300 text-sm  px-2">{{ $showEdit ? __('Name') : '' }}@error('modelName') <span class="text-red-600">{{ $message }}</span>@enderror</div>
            <div class="text-gray-500 dark:text-gray-300 text-sm ">{{ $showEdit ? __('Patronymic') : '' }}</div>
            <div class="text-gray-500 dark:text-gray-300 text-sm">{{ __('Birthday') }}</div>
            <div class="text-center text-gray-500 text-sm">...</div>
            
            <div >
                <x-head.h1>
                    {{ __('User') }}
                </x-head.h1>
            </div>
            
            @if ($showEdit)

                <x-input.text wire:model="modelSurname" class="" /> 
                <x-input.text wire:model.live="modelName" class="" />
                <x-input.text wire:model="modelPatronymic" class="" /> 
                <x-input.text type="date" wire:model="modelBirthday" class="" /> 
                <div class="flex justify-center space-x-2 items-center">
                    <x-button.icon-ok wire:click="save" title="Сохранить" />
                    <x-button.icon-cancel @click="show = false" wire:click="cancelEdit" title="Отменить" />
                </div>
            
            @else
            
            <div class="relative text-indigo-900 dark:text-indigo-200 font-bold px-2 col-span-3 text-xl">
                {{ $model->surname ?? '' }} {{ $model->name }} {{ $model->patronymic ?? '' }}
            </div>   
            <div class="relative  text-indigo-900 dark:text-indigo-200 font-bold text-lg">
                {{ $model->birthdayFormat }}
            </div>        
            <div class="flex justify-center items-center text-indigo-900 font-bold">
                <x-button.icon-edit wire:click="showEditMode" title="Редактировать" />
            </div>

            @endif
        </div>