@extends('layouts.admin')

@section('title')
    Admin - Blog Edit
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Edit Blog Post</span>
                    <div class="row">
                        @include('admin.blog.form', [
                            'route'       => route('admin_blog_edit', ['id' => $page->id]),
                            'button_text' => 'Edit Image',
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
