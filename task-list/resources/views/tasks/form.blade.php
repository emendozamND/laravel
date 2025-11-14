@extends('layouts.app')
@section('title', isset($task)? 'edit Task': 'add Task')
@section('styles')
<style>
    .error-message{
        color:red;
        font-size:0.8rem;
    }
</style>
@endsection
@section('content')
{{-- resources/views/tasks/form.blade.php --}}

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="error-message">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST"
      action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
    @csrf

    @isset($task)
        @method('PUT')
    @endisset

    <div>
        <label for="title">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $task->title ?? '') }}"
        >
        @error('title')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <textarea
            name="description"
            id="description"
            rows="5"
        >{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="long_description">Long description</label>
        <textarea
            name="long_description"
            id="long_description"
            rows="10"
        >{{ old('long_description', $task->long_description ?? ($task->long_description ?? '')) }}</textarea>
        @error('long_description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit">
            @isset($task)
                Update Task
            @else
                Add Task
            @endisset
        </button>
    </div>
@endsection

