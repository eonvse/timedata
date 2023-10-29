<div class="mx-auto max-w-6xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        @include('layouts.navigation-wire')
        @include('livewire.info.part.user-edit')
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" wire:click="cancelEdit()">
            <div class="grid grid-cols-3 items-start">
                <div class="min-h-[100px] shadow-md p-2">
                    include('livewire.info.part.user-files')    
                </div>
                <div class="min-h-[100px] p-2 pl-5">
                    include('livewire.info.part.user-notes') 
                </div>
                <div class="min-h-[100px] p-2 pl-5">
                    Фин. учет  
                </div>
            </div>            
            <div class="grid grid-cols-2 items-start mt-10">
                <div class="min-h-[100px]">
                    include('livewire.info.part.user-teams')     
                </div>
                <div class="min-h-[100px] pl-5">
                    include('livewire.info.part.user-upcoming-events')    
                </div>
            </div>            
            <div class="relative overflow-x-auto shadow-md sm:rounded text-right">
                ????
            </div>
        </div>
    </div>

</div>