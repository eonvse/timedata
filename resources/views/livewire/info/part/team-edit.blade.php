        <div class="p-3 grid grid-cols-4 items-center">
            <div class="row-span-2"><x-head.page-wire>{{ __('Team')}} + link back</x-head.page-wire></div>
            <div>{{ __('Team Name') }}</div>
            <div>{{ __('Team Info') }}</div>
            <div>
                {{ __('Team Color') }}
                <span class="{{ $model->color->color }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="relative">
                <x-input.text wire:model.lazy="modelName" :disabled="$disabledFields['name']" required wire:mouseenter="showEdit('name')"/> 
                <x-modal-wire.dropdown wire:model="showEditName" maxWidth="md">
                @if($disabledFields['name'])
                    <x-button.text-edit class="text-sm" wire:click="visibleEdit('name')">{{ __('Edit') }}</x-button.text-edit>
                    <x-button.text-cancel class="text-sm" wire:click="cancelEdit()">{{ __('Cancel') }}</x-button.text-cancel>
                @else
                    <x-button.text-edit class="text-sm" wire:click="save('name')">{{ __('Save') }}</x-button.text-edit>
                    <x-button.text-cancel class="text-sm" wire:click="cancelEdit()">{{ __('Cancel') }}</x-button.text-cancel>
                @endif
                </x-modal-wire.dropdown>
            </div>        
            <div class="relative">
                <x-input.text wire:model.lazy="modelInfo" :disabled="$disabledFields['info']" required wire:mouseenter="showEdit('info')"/> 
                <x-modal-wire.dropdown wire:model="showEditInfo" maxWidth="md">
                @if($disabledFields['info'])
                    <x-button.text-edit class="text-sm" wire:click="visibleEdit('info')">{{ __('Edit') }}</x-button.text-edit>
                    <x-button.text-cancel class="text-sm" wire:click="cancelEdit()">{{ __('Cancel') }}</x-button.text-cancel>
                @else
                    <x-button.text-edit class="text-sm" wire:click="save('info')">{{ __('Save') }}</x-button.text-edit>
                    <x-button.text-cancel class="text-sm" wire:click="cancelEdit()">{{ __('Cancel') }}</x-button.text-cancel>
                @endif
                </x-modal-wire.dropdown>
            </div>        
            <div class="relative">
                <x-input.select-color  class="inline-block" :items="$colors->toArray()" wire:model.lazy="modelColorId" :disabled="$disabledFields['color_id']" wire:mouseenter="showEdit('color_id')"/>
                <x-modal-wire.dropdown wire:model="showEditColor" maxWidth="md">
                @if($disabledFields['color_id'])
                    <x-button.text-edit class="text-sm" wire:click="visibleEdit('color_id')">{{ __('Edit') }}</x-button.text-edit>
                    <x-button.text-cancel class="text-sm" wire:click="cancelEdit()">{{ __('Cancel') }}</x-button.text-cancel>
                @else
                    <x-button.text-edit class="text-sm" wire:click="save('color_id')">{{ __('Save') }}</x-button.text-edit>
                    <x-button.text-cancel class="text-sm" wire:click="cancelEdit()">{{ __('Cancel') }}</x-button.text-cancel>
                @endif
                </x-modal-wire.dropdown>
            </div>                         
        </div>