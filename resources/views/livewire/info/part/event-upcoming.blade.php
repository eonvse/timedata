<div>
    <x-head.h2>{{ __('Next events') }}</x-head.h2>
	@foreach($upcomingEvents as $event)
    <div class="items-center border-b dark:border-gray-600 text-sm text-orange-800 dark:text-orange-500 hover:bg-gray-500 hover:text-white dark:hover:bg-gray-300 dark:hover:text-black my-2">
            <a href="{{ route('info.time-event',['id'=>$event->id, 'edit'=>0])}}" class="after:content-['_↗']">
                <span class="tabular-nums">{{ $event->dayFormat }}</span>
                <span class="mx-1 tabular-nums">{{ $event->startFormat }} - {{ $event->endFormat }}</span>
                <span class="">{{ $event->title ?? '' }}</span>
            </a>    
    </div>	
    @endforeach
</div>