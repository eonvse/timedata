<div>
    <x-head.h2>{{ __('Previous events') }}</x-head.h2>
	@foreach($previousEvents as $event)
    <div class="items-center border-b text-sm hover:bg-gray-200 my-2">
            <a href="{{ route('info.time-event',['id'=>$event->id, 'edit'=>0])}}" class="after:content-['_↗']">
                <span class="tabular-nums">{{ $event->dayFormat }}</span> 
                <span class="mx-1 tabular-nums">{{ $event->startFormat }} - {{ $event->endFormat }}</span>
                <span class="">{{ $event->title ?? '' }}</span>
            </a>    
    </div>	
    @endforeach
</div>