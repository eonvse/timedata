<div>
<x-head.page-nav>
    @include('layouts.navigation-wire')
</x-head.page-nav>
<div class="mx-auto max-w-6xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        <div class="grid grid-cols-3 items-center">
            <div class="font-bold bg-neutral-600 text-white w-full h-full text-xl text-center p-1">{{ __('Event') }}</div>
            <div class="{{ $model->team->color->color }} p-1">
                <a href="{{ route('info.team',['id'=>$model->team->id, 'edit'=>0]) }}" ><h3 class="text-lg font-bold">{{ __('Team') }}: {{ $model->team->name }}</h3></a>
            </div>
            <div class="text-black dark:text-gray-200 mx-2">{{ $model->team->info }}</div>
        </div>
        @include('livewire.info.part.event-edit')
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" wire:click="cancelEdit()">
            <div class="grid grid-cols-6 items-start">
                <div class="min-h-[100px] p-2 col-span-4">
                    @include('livewire.info.part.event-team')    
                </div>
                <div class="min-h-[100px] p-2 col-span-2 shadow-lg">
                    @include('livewire.info.part.event-upcoming')    
                </div>
                <div class="min-h-[100px] p-2 col-span-2">
                    @include('livewire.info.part.event-notes')    
                </div>
                <div class="min-h-[100px] p-2 col-span-2">
                    @include('livewire.info.part.event-files')    
                </div>
                <div class="min-h-[100px] p-2 col-span-2">
                    @include('livewire.info.part.event-previous')    
                </div>
            </div>            
        </div>
    </div>
</div>
</div>

