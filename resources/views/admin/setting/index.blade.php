@extends('admin.layouts.app')
@section('title') @lang('transAdmin.settings') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h3 mb-0">@lang('transAdmin.settings')</div>
    </div>

    <table class="table shadow table-bordered table-striped table-hover table-md bg-white my-4">
        <thead>
        <tr>
            <th>@lang('transAdmin.image')</th>
            <th>@lang('transAdmin.name')</th>
            <th><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                @if($obj[0]->setting)
                    <img src="{{ Storage::disk('local')->url($obj[0]->setting) }}"
                         alt="{{ $obj[0]->setting }}"
                         class="img-fluid img-max border">
                @else
                    <img src="{{ asset('img/temp/setting.png') }}" alt="@lang('transAdmin.not-found')"
                         class="img-fluid img-max border">
                @endif
            </td>
            <td>
                <div class="mb-1">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM"
                         class="border"> {{ $obj[1]->setting }}
                </div>
                <div class="mb-1">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="RUS"
                         class="border"> {{ $obj[2]->setting }}
                </div>
                <div>
                    <img src="{{ asset('img/flag/eng.png') }}" alt="ENG"
                         class="border"> {{ $obj[3]->setting }}
                </div>
            </td>
            <td>
                <a href="{{ route('admin.settings.edit') }}" class="btn btn-outline-success btn-sm mb-1">
                    <i class="fas fa-pen"></i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
@endsection