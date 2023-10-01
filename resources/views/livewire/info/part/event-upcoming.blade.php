<div>
    <x-head.h2>{{ __('Next events') }}</x-head.h2>
	@foreach($upcomingEvents as $event)
    <div class="items-center border-b text-sm hover:bg-gray-200 my-2">
            <a href="{{ route('info.time-event',['id'=>$event->id, 'edit'=>0])}}" class="">
                <div class="">
                    {{ $event->dayFormat }} 
                    <span class="text-xs mx-1">{{ $event->startFormat }} - {{ $event->endFormat }}</span>
                </div>
                <div class="text-xs">{{ $event->title ?? '' }}</div>
            </a>    
    </div>	
    @endforeach
</div>