<div class="row" id="blog_app">
    <div class="col s12 m4 offset-m2">
        <div class="card">
            <div class="card-content">
                <span class="card-title">{{ $title }}</span>
                <div class="row">
                    <form class="col s12" action="{{ $route }}" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="title" name="title" type="text" value="{{ old('title', $page->title) }}" @keyup="checkSlug">
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
                                <input id="slug" name="slug" type="text" value="{{ old('slug', $page->slug) }}" @keyup="checkSlug" v-model="slug" disabled="disabled">
                                <label for="slug">Slug</label>
                                <form-error v-if="errors.title" :error="errors.title"></form-error>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="content_content" name="content[content]" class="ck_textarea">
                                    {{ old('content.content', $content['content'] ?? '') }}
                                </textarea>
                                <label for="content_content">Post</label>
                                @if ($errors->has('content.content'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light" type="submit" name="action">{{ $button_text }}
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> {{-- End Form Column--}}

    <div class="col s12 m4">

    </div>
</div>
