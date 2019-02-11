@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col m4 s12">
            @if (!empty($page['content']['carousel_images']))
                <div class="card">
                    <div class="carousel carousel-slider center">
                        @foreach ($page['content']['carousel_images'] as $image)
                            <a class="carousel-item" href="{{ $image['path'] }}">
                                <img src="{{ $image['path'] }}" alt="{{ $image['caption'] ?? 'DiveLogRepeat' }}" title="{{ $image['title'] }}">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
