@extends('layout.main')

@section('title', 'New Lecture')

@section('content')
    <div>
        <h1>Create New Lecture</h1>

        <form
            action="{{ route('admin.lectures.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="edit"
        >
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title">
                @error('title')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="summernote" name="content"></textarea>
                @error('content')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="video_id">YouTube Video ID</label>
                <input type="text" id="video_id" name="video_id">
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

            <button type="submit">Create lecture</button>
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
