@extends('layouts.admin')

@section('title')
    Admin - Image Create
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Add New Image</span>
                    <div class="row">
                        @include('admin.images.form', [
                            'route' => route('admin_image_create'),
                            'button_text' => 'Add Image',
                        ])
                    </div>
                </div>

                {{--<div class="card-action">--}}
                    {{--<a href="/password/reset">Forgot Password</a><a href="{{ route('register') }}">Register</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection
