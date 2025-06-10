@extends('Form.layout.Main')

@section('form-content')
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        <h2>New User</h2>
        @csrf
        @if ($success = session('success'))
            <div class="text-success">{{ $success }}</div>
        @endif

        @if ($password = session('password'))
            <div class="text-error">{{ $password }}</div>
        @endif

        <div class="form-direction-row">
            <input type="text" name="name" placeholder="Name" @error('name') class="input-error" @enderror
                value="{{ old('name') }}">
            <input type="text" name="email" placeholder="Email" @error('email') class="input-error" @enderror
                value="{{ old('email') }}">
        </div>

        <div class="form-direction-row input-icon @error('image') input-error @enderror">
            <input type="file" name="image" value="{{ old('image') }}">
            <span class="material-symbols-rounded">add_a_photo</span>
        </div>

        <div class="form-direction-row">
            <input type="text" name="contact" placeholder="Contact" @error('contact') class="input-error" @enderror
                value="{{ old('contact') }}">
            <input type="text" name="location" placeholder="Location" @error('location') class="input-error" @enderror
                value="{{ old('location') }}">
        </div>

        <div class="form-direction-row input-icon">
            <label for="birthdate">Birth</label>
            <input type="date" id="birthdate" name="birthdate" @error('birthdate') class="input-error" @enderror
                value="{{ old('birthdate') }}">
        </div>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon @error('position') input-error @enderror">
                <input type="text" name="position" placeholder="Position" value="{{ old('position') }}">
                <span class="material-symbols-rounded"></span>
            </div>
            <div class="form-direction-row input-icon @error('role') input-error @enderror">
                <select name="role" value="{{ old('role') }}">
                    <option hidden value="">Select role</option>
                    <option value="admin">Admin</option>
                    <option value="member">Member</option>
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>
        </div>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon @error('password') input-error @enderror">
                <input type="password" name="password" placeholder="Password">
                <span class="material-symbols-rounded"></span>
            </div>

            <div class="form-direction-row input-icon @error('repeat-password') input-error @enderror">
                <input type="password" name="repeat-password" placeholder="Repeat Password">
                <span class="material-symbols-rounded">visibility</span>
            </div>
        </div>

        {{-- <div class="form-direction-row input-icon">
                <label for="deadline">End</label>
                <input type="date" id="deadline" name="deadline" @error('deadline') class="input-error" @enderror>
            </div> --}}

        <div class="form-direction-row">
            <button type="button" onclick="window.location.href= '{{ route('user') }}'">
                Cancel
            </button>
            <button type="submit">
                Create
            </button>
        </div>
    </form>
@endsection
