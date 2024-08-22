@extends('Task.layout')
@section('content')
    <div class="container mt-2">

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end mt-3">
                <a href="{{ route('task.view') }}" class="btn btn-success mx-3">Create Task</a>
                <a href="{{ route('dashboard') }}" class="btn btn-success">Home</a>

            </div>
        </div>

        @if ($tasks && $tasks->count() > 0)

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach ($tasks as $key=> $task)
                <tbody>
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            <div>
                            <a href="{{ route('view', $task->id) }}" class="btn btn-primary btn-md">View</a>
                            </div>
                            <div>
                            <a href="{{ route('task.update', $task->id) }}" class="btn btn-info btn-md mt-2">Update</a>
                            </div>
                            <div>
                            <form action="{{ route('delete', $task->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-md mt-2">Delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        @else
        <div class="alert alert-warning">
            No tasks found. Please create a new task.
        </div>
    @endif
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this task?');
        }
    </script>
@endsection
