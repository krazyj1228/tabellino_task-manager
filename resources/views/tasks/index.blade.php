@extends('layouts.app', ['title' => 'My tasks'])

@section('content')
<main class="container">
    <div class="topline">
        <div><div class="eyebrow">Personal Task Manager</div><h1>Do things<br>that make you happy!</h1><p class="subtitle">A clear view of the things on your plate.</p></div>
        <a class="button" href="{{ route('tasks.create', [], false) }}">+ Add task</a>
    </div>
    <section class="stats" aria-label="Task summary">
        <div class="stat"><span class="stat-label">All tasks</span><strong class="stat-number">{{ $totalTasks }}</strong></div>
        <div class="stat"><span class="stat-label">In progress</span><strong class="stat-number">{{ $pendingTasks }}</strong></div>
        <div class="stat"><span class="stat-label">Completed</span><strong class="stat-number">{{ $completedTasks }}</strong></div>
    </section>
    <section class="panel">
        <div class="panel-head"><h2>Your task list</h2><span class="subtitle">{{ now()->format('F j, Y') }}</span></div>
        @if($tasks->isEmpty())
            <div class="empty"><strong>Your list is wide open.</strong>Add your first task and start building momentum.</div>
        @else
            <ul class="task-list">
            @foreach($tasks as $task)
                <li class="task {{ $task->status === 'completed' ? 'done' : '' }}">
                    <form method="POST" action="{{ route('tasks.status', [$task], false) }}">
                        @csrf @method('PATCH')
                        <input class="check" type="checkbox" onchange="this.form.submit()" {{ $task->status === 'completed' ? 'checked' : '' }} aria-label="Mark {{ $task->title }} {{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                        <input type="hidden" name="status" value="{{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                    </form>
                    <div><div class="task-title">{{ $task->title }}</div>@if($task->description)<p class="task-description">{{ $task->description }}</p>@endif<div class="task-meta"><span class="badge {{ $task->status === 'completed' ? 'done' : '' }}">{{ $task->status }}</span>@if($task->due_date)<span>Due {{ $task->due_date->format('M j, Y') }}</span>@endif</div></div>
                    <div class="actions"><a class="icon-link" href="{{ route('tasks.edit', [$task], false) }}">Edit</a><form method="POST" action="{{ route('tasks.destroy', [$task], false) }}" onsubmit="return confirm('Delete this task?')">@csrf @method('DELETE')<button class="icon-link" type="submit">Delete</button></form></div>
                </li>
            @endforeach
            </ul>
        @endif
    </section>
</main>
@endsection