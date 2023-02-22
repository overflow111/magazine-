@extends('admin.layouts.app')
@section('title') @lang('transAdmin.posts') @endsection
@section('content')
    <script type="text/javascript" src="{{ asset('js/amcharts/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/serial.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/light.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/lang/tm.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/lang/ru.js') }}"></script>
    <style>
        .chart-serial {
            position: relative;
            height: 25rem;
            width: 100%;
        }

        .amcharts-chart-div a {
            display: none !important;
        }
    </style>

    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.posts.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.posts')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.show')
        </div>

        <div>
            <a href="{{ route('admin.posts.edit', $obj->id) }}" class="btn btn-outline-success btn-sm mb-1">
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
                                "{{ $obj->getTitle() }}" @lang('transAdmin.are-you-sure-want-to-delete')
                                <div class="mt-2 small">
                                    <span class="text-danger font-weight-bold">@lang('transAdmin.be-carefully')</span>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <form action="{{ route('admin.posts.delete', $obj->id) }}" method="post">
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
        <div class="card-header py-3">
            <div class="h6 mb-0">
                @lang('transAdmin.posts')
                <span class="text-secondary">
                    (1 @lang('transAdmin.year') - <span
                        class="text-danger">{{ $daysByViewed->sum('count') }} @lang('transAdmin.viewed')</span>)
                </span>
            </div>
        </div>
        <div class="card-body p-2">
            <script>
                var chartData2 = chartData2();
                var chart2 = AmCharts.makeChart("chartSerial2", {
                    "type": "serial",
                    "theme": "light",
                    @if(app()->getLocale() == 'tm')
                    "language": "tm",
                    @elseif(app()->getLocale() == 'ru')
                    "language": "ru",
                    @endif
                    "autoMarginOffset": 10,
                    "marginTop": 15,
                    "dataProvider": chartData2,
                    "valueAxes": [{"axisAlpha": 0.2, "dashLength": 1, "position": "left"}],
                    "mouseWheelZoomEnabled": true,
                    "graphs": [{
                        "id": "g1",
                        "balloonText": "[[value]]",
                        "bullet": "round",
                        "bulletBorderAlpha": 1,
                        "bulletColor": "#FFFFFF",
                        "hideBulletsCount": 50,
                        "valueField": "countA",
                        "useLineColorForBulletBorder": true,
                        "balloon": {
                            "drop": true
                        }
                    }],
                    "chartScrollbar": {
                        "autoGridCount": true,
                        "graph": "g1",
                        "scrollbarHeight": 40
                    },
                    "chartCursor": {
                        "limitToGraph": "g1"
                    },
                    "categoryField": "date",
                    "categoryAxis": {
                        "parseDates": true,
                        "axisColor": "#DADADA",
                        "dashLength": 1,
                        "minorGridEnabled": true
                    }
                });
                chart2.addListener("rendered", zoomchart2);
                zoomchart2();

                function zoomchart2() {
                    chart2.zoomToIndexes(chartData2.length - 40, chartData2.length - 1);
                }

                function chartData2() {
                    var chartData2 = [];
                        @foreach($daysByViewed as $day)
                    var $date = new Date('{{ substr($day->day, 0, 10) }}');
                    var $countA = parseInt({{ $day->count }});
                    chartData2.push({
                        date: $date,
                        countA: $countA,
                    });
                    @endforeach
                        return chartData2;
                }
            </script>
            <div id="chartSerial2" class="chart-serial w-100"></div>
        </div>
    </div>

    <div class="card shadow my-4">
        <div class="card-body p-0">
            <table class="table table-striped table-md mb-0">
                <tbody>
                <tr>
                    <td class="w-25 text-secondary">@lang('transAdmin.images')</td>
                    <td>
                        @forelse($obj->images as $image)
                            <div class="d-inline-block">
                                <a href="{{ route('admin.posts.images.delete', $image->id) }}"
                                   class="btn btn-light btn-sm position-absolute m-1 py-0 px-1">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <img src="{{ Storage::disk('local')->url('sm/' . $image->image) }}"
                                     alt="{{ $image->image }}"
                                     class="img-fluid img-max {{ $image->image == $obj->image ? 'border-danger':'border'}} mb-1">
                            </div>
                        @empty
                            <img src="{{ asset('img/temp/post-sm.png') }}" alt="@lang('transAdmin.not-found')"
                                 class="img-fluid img-max border">
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.title')</td>
                    <td>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM"
                                 class="border"> {{ $obj->title_tm }}
                        </div>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/rus.png') }}" alt="RUS"
                                 class="border"> {{ $obj->title_ru }}
                        </div>
                        <div>
                            <img src="{{ asset('img/flag/eng.png') }}" alt="ENG"
                                 class="border"> {{ $obj->title_en }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.author')</td>
                    <td>{{ $obj->author->getName() }}</td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.category')</td>
                    <td>{{ $obj->category->getName() }}</td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.body')</td>
                    <td>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM"
                                 class="border"> {!! $obj->body_tm !!}
                        </div>
                        <div class="mb-1">
                            <img src="{{ asset('img/flag/rus.png') }}" alt="RUS"
                                 class="border"> {!! $obj->body_ru !!}
                        </div>
                        <div>
                            <img src="{{ asset('img/flag/eng.png') }}" alt="ENG"
                                 class="border"> {!! $obj->body_en !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.published-at')</td>
                    <td>{{ date('Y-m-d H:i', strtotime($obj->published_at)) }}</td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.main')</td>
                    <td>
                        @if($obj->main)
                            <i class="fas fa-check text-secondary"></i>
                        @else
                            <i class="fas fa-times text-secondary"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.recommended')</td>
                    <td>
                        @if($obj->recommended)
                            <i class="fas fa-check text-secondary"></i>
                        @else
                            <i class="fas fa-times text-secondary"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.viewed')</td>
                    <td>{{ $obj->viewed }} <span class="small text-secondary">@lang('transAdmin.viewed')</span></td>
                </tr>
                <tr>
                    <td class="text-secondary">@lang('transAdmin.status')</td>
                    <td>
                        <span class="badge {{ $obj->active == 1 ? 'badge-info' : 'badge-dark' }}">
                            {{ $obj->active == 1 ? trans('transAdmin.enable'):trans('transAdmin.disable') }}
                        </span>
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
@endsection