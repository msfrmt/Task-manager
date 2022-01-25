@extends('admin.master')

@section('body')
<br />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="text-center text-success">TODOList</h4>
            </div>
            <section style="padding-top:60px; padding-left:15px;">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('search') }}">
                                    <div class="form-group">
                                        <div class="col-md-7">
                                            <input type="text" name="terms" id="terms" class="form-control typehead" placeholder="search.." />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" value="Search" class="btn btn-success btn-xs">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <form action="{{ route('filter') }}">
                <div class="form-group" style="padding-left:15px;">
                    <div class=" col-md-2">
                        <a href="{{ route('filter-q',['id'=>5]) }}" class="btn btn-info warning">
                            <span>Today</span>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('filter-q',['id'=>1]) }}" class="btn btn-info success">
                            <span>Yesterday</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="from" id="from" value="" class="form-control">&nbsp;
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="to" id="to" value="" class="form-control">&nbsp;
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Submit" class="btn btn-success btn-xs">
                    </div>
                </div>
            </form>
            <div class="panel-body">
                <h3 class="text-center text-success"></h3>
                <table class="table table-bordered">
                    <tr class="bg-primary">
                        <th> Task No </th>
                        <th> Task Name </th>
                        <th> Completion Date</th>
                        <!-- <th> Status </th> -->
                        <th> Action </th>
                    </tr>
                    @php($i=1)
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $i++ }} </td>
                        <td>{{ $task->task_name }}</td>
                        <td>{{ date('d-m-Y', strtotime($task->completion_date))}}</td>
                        <!-- <td>{{ $task->completion_status == 1? 'Done' : 'Undone' }}</td> -->
                        <td>
                            @if($task->completion_status == 1)
                            <a href="{{ route('undone-task',['id'=>$task->id]) }}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Done">
                                <span class="glyphicon glyphicon-ok"> </span>
                            </a>
                            @else
                            <a href="{{ route('done-task',['id'=>$task->id]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Undone">
                                <span class="glyphicon glyphicon-arrow-down"> </span>
                            </a>
                            @endif
                            <a href="{{ route('edit-task',['id'=>$task->id]) }}" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-edit"> </span>
                            </a>

                            <a href="{{ route('delete-task',['id'=>$task->id]) }}" class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash"> </span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection