<div>
	<div class="grid grid-cols-2 items-center mb-2">
		<div><x-head.h2>{{ __('User Files') }}</x-head.h2></div>
		<div>
            <x-spinner wire:loading wire:target="addUserFile" />
            <x-spinner wire:loading wire:target="saveUserFile" />
            <x-spinner wire:loading wire:target="cancelAddFile" />
			<x-button.create class="w-full" wire:click="addUserFile">{{ __('Add User File') }}</x-button.create>
            <x-modal-wire.dropdown wire:model="showAddFile" maxWidth="sm">
            	<form wire:submit="saveUserFile" class="flex-col space-y-2">
                    <input type="checkbox" wire:model.live = "isLocalFile"><span class="mx-2">Локальный файл</span>{{ $isLocalFile }}
                    @if ($isLocalFile)
                    <div>
                        <input type="file" wire:model="addFileUser" class="text-sm">
                        @error('addFileUser') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div wire:loading wire:target="addFileUser">{{ __('Uploading...') }}</div>
                    @else
                    <div>
                        <x-input.label>Название</x-input.label>
                        <x-input.text wire:model.live="webName" required />
                        @error('webName') <div class="text-red-500">{{ $message }}</div> @enderror

                        <x-input.label>Url</x-input.label>
                        <x-input.text wire:model.live="webUrl" required />
                        @error('webUrl') <div class="text-red-500">{{ $message }}</div> @enderror
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
            <x-spinner wire:loading wire:target="deleteUserFile" />
            <x-spinner wire:loading wire:target="cancelDelFile" />
            <div class="flex-col space-y-2">
                <x-input.label class="text-lg font-medium">Вы действительно хотите удалить файл? 
                    <div class="text-black">{{ $delFileUser['name'] }}</div>
                </x-input.label>
                <x-button.secondary @click="show = false" wire:click="cancelDelFile">Отменить</x-button.secondary>
                <x-button.danger wire:click="deleteUserFile({{ $delFileUser['id'] }})">{{ __('Delete')}}</x-button.danger>
            </div>                            
        </x-slot>
    </x-modal-wire.dialog>

</div>