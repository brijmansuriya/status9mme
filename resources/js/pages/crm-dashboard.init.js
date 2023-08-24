/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: CRM Dashboard
*/

!function($) {
    "use strict";

    var CRMDashboard = function() {};

    //creates Bar chart
    CRMDashboard.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#eeeeee',
            barSizeRatio: 0.4,
            barColors: lineColors
        });
    },

    //Line chart
    CRMDashboard.prototype.createLineChart = function(element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Line({
          element: element,
          data: data,
          xkey: xkey,
          ykeys: ykeys,
          labels: labels,
          fillOpacity: opacity,
          pointFillColors: Pfillcolor,
          pointStrokeColors: Pstockcolor,
          behaveLikeLine: true,
          gridLineColor: '#eef0f2',
          hideHover: 'auto',
          lineWidth: '3px',
          pointSize: 0,
          resize: true, //defaulted to true
          lineColors: lineColors
        });
    },
        
    //creates Donut chart
    CRMDashboard.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            barSize: 0.2,
            resize: true, //defaulted to true
            colors: colors
        });
    },
    CRMDashboard.prototype.init = function() {

        //creating bar chart
        var $barData  = [
            { y: '2012', a: 100, b: 90},
            { y: '2013', a: 75,  b: 65},
            { y: '2014', a: 50,  b: 40},
            { y: '2015', a: 75,  b: 65},
            { y: '2016', a: 50,  b: 40},
            { y: '2017', a: 75,  b: 65},
            { y: '2018', a: 100, b: 90}
        ];
        this.createBarChart('morris-bar-example', $barData, 'y', ['a', 'b'], ["Won Deal", "Lost Deal"], ['#02c0ce','#0acf97']);

        //create line chart
        var $data  = [
            { y: '2010', a: 50, b: 0 },
            { y: '2011', a: 75, b: 50 },
            { y: '2012', a: 30, b: 80 },
            { y: '2013', a: 50, b: 50 },
            { y: '2014', a: 75, b: 10 },
            { y: '2015', a: 50, b: 40 },
            { y: '2016', a: 75, b: 50 },
            { y: '2017', a: 100, b: 70 }
          ];
        this.createLineChart('deals-analytics', $data, 'y', ['a', 'b'], ["Won Deal", "Lost Deal"],['0.1'],['#ffffff'],['#999999'], ['#1abc9c', '#f1556c']);

        //creating donut chart
        var $donutData = [
                {label: "Group 1", value: 12},
                {label: "Group 2", value: 30},
                {label: "Group 3", value: 20}
            ];
        this.createDonutChart('morris-donut-example', $donutData, ['#4fc6e1','#6658dd', '#ebeff2']);
    },
    //init
    $.CRMDashboard = new CRMDashboard, $.CRMDashboard.Constructor = CRMDashboard
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.CRMDashboard.init();
}(window.jQuery);