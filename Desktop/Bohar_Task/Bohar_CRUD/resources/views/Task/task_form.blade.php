@extends('Task.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1>Create New Task</h1>
        </div>
    </div>
    <div class="row">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
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
            <form action="{{ route('task.post', ['id' => Auth::id()]) }}" method="POST">
                <div class="form-group">
                    <label for="title">Task Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Enter task title" required>
                </div>


                <div class="form-group mt-3">
                    <label for="description">Task Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter task description"></textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <select class="form-control-dropdown " id="status" name="status">
                        <option value="" disabled selected>status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <a href="{{ route('all_tasks') }}" class="btn btn-success btn-md ml-5 mt-3">Dashboard</a>

                @csrf
            </form>
        </div>
    </div>
</div>
@endsection


