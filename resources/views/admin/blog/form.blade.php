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
            <form-error v-if="errors.title" :error="errors.title"></form-error>
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

