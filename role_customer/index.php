<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Analytics Dashboard - Application Intel - SmartAdmin v4.5.1
    </title>
    <meta name="description" content="Analytics Dashboard">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../assets/dist/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="../assets/dist/css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="../assets/dist/css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/miscellaneous/reactions/reactions.css">
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/miscellaneous/fullcalendar/fullcalendar.bundle.css">
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/miscellaneous/jqvmap/jqvmap.bundle.css">
</head>

<body class="mod-bg-1 mod-nav-link ">
    <!-- DOC: script to save and load page settings -->
    <script>
        /**
         *	This script should be placed right after the body tag for fast execution 
         *	Note: the script is written in pure javascript and does not depend on thirdparty library
         **/
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /** 
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';
        /** 
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);

        } else if (themeSettings.themeURL && document.getElementById('mytheme')) {
            document.getElementById('mytheme').href = themeSettings.themeURL;
        }
        /** 
         * Save to localstorage 
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|footer|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /** 
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <?php include('./include/sidebar.inc.php') ?>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <?php include('./include/navbar.inc.php') ?>
                <!-- END Page Header -->
                <!-- BEGIN Page Content -->
                <!-- BEGIN Main -->
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                        <li class="breadcrumb-item">Application Intel</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-chart-area'></i><span class='fw-300'>Dashboard</span>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                <div class="">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        21.5k
                                        <small class="m-0 l-h-n">users signed up</small>
                                    </h3>
                                </div>
                                <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                                <div class="">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        $10,203
                                        <small class="m-0 l-h-n">Visual Index Figure</small>
                                    </h3>
                                </div>
                                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                                <div class="">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        - 103.72
                                        <small class="m-0 l-h-n">Offset Balance Ratio</small>
                                    </h3>
                                </div>
                                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                                <div class="">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        +40%
                                        <small class="m-0 l-h-n">Product level increase</small>
                                    </h3>
                                </div>
                                <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- END Main -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <?php include('./include/footer.inc.php') ?>
                <!-- END Page Footer -->
                <!-- BEGIN Shortcuts -->
                <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <ul class="app-list w-auto h-auto p-0 text-left">
                                    <li>
                                        <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                            <div class="icon-stack">
                                                <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                            </div>
                                            <span class="app-list-name">
                                                Home
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page_inbox_general.html" class="app-list-item text-white border-0 m-0">
                                            <div class="icon-stack">
                                                <i class="base base-7 icon-stack-3x opacity-100 color-success-500 "></i>
                                                <i class="base base-7 icon-stack-2x opacity-100 color-success-300 "></i>
                                                <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                            </div>
                                            <span class="app-list-name">
                                                Inbox
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                            <div class="icon-stack">
                                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                            </div>
                                            <span class="app-list-name">
                                                Add More
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Shortcuts -->
                <!-- BEGIN Color profile -->
                <!-- this area is hidden and will not be seen on screens or screen readers -->
                <!-- we use this only for CSS color refernce for JS stuff -->
                <p id="js-color-profile" class="d-none">
                    <span class="color-primary-50"></span>
                    <span class="color-primary-100"></span>
                    <span class="color-primary-200"></span>
                    <span class="color-primary-300"></span>
                    <span class="color-primary-400"></span>
                    <span class="color-primary-500"></span>
                    <span class="color-primary-600"></span>
                    <span class="color-primary-700"></span>
                    <span class="color-primary-800"></span>
                    <span class="color-primary-900"></span>
                    <span class="color-info-50"></span>
                    <span class="color-info-100"></span>
                    <span class="color-info-200"></span>
                    <span class="color-info-300"></span>
                    <span class="color-info-400"></span>
                    <span class="color-info-500"></span>
                    <span class="color-info-600"></span>
                    <span class="color-info-700"></span>
                    <span class="color-info-800"></span>
                    <span class="color-info-900"></span>
                    <span class="color-danger-50"></span>
                    <span class="color-danger-100"></span>
                    <span class="color-danger-200"></span>
                    <span class="color-danger-300"></span>
                    <span class="color-danger-400"></span>
                    <span class="color-danger-500"></span>
                    <span class="color-danger-600"></span>
                    <span class="color-danger-700"></span>
                    <span class="color-danger-800"></span>
                    <span class="color-danger-900"></span>
                    <span class="color-warning-50"></span>
                    <span class="color-warning-100"></span>
                    <span class="color-warning-200"></span>
                    <span class="color-warning-300"></span>
                    <span class="color-warning-400"></span>
                    <span class="color-warning-500"></span>
                    <span class="color-warning-600"></span>
                    <span class="color-warning-700"></span>
                    <span class="color-warning-800"></span>
                    <span class="color-warning-900"></span>
                    <span class="color-success-50"></span>
                    <span class="color-success-100"></span>
                    <span class="color-success-200"></span>
                    <span class="color-success-300"></span>
                    <span class="color-success-400"></span>
                    <span class="color-success-500"></span>
                    <span class="color-success-600"></span>
                    <span class="color-success-700"></span>
                    <span class="color-success-800"></span>
                    <span class="color-success-900"></span>
                    <span class="color-fusion-50"></span>
                    <span class="color-fusion-100"></span>
                    <span class="color-fusion-200"></span>
                    <span class="color-fusion-300"></span>
                    <span class="color-fusion-400"></span>
                    <span class="color-fusion-500"></span>
                    <span class="color-fusion-600"></span>
                    <span class="color-fusion-700"></span>
                    <span class="color-fusion-800"></span>
                    <span class="color-fusion-900"></span>
                </p>
                <!-- END Color profile -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

    <!-- BEGIN Quick Menu -->
    <?php include('./include/quick_menu.inc.php') ?>
    <!-- END Quick Menu -->

    <!-- BEGIN Page Settings -->
    <?php include('./include/modal-settings.inc.php') ?>
    <!-- END Page Settings -->
    <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
    <script src="../assets/dist/js/vendors.bundle.js"></script>
    <script src="../assets/dist/js/app.bundle.js"></script>
    <script type="text/javascript">
        /* Activate smart panels */
        $('#js-page-content').smartPanel();
    </script>
    <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
    <script src="../assets/dist/js/dependency/moment/moment.js"></script>
    <script src="../assets/dist/js/miscellaneous/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="../assets/dist/js/statistics/sparkline/sparkline.bundle.js"></script>
    <script src="../assets/dist/js/statistics/easypiechart/easypiechart.bundle.js"></script>
    <script src="../assets/dist/js/statistics/flot/flot.bundle.js"></script>
    <script src="../assets/dist/js/miscellaneous/jqvmap/jqvmap.bundle.js"></script>
    <script>
        $(document).ready(function() {
            //$('#js-page-content').smartPanel(); 

            //
            //
            var dataSetPie = [{
                    label: "Asia",
                    data: 4119630000,
                    color: color.primary._500
                },
                {
                    label: "Latin America",
                    data: 590950000,
                    color: color.info._500
                },
                {
                    label: "Africa",
                    data: 1012960000,
                    color: color.warning._500
                },
                {
                    label: "Oceania",
                    data: 95100000,
                    color: color.danger._500
                },
                {
                    label: "Europe",
                    data: 727080000,
                    color: color.success._500
                },
                {
                    label: "North America",
                    data: 344120000,
                    color: color.fusion._400
                }
            ];


            $.plot($("#flotPie"), dataSetPie, {
                series: {
                    pie: {
                        innerRadius: 0.5,
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 2 / 3,
                            threshold: 0.1
                        }
                    }
                },
                legend: {
                    show: false
                }
            });


            $.plot('#flotBar1', [{
                    data: [
                        [1, 0],
                        [2, 0],
                        [3, 0],
                        [4, 1],
                        [5, 3],
                        [6, 3],
                        [7, 10],
                        [8, 11],
                        [9, 10],
                        [10, 9],
                        [11, 12],
                        [12, 8],
                        [13, 10],
                        [14, 6],
                        [15, 3]
                    ],
                    bars: {
                        show: true,
                        lineWidth: 0,
                        fillColor: color.fusion._50,
                        barWidth: .3,
                        order: 'left'
                    }
                },
                {
                    data: [
                        [1, 0],
                        [2, 0],
                        [3, 1],
                        [4, 2],
                        [5, 2],
                        [6, 5],
                        [7, 8],
                        [8, 12],
                        [9, 10],
                        [10, 11],
                        [11, 3]
                    ],
                    bars: {
                        show: true,
                        lineWidth: 0,
                        fillColor: color.success._500,
                        barWidth: .3,
                        align: 'right'
                    }
                }
            ], {
                grid: {
                    borderWidth: 0,
                },
                yaxis: {
                    min: 0,
                    max: 15,
                    tickColor: 'rgba(0,0,0,0.05)',
                    ticks: [
                        [0, ''],
                        [5, '$5000'],
                        [10, '$25000'],
                        [15, '$45000']
                    ],
                    font: {
                        color: '#444',
                        size: 10
                    }
                },
                xaxis: {
                    mode: 'categories',
                    tickColor: 'rgba(0,0,0,0.05)',
                    ticks: [
                        [0, '3am'],
                        [1, '4am'],
                        [2, '5am'],
                        [3, '6am'],
                        [4, '7am'],
                        [5, '8am'],
                        [6, '9am'],
                        [7, '10am'],
                        [8, '11am'],
                        [9, '12nn'],
                        [10, '1pm'],
                        [11, '2pm'],
                        [12, '3pm'],
                        [13, '4pm'],
                        [14, '5pm']
                    ],
                    font: {
                        color: '#999',
                        size: 9
                    }
                }
            });


            /*
             * VECTOR MAP
             */

            var data_array = {
                "af": "16.63",
                "al": "0",
                "dz": "158.97",
                "ao": "85.81",
                "ag": "1.1",
                "ar": "351.02",
                "am": "8.83",
                "au": "1219.72",
                "at": "366.26",
                "az": "52.17",
                "bs": "7.54",
                "bh": "21.73",
                "bd": "105.4",
                "bb": "3.96",
                "by": "52.89",
                "be": "461.33",
                "bz": "1.43",
                "bj": "6.49",
                "bt": "1.4",
                "bo": "19.18",
                "ba": "16.2",
                "bw": "12.5",
                "br": "2023.53",
                "bn": "11.96",
                "bg": "44.84",
                "bf": "8.67",
                "bi": "1.47",
                "kh": "11.36",
                "cm": "21.88",
                "ca": "1563.66",
                "cv": "1.57",
                "cf": "2.11",
                "td": "7.59",
                "cl": "199.18",
                "cn": "5745.13",
                "co": "283.11",
                "km": "0.56",
                "cd": "12.6",
                "cg": "11.88",
                "cr": "35.02",
                "ci": "22.38",
                "hr": "59.92",
                "cy": "22.75",
                "cz": "195.23",
                "dk": "304.56",
                "dj": "1.14",
                "dm": "0.38",
                "do": "50.87",
                "ec": "61.49",
                "eg": "216.83",
                "sv": "21.8",
                "gq": "14.55",
                "er": "2.25",
                "ee": "19.22",
                "et": "30.94",
                "fj": "3.15",
                "fi": "231.98",
                "fr": "2555.44",
                "ga": "12.56",
                "gm": "1.04",
                "ge": "11.23",
                "de": "3305.9",
                "gh": "18.06",
                "gr": "305.01",
                "gd": "0.65",
                "gt": "40.77",
                "gn": "4.34",
                "gw": "0.83",
                "gy": "2.2",
                "ht": "6.5",
                "hn": "15.34",
                "hk": "226.49",
                "hu": "132.28",
                "is": "0",
                "in": "1430.02",
                "id": "695.06",
                "ir": "337.9",
                "iq": "84.14",
                "ie": "204.14",
                "il": "201.25",
                "it": "2036.69",
                "jm": "13.74",
                "jp": "5390.9",
                "jo": "27.13",
                "kz": "129.76",
                "ke": "32.42",
                "ki": "0.15",
                "kw": "117.32",
                "kg": "4.44",
                "la": "6.34",
                "lv": "23.39",
                "lb": "39.15",
                "ls": "1.8",
                "lr": "0.98",
                "lt": "35.73",
                "lu": "52.43",
                "mk": "9.58",
                "mg": "8.33",
                "mw": "5.04",
                "my": "218.95",
                "mv": "1.43",
                "ml": "9.08",
                "mt": "7.8",
                "mr": "3.49",
                "mu": "9.43",
                "mx": "1004.04",
                "md": "5.36",
                "rw": "5.69",
                "ws": "0.55",
                "st": "0.19",
                "sa": "434.44",
                "sn": "12.66",
                "rs": "38.92",
                "sc": "0.92",
                "sl": "1.9",
                "sg": "217.38",
                "sk": "86.26",
                "si": "46.44",
                "sb": "0.67",
                "za": "354.41",
                "es": "1374.78",
                "lk": "48.24",
                "kn": "0.56",
                "lc": "1",
                "vc": "0.58",
                "sd": "65.93",
                "sr": "3.3",
                "sz": "3.17",
                "se": "444.59",
                "ch": "522.44",
                "sy": "59.63",
                "tw": "426.98",
                "tj": "5.58",
                "tz": "22.43",
                "th": "312.61",
                "tl": "0.62",
                "tg": "3.07",
                "to": "0.3",
                "tt": "21.2",
                "tn": "43.86",
                "tr": "729.05",
                "tm": "0",
                "ug": "17.12",
                "ua": "136.56",
                "ae": "239.65",
                "gb": "2258.57",
                "us": "14624.18",
                "uy": "40.71",
                "uz": "37.72",
                "vu": "0.72",
                "ve": "285.21",
                "vn": "101.99",
                "ye": "30.02",
                "zm": "15.69",
                "zw": "0"
            };

            $('#vector-map').vectorMap({
                map: 'world_en',
                backgroundColor: 'transparent',
                color: color.warning._50,
                borderOpacity: 0.5,
                borderWidth: 1,
                hoverColor: color.success._300,
                hoverOpacity: null,
                selectedColor: color.success._500,
                selectedRegions: ['US'],
                enableZoom: true,
                showTooltip: true,
                scaleColors: [color.primary._400, color.primary._50],
                values: data_array,
                normalizeFunction: 'polynomial',
                onRegionClick: function(element, code, region) {
                    /*var message = 'You clicked "'
						+ region
						+ '" which has the code: '
						+ code.toLowerCase();
			 
					console.log(message);*/

                    var randomNumber = Math.floor(Math.random() * 10000000);
                    var arrow;

                    if (Math.random() >= 0.5 == true) {
                        arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-up text-success fs-xs"></i></div>'
                    } else {
                        arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-down text-danger fs-xs"></i></div>'
                    }

                    $('.js-jqvmap-flag').attr('src', 'https://lipis.github.io/flag-icon-css/flags/4x3/' + code.toLowerCase() + '.svg');
                    $('.js-jqvmap-country').html(region + ' - ' + '$' + randomNumber.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + arrow);
                }
            });


            /* TAB 1: UPDATING CHART */
            var data = [],
                totalPoints = 200;
            var getRandomData = function() {
                if (data.length > 0)
                    data = data.slice(1);

                // do a random walk
                while (data.length < totalPoints) {
                    var prev = data.length > 0 ? data[data.length - 1] : 50;
                    var y = prev + Math.random() * 10 - 5;
                    if (y < 0)
                        y = 0;
                    if (y > 100)
                        y = 100;
                    data.push(y);
                }

                // zip the generated y values with the x values
                var res = [];
                for (var i = 0; i < data.length; ++i)
                    res.push([i, data[i]])
                return res;
            }
            // setup control widget
            var updateInterval = 1500;
            $("#updating-chart").val(updateInterval).change(function() {

                var v = $(this).val();
                if (v && !isNaN(+v)) {
                    updateInterval = +v;
                    $(this).val("" + updateInterval);
                }

            });
            // setup plot
            var options = {
                colors: [color.primary._700],
                series: {
                    lines: {
                        show: true,
                        lineWidth: 0.5,
                        fill: 0.9,
                        fillColor: {
                            colors: [{
                                    opacity: 0.6
                                },
                                {
                                    opacity: 0
                                }
                            ]
                        },
                    },

                    shadowSize: 0 // Drawing is faster without shadows
                },
                grid: {
                    borderColor: 'rgba(0,0,0,0.05)',
                    borderWidth: 1,
                    labelMargin: 5
                },
                xaxis: {
                    color: '#F0F0F0',
                    tickColor: 'rgba(0,0,0,0.05)',
                    font: {
                        size: 10,
                        color: '#999'
                    }
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    color: '#F0F0F0',
                    tickColor: 'rgba(0,0,0,0.05)',
                    font: {
                        size: 10,
                        color: '#999'
                    }
                }
            };
            var plot = $.plot($("#updating-chart"), [getRandomData()], options);
            /* live switch */
            $('input[type="checkbox"]#start_interval').click(function() {
                if ($(this).prop('checked')) {
                    $on = true;
                    updateInterval = 1500;
                    update();
                } else {
                    clearInterval(updateInterval);
                    $on = false;
                }
            });
            var update = function() {
                if ($on == true) {
                    plot.setData([getRandomData()]);
                    plot.draw();
                    setTimeout(update, updateInterval);

                } else {
                    clearInterval(updateInterval)
                }

            }



            /*calendar */
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');


            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
                themeSystem: 'bootstrap',
                timeZone: 'UTC',
                //dateAlignment: "month", //week, month
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day',
                    list: 'list'
                },
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                navLinks: true,
                header: {
                    left: 'title',
                    center: '',
                    right: 'today prev,next'
                },
                footer: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                    center: '',
                    right: ''
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [{
                        title: 'All Day Event',
                        start: YM + '-01',
                        description: 'This is a test description', //this is currently bugged: https://github.com/fullcalendar/fullcalendar/issues/1795
                        className: "border-warning bg-warning text-dark"
                    },
                    {
                        title: 'Reporting',
                        start: YM + '-14T13:30:00',
                        end: YM + '-14',
                        className: "bg-white border-primary text-primary"
                    },
                    {
                        title: 'Surgery oncall',
                        start: YM + '-02',
                        end: YM + '-03',
                        className: "bg-primary border-primary text-white"
                    },
                    {
                        title: 'NextGen Expo 2019 - Product Release',
                        start: YM + '-03',
                        end: YM + '-05',
                        className: "bg-info border-info text-white"
                    },
                    {
                        title: 'Dinner',
                        start: YM + '-12',
                        end: YM + '-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: YM + '-09T16:00:00',
                        className: "bg-danger border-danger text-white"
                    },
                    {
                        id: 1000,
                        title: 'Repeating Event',
                        start: YM + '-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: YESTERDAY,
                        end: TOMORROW,
                        className: "bg-success border-success text-white"
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T10:30:00',
                        end: TODAY + 'T12:30:00',
                        className: "bg-primary text-white border-primary"
                    },
                    {
                        title: 'Lunch',
                        start: TODAY + 'T12:00:00',
                        className: "bg-info border-info"
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T14:30:00',
                        className: "bg-warning text-dark border-warning"
                    },
                    {
                        title: 'Happy Hour',
                        start: TODAY + 'T17:30:00',
                        className: "bg-success border-success text-white"
                    },
                    {
                        title: 'Dinner',
                        start: TODAY + 'T20:00:00',
                        className: "bg-danger border-danger text-white"
                    },
                    {
                        title: 'Birthday Party',
                        start: TOMORROW + 'T07:00:00',
                        className: "bg-primary text-white border-primary text-white"
                    },
                    {
                        title: 'Gotbootstrap Meeting',
                        url: 'http://gotbootstrap.com/',
                        start: YM + '-28',
                        className: "bg-info border-info text-white"
                    }
                ],
                viewSkeletonRender: function() {
                    $('.fc-toolbar .btn-default').addClass('btn-sm');
                    $('.fc-header-toolbar h2').addClass('fs-md');
                    $('#calendar').addClass('fc-reset-order')
                },

            });

            calendar.render();
        });
    </script>
</body>
<!-- END Body -->

</html>