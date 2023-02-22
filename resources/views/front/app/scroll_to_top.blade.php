<button type="button" id="scroll-to-top" class="btn btn-sm btn-light position-fixed m-2 m-sm-3">
    <i class="bi bi-caret-up-fill text-danger"></i>
</button>
<style>
    #scroll-to-top {
        opacity: 0.5;
        bottom: 0;
        right: 0;
        z-index: 1070;
    }
</style>
<script>
    $(document).ready(function () {
        $('#scroll-to-top').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 1500);
            return false;
        }).fadeOut(0);
        $(window).scroll(function () {
            if ($(this).scrollTop() > 1000) {
                $('#scroll-to-top').fadeIn();
            } else {
                $('#scroll-to-top').fadeOut();
            }
        });
    });
</script>