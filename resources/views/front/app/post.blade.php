<div class="row py-2 py-sm-3" data-aos-once="true" data-aos="zoom-in-up">
    <div class="col-4 image-hover">
        <a href="{{ route('post', $post->slug) }}" title="{{ $post->getTitle() }}" class="d-flex align-items-center justify-content-center o-hidden rounded">
            @if($post->image)
                <img src="{{ asset('img/temp/post-sm.png') }}"
                     data-src="{{ Storage::disk('local')->url('sm/'.$post->image) }}"
                     alt="{{ $post->getTitle() }}"
                     class="load-image img-fluid">
            @else
                <img src="{{ asset('img/temp/post-sm.png') }}"
                     alt="{{ $post->getTitle() }}"
                     class="img-fluid">
            @endif
        </a>
    </div>
    <div class="col-8 pl-0">
        <div class="bg-white border rounded p-2 p-sm-3">
            <a href="{{ route('category', $post->category->slug) }}" title="{{ $post->category->getName() }}"
               class="d-block text-success font-weight-bold small text-uppercase mb-sm-1">
                {{ $post->category->getName() }}
            </a>
            <a href="{{ route('post', $post->slug) }}" title="{{ $post->getTitle() }}"
               class="d-block h6 mb-2">
                {{ $post->getTitle() }}
            </a>
            <a href="{{ route('author', $post->author->slug) }}" title="{{ $post->author->getName() }}"
               class="d-block h6 text-secondary mb-1">
                {{ $post->author->getName() }}
            </a>
            <div class="small text-secondary mb-1 mb-sm-2">
                {{ $post->author->getJob() }}
            </div>
            <div class="small text-secondary">
                {{ $post->published_at->format('d.m.Y') }}
            </div>
        </div>
    </div>
</div>