@extends('layouts.admin')

@section('title')
    Admin - Image List
@endsection

@section('content')
    <div id="image_list_app">
        <div class="row">
            <div class="col s12 m4 offset-m2">
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script type="text/javascript" src="/js/pages/images/list.js"></script>
@endpush
