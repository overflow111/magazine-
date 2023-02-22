<div class="container-lg">
    <div class="mx-sm-n4 mx-lg-0">
        <div class="row no-gutters">
            <div class="col-12 col-md-6">
                <div class="image-hover mx-n2 mx-sm-0" data-aos-once="true" data-aos="zoom-in-up">
                    <a href="{{ route('post', $main->slug) }}" title="{{ $main->getTitle() }}"
                       class="d-flex align-items-end justify-content-between o-hidden">
                        <div class="position-absolute text-white bg-slide-text w-100 p-3" style="z-index:1;">
                            <div class="text-uppercase mb-1 mb-sm-2">
                                {{ $main->category->getName() }}
                            </div>
                            <div class="h4">
                                {{ $main->getTitle() }}
                            </div>
                        </div>
                        @if($main->image)
                            <img src="{{ asset('img/temp/post.png') }}"
                                 data-src="{{ Storage::disk('local')->url($main->image) }}"
                                 alt="{{ $main->getTitle() }}"
                                 class="load-image img-fluid">
                        @else
                            <img src="{{ asset('img/temp/post.png') }}"
                                 alt="{{ $main->getTitle() }}"
                                 class="img-fluid">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row no-gutters">
                    @foreach($recommended as $post)
                        <div class="col-6 col-sm-4 col-md-6 {{ $loop->last ? 'd-sm-none d-md-block':'' }}">
                            <div class="image-hover" data-aos-once="true" data-aos="zoom-in-up">
                                <a href="{{ route('post', $post->slug) }}" title="{{ $post->getTitle() }}"
                                   class="d-flex align-items-end justify-content-between o-hidden">
                                    <div class="position-absolute text-white bg-slide-text w-100 p-2 p-sm-3" style="z-index:1;">
                                        <div class="small text-uppercase mb-sm-1">
                                            {{ $post->category->getName() }}
                                        </div>
                                        <div class="small h6">
                                            {{ $post->getTitle() }}
                                        </div>
                                    </div>
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>