@extends('layouts.admin')

@section('title')
    Admin - Image Edit
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Edit Image</span>
                    <div class="card-image">
                        <img
                            src="/{{ $image->folder }}{{ $image->has_sizes ? 'medium/' : '' }}{{ $image->file_name }}"
                            alt="{{ $image->description }}"
                            title="{{ $image->title }}"
                        >
                    </div>
                    <div class="row">
                        @include('admin.images.form', [
                            'route'       => route('admin_image_edit', ['id' => $image->id]),
                            'button_text' => 'Edit Image',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
