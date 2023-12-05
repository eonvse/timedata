<div>
<x-head.page-nav>
    @include('layouts.navigation-wire')
</x-head.page-nav>
<div class="mx-auto max-w-6xl min-h-[50%] sm:px-6 lg:px-8 py-4 flex space-x-4">

    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grow">
        @include('livewire.info.part.team-edit')
        <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="sm:grid sm:grid-cols-2 items-start">
                <div class="min-h-[100px] shadow-md p-2">
                    @include('livewire.info.part.team-users')    
                </div>
                <div class="min-h-[100px] p-2 sm:pl-5">
                    @include('livewire.info.part.team-upcoming-events')    
                </div>
            </div>            
            <div class="sm:grid sm:grid-cols-2 items-start mt-10">
                <div class="min-h-[100px]">
                    @include('livewire.info.part.team-notes')    
                </div>
                <div class="min-h-[100px] sm:pl-5">
                    @include('livewire.info.part.team-files')    
                </div>
            </div>            
            <div class="relative overflow-x-auto shadow-md sm:rounded">
            </div>
        </div>
    </div>

</div>
</div>
