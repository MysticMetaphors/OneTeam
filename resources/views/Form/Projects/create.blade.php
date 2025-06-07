@extends('Form.layout.Main')

@section('form-content')
    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
        <h2>Create Project</h2>
        @csrf
        @if ($success = session('success'))
            <div class="text-success">{{ $success }}</div>
        @endif

        <div class="form-direction-row">
            <input type="text" name="name" placeholder="Name" @error('name') class="input-error" @enderror>
            <input type="text" name="owner" placeholder="Owner's Name" @error('owner') class="input-error" @enderror>
        </div>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon @error('image') input-error @enderror">
                <input type="file" name="image">
                <span class="material-symbols-rounded">image</span>
            </div>

            <div class="form-direction-row input-icon @error('status') input-error @enderror">
                <select name="status" >
                    <option hidden value="">Select Status</option>
                    <option value="On hold">New</option>
                    <option value="On hold">On hold</option>
                    <option value="In progress">In progress</option>
                    <option value="Complete">Complete</option>
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>
        </div>

        <textarea name="description" placeholder="Description" rows="4"
            @error('description') class="input-error" @enderror></textarea>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon">
                <label for="start_date">Start</label>
                <input type="date" id="start_date" name="start_date" @error('start_date') class="input-error" @enderror>
            </div>

            <div class="form-direction-row input-icon">
                <label for="deadline">End</label>
                <input type="date" id="deadline" name="deadline" @error('deadline') class="input-error" @enderror>
            </div>
        </div>
        <div class="form-direction-row">
            <button type="button">
                Cancel
            </button>
            <button type="submit">
                Create
            </button>
        </div>
    </form>
@endsection
