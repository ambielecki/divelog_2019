@extends('layouts.main')

@section('title')
    DiveLogRepeat - {{ $post->title }}
@stop

@section('content')
    <div class="row">
        <div class="col s12 m4 offset-m2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">{{ $post->title }}</span>
                    <div class="card-content">
                        {!! $content['content'] !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m3 offset-m1">
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
