@extends('admin.layouts.app')
@section('title') @lang('transAdmin.user-agents') @endsection
@section('content')
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.mark.js') }}"></script>

    <div class="d-flex align-items-center justify-content-between">
        <div class="h3 mb-0">@lang('transAdmin.user-agents')</div>
    </div>

    <div class="my-4">
        <input type="text" class="form-control form-control-lg mb-2 text-danger" id="customSearchBox"
               placeholder="@lang('transAdmin.search')..." autofocus>
        <table class="table shadow table-bordered table-striped table-hover table-md bg-white" id="dt-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>@lang('transAdmin.user-agent')</th>
                <th>@lang('transAdmin.device')</th>
                <th>@lang('transAdmin.platform')</th>
                <th>@lang('transAdmin.browser')</th>
                <th>@lang('transAdmin.robot')</th>
                <th>@lang('transAdmin.status')</th>
            </tr>
            </thead>
        </table>
    </div>
    <style>
        #dt-table_length, #dt-table_filter {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            var table = $('#dt-table').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [10],
                ajax: {
                    url: "{{ route('admin.user-agents.api') }}",
                    dataType: "json",
                    type: "POST",
                    data: {"_token": "{{ csrf_token() }}"}
                },
                columns: [
                    {data: 'id'},
                    {data: 'user_agent'},
                    {data: 'device'},
                    {data: 'platform'},
                    {data: 'browser'},
                    {data: 'robot'},
                    {data: 'disabled', searchable :false},
                ],
                order: [[0, 'desc']],
                mark: true,
                "language": {
                    @if(app()->getLocale() == 'tm')
                    "url": "{{ asset('js/datatables/tm.json') }}",
                    @elseif(app()->getLocale() == 'ru')
                    "url": "{{ asset('js/datatables/ru.json') }}",
                    @endif
                }
            });

            var csb = document.getElementById('customSearchBox');
            var csbTimeout = null;
            csb.onkeyup = function (e) {
                var that = this;
                clearTimeout(csbTimeout);
                csbTimeout = setTimeout(function () {
                    if (table.search() !== that.value) {
                        table.search(that.value).draw();
                    }
                }, 500);
            };
        });
    </script>
@endsection