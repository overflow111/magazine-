<style>
    div#loading-screen {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        opacity: 0.75;
        z-index: 1200;
    }
</style>
<script>
    $(window).on("load", function () {
        $("#loading-screen").fadeOut(400);
    });
</script>
<div id="loading-screen" class="bg-light position-fixed w-100 h-100">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>