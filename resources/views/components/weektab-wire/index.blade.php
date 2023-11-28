    <!-- Component Start -->
    @props([
        'week'=>'-',
        'year'=>'-',
        'start'=>'-',
        'end'=>'-'
    ])

    <div class="flex flex-grow w-full h-full overflow-auto"> 
            
            <div class="flex flex-col flex-grow">
                <div class="flex space-x-2 items-center">
                    @isset($buttons)
                       {{$buttons}}
                    @endisset
                    <h2 class="flex-none col-span-4 ml-2 text-xl font-bold leading-none tabular-nums">
                        {{ __('Week') }} {{ $week }}. {{ $start }} - {{ $end }} {{ $year }}
                    </h2>
                    @isset($filter)
                    <div class="flex-none px-5">
                        {{ $filter }}
                    </div>
                    @endisset      
                    @isset($navigation)
                        {{ $navigation }}
                    @endisset      
                </div>

                {{ $slot }}

            </div>
        </div>
    <!-- Component End  -->
