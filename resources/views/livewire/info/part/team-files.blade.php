<div>
	<div class="grid grid-cols-2 items-center">
		<div><x-head.h2>{{ __('Team Files') }}</x-head.h2></div>
		<div>
			<x-button.create class="w-full" wire:click="addTeamFile">{{ __('Add Team File') }}</x-button.create>
            <x-modal-wire.dropdown wire:model="showAddFile" maxWidth="sm">
            	<form wire:submit="saveTeamFile" class="flex-col space-y-2">
                    <input type="checkbox" wire:model.live = "isLocalFile"><span class="mx-2">Локальный файл</span>
                    @if ($isLocalFile)
                    <div>
                        <input type="file" wire:model="addFile" class="text-sm">
                        @error('addFile') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div wire:loading wire:target="addFile">{{ __('Uploading...') }}</div>
                    @else
                    <div>
                        <x-input.label>Название</x-input.label>
                        <x-input.text wire:model.blur="webName" required />
                        <x-input.label>Url</x-input.label>
                        <x-input.text wire:model.blur="webUrl" required />
                    </div>
                    @endif
            		<x-button.create class="text-sm" type="submit">{{ __('Add') }}</x-button.create>
                    <x-button.secondary class="text-sm" wire:click="cancelAddFile">{{ __('Cancel') }}</x-button.secondary>
            	</form>
            </x-modal-wire.dropdown>
		</div>
	</div>
	@foreach($files as $file)
		<div><x-item.team-file :item="$file" /></div>
	@endforeach
    <x-modal-wire.dialog wire:model.defer="showDelFile" type="warn" maxWidth="md">
        <x-slot name="title"><span class="grow">{{ __('Delete File') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelFile" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
        <x-slot name="content">
            <div class="flex-col space-y-2">
                <x-input.label class="text-lg font-medium">Вы действительно хотите удалить файл? 
                    <div class="text-black">{{ $delFile['name'] }}</div>
                </x-input.label>
                <x-button.secondary @click="show = false" wire:click="cancelDelFile">Отменить</x-button.secondary>
                <x-button.danger wire:click="deleteTeamFile({{ $delFile['id'] }})">{{ __('Delete')}}</x-button.danger>
            </div>                            
        </x-slot>
    </x-modal-wire.dialog>

</div>