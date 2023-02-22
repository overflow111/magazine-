<footer class="bg-white border-top small py-2 py-sm-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-sm-4 py-2 py-sm-3">
                <div class="py-1">
                    @lang('transFront.description')
                </div>
            </div>
            <div class="col-sm-4 py-2 py-sm-3">
                <div class="py-1">
                    <i class="bi bi-geo-alt"></i> @lang('transFront.address')
                </div>
                <div class="py-1">
                    @foreach(explode(",", trans('transFront.phones')) as $phone)
                        @if(!$loop->first)
                            &nbsp;
                        @endif
                        <a href="tel:+99312{{$phone}}" title="+99312{{$phone}}">
                            <i class="bi bi-telephone"></i> +993 (12) {{ $phone }}
                        </a>
                    @endforeach
                </div>
                <div class="py-1">
                    <i class="bi bi-printer"></i> +993 (12) @lang('transFront.fax')
                </div>
                <div class="py-1">
                    <a href="mailto:@lang('transFront.email')" title="@lang('transFront.email')">
                        <i class="bi bi-envelope"></i> @lang('transFront.email')
                    </a>
                </div>
            </div>
            <div class="col-sm-4 py-2 py-sm-3">
                <div class="py-1">
                    <a href="{{ route('about-us') }}" title="@lang('transFront.about-us')">
                        @lang('transFront.about-us')
                    </a>
                </div>
                <div class="py-1">
                    <a href="{{ route('contact') }}" title="@lang('transFront.contact-to-administrator')">
                        @lang('transFront.contact-to-administrator')
                    </a>
                </div>
                <div class="py-1">
                    © {{ date('Y') }} <span class="font-weight-bold">@lang('transFront.app-website')</span>
                </div>
                <div class="py-1">
                    @lang('transFront.rights')
                </div>
            </div>
        </div>
    </div>
</footer>