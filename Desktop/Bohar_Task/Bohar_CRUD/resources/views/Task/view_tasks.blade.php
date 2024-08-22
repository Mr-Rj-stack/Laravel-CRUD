@extends('Task.layout')
@section('content')

    <div class="container">
        <a href="{{ route('all_tasks') }}" class="btn btn-success mt-5">Dashboard</a>

        <div class="container container-fluid mt-5">
            <div class="card"style="background:lightblue;">
              <div class="card-body">
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text">{{ $task->description }}</p>

                @if($task->status=="completed"){
                    <span class="badge badge-success">{{ $task->status}}</span>
                }
                @elseif($task->status=='in_progress'){
                    <span class="badge badge-warning">{{ $task->status}}</span>

                }
                @elseif($task->status=='pending'){
                    <span class="badge badge-danger">{{ $task->status}}</span>

                }
                @endif
              </div>
            </div>
        </div>

    </div>
@endsection
