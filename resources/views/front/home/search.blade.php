@extends('front.layouts.app')
@section('title')@lang('transAdmin.search') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transAdmin.search')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div>
            <div class="input-group">
                <input type="text" class="form-control rounded" name="q" title="@lang('transFront.search')" autocomplete="off"
                       placeholder="@lang('transFront.search')" id="search" maxlength="40" autofocus
                       aria-label="" aria-describedby="button-add">
                <div class="input-group-append" style="margin-left:-43px;z-index:10;">
                    <button class="btn btn-link rounded-pill" type="button" id="button-add"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="position-relative">
                <div class="position-absolute bg-white w-100 p-2 border rounded d-none" style="z-index:10;" id="result"></div>
            </div>
        </div>
        <script>
            var timeout = null;
            $('#search').keyup(function () {
                clearTimeout(timeout);
                var search = $(this).val();
                timeout = setTimeout(function () {
                    if (search.length > 2) {
                        $.ajax({
                            url: "{{ route("search.api") }}",
                            dataType: "json",
                            type: "GET",
                            data: {"q": search},
                            success: function (result, status, xhr) {
                                if (result["posts"].length > 0) {
                                    let posts = '';
                                    for (let i = 0; i < result["posts"].length; i++) {
                                        posts += '<a href="' + result["posts"][i]["slug"] + '" class="d-block text-truncate p-1">'
                                            + result["posts"][i]["title"]
                                            + '</a>';
                                    }
                                    $('#result').html(posts).removeClass('d-none');
                                } else {
                                    $('#result').html('<div class="p-1">@lang('transAdmin.post') @lang('transAdmin.not-found') :(</div>').removeClass('d-none');
                                    setTimeout(function () {
                                        $('#result').html('').addClass('d-none');
                                    }, 3000);
                                }
                            },
                        });
                    } else {
                        $('#result').html('').addClass('d-none');
                    }
                }, 500);
            });
        </script>
        @include('front.app.menu')
    </div>
@endsection
