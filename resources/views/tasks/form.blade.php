@if($errors->any()) <ul class="errors">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul> @endif
<form class="form-grid" method="POST" action="{{ $formAction }}">
    @csrf @if($formMethod !== 'POST') @method($formMethod) @endif
    <label>Task title <input name="title" value="{{ old('title', $task->title ?? '') }}" maxlength="120" required autofocus placeholder="e.g. Prepare monthly review"></label>
    <label>Notes <textarea name="description" maxlength="1000" placeholder="Add a little context (optional)">{{ old('description', $task->description ?? '') }}</textarea></label>
    <label>Due date <input type="date" name="due_date" value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"></label>
    @if(isset($task)) <label>Status <select name="status"><option value="pending" @selected(old('status', $task->status) === 'pending')>Pending</option><option value="completed" @selected(old('status', $task->status) === 'completed')>Completed</option></select></label> @else <input type="hidden" name="status" value="pending"> @endif
    <div class="form-actions"><a class="button secondary" href="{{ route('tasks.index', [], false) }}">Cancel</a><button class="button" type="submit">{{ $submitLabel }}</button></div>
</form>