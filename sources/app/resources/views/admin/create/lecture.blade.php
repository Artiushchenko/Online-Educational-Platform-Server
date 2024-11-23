@extends('layout.main')

@section('title', 'New Lecture')

@section('content')
    <div>
        <h1>Create New Lecture</h1>

        <form action="{{ route('admin.storeLecture') }}" method="POST" class="edit">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
                @error('title')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="summernote" name="content" required></textarea>
                @error('content')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="video_id">YouTube Video ID</label>
                <input type="text" id="video_id" name="video_id" required>
                @error('video_id')
                    <div>{{ $message }}</div>
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
