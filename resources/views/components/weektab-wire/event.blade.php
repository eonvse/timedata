@props(['id','name','start','end','title'=>'Без темы', 'color'=>''])
<a  href="{{ route('info.time-event',['id'=>$id, 'edit'=>0])}}" class="border-b text-indigo-900 flex items-center flex-shrink-0 h-5 px-1 text-sm hover:bg-gray-500 hover:text-white {{ $color }}">
    <span class="px-1 font-extrabold tabular-nums">{{ $start }} - {{ $end }}</span>
    <span class="ml-2 font-medium">{{ $name }}.</span>
    <span class="ml-2">"{{ $title }}"</span>
</a>
