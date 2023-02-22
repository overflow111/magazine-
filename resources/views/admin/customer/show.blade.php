@extends('admin.layouts.app')
@section('title') @lang('transAdmin.customers') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.customers.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.customers')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.show')
        </div>

        <div>
            <a href="{{ route('admin.customers.edit', $obj->id) }}" class="btn btn-outline-success btn-sm mb-1">
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
                            <form action="{{ route('admin.customers.delete', $obj->id) }}" method="post">
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
                    <td class="w-25 text-secondary">@lang('transAdmin.name')</td>
                    <td>{{ $obj->name }}</td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.surname')</td>
                    <td>{{ $obj->surname }}</td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.email')</td>
                    <td>{{ $obj->email }}</td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.username')</td>
                    <td>
                        <a class="text-dark" href="tel:+993{{ $obj->username }}"
                           title="+993{{ $obj->username }}">
                            <i class="fas fa-mobile-alt text-gray-500"></i>
                            {{ $obj->username }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.created-at')</td>
                    <td>{{ date('Y-m-d H:i', strtotime($obj->created_at)) }}
                        - {{ date('Y-m-d H:i', strtotime($obj->updated_at)) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow my-4">
        <div class="card-body p-0">
            <table class="table table-striped table-md mb-0">
                <tbody>
                <tr>
                    <td class="w-25 text-secondary">@lang('transAdmin.sales')</td>
                    <td>
                        @forelse($obj->sales as $sale)
                            <div class="my-1">
                                <a href="{{ route('admin.sales.show', $sale->id) }}"
                                   class="text-danger font-weight-bold">
                                    {{ $sale->getName() }}
                                </a>
                                &nbsp;
                                {{ date('Y-m-d H:i', strtotime($sale->created_at)) }}
                                &nbsp;
                                <span class="text-danger font-weight-bold">
                                    {{ number_format((float)$sale->price, 2, '.', '') }}
                                    <small>TMT</small>
                                </span>
                                &nbsp;
                                {{ $sale->status() }}
                                {!! $sale->icon() !!}
                            </div>
                        @empty
                            <div class="text-secondary">
                                <i class="fas fa-exclamation-circle"></i> @lang('transAdmin.sale') @lang('transAdmin.not-found')
                            </div>
                        @endforelse
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow my-4">
        <div class="card-body p-0">
            <table class="table table-striped table-md mb-0">
                <tbody>
                <tr>
                    <td class="w-25 text-secondary">@lang('transAdmin.magazines')</td>
                    <td>
                        @forelse($obj->buys as $buy)
                            <div class="my-1">
                                <a href="{{ route('admin.magazines.show', $buy->magazine->id) }}"
                                   class="text-dark">
                                    {{ $buy->magazine->getTitle() }}
                                </a>
                            </div>
                        @empty
                            <div class="text-secondary">
                                <i class="fas fa-exclamation-circle"></i> @lang('transAdmin.magazine') @lang('transAdmin.not-found')
                            </div>
                        @endforelse
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection