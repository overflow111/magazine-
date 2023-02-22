@extends('admin.layouts.app')
@section('title') @lang('transAdmin.plans') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h3 mb-0">@lang('transAdmin.plans')</div>
        <a href="{{ route('admin.plans.create') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-plus"></i> @lang('transAdmin.plan')
        </a>
    </div>

    <table class="table shadow table-bordered table-striped table-hover table-md bg-white my-4">
        <thead>
        <tr>
            <th>@lang('transAdmin.name')</th>
            <th>@lang('transAdmin.month')</th>
            <th>@lang('transAdmin.magazine')</th>
            <th>@lang('transAdmin.price')</th>
            <th>@lang('transAdmin.status')</th>
            <th><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        @forelse($objs as $obj)
            <tr>
                <td>
                    <div class="mb-1">
                        <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM"
                             class="border"> {{ $obj->name_tm }}
                    </div>
                    <div class="mb-1">
                        <img src="{{ asset('img/flag/rus.png') }}" alt="RUS"
                             class="border"> {{ $obj->name_ru }}
                    </div>
                    <div>
                        <img src="{{ asset('img/flag/eng.png') }}" alt="ENG"
                             class="border"> {{ $obj->name_en }}
                    </div>
                </td>
                <td>
                    {{ $obj->month }}
                </td>
                <td>
                    {{ $obj->download }}
                </td>
                <td class="text-danger font-weight-bold">
                    {!! number_format((float)$obj->price, 2, '.', '') !!}
                    <small>TMT</small>
                </td>
                <td>
                    <span class="badge {{ $obj->active == 1 ? 'badge-info' : 'badge-dark' }}">
                        {{ $obj->active == 1 ? trans('transAdmin.enable'):trans('transAdmin.disable') }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.plans.edit', $obj->id) }}" class="btn btn-outline-success btn-sm mb-1">
                        <i class="fas fa-pen"></i>
                    </a>
                    <br>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-dark btn-sm mb-1" data-toggle="modal"
                            data-target="#d{{ $obj->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="d{{ $obj->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div>
                                        "{{ $obj->getName() }}" @lang('transAdmin.are-you-sure-want-to-delete')
                                        <div class="mt-2 small">
                                            <span class="text-danger font-weight-bold">@lang('transAdmin.be-carefully')</span>
                                        </div>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-right">
                                    <form action="{{ route('admin.plans.delete', $obj->id) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">@lang('transAdmin.cancel')</button>
                                        <button type="submit" class="btn btn-dark btn-sm">@lang('transAdmin.delete')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center bg-light text-secondary">
                    <i class="fas fa-exclamation-circle"></i> @lang('transAdmin.plan') @lang('transAdmin.not-found')
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection