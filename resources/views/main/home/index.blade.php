@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col m6 s12">
            @if (!empty($page['content']['carousel_images']))
                <div class="carousel carousel-slider center">
                    @foreach ($page['content']['carousel_images'] as $image)
                        <a class="carousel-item" href="{{ $image['path'] }}">
                            <img src="{{ $image['path'] }}" alt="{{ $image['caption'] ?? 'DiveLogRepeat' }}">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection