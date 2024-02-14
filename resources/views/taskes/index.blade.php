@section('content')
    <h1>Your Tasks</h1>

    @if($tasks->count() > 0)
        <ul>
            @foreach($tasks as $task)
                <li>{{ $task->title }} - {{ $task->description }}</li>
            @endforeach
        </ul>
    @else
        <p>No tasks assigned.</p>
    @endif
@endsection
