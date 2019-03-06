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
                                <div class="input-field col s12 m4">
                                    <label>
                                        <input name="uses_hero_image" type="checkbox" value="1">
                                        <span>Use Hero Image</span>
                                    </label>
                                </div>

                                <div class="col s12 m8">
                                    <img v-if="display_hero_path" :src="display_hero_path" class="responsive-img">
                                </div>
                            </div>

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
                                        {{ old('content.content', $content['content'] ?: '') }}
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
            </div>{{-- End Form Column --}}

            <div class="col s12 m5">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Select Images</span>
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

                        <div class="row">
                            <div class="col s6 m3">
                                <label>
                                    <input
                                        name="image_destination"
                                        type="radio"
                                        value="for_hero"
                                        v-model="image_destination"
                                        @change="getImageList"
                                    >
                                    <span>For Hero</span>
                                </label>
                            </div>
                            <div class="col s6 m3">
                                <label>
                                    <input
                                        name="image_destination"
                                        type="radio"
                                        value="for_carousel"
                                        v-model="image_destination"
                                        @change="getImageList"
                                    >
                                    <span>For Carousel</span>
                                </label>
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
                </div>{{-- End Image Picker Card --}}
            </div>{{-- End Image Picker Column --}}
        </div>{{-- End Row --}}
    </div> {{-- End Vue App --}}
@endsection

@push('page_scripts')
    <script type="text/javascript">
        HomeEdit = {
            current_page: JSON.parse('{!! json_encode($current_page) !!}'),
            current_content: JSON.parse('{!! json_encode($content) !!}'),
        };

        ClassicEditor
            .create(document.querySelector( '.ck_textarea' ))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript" src="/js/pages/home/edit.js"></script>
@endpush
