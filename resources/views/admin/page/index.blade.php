@extends('admin.layouts.app')
@section('title') @lang('transAdmin.pages') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h3 mb-0">@lang('transAdmin.pages')</div>
    </div>

    <table class="table shadow table-bordered table-striped table-hover table-md bg-white my-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>@lang('transAdmin.body')</th>
            <th><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        @forelse($objs as $obj)
            <tr>
                <td>#{{ $obj->id }}</td>
                <td>{!! $obj->getBody() !!}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', $obj->id) }}" class="btn btn-outline-success btn-sm mb-1">
                        <i class="fas fa-pen"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center bg-light text-secondary">
                    <i class="fas fa-exclamation-circle"></i> @lang('transAdmin.page') @lang('transAdmin.not-found')
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection