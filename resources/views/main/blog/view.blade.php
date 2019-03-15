@extends('layouts.main')

@section('title')
    DiveLogRepeat - {{ $post->title }}
@stop

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card blog_card" style="clear: both">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">{{ $post->title }}</span>
                    {!! $content['content'] !!}
                </div>
            </div>
        </div>
    </div>
@stop

@push('page_scripts')

@endpush
