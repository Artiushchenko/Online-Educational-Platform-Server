@extends('layout.main')

@section('title', 'Edit Lecture')

@section('content')
    <div>
        <h1>Edit Lecture</h1>

        <form
            action="{{ route('admin.updateLecture', $lecture->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="edit"
        >
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $lecture->title) }}">
                @error('title')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="summernote" name="content" required>{{ old('content', $lecture->content) }}</textarea>
                @error('content')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="video_id">YouTube Video ID</label>
                <input type="text" id="video_id" name="video_id" value="{{ old('video_id', $lecture->video_id) }}">
                @error('video_id')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="files">Upload Files</label>
                <input type="file" id="files" name="files[]" multiple>
                @error('files.*')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            @if($lecture->files->isNotEmpty())
                <div class="form-group">
                    <label>Attached files</label>
                    <hr>
                    <p class="alert-text">If you want to delete any old files, check the boxes next to them.</p>
                    <hr>
                    <ul class="lecture-files-list">
                        @foreach ($lecture->files as $file)
                            <li>
                                <label>
                                    <input type="checkbox" name="delete_files[]" value="{{ $file->id }}">
                                </label>

                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ $file->file_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit">Update Lecture</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                width: 600,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview',]]
                ]
            });
        });
    </script>
@endsection
