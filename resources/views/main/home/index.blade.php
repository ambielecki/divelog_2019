@extends('layouts.main')

@section('title')
    {{ $page['title'] ?? 'Home - DiveLogRepeat' }}
@endsection

@section('content')
    @if (isset($content['hero_image']))
        <div class="row hero_image_block">
            <img class="hero_image" alt="{{ $content['hero_image']['caption'] ?? 'Welcome To DiveLogRepeat' }}" src="{{ $content['hero_image']['path'] }}">
            <div class="hero_text">
                {{ $content['hero_image']['title'] ?? 'Welcome To DiveLogRepeat' }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m8 push-m4">
                            <span class="card-title">{!! $content['title'] ?? '' !!}</span>
                            {!! $content['content'] ?? 'What No Content?' !!}
                        </div>

                        <div class="col m4 s12 pull-m8">
                            @if (!empty($content['carousel_images']))
                                <div class="carousel carousel-slider center">
                                    @foreach ($content['carousel_images'] as $image)
                                        <a class="carousel-item" href="{{ $image['path'] }}">
                                            <h5 class="carousel_text white-text">{{ $image['title'] }}</h5>
                                            <img src="{{ $image['path'] }}" alt="{{ $image['caption'] ?? 'DiveLogRepeat' }}" title="{{ $image['title'] }}">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
