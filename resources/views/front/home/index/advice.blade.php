<div class="container-lg py-3 py-sm-4">
    <div class="row">
        @foreach($advicePosts as $post)
            <div class="col-md-6">
                @include('front.app.post')
            </div>
        @endforeach
    </div>
</div>