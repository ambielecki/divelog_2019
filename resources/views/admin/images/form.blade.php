<form class="col s12" action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        @if (!$image->file_name)
            <div class="file-field input-field">
                <div class="btn">
                    <span>Select Image</span>
                    <input type="file" name="image_file" value="{{ old('file') }}">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
                @if ($errors->has('image_file'))
                    <span class="red-text">
                        <strong>{{ $errors->first('image_file') }}</strong>
                    </span>
                @endif
            </div>
        @endif

        <div class="input-field col s12">
            <input id="title" name="title" type="text" value="{{ old('title', $image->title) }}">
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
            <textarea name='description' id="description" class="materialize-textarea">{{ old('description', $image->description) }}</textarea>
            <label for="description">Description</label>
            @if ($errors->has('description'))
                <span class="red-text">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <select name="tags[]" id="tags" class="material_select" multiple>
                <option value="" disabled>Add Tags</option>
                @foreach ($tags as $id => $tag)
                    <option value="{{ $id }}" @if (old())
                            {{ in_array($id, old('tags') ?: []) ? 'selected' : '' }}
                        @else
                            {{ isset($image_tags[$id]) ? 'selected' : '' }}
                        @endif
                     >{{ $tag }}</option>
                @endforeach
            </select>
            <label for="tags">Add Existing Tags</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <textarea name="new_tags" id="new_tags" class="materialize-textarea" placeholder="Add New Tags Separated By Commas">{{ old('new_tags') }}</textarea>
            <label for="new_tags">New Tags</label>
            @if ($errors->has('new_tags'))
                <span class="red-text">
                    <strong>{{ $errors->first('new_tags') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <label>
                <input type="checkbox" name="is_hero" value="1" {{ old('is_hero', $image->is_hero) ? 'checked' : '' }}>
                <span>Hero Image</span>
            </label>
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

