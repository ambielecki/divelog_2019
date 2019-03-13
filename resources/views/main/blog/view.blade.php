@extends('layouts.main')

@section('title')
    DiveLogRepeat - {{ $post->title }}
@stop

@section('content')
    <div class="row">
        <div class="col s12 m5 offset-m1">
            <div class="card blog_card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">{{ $post->title }}</span>
                    {!! $content['content'] !!}
                </div>
            </div>
        </div>
        <div class="col s12 offset-m1 m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">Previous Posts</span>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page_scripts')

@endpush
