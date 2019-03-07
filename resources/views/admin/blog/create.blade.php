@extends('layouts.admin')

@section('title')
    Admin - Blog Create
@endsection

@section('content')
    <div class="row" id="blog_app">
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Add New Blog Post</span>
                    <div class="row">
                        @include('admin.blog.form', [
                            'route'       => route('admin_blog_create'),
                            'button_text' => 'Add Post',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/blog/form.js') }}"></script>
@endpush
