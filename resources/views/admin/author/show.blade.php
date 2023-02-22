@extends('admin.layouts.app')
@section('title') @lang('transAdmin.authors') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.authors.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.authors')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.show')
        </div>

        <div>
            <a href="{{ route('admin.authors.edit', $obj->id) }}" class="btn btn-outline-success btn-sm mb-1">
                <i class="fas fa-pen"></i>
            </a>

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
                            <form action="{{ route('admin.authors.delete', $obj->id) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">@lang('transAdmin.cancel')</button>
                                <button type="submit" class="btn btn-dark btn-sm">@lang('transAdmin.delete')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow my-4">
        <div class="card-body p-0">
            <table class="table table-striped table-md mb-0">
                <tbody>
                <tr>
                    <td class="w-25 text-secondary">@lang('transAdmin.image')</td>
                    <td>
                        @if($obj->image)
                            <img src="{{ Storage::disk('local')->url($obj->image) }}"
                                 alt="{{ $obj->image }}"
                                 class="img-fluid img-max border">
                        @else
                            <img src="{{ asset('img/temp/author.png') }}" alt="@lang('transAdmin.not-found')"
                                 class="img-fluid img-max border">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.name')</td>
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
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.job')</td>
                    <td>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM"
                                 class="border"> {!! $obj->job_tm !!}
                        </div>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/rus.png') }}" alt="RUS"
                                 class="border"> {!! $obj->job_ru !!}
                        </div>
                        <div>
                            <img src="{{ asset('img/flag/eng.png') }}" alt="ENG"
                                 class="border"> {!! $obj->job_en !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.status')</td>
                    <td>
                        <span class="badge {{ $obj->active == 1 ? 'badge-info' : 'badge-dark' }}">
                            {{ $obj->active == 1 ? trans('transAdmin.enable'):trans('transAdmin.disable') }}
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection