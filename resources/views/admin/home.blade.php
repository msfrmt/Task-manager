@extends('admin.master')
@section('body')
<div class="alert alert-danger" role="alert">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<center>
    <h2>Welcome, {{Auth::user()->name}}</h2>
</center>

<center>
    <p>List & manage Your Todo task with Todolist.</p>
</center>
@endsection