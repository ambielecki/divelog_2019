@extends('layouts.main')

@section('title')
    Home - DiveLogRepeat
@endsection

@section('content')
    <div class="row">
        <div class="col m8 s12 push-m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">{{ $page['title'] }}</span>
                </div>
            </div>
        </div>

        <div class="col m4 s12 pull-m8">
            @if (!empty($page['content']['carousel_images']))
                <div class="card">
                    <div class="carousel carousel-slider center">
                        @foreach ($page['content']['carousel_images'] as $image)
                            <a class="carousel-item" href="{{ $image['path'] }}">
                                <h5 class="carousel_text white-text">{{ $image['title'] }}</h5>
                                <img src="{{ $image['path'] }}" alt="{{ $image['caption'] ?? 'DiveLogRepeat' }}" title="{{ $image['title'] }}">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
