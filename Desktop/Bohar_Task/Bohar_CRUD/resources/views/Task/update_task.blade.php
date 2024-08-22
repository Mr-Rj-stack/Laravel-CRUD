@extends('Task.layout')
@section('content')
    <div class="container">
        <a href="{{ route('all_tasks') }}" class="btn btn-success mt-5">Dashboard</a>
        <div class="row">
            <div class="col text-center">
                <h1>Update Task</h1>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-6">
                <form action="{{ route('task.update.post', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <div class="form-group">
                        <label for="title">Task Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}"
                            required>
                    </div>


                    <div class="form-group">
                        <label for="description">Task description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ $task->description }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select class="form-control-dropdown" id="status" name="status">
                            <option value="" disabled selected>status</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
