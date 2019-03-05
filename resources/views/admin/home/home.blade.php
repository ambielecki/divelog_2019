@extends('layouts.admin')

@section('title')
    Admin - Home Edit
@endsection

@section('content')
    <div id="home_edit_app">
        <div class="row">
            <div class="col s12 m5 offset-m1">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Edit Home Page</span>

                        <form action="{{ route('admin_home_edit') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="content_content" name="content[content]" class="ck_textarea">Hello, World!</textarea>
                                    <label for="content_content">Main Content</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Test
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        ClassicEditor
            .create( document.querySelector( '.ck_textarea' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
