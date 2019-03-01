@extends('layouts.shell')

@section('layout')
    <main>
        @yield('content')
    </main>
    @include('shared.footer')
@endsection

@push('body_scripts')
    <script type="text/javascript" src="{{ mix('/js/main.js') }}"></script>
@endpush
