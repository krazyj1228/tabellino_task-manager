@extends('layouts.app', ['title' => 'Edit task'])
@section('content')
<main class="container"><div class="form-wrap"><div class="eyebrow">Edit task</div><h1>Keep it moving.</h1><p class="subtitle">Update the details or mark this one complete.</p><div class="form-panel">@include('tasks.form', ['formAction' => route('tasks.update', [$task], false), 'formMethod' => 'PUT', 'submitLabel' => 'Save changes'])</div></div></main>
@endsection