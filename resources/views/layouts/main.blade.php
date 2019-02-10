@extends('layouts.shell')

@section('layout')
    @include('main.header.header')

    @yield('content')
@endsection

@push('body_scripts')
    <script type="text/javascript" src="/js/main.js"></script>
@endpush
