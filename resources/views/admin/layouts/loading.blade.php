<style>
    div#loading-screen {
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
        <span class="spinner-border border-light border-bottom-danger border-left-danger bg-white"></span>
    </div>
</div>