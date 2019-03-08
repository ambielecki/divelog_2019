<div class="row" id="blog_app">
    <div class="col s12 m5 offset-m2">
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

                        <div>
                            <label for="slug" class="label_override">Slug</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="slug" name="slug" type="text" value="{{ old('slug', $page->slug) }}" @keyup="checkSlug" v-model="slug" disabled="disabled">
                                <form-error v-if="errors.title" :error="errors.title"></form-error>
                            </div>
                        </div>

                        <div>
                            <label for="content_content" class="label_override" style="display: block">Post</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="content_content" name="content[content]" class="ck_textarea">
                                    {{ old('content.content', $content['content'] ?? '') }}
                                </textarea>

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

    <div class="col s12 m5">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">search</i>
                                <input @keyup="searchImages" v-model="search" placeholder="Search">
                            </div>

                            <div class="input-field col s6">
                                <select @change="getImageList()" v-model="limit" class="material_select">
                                    <option value="20" selected>20</option>
                                    <option value="60">60</option>
                                    <option value="100">100</option>
                                </select>
                                <label>Limit</label>
                            </div>
                        </div>

                        <div v-if="!images_loading && images.length !== 0" class="row">
                            <image-thumbnail
                                v-for="image in images"
                                :class="'col s3'"
                                :image="image"
                                @image_clicked="imageThumbClick"
                            ></image-thumbnail>
                        </div>
                        <div v-else-if="images_loading" class="center-align">
                            <div class="preloader-wrapper big active">
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div><div class="gap-patch">
                                        <div class="circle"></div>
                                    </div><div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <b>There were no images matching your search criteria.</b>
                        </div>
                    </div>

                    <div class="row" v-if="pages && (pages !== 1)">
                        <div class="col s12">
                            <page-list :page="page" :pages="pages" :links="false" @page_clicked="paginationClick"></page-list>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- End Picker Row --}}

        <div class="row" v-show="show_selected">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="valign-wrapper">
                            <i class="material-icons copy_btn" data-clipboard-target="#image_copy_code">file_copy</i><b> Image Insert Code: <input type="text" id="image_copy_code" :value="'||-- ' + selected_image.id + ' --||'" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <image-detail v-if="selected_image.hasOwnProperty('id')" :image="selected_image" :display_action="false"></image-detail>
            </div>
        </div>
    </div>
</div>
