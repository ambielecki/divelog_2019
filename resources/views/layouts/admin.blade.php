@extends('layouts.shell')

@section('layout')
    @include('admin.header.header')
    <main>
        @include('shared.flash_message')
        @yield('content')
    </main>
    @include('shared.footer')
@endsection

@push('body_scripts')
    <script type="text/javascript" src="{{ mix('/js/admin_vendor.js') }}"></script>
    @stack('page_scripts')
@endpush
