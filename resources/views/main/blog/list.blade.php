@extends('layouts.main')

@section('title')
    DiveLogRepeat - Blog Posts
@stop

@section('content')
    <div class="row" id="blog_list">
        <div class="col s12 m6 offset-m3">
            <blog-item v-for="post in posts" :post="post"></blog-item>
        </div>
    </div>
@stop

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/blog/list.js') }}"></script>
@endpush
