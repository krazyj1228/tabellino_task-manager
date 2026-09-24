@extends('layouts.app', ['title' => 'Add task'])
@section('content')
<main class="container"><div class="form-wrap"><div class="eyebrow">New task</div><h1>Put it on the list.</h1><p class="subtitle">Capture the next thing you want to move forward.</p><div class="form-panel">@include('tasks.form', ['formAction' => route('tasks.store', [], false), 'formMethod' => 'POST', 'submitLabel' => 'Add task'])</div></div></main>
@endsection