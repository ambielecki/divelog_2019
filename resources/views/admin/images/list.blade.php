@extends('layouts.admin')

@section('title')
    Admin - Image List
@endsection

@section('content')
    <div id="image_list_app">
        <div class="row">
            <div class="col s12 m4 offset-m2">
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

                    <div class="card-action">
                        <a href="/admin/images/create" class="waves-effect waves-light btn">Upload Image</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <image-detail v-if="selected_image.hasOwnProperty('id')" :image="selected_image"></image-detail>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script type="text/javascript" src="/js/pages/images/list.js"></script>
@endpush
