@props(['id','name','start','end'=>'','title'=>'Без темы', 'color'=>''])
<input type="hidden" name="event-id" value="{{ $id }}">
<a href="{{ route('info.time-event',['id'=>$id, 'edit'=>0])}}" class="text-indigo-900  grid grid-cols-6 items-center h-5 px-1 text-xs hover:bg-gray-500 hover:text-white {{ $color }}" title="{{ $start }} {{ !empty($end) ? '- '.$end : $end }}: {{ $title }}">
    <span class="p-1 font-bold bg-gray-500 text-white leading-none text-center">{{ $start }}</span>
    <span class="ml-2 font-medium leading-none truncate col-span-5">{{ $name }}</span>
</a>
<!-- <button class="flex items-center flex-shrink-0 h-5 px-1 text-xs hover:bg-gray-200">
    <span class="flex-shrink-0 w-2 h-2 bg-gray-500 rounded-full"></span>
    <span class="ml-2 font-light leading-none">2:15pm</span>
    <span class="ml-2 font-medium leading-none truncate">A confirmed event</span>

    href="{{ route('info.team',['id'=>$id]) }}"
</button> -->