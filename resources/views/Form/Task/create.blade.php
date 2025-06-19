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

        <div class="form-direction-row">
            <input type="text" name="title" placeholder="Title" @error('title') class="input-error" @enderror
                value="{{ old('title') }}">
            <input type="text" name="type" placeholder="Type" @error('type') class="input-error" @enderror
                value="{{ old('type') }}">
        </div>

        <textarea name="description" id="" placeholder="Description" rows="4"
            @error('description') class="input-error" @enderror>{{ old('description') }}</textarea>

        <div class="form-direction-row">
            {{-- <div class="form-direction-row input-icon @error('priority') input-error @enderror">
                <input type="text" name="type" placeholder="Type" @error('type') class="input-error" @enderror
                    value="{{ old('type') }}">
            </div> --}}
            <div class="form-direction-row input-icon @error('priority') input-error @enderror">
                <select name="priority" value="{{ old('priority') }}">
                    <option hidden value="">Select Priority</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>
            <div class="form-direction-row input-icon">
                <label for="deadline">Due</label>
                <input type="date" id="deadline" name="deadline" @error('deadline') class="input-error" @enderror
                    value="{{ old('deadline') }}">
            </div>
        </div>

        <div class="form-direction-row">
            <div class="form-direction-row input-icon @error('project') input-error @enderror">
                <select name="project" value="{{ old('project') }}">
                    <option hidden value="">Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>

            <div class="form-direction-row input-icon @error('assignee') input-error @enderror">
                <select name="assignee" value="{{ old('assignee') }}">
                    <option hidden value="">Assign To</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <span class="material-symbols-rounded">expand_more</span>
            </div>
        </div>

        {{-- <div class="form-direction-row">
            <div class="form-direction-row input-icon">
                <label for="deadline">Due</label>
                <input type="date" id="deadline" name="deadline" @error('deadline') class="input-error" @enderror
                    value="{{ old('deadline') }}">
            </div>
        </div> --}}

        <div>
            <button type="button" onclick="addSub()" class="btn-no-bg">Add SubTasks</button>
            <div id="subtasks">
                {{-- <div class="form-direction-row input-icon">
                    <span class="material-symbols-rounded">
                        remove
                    </span>
                    <input type="text" placeholder="Subtask" name="sub[]">
                </div> --}}
            </div>
        </div>

        <div>
            <label for="attach" class="attachment">Attachment</label>
            <div class="form-direction-row input-icon @error('attach') input-error @enderror">
                <input type="file" name="attach" value="{{ old('attach') }}">
                <span class="material-symbols-rounded">attachment</span>
            </div>
        </div>

        <div class="checkbox-input">
            <input type="checkbox" name="recurring" id="check" onclick="show()">
            <span>Repeat?</span>
        </div>

        <div class="form-direction-row input-icon @error('recurring') input-error @enderror">
            <input type="number" name="repeat_interval" placeholder="Number days before repeat" id="interval" style="display: none">
        </div>

        <div class="form-direction-row">
            <button type="button" onclick="window.location.href = '{{ route('task') }}'">
                Cancel
            </button>
            <button type="submit">
                Create
            </button>
        </div>
    </form>

    <script>
        function addSub() {
            console.log('test');
            const subCon = document.getElementById('subtasks');
            const subInstance =
                `
                 <div class="form-direction-row input-icon">
                    <span class="material-symbols-rounded">
                        remove
                    </span>
                    <input type="text" placeholder="Subtask" name="sub[]">
                </div>
                `;
            console.log(subInstance);
            subCon.insertAdjacentHTML('beforeend', subInstance);
            return;
        }

        function show() {
            const checkbox = document.getElementById('check');
            const input = document.getElementById('interval');
            if (!checkbox.checked) {
                input.style.display = 'none';
            } else {
                input.style.display = 'block';
            }
        }
    </script>
@endsection
