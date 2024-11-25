@extends('layout.main')

@section('title', 'Statistics')

@section('content')
    <div>
        <div class="dashboard">
            <div class="stat-card">
                <p>{{ $usersCount }}</p>
                <h3>Users</h3>
            </div>

            <div class="stat-card">
                <p>{{ $coursesCount }}</p>
                <h3>Courses</h3>
            </div>

            <div class="stat-card">
                <p>{{ $lecturesCount }}</p>
                <h3>Lectures</h3>
            </div>

            <div class="stat-card">
                <p>{{ $categoriesCount }}</p>
                <h3>Categories</h3>
            </div>

            <div class="stat-card">
                <p>{{ $filesCount }}</p>
                <h3>Files</h3>
            </div>
        </div>
    </div>
@endsection
