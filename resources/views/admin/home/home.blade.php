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
                            <input type="hidden" name="id" value="{{ $current_page->id }}">

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="title" name="title" type="text" value="{{ old('title', $current_page->title) }}">
                                    <label for="title">Title</label>
                                    @if ($errors->has('title'))
                                        <span class="red-text">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="content_content" name="content[content]" class="ck_textarea">
                                        {{ old('content.content', $current_page['content']['content'] ?: '') }}
                                    </textarea>
                                    <label for="content_content">Main Content</label>
                                    @if ($errors->has('content.content'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
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
                </div>{{-- End Form Card --}}

                <div class="col s12 m5">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Edit Home Page</span>
                        </div>
                    </div>{{-- End Image Picker Card --}}
                </div>{{-- End Image Picker Column --}}
            </div>{{-- End Form Column --}}
        </div>{{-- End Row --}}
    </div> {{-- End Vue App --}}
@endsection

@push('page_scripts')
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector( '.ck_textarea' ))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
