        <div class="p-3 grid grid-cols-4 items-center">
            <div class="row-span-2"><x-head.page-wire>{{ __('Team')}} + link back</x-head.page-wire></div>
            <div>{{ __('Team Name') }}</div>
            <div>{{ __('Team Info') }}</div>
            <div>
                {{ __('Team Color') }}
                <span class="{{ $model->color->color }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            @if ($showEdit)
                <x-input.text wire:model.lazy="modelName" required />
                <x-input.text wire:model.lazy="modelInfo" required /> 
                <x-input.select-color :items="$colors->toArray()" class="inline-block" wire:model.lazy="modelColorId"/>
            @else
            <div class="relative">
                {{ $modelName }}
            </div>        
            <div class="relative">
                {{ $modelInfo }}
            </div>        
            <div class="relative">
                {{ $model->color->color }}
            </div>
            @endif
        </div>