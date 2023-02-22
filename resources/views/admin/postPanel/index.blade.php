@extends('admin.layouts.app')
@section('title') @lang('transAdmin.post-panel') @endsection
@section('content')
    <script type="text/javascript" src="{{ asset('js/Chart.bundle.min.js') }}"></script>

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
        <div class="h3 mb-0">@lang('transAdmin.post-panel')</div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.posts')
                        <span class="text-secondary">
                            (1 @lang('transAdmin.year') - <span class="text-danger">{{ $daysByViewed->sum('count') }}
                                @lang('transAdmin.viewed')</span>)
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
        </div>
        <div class="col-md-6">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.posts')
                        <span class="text-secondary">
                            (1 @lang('transAdmin.year') - <span class="text-danger">{{ $monthsByViewed->sum('count') }}
                                @lang('transAdmin.viewed')</span>)
                        </span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="myChart2" width="100" height="65"></canvas>
                </div>
            </div>
            <script>
                new Chart(document.getElementById("myChart2"), {
                    type: 'bar',
                    data: {
                        labels: [@foreach($monthsByViewed as $obj)"{{ $obj->month(date('n', strtotime($obj->name))) }}",@endforeach],
                        datasets: [{
                            data: [@foreach($monthsByViewed as $obj)"{{ $obj->count }}",@endforeach],
                            backgroundColor: ['#E57373', '#64B5F6', '#DCE775', '#81C784', '#BA68C8', '#FFB74D', '#4DD0E1', '#F06292', '#A1887F', '#FFD54F', '#E57373', '#64B5F6', '#DCE775', '#81C784'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {legend: false, scales: {yAxes: [{ticks: {beginAtZero: true}}]},},
                });
            </script>
        </div>
    </div>
@endsection