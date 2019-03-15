@extends('layouts.main')

@section('title')
    DiveLogRepeat - Log
@stop

@section('content')
    <div class="row" id="log_app">
        <p>Fallback check</p>
        <router-view></router-view>
    </div>
@stop

@push('page_scripts')
    <script type="text/javascript" src="/js/pages/divelog/app.js"></script>
@endpush
