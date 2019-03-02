@extends('layouts.admin')

@section('title')
    Admin - Image List
@endsection

@section('content')
    <p>Hello</p>
@endsection

@push('body_scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            console.log('sending axios request');
            Axios
                .get('/api/admin/images', {})
                .then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });
        });
    </script>
@endpush
