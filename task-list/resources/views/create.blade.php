@extends('layouts.app')
@section('title','add Task')
@section('styles')
<style>
    .error-message{
        color:red;
        font-size:0.8rem;
    }
</style>
@endsection
@section('content')
{{ $errors }}
<form method="POST" action="{{ route('tasks.store') }}">
    @csrf {{-- cross site request forgery --}}
    <div>
        <label for="title">title</label>
        <input type="text" name="title", id="title" />
        @error('title')
        <p class="error-message">{{ $message }} </p>
        @enderror
    </div> 
    <div>
        <label for="description">description</label>
        <textarea name="description", id="description" rows="5"></textarea>
         @error('description')
        <p class="error-message">{{ $message }} </p>
        @enderror
    </div> 
    <div>
        <label for="long_description">long_description</label>
        <textarea name="long_description", id="long_description" rows="10"></textarea>
         @error('long_description')
        <p class="error-message">{{ $message }} </p>
        @enderror-
    </div> 
    <div>
    <button type="submit">Add Task</button>        
    </div> 
</form>
@endsection

