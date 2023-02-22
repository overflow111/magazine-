@extends('front.layouts.app')
@section('title')@lang('transFront.my-plans') | @lang('transFront.app-name')@endsection
@section('keywords')@lang('transFront.my-plans')@endsection
@section('image'){{ asset('img/syyahat.jpg') }}@endsection
@section('content')
    <div class="container-lg py-3 py-sm-4">
        <div class="h4 border-bottom pb-2 pb-sm-3 mb-2 mb-sm-3">
            @lang('transFront.my-plans')
        </div>
        @if($sales->count() > 0)
            <table class="table shadow table-bordered table-striped table-hover table-sm bg-white">
                <thead>
                <tr>
                    <th class="font-weight-bold">@lang('transAdmin.month')</th>
                    <th class="font-weight-bold">@lang('transAdmin.date-end')</th>
                    <th class="font-weight-bold">@lang('transAdmin.price')</th>
                    <th class="font-weight-bold">@lang('transAdmin.status')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->plan_month }}</td>
                        <td>{{ date('Y-m-d', strtotime($sale->date_end)) }}</td>
                        <td class="h5">
                            {!! number_format((float)$sale->price, 2, '.', '') !!}
                            <small>TMT</small>
                        </td>
                        <td>{{ $sale->status() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            @component('front.app.not_found')
                @lang('transAdmin.plan')
            @endcomponent
        @endif
        @if($sales->hasPages())
            <div class="pt-2 pt-sm-3" data-aos-once="true" data-aos="zoom-in-up">
                {{ $sales->links() }}
            </div>
        @endif
    </div>
@endsection
