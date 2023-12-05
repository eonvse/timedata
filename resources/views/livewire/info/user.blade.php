<div>
<x-head.page-nav>
    @include('layouts.navigation-wire')
</x-head.page-nav>
<div class="mx-auto max-w-6xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        @include('livewire.info.part.user-edit')
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="grid grid-cols-3 items-start shadow-md">
                <div class="min-h-[100px] p-2">
                    @include('livewire.info.part.user-files')    
                </div>
                <div class="min-h-[100px] p-2 pl-5">
                    @include('livewire.info.part.user-notes') 
                </div>
                <div class="min-h-[100px] p-2 pl-5 dark:text-gray-400">
                    Фин. учет  
                </div>
            </div>            
            <div class="grid grid-cols-2 items-start mt-10">
                <div class="min-h-[100px]">
                    <div class="grid grid-cols-2 p-2">
                    <div><x-head.h2>{{ __('Teams') }}</x-head.h2></div>
                    <div>
                        <x-spinner wire:loading wire:target="openAddTeams" />
                        <x-spinner wire:loading wire:target="cancelAddTeams" />
                        <x-button.create class="w-full" wire:click="openAddTeams">{{ __('User add teams') }}</x-button.create>
                        <x-modal-wire.dropdown wire:model="showAddTeams" maxWidth="sm">
                            <form wire:submit.prevent="saveUserTeam" class="flex-col space-y-2">
                                <div><x-input.select  class="inline-block my-2" :items="$teamsForAdd" noneTxt="Выберите группу" wire:model="addTeams" required /></div>
                                <x-button.create class="text-sm" type="submit">{{ __('Add') }}</x-button.create>
                                <x-button.secondary class="text-sm" wire:click="cancelAddTeams()">{{ __('Cancel') }}</x-button.secondary>
                            </form>
                        </x-modal-wire.dropdown>
                    </div>
                    </div>
                    @forelse($teams as $team)
                    <a href="{{ route('info.team',['id'=>$team->tid, 'edit'=>0])}}">
                        <div class="hover:bg-neutral-200 border-b p-1  dark:hover:bg-gray-600 text-gray-500 dark:text-gray-400 after:content-['_↗']">
                            <span class="{{ $team->color ?? '' }} dark:{{ $team->dark ?? '' }} p-1 text-black">{{ $team->tname }}</span>
                            <span class="text-sm italic ">{{ $team->tinfo }}</span>
                        </div>
                    </a>
                    @empty
                        <div class="dark:text-gray-400">Никуда не записан</div>
                    @endforelse

                </div>
                <div class="min-h-[100px] pl-5">
                    <div><x-head.h2>{{ __('Team Upcoming Events') }}</x-head.h2></div>
                    @forelse($upcomingEvents as $item)
                    <a href="{{ route('info.time-event',['id'=>$item->id, 'edit'=>0])}}">
                        <div class="hover:bg-neutral-200 text-xs border-b p-1 after:content-['_↗']">
                            <span class="tabular-nums">{{ $item->day }} {{ $item->start }}-{{ $item->end }} </span>
                            <span class="{{ $item->color }} p-1">{{ $item->tname }}</span>
                            {{ $item->title ?? '' }} 
                        </div>
                    </a>
                    @empty
                        <div class="dark:text-gray-400">Нет предстоящих занятий</div>
                    @endforelse
                </div>
            </div>            
        </div>
    </div>

</div>
</div>