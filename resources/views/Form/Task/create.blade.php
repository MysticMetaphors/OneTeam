@extends('Form.layout.Main')

@section('form-content')
    <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
        <h2>New Task</h2>
        @csrf
        @if ($success = session('success'))
            <div class="text-success">{{ $success }}</div>
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

        <input type="text" name="title" placeholder="Title" @error('title') class="input-error" @enderror>
        <textarea name="description" id="" placeholder="Description" rows="4"
            @error('description') class="input-error" @enderror></textarea>


        <div class="form-direction-row">
            <div class="form-direction-row input-icon @error('priority') input-error @enderror">
                <input type="text" name="type" placeholder="Type" @error('type') class="input-error" @enderror>
            </div>
            <div class="form-direction-row input-icon @error('priority') input-error @enderror">
                <select name="priority">
                    <option hidden value="">Select Priority</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>
        </div>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon @error('project') input-error @enderror">
                <select name="project">
                    <option hidden value="">Select Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>

            <div class="form-direction-row input-icon @error('assignee') input-error @enderror">
                <select name="assignee">
                    <option hidden value="">Assign To</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>
        </div>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon">
                <label for="deadline">Due</label>
                <input type="date" id="deadline" name="deadline" @error('deadline') class="input-error" @enderror>
            </div>
        </div>

        {{-- <div class="form-direction-row input-icon @error('recurring') input-error @enderror">
            <div class="checkbox-input">
                <input type="checkbox" name="recurring">
                <span>Repeat?</span>
            </div>
            <input type="number" name="repeat_interval" placeholder="Number days before repeat">
        </div> --}}

        <div class="form-direction-row">
            <button type="button" onclick="window.location.href = '{{ route('task') }}'">
                Cancel
            </button>
            <button type="submit">
                Create
            </button>
        </div>
    </form>
@endsection
