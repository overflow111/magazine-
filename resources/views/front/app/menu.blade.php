<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('.category-splide', {
            arrows: false,
            pagination: false,
            fixedWidth: '10rem',
            gap: '1.5rem',
            padding: {left: '1.5rem', right: '1.5rem',},
            breakpoints: {575: {fixedWidth: '7.5rem', gap: '1rem', padding: {left: '1rem', right: '1rem',},},}
        }).mount();
    });
</script>
<div class="splide category-splide py-2 py-sm-3 mx-n3 mx-sm-n4">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($menuCategories as $category)
                <li class="splide__slide">
                    @include('front.app.category')
                </li>
            @endforeach
        </ul>
    </div>
</div>