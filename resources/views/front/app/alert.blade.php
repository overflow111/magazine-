@if(session('success'))
    <div class="alert alert-success position-fixed m-2" role="alert" id="alert">
        <i class="bi bi-check-circle"></i> {!! session('success') !!}
    </div>
@elseif(!empty($success))
    <div class="alert alert-success position-fixed m-2" role="alert" id="alert">
        <i class="bi bi-check-circle"></i> {!! $success !!}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger position-fixed m-2" role="alert" id="alert">
        <i class="bi bi-x-circle"></i> {!! session('error') !!}
    </div>
@elseif(!empty($error))
    <div class="alert alert-danger position-fixed m-2" role="alert" id="alert">
        <i class="bi bi-x-circle"></i> {!! $error !!}
    </div>
@elseif($errors->any())
    <div class="alert alert-danger position-fixed m-2" role="alert" id="alert">
        @foreach($errors->all() as $error)
            <i class="bi bi-x-circle"></i> {{ $error }}
            @if(!$loop->last)
                <br>
            @endif
        @endforeach
    </div>
@endif
<style>
    #alert {
        opacity: 0.9;
        top: 0;
        right: 0;
        z-index: 1100;
    }
</style>
<script>
    window.setTimeout(function () {
        $("#alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 10000);
</script>