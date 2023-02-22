<div class="row py-2 py-sm-3" data-aos-once="true" data-aos="zoom-in-up">
    <div class="col-4 image-hover">
        <a href="{{ route('download', $magazine->slug) }}" title="{{ $magazine->getTitle() }}" class="d-flex align-items-center justify-content-center o-hidden rounded">
            @if($magazine->image)
                <img src="{{ asset('img/temp/magazine.png') }}"
                     data-src="{{ Storage::disk('local')->url($magazine->image) }}"
                     alt="{{ $magazine->getTitle() }}"
                     class="load-image img-fluid">
            @else
                <img src="{{ asset('img/temp/magazine.png') }}"
                     alt="{{ $magazine->getTitle() }}"
                     class="img-fluid">
            @endif
        </a>
    </div>
    <div class="col-8 pl-0">
        <div class="bg-white border rounded p-2 p-sm-3">
            <a href="{{ route('download', $magazine->slug) }}" title="{{ $magazine->getTitle() }}"
               class="d-block h6 mb-2">
                {{ $magazine->getTitle() }}
            </a>
            <div class="small text-secondary mb-2 mb-sm-3">
                {{ $magazine->published_at->format('d.m.Y') }}
            </div>
            <div>
                {!! $magazine->getBody() !!}
            </div>
        </div>
    </div>
</div>