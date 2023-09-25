<div>
	<div class="grid grid-cols-2 items-center">
		<div><x-head.h2>Участники</x-head.h2></div>
		<div>
			<x-button.create class="w-full" wire:click="addUserTeam()">{{ __('Add User Team') }}</x-button.create>
            <x-modal-wire.dropdown wire:model="showAddUser" maxWidth="sm">
            	<form wire:submit.prevent="saveUserTeam" class="flex-col space-y-2">
            		<div><x-input.select-user  class="inline-block my-2" :items="$users->toArray()" wire:model="addUserId" required /></div>
	                <x-button.create class="text-sm" type="submit">{{ __('Add') }}</x-button.create>
                    <x-button.secondary class="text-sm" wire:click="cancelAddUser()">{{ __('Cancel') }}</x-button.secondary>

            	</form>
            </x-modal-wire.dropdown>
		</div>
	</div>
	@foreach($usersTeam as $user)
		<div><x-item.team-user :item="$user" /></div>
	@endforeach
</div>