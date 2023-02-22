<div class="image-hover" data-aos-once="true" data-aos="zoom-in-up">
    <a href="{{ route('category', $category->slug) }}" title="{{ $category->getName() }}"
       class="d-flex align-items-center justify-content-center o-hidden rounded border">
        @if($category->image)
            <img src="{{ asset('img/temp/category.png') }}"
                 data-src="{{ Storage::disk('local')->url($category->image) }}"
                 alt="{{ $category->getName() }}"
                 class="load-image img-fluid">
        @else
            <img src="{{ asset('img/temp/category.png') }}"
                 alt="{{ $category->getName() }}"
                 class="img-fluid">
        @endif
    </a>
    <div class="text-center p-1">
        <a href="{{ route('category', $category->slug) }}" title="{{ $category->getName() }}" class="h6">
            {{ $category->getName() }}
        </a>
    </div>
</div>