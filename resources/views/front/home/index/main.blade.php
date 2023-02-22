<div class="bg-white">
    <div class="container-lg py-3 py-sm-4">
        <div class="row">
            @foreach($mainPosts as $post)
                <div class="col-6">
                    <div class="d-flex align-items-center row py-2 py-sm-3" data-aos-once="true" data-aos="zoom-in-up">
                        <div class="col-sm-5 image-hover">
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
                        <div class="col-sm-7">
                            <a href="{{ route('category', $post->category->slug) }}" title="{{ $post->category->getName() }}"
                               class="d-block text-success font-weight-bold small text-uppercase mt-1 mt-sm-0 mb-sm-1">
                                {{ $post->category->getName() }}
                            </a>
                            <a href="{{ route('post', $post->slug) }}" title="{{ $post->getTitle() }}"
                                class="d-block h6">
                                {{ $post->getTitle() }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>