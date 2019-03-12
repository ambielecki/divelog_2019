@extends('layouts.admin')

@section('title')
    Admin - Blog Edit
@endsection

@section('content')
    @include('admin.blog.form', [
        'title'       => 'Edit Post',
        'route'       => route('admin_blog_edit', ['id' => $page->id]),
        'button_text' => 'Edit Post',
    ])
@endsection

@push('page_scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/blog/form.js') }}"></script>
@endpush
