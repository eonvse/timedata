    <!-- Component Start -->
    @props([
        'week'=>'-',
        'year'=>'-',
        'start'=>'-',
        'end'=>'-'
    ])

    <div class="flex flex-grow w-full h-full overflow-auto"> 
            
            <div class="flex flex-col flex-grow">
                <div class="flex items-center mt-4">
                    @isset($buttons)
                       {{$buttons}}
                    @endisset   
                    <h2 class="ml-2 text-xl font-bold leading-none">
                        {{ __('Week') }} {{ $week }}. {{ $start }} - {{ $end }} {{ $year }}
                    </h2>
                </div>

                {{ $slot }}

            </div>
        </div>
    <!-- Component End  -->
