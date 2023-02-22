@extends('admin.layouts.app')
@section('title') @lang('transAdmin.visitor-panel') @endsection
@section('content')
    <script type="text/javascript" src="{{ asset('js/Chart.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/ammap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/worldLow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/serial.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/light.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/lang/tm.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/amcharts/lang/ru.js') }}"></script>

    <div class="d-flex align-items-center justify-content-between">
        <div class="h3 mb-0">@lang('transAdmin.visitor-panel')</div>
        <div class="d-inline-flex">
            <div class="dropdown">
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dmb2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    {{ $robot ? trans('transAdmin.robot') : trans('transAdmin.human') }}
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dmb2">
                    <a class="dropdown-item"
                       href="{{ route('admin.visitor-panel', ['robot' => 0]) }}">
                        @lang('transAdmin.human')
                    </a>
                    <a class="dropdown-item"
                       href="{{ route('admin.visitor-panel', ['robot' => 1]) }}">
                        @lang('transAdmin.robot')
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-md-12">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.recent-visitors')
                        <span class="text-secondary">
                            (1 @lang('transAdmin.week') - {{ $maps->sum('count') }} @lang('transAdmin.visitor'))
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Styles -->
                    <style>
                        #chartMap {
                            width: 100%;
                        }

                        .amcharts-chart-div a {
                            display: none !important;
                        }
                    </style>
                    <!-- Chart code -->
                    <script>
                        var latlong = {};
                        latlong["A1"] = {"latitude": 40, "longitude": 60};
                        latlong["A2"] = {"latitude": 40, "longitude": 60};
                        latlong["O1"] = {"latitude": 40, "longitude": 60};
                        latlong["AD"] = {"latitude": 42.5, "longitude": 1.5};
                        latlong["AE"] = {"latitude": 24, "longitude": 54};
                        latlong["AF"] = {"latitude": 33, "longitude": 65};
                        latlong["AG"] = {"latitude": 17.05, "longitude": -61.8};
                        latlong["AI"] = {"latitude": 18.25, "longitude": -63.1667};
                        latlong["AL"] = {"latitude": 41, "longitude": 20};
                        latlong["AM"] = {"latitude": 40, "longitude": 45};
                        latlong["AN"] = {"latitude": 12.25, "longitude": -68.75};
                        latlong["AO"] = {"latitude": -12.5, "longitude": 18.5};
                        latlong["AP"] = {"latitude": 35, "longitude": 105};
                        latlong["AQ"] = {"latitude": -90, "longitude": 0};
                        latlong["AR"] = {"latitude": -34, "longitude": -64};
                        latlong["AS"] = {"latitude": -14.3333, "longitude": -170};
                        latlong["AT"] = {"latitude": 47.3333, "longitude": 13.3333};
                        latlong["AU"] = {"latitude": -27, "longitude": 133};
                        latlong["AW"] = {"latitude": 12.5, "longitude": -69.9667};
                        latlong["AZ"] = {"latitude": 40.5, "longitude": 47.5};
                        latlong["BA"] = {"latitude": 44, "longitude": 18};
                        latlong["BB"] = {"latitude": 13.1667, "longitude": -59.5333};
                        latlong["BD"] = {"latitude": 24, "longitude": 90};
                        latlong["BE"] = {"latitude": 50.8333, "longitude": 4};
                        latlong["BF"] = {"latitude": 13, "longitude": -2};
                        latlong["BG"] = {"latitude": 43, "longitude": 25};
                        latlong["BH"] = {"latitude": 26, "longitude": 50.55};
                        latlong["BI"] = {"latitude": -3.5, "longitude": 30};
                        latlong["BJ"] = {"latitude": 9.5, "longitude": 2.25};
                        latlong["BL"] = {"latitude": 17.89, "longitude": -62.84}; //
                        latlong["BM"] = {"latitude": 32.3333, "longitude": -64.75};
                        latlong["BN"] = {"latitude": 4.5, "longitude": 114.6667};
                        latlong["BO"] = {"latitude": -17, "longitude": -65};
                        latlong["BQ"] = {"latitude": 12.15, "longitude": -68.266}; //
                        latlong["BR"] = {"latitude": -10, "longitude": -55};
                        latlong["BS"] = {"latitude": 24.25, "longitude": -76};
                        latlong["BT"] = {"latitude": 27.5, "longitude": 90.5};
                        latlong["BV"] = {"latitude": -54.4333, "longitude": 3.4};
                        latlong["BW"] = {"latitude": -22, "longitude": 24};
                        latlong["BY"] = {"latitude": 53, "longitude": 28};
                        latlong["BZ"] = {"latitude": 17.25, "longitude": -88.75};
                        latlong["CA"] = {"latitude": 54, "longitude": -100};
                        latlong["CC"] = {"latitude": -12.5, "longitude": 96.8333};
                        latlong["CD"] = {"latitude": 0, "longitude": 25};
                        latlong["CF"] = {"latitude": 7, "longitude": 21};
                        latlong["CG"] = {"latitude": -1, "longitude": 15};
                        latlong["CH"] = {"latitude": 47, "longitude": 8};
                        latlong["CI"] = {"latitude": 8, "longitude": -5};
                        latlong["CK"] = {"latitude": -21.2333, "longitude": -159.7667};
                        latlong["CL"] = {"latitude": -30, "longitude": -71};
                        latlong["CM"] = {"latitude": 6, "longitude": 12};
                        latlong["CN"] = {"latitude": 35, "longitude": 105};
                        latlong["CO"] = {"latitude": 4, "longitude": -72};
                        latlong["CR"] = {"latitude": 10, "longitude": -84};
                        latlong["CU"] = {"latitude": 21.5, "longitude": -80};
                        latlong["CV"] = {"latitude": 16, "longitude": -24};
                        latlong["CW"] = {"latitude": 12.5246, "longitude": -70.0265};
                        latlong["CX"] = {"latitude": -10.5, "longitude": 105.6667};
                        latlong["CY"] = {"latitude": 35, "longitude": 33};
                        latlong["CZ"] = {"latitude": 49.75, "longitude": 15.5};
                        latlong["DE"] = {"latitude": 51, "longitude": 9};
                        latlong["DJ"] = {"latitude": 11.5, "longitude": 43};
                        latlong["DK"] = {"latitude": 56, "longitude": 10};
                        latlong["DM"] = {"latitude": 15.4167, "longitude": -61.3333};
                        latlong["DO"] = {"latitude": 19, "longitude": -70.6667};
                        latlong["DZ"] = {"latitude": 28, "longitude": 3};
                        latlong["EC"] = {"latitude": -2, "longitude": -77.5};
                        latlong["EE"] = {"latitude": 59, "longitude": 26};
                        latlong["EG"] = {"latitude": 27, "longitude": 30};
                        latlong["EH"] = {"latitude": 24.5, "longitude": -13};
                        latlong["ER"] = {"latitude": 15, "longitude": 39};
                        latlong["ES"] = {"latitude": 40, "longitude": -4};
                        latlong["ET"] = {"latitude": 8, "longitude": 38};
                        latlong["EU"] = {"latitude": 47, "longitude": 8};
                        latlong["FI"] = {"latitude": 62, "longitude": 26};
                        latlong["FJ"] = {"latitude": -18, "longitude": 175};
                        latlong["FK"] = {"latitude": -51.75, "longitude": -59};
                        latlong["FM"] = {"latitude": 6.9167, "longitude": 158.25};
                        latlong["FO"] = {"latitude": 62, "longitude": -7};
                        latlong["FR"] = {"latitude": 46, "longitude": 2};
                        latlong["GA"] = {"latitude": -1, "longitude": 11.75};
                        latlong["GB"] = {"latitude": 54, "longitude": -2};
                        latlong["GD"] = {"latitude": 12.1167, "longitude": -61.6667};
                        latlong["GE"] = {"latitude": 42, "longitude": 43.5};
                        latlong["GF"] = {"latitude": 4, "longitude": -53};
                        latlong["GG"] = {"latitude": 49.2, "longitude": -2.5}; //
                        latlong["GH"] = {"latitude": 8, "longitude": -2};
                        latlong["GI"] = {"latitude": 36.1833, "longitude": -5.3667};
                        latlong["GL"] = {"latitude": 72, "longitude": -40};
                        latlong["GM"] = {"latitude": 13.4667, "longitude": -16.5667};
                        latlong["GN"] = {"latitude": 11, "longitude": -10};
                        latlong["GP"] = {"latitude": 16.25, "longitude": -61.5833};
                        latlong["GQ"] = {"latitude": 2, "longitude": 10};
                        latlong["GR"] = {"latitude": 39, "longitude": 22};
                        latlong["GS"] = {"latitude": -54.5, "longitude": -37};
                        latlong["GT"] = {"latitude": 15.5, "longitude": -90.25};
                        latlong["GU"] = {"latitude": 13.4667, "longitude": 144.7833};
                        latlong["GW"] = {"latitude": 12, "longitude": -15};
                        latlong["GY"] = {"latitude": 5, "longitude": -59};
                        latlong["HK"] = {"latitude": 22.25, "longitude": 114.1667};
                        latlong["HM"] = {"latitude": -53.1, "longitude": 72.5167};
                        latlong["HN"] = {"latitude": 15, "longitude": -86.5};
                        latlong["HR"] = {"latitude": 45.1667, "longitude": 15.5};
                        latlong["HT"] = {"latitude": 19, "longitude": -72.4167};
                        latlong["HU"] = {"latitude": 47, "longitude": 20};
                        latlong["ID"] = {"latitude": -5, "longitude": 120};
                        latlong["IE"] = {"latitude": 53, "longitude": -8};
                        latlong["IL"] = {"latitude": 31.5, "longitude": 34.75};
                        latlong["IN"] = {"latitude": 20, "longitude": 77};
                        latlong["IO"] = {"latitude": -6, "longitude": 71.5};
                        latlong["IQ"] = {"latitude": 33, "longitude": 44};
                        latlong["IR"] = {"latitude": 32, "longitude": 53};
                        latlong["IS"] = {"latitude": 65, "longitude": -18};
                        latlong["IT"] = {"latitude": 42.8333, "longitude": 12.8333};
                        latlong["JM"] = {"latitude": 18.25, "longitude": -77.5};
                        latlong["JO"] = {"latitude": 31, "longitude": 36};
                        latlong["JP"] = {"latitude": 36, "longitude": 138};
                        latlong["KE"] = {"latitude": 1, "longitude": 38};
                        latlong["KG"] = {"latitude": 41, "longitude": 75};
                        latlong["KH"] = {"latitude": 13, "longitude": 105};
                        latlong["KI"] = {"latitude": 1.4167, "longitude": 173};
                        latlong["KM"] = {"latitude": -12.1667, "longitude": 44.25};
                        latlong["KN"] = {"latitude": 17.3333, "longitude": -62.75};
                        latlong["KP"] = {"latitude": 40, "longitude": 127};
                        latlong["KR"] = {"latitude": 37, "longitude": 127.5};
                        latlong["KW"] = {"latitude": 29.3375, "longitude": 47.6581};
                        latlong["KY"] = {"latitude": 19.5, "longitude": -80.5};
                        latlong["KZ"] = {"latitude": 48, "longitude": 68};
                        latlong["LA"] = {"latitude": 18, "longitude": 105};
                        latlong["LB"] = {"latitude": 33.8333, "longitude": 35.8333};
                        latlong["LC"] = {"latitude": 13.8833, "longitude": -61.1333};
                        latlong["LI"] = {"latitude": 47.1667, "longitude": 9.5333};
                        latlong["LK"] = {"latitude": 7, "longitude": 81};
                        latlong["LR"] = {"latitude": 6.5, "longitude": -9.5};
                        latlong["LS"] = {"latitude": -29.5, "longitude": 28.5};
                        latlong["LT"] = {"latitude": 55, "longitude": 24};
                        latlong["LU"] = {"latitude": 49.75, "longitude": 6};
                        latlong["LV"] = {"latitude": 57, "longitude": 25};
                        latlong["LY"] = {"latitude": 25, "longitude": 17};
                        latlong["MA"] = {"latitude": 32, "longitude": -5};
                        latlong["MC"] = {"latitude": 43.7333, "longitude": 7.4};
                        latlong["MD"] = {"latitude": 47, "longitude": 29};
                        latlong["ME"] = {"latitude": 42.5, "longitude": 19.4};
                        latlong["MF"] = {"latitude": 18.5, "longitude": 63.5}; //
                        latlong["MG"] = {"latitude": -20, "longitude": 47};
                        latlong["MH"] = {"latitude": 9, "longitude": 168};
                        latlong["MK"] = {"latitude": 41.8333, "longitude": 22};
                        latlong["ML"] = {"latitude": 17, "longitude": -4};
                        latlong["MM"] = {"latitude": 22, "longitude": 98};
                        latlong["MN"] = {"latitude": 46, "longitude": 105};
                        latlong["MO"] = {"latitude": 22.1667, "longitude": 113.55};
                        latlong["MP"] = {"latitude": 15.2, "longitude": 145.75};
                        latlong["MQ"] = {"latitude": 14.6667, "longitude": -61};
                        latlong["MR"] = {"latitude": 20, "longitude": -12};
                        latlong["MS"] = {"latitude": 16.75, "longitude": -62.2};
                        latlong["MT"] = {"latitude": 35.8333, "longitude": 14.5833};
                        latlong["MU"] = {"latitude": -20.2833, "longitude": 57.55};
                        latlong["MV"] = {"latitude": 3.25, "longitude": 73};
                        latlong["MW"] = {"latitude": -13.5, "longitude": 34};
                        latlong["MX"] = {"latitude": 23, "longitude": -102};
                        latlong["MY"] = {"latitude": 2.5, "longitude": 112.5};
                        latlong["MZ"] = {"latitude": -18.25, "longitude": 35};
                        latlong["NA"] = {"latitude": -22, "longitude": 17};
                        latlong["NC"] = {"latitude": -21.5, "longitude": 165.5};
                        latlong["NE"] = {"latitude": 16, "longitude": 8};
                        latlong["NF"] = {"latitude": -29.0333, "longitude": 167.95};
                        latlong["NG"] = {"latitude": 10, "longitude": 8};
                        latlong["NI"] = {"latitude": 13, "longitude": -85};
                        latlong["NL"] = {"latitude": 52.5, "longitude": 5.75};
                        latlong["NO"] = {"latitude": 62, "longitude": 10};
                        latlong["NP"] = {"latitude": 28, "longitude": 84};
                        latlong["NR"] = {"latitude": -0.5333, "longitude": 166.9167};
                        latlong["NU"] = {"latitude": -19.0333, "longitude": -169.8667};
                        latlong["NZ"] = {"latitude": -41, "longitude": 174};
                        latlong["OM"] = {"latitude": 21, "longitude": 57};
                        latlong["PA"] = {"latitude": 9, "longitude": -80};
                        latlong["PE"] = {"latitude": -10, "longitude": -76};
                        latlong["PF"] = {"latitude": -15, "longitude": -140};
                        latlong["PG"] = {"latitude": -6, "longitude": 147};
                        latlong["PH"] = {"latitude": 13, "longitude": 122};
                        latlong["PK"] = {"latitude": 30, "longitude": 70};
                        latlong["PL"] = {"latitude": 52, "longitude": 20};
                        latlong["PM"] = {"latitude": 46.8333, "longitude": -56.3333};
                        latlong["PN"] = {"latitude": -24.7, "longitude": -127.4}; //
                        latlong["PR"] = {"latitude": 18.25, "longitude": -66.5};
                        latlong["PS"] = {"latitude": 32, "longitude": 35.25};
                        latlong["PT"] = {"latitude": 39.5, "longitude": -8};
                        latlong["PW"] = {"latitude": 7.5, "longitude": 134.5};
                        latlong["PY"] = {"latitude": -23, "longitude": -58};
                        latlong["QA"] = {"latitude": 25.5, "longitude": 51.25};
                        latlong["RE"] = {"latitude": -21.1, "longitude": 55.6};
                        latlong["RO"] = {"latitude": 46, "longitude": 25};
                        latlong["RS"] = {"latitude": 44, "longitude": 21};
                        latlong["RU"] = {"latitude": 60, "longitude": 100};
                        latlong["RW"] = {"latitude": -2, "longitude": 30};
                        latlong["SA"] = {"latitude": 25, "longitude": 45};
                        latlong["SB"] = {"latitude": -8, "longitude": 159};
                        latlong["SC"] = {"latitude": -4.5833, "longitude": 55.6667};
                        latlong["SD"] = {"latitude": 15, "longitude": 30};
                        latlong["SE"] = {"latitude": 62, "longitude": 15};
                        latlong["SG"] = {"latitude": 1.3667, "longitude": 103.8};
                        latlong["SH"] = {"latitude": -15.9333, "longitude": -5.7};
                        latlong["SI"] = {"latitude": 46, "longitude": 15};
                        latlong["SJ"] = {"latitude": 78, "longitude": 20};
                        latlong["SK"] = {"latitude": 48.6667, "longitude": 19.5};
                        latlong["SL"] = {"latitude": 8.5, "longitude": -11.5};
                        latlong["SM"] = {"latitude": 43.7667, "longitude": 12.4167};
                        latlong["SN"] = {"latitude": 14, "longitude": -14};
                        latlong["SO"] = {"latitude": 10, "longitude": 49};
                        latlong["SR"] = {"latitude": 4, "longitude": -56};
                        latlong["SS"] = {"latitude": 4.85, "longitude": 31.6}; //
                        latlong["ST"] = {"latitude": 1, "longitude": 7};
                        latlong["SV"] = {"latitude": 13.8333, "longitude": -88.9167};
                        latlong["SX"] = {"latitude": 18.04, "longitude": 63.05}; //
                        latlong["SY"] = {"latitude": 35, "longitude": 38};
                        latlong["SZ"] = {"latitude": -26.5, "longitude": 31.5};
                        latlong["TC"] = {"latitude": 21.75, "longitude": -71.5833};
                        latlong["TD"] = {"latitude": 15, "longitude": 19};
                        latlong["TF"] = {"latitude": -43, "longitude": 67};
                        latlong["TG"] = {"latitude": 8, "longitude": 1.1667};
                        latlong["TH"] = {"latitude": 15, "longitude": 100};
                        latlong["TJ"] = {"latitude": 39, "longitude": 71};
                        latlong["TK"] = {"latitude": -9, "longitude": -172};
                        latlong["TM"] = {"latitude": 40, "longitude": 60};
                        latlong["TN"] = {"latitude": 34, "longitude": 9};
                        latlong["TO"] = {"latitude": -20, "longitude": -175};
                        latlong["TR"] = {"latitude": 39, "longitude": 35};
                        latlong["TT"] = {"latitude": 11, "longitude": -61};
                        latlong["TV"] = {"latitude": -8, "longitude": 178};
                        latlong["TW"] = {"latitude": 23.5, "longitude": 121};
                        latlong["TZ"] = {"latitude": -6, "longitude": 35};
                        latlong["UA"] = {"latitude": 49, "longitude": 32};
                        latlong["UG"] = {"latitude": 1, "longitude": 32};
                        latlong["UM"] = {"latitude": 19.2833, "longitude": 166.6};
                        latlong["US"] = {"latitude": 38, "longitude": -97};
                        latlong["UY"] = {"latitude": -33, "longitude": -56};
                        latlong["UZ"] = {"latitude": 41, "longitude": 64};
                        latlong["VA"] = {"latitude": 41.9, "longitude": 12.45};
                        latlong["VC"] = {"latitude": 13.25, "longitude": -61.2};
                        latlong["VE"] = {"latitude": 8, "longitude": -66};
                        latlong["VG"] = {"latitude": 18.5, "longitude": -64.5};
                        latlong["VI"] = {"latitude": 18.3333, "longitude": -64.8333};
                        latlong["VN"] = {"latitude": 16, "longitude": 106};
                        latlong["VU"] = {"latitude": -16, "longitude": 167};
                        latlong["WF"] = {"latitude": -13.3, "longitude": -176.2};
                        latlong["WS"] = {"latitude": -13.5833, "longitude": -172.3333};
                        latlong["YE"] = {"latitude": 15, "longitude": 48};
                        latlong["YT"] = {"latitude": -12.8333, "longitude": 45.1667};
                        latlong["ZA"] = {"latitude": -29, "longitude": 24};
                        latlong["ZM"] = {"latitude": -15, "longitude": 30};
                        latlong["ZW"] = {"latitude": -20, "longitude": 30};

                        var colors = ['#FF0F00', '#FF6600', '#FF9E01', '#0D8ECF', '#2A0CD0'];
                        var mapData = [
                                @foreach($maps as $map)
                            {
                                "code": ("{{ $map->country_code }}").toString(),
                                "name": ("{{ $map->country_name }}").toString(),
                                "value": parseInt({{ $map->count }}),
                                "color": colors[Math.floor(Math.random() * colors.length)]
                            },
                            @endforeach
                        ];

                        // get min and max values
                        var minBulletSize = 10;
                        var maxBulletSize = 20;
                        var min = Infinity;
                        var max = -Infinity;
                        for (var i = 0; i < mapData.length; i++) {
                            var value = mapData[i].value;
                            if (value < min) {
                                min = value;
                            }
                            if (value > max) {
                                max = value;
                            }
                        }

                        // it's better to use circle square to show difference between values, not a radius
                        var maxSquare = maxBulletSize * maxBulletSize * 2 * Math.PI;
                        var minSquare = minBulletSize * minBulletSize * 2 * Math.PI;

                        // create circle for each country
                        var images = [];
                        for (var i = 0; i < mapData.length; i++) {
                            var dataItem = mapData[i];
                            var value = dataItem.value;
                            // calculate size of a bubble
                            var square = (value - min) / (max - min) * (maxSquare - minSquare) + minSquare;
                            if (square < minSquare) {
                                square = minSquare;
                            }
                            var size = Math.sqrt(square / (Math.PI * 2));
                            var id = dataItem.code;

                            images.push({
                                "type": "circle",
                                "theme": "light",
                                "width": size,
                                "height": size,
                                "color": dataItem.color,
                                "longitude": latlong[id].longitude,
                                "latitude": latlong[id].latitude,
                                "title": dataItem.name + "<br>" + dataItem.value,
                                "value": value
                            });
                        }
                        // build map
                        var map = AmCharts.makeChart("chartMap", {
                            "type": "map",
                            "projection": "eckert5",
                            "dataProvider": {
                                "map": "worldLow",
                                "images": images
                            }
                        });

                        function setChartMapRatio() {
                            $map = $('#chartMap');
                            $map.css({'height': $map.width() * 0.5});
                        }

                        $(document).ready(function () {
                            setChartMapRatio();
                            $(window).resize(function () {
                                setChartMapRatio();
                            })
                        });
                    </script>

                    <!-- HTML -->
                    <div id="chartMap"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.visitors')
                        <span class="text-secondary">(1 @lang('transAdmin.year') - {{ $days->sum('count') }} @lang('transAdmin.visitor'))</span>
                    </div>
                </div>
                <div class="card-body p-2">
                    <!-- Styles -->
                    <style>
                        .chart-serial {
                            position: relative;
                            height: 12.5rem;
                            width: 100%;
                        }

                        @media (min-width: 768px) {
                            .chart-serial {
                                height: 25rem;
                            }
                        }

                        #chartSerial {
                            width: 100%;
                        }

                        .amcharts-chart-div a {
                            display: none !important;
                        }
                    </style>
                    <!-- Chart code -->
                    <script>
                        var chartData = chartData();
                        var chart = AmCharts.makeChart("chartSerial", {
                            "type": "serial",
                            "theme": "light",
                            @if(app()->getLocale() == 'tm')
                            "language": "tm",
                            @elseif(app()->getLocale() == 'ru')
                            "language": "ru",
                            @endif
                            "autoMarginOffset": 10,
                            "marginTop": 15,
                            "dataProvider": chartData,
                            "valueAxes": [{
                                "axisAlpha": 0.2,
                                "dashLength": 1,
                                "position": "left"
                            }],
                            "mouseWheelZoomEnabled": true,
                            "graphs": [{
                                "id": "g1",
                                "balloonText": "[[value]]",
                                "bullet": "round",
                                "bulletBorderAlpha": 1,
                                "bulletColor": "#FFFFFF",
                                "hideBulletsCount": 50,
                                "title": "red line",
                                "valueField": "visits",
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

                        chart.addListener("rendered", zoomChart);
                        zoomChart();

                        // this method is called when chart is first inited as we listen for "rendered" event
                        function zoomChart() {
                            // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                            chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
                        }

                        function chartData() {
                            var chartData = [];
                                    @foreach($days as $day)
                            var $date = new Date('{{ substr($day->day, 0, 10) }}');
                            var $count = parseInt({{ $day->count }});
                            chartData.push({
                                date: $date,
                                visits: $count
                            });
                            @endforeach
                                return chartData;
                        }
                    </script>

                    <!-- HTML -->
                    <div id="chartSerial" class="chart-serial"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.devices')
                        <span class="text-secondary">(1 @lang('transAdmin.year'), @lang('transAdmin.top') 10)</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="myChart1" width="100" height="65"></canvas>
                </div>
            </div>
            <script>
                var ctx = document.getElementById("myChart1");
                var myChart1 = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: [
                            @foreach($devices as $device)
                                "{{ $device->name }}",
                            @endforeach
                        ],
                        datasets: [{
                            data: [
                                @foreach($devices as $device)
                                    "{{ $device->count }}",
                                @endforeach
                            ],
                            backgroundColor: ['#E57373', '#64B5F6', '#DCE775', '#81C784', '#BA68C8', '#FFB74D', '#4DD0E1', '#F06292', '#A1887F', '#FFD54F', '#E57373', '#64B5F6', '#DCE775', '#81C784'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                });
            </script>
        </div>
        <div class="col-md-6">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.platforms')
                        <span class="text-secondary">(1 @lang('transAdmin.year'), @lang('transAdmin.top') 10)</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="myChart2" width="100" height="65"></canvas>
                </div>
            </div>
            <script>
                var ctx = document.getElementById("myChart2");
                var myChart2 = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($platforms as $platform)
                                "{{ $platform->name }}",
                            @endforeach
                        ],
                        datasets: [{
                            data: [
                                @foreach($platforms as $platform)
                                    "{{ $platform->count }}",
                                @endforeach
                            ],
                            backgroundColor: ['#E57373', '#64B5F6', '#DCE775', '#81C784', '#BA68C8', '#FFB74D', '#4DD0E1', '#F06292', '#A1887F', '#FFD54F', '#E57373', '#64B5F6', '#DCE775', '#81C784'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                });
            </script>
        </div>
        <div class="col-md-6">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.browsers')
                        <span class="text-secondary">(1 @lang('transAdmin.year'), @lang('transAdmin.top') 10)</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="myChart3" width="100" height="65"></canvas>
                </div>
            </div>
            <script>
                var ctx = document.getElementById("myChart3");
                var myChart3 = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: [
                            @foreach($browsers as $browser)
                                "{{ $browser->name }}",
                            @endforeach
                        ],
                        datasets: [{
                            data: [
                                @foreach($browsers as $browser)
                                    "{{ $browser->count }}",
                                @endforeach
                            ],
                            backgroundColor: ['#E57373', '#64B5F6', '#DCE775', '#81C784', '#BA68C8', '#FFB74D', '#4DD0E1', '#F06292', '#A1887F', '#FFD54F', '#E57373', '#64B5F6', '#DCE775', '#81C784'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                });
            </script>
        </div>
        <div class="col-md-6">
            <div class="card shadow my-3">
                <div class="card-header py-3">
                    <div class="h6 mb-0">
                        @lang('transAdmin.robots')
                        <span class="text-secondary">(1 @lang('transAdmin.year'), @lang('transAdmin.top') 10)</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="myChart4" width="100" height="65"></canvas>
                </div>
            </div>
            <script>
                var ctx = document.getElementById("myChart4");
                var myChart4 = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($robots as $robot)
                                "{{ $robot->name }}",
                            @endforeach
                        ],
                        datasets: [{
                            data: [
                                @foreach($robots as $robot)
                                    "{{ $robot->count }}",
                                @endforeach
                            ],
                            backgroundColor: ['#E57373', '#64B5F6', '#DCE775', '#81C784', '#BA68C8', '#FFB74D', '#4DD0E1', '#F06292', '#A1887F', '#FFD54F', '#E57373', '#64B5F6', '#DCE775', '#81C784'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                });
            </script>
        </div>
    </div>
@endsection