<div class="mx-auto max-w-5xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        @include('layouts.navigation-wire')
        @include('livewire.info.part.event-edit')
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" wire:click="cancelEdit()">
            <div class="grid grid-cols-2 items-start">
                <div class="min-h-[100px] shadow-md p-2 col-span-2">
                    @include('livewire.info.part.event-team')    
                </div>
                <div class="min-h-[100px] p-2 pl-5">
                    @include('livewire.info.part.event-notes')    
                </div>
                <div class="min-h-[100px] pl-5">
                    @include('livewire.info.part.event-files')    
                </div>
            </div>            
        </div>
    </div>

</div>

