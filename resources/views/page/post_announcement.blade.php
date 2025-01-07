{{-- resources\views\page\post_announcement.blade.php --}}
@extends('layouts.main_layout')

@section('title', 'MSWDO - Post Announcement - Page')

@section('head')
<link rel="stylesheet" href="{{asset('css/postannouncement.css')}}">
@endsection

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header">
            <h5 class="mt-1">Post Announcement</h5>
        </div>
        <div class="card-body">
            <form id="postAnnouncementForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="caption">Caption</label>
                    <textarea class="form-control" id="caption" name="caption" rows="3"
                        placeholder="Write your announcement caption here..."></textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="media">Upload Images/Videos</label>
                    <input type="file" class="form-control" id="media" name="media[]" accept="image/*,video/*" multiple>
                    <small class="form-text text-muted">Supported formats: JPG, PNG, MP4. You can select multiple
                        files.</small>
                </div>
                <div class="form-group mt-3">
                    <label>Selected Media Preview:</label>
                    <div id="mediaPreview" class="d-flex flex-wrap"></div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Post Announcement</button>
            </form>
        </div>
    </div>
</div>

{{-- Scripts Compile --}}
<script src="{{asset('js/postannouncement.js')}}"></script>
@endsection