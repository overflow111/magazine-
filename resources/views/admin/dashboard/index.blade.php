@extends('admin.layouts.app')
@section('title') @lang('transAdmin.dashboard') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h3 mb-0">
            @lang('transAdmin.dashboard')
        </div>
    </div>

    <div class="my-2">
        <div class="card my-3 shadow">
            <div class="card-body text-center p-5">
                <img src="{{ asset('img/syyahat.svg') }}"
                     alt="@lang('transFront.app-name')"
                     class="img-fluid my-auto"
                     style="max-height:15rem;">
            </div>
        </div>
        <div class="row">
            @foreach($counts as $count)
                <div class="col-6 col-md-3 col-xl-2 my-3">
                    <div class="card border-left-{{ $count['color'] }} shadow h-100">
                        <div class="card-body p-3">
                            <div class="h5 text-{{ $count['color'] }} text-uppercase">{{ $count['name'] }}</div>
                            <div class="h3 mb-0">{{ $count['count'] }}</div>
                            <div class="text-right">
                                <i class="fas fa-{{ $count['icon'] }} fa-2x text-{{ $count['color'] }}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection