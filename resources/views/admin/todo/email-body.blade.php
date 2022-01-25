@extends('admin.master')

@section('body')
<br />
<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
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
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection