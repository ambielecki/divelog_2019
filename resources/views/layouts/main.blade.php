@extends('layouts.shell')

@section('layout')
    @include('main.header.header')
    <main>
        @yield('content')
    </main>
    @include('shared.footer.footer')
@endsection

@push('body_scripts')
    <script type="text/javascript" src="{{ mix('/js/main.js') }}"></script>
@endpush
