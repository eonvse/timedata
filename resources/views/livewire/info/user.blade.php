<div class="mx-auto max-w-6xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        @include('layouts.navigation-wire')
        @include('livewire.info.part.user-edit')
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" wire:click="cancelEdit()">
            <div class="grid grid-cols-3 items-start shadow-md">
                <div class="min-h-[100px] p-2">
                    @include('livewire.info.part.user-files')    
                </div>
                <div class="min-h-[100px] p-2 pl-5">
                    @include('livewire.info.part.user-notes') 
                </div>
                <div class="min-h-[100px] p-2 pl-5">
                    Фин. учет  
                </div>
            </div>            
            <div class="grid grid-cols-2 items-start mt-10">
                <div class="min-h-[100px]">
                    <div><x-head.h2>{{ __('Teams') }}</x-head.h2></div>
                    @forelse($teams as $team)
                    <a href="{{ route('info.team',['id'=>$team->tid, 'edit'=>0])}}">
                        <div class="hover:bg-neutral-200 border-b p-1 after:content-['_↗']">
                            <span class="{{ $team->color ?? '' }} p-1">{{ $team->tname }}</span>
                            <span class="text-sm text-gray-500 italic">{{ $team->tinfo }}</span>
                        </div>
                    </a>
                    @empty
                        Никуда не записан
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
                        Нет предстоящих занятий
                    @endforelse
                </div>
            </div>            
            <div class="relative overflow-x-auto shadow-md sm:rounded text-right">
                ????
            </div>
        </div>
    </div>

</div>