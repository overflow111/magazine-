@extends('front.layouts.app')
@section('title')@lang('transAdmin.plan') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transAdmin.plan')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            @lang('transAdmin.plan')
        </div>
        <div class="form-row justify-content-center text-center">
            @foreach($plans as $plan)
                <div class="col-6 col-sm-4 col-md-3 py-2 py-sm-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $plan->getName() }}
                        </div>
                        <div class="card-body">
                            <div class="h3 mb-3">
                                {{ $plan->price }}
                                <small>TMT</small>
                            </div>
                            <div class="mb-3">
                                @lang('transAdmin.month'): {{ $plan->month }}
                                <br>
                                @lang('transAdmin.magazine'): {{ $plan->download }}
                            </div>
                            <form action="{{ route('sale.store') }}" method="post">
                                @csrf
                                @honeypot
                                <input type="hidden" name="plan" value="{{ $plan->id }}" required>
                                <button type="submit" class="btn btn-danger btn-block">
                                    @lang('transFront.buy')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
