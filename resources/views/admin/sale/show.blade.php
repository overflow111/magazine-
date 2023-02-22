@extends('admin.layouts.app')
@section('title') @lang('transAdmin.sales') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.sales.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.sales')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.show')
        </div>
    </div>

    <div class="card shadow my-4">
        <div class="card-body p-0">
            <table class="table table-striped table-md mb-0">
                <tbody>
                <tr>
                    <td class="w-25 text-secondary">@lang('transAdmin.name')</td>
                    <td class="text-danger font-weight-bold">{{ $obj->getName() }}</td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.customer')</td>
                    <td class="p-1">
                        <table class="table table-bordered table-sm mb-0">
                            <tbody>
                            <tr>
                                <td class="w-25 text-secondary">@lang('transAdmin.name')</td>
                                <td>{{ $obj->customer_name }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.surname')</td>
                                <td>{{ $obj->customer_surname }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.email')</td>
                                <td>{{ $obj->customer_email }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.username')</td>
                                <td>
                                    <a class="text-dark" href="tel:+993{{ $obj->customer_username }}"
                                       title="+993{{ $obj->customer_username }}">
                                        <i class="fas fa-mobile-alt text-gray-500"></i>
                                        {{ $obj->customer_username }}
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.plan')</td>
                    <td class="p-1">
                        <table class="table table-bordered table-sm mb-0">
                            <tbody>
                            <tr>
                                <td class="w-25 text-secondary">@lang('transAdmin.name')</td>
                                <td>{{ $obj->plan->getName() }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.month')</td>
                                <td>{{ $obj->plan_month }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.magazine')</td>
                                <td>{{ $obj->plan_download }} <span class="text-secondary">(@lang('transAdmin.downloaded'): {{ $obj->downloaded }})</span></td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.date-start')</td>
                                <td>{{ date('Y-m-d', strtotime($obj->date_start)) }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.date-end')</td>
                                <td>{{ date('Y-m-d', strtotime($obj->date_end)) }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">@lang('transAdmin.price')</td>
                                <td class="text-danger font-weight-bold">
                                    {!! number_format((float)$obj->price, 2, '.', '') !!}
                                    <small>TMT</small>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.status')</td>
                    <td>
                        {{ $obj->status() }} {!! $obj->icon() !!}
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