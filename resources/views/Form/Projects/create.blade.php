@extends('Form.layout.Main')

@section('form-content')
    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
        <h2>Create Project s</h2>
        @csrf
        @if ($success = session('success'))
            <div class="text-success">{{ $success }}</div>
        @endif

        <div class="form-direction-row">
            <input type="text" name="name" placeholder="Name" @error('name') class="input-error" @enderror
                value="{{ old('name') }}">
            <input type="text" name="owner" placeholder="Owner's Name" @error('owner') class="input-error" @enderror
                value="{{ old('owner') }}">
        </div>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon @error('image') input-error @enderror">
                <input type="file" name="image" value="{{ old('image') }}">
                <span class="material-symbols-rounded">image</span>
            </div>

            <div class="form-direction-row input-icon @error('status') input-error @enderror">
                <select name="status" value="{{ old('status') }}">
                    <option hidden value="">Select Status</option>
                    <option value="New">New</option>
                    <option value="On hold">On hold</option>
                    <option value="In progress">In progress</option>
                    <option value="Complete">Complete</option>
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>
        </div>

        <textarea name="description" placeholder="Description" rows="4"
            @error('description') class="input-error" @enderror>{{ old('description') }}</textarea>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon">
                <label for="start_date">Start</label>
                <input type="date" id="start_date" name="start_date" @error('start_date') class="input-error" @enderror
                    value="{{ old('start_date') }}">
            </div>

            <div class="form-direction-row input-icon">
                <label for="deadline">Due</label>
                <input type="date" id="deadline" name="deadline" @error('deadline') class="input-error" @enderror
                    value="{{ old('deadline') }}">
            </div>
        </div>
        <div class="form-direction-row">
            <button type="button" onclick="window.location.href='{{ route('project') }}'">
                Cancel
            </button>
            <button type="submit">
                Create
            </button>
        </div>
    </form>
@endsection
