/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Dashboard 4 init
*/

!function($) {
    "use strict";

    var Dashboard4 = function() {};

    //creates Bar chart
    Dashboard4.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#eeeeee',
            barSizeRatio: 0.2,
            barColors: lineColors
        });
    },

    //creates area chart with dotted
    Dashboard4.prototype.createAreaChartDotted = function(element, pointSize, lineWidth, data, xkey, ykeys, labels, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Area({
            element: element,
            pointSize: 3,
            lineWidth: 1,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            pointFillColors: Pfillcolor,
            pointStrokeColors: Pstockcolor,
            resize: true,
            smooth: false,
            gridLineColor: '#eef0f2',
            lineColors: lineColors
        });
    },
        
    //creates Donut chart
    Dashboard4.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            barSize: 0.2,
            resize: true, //defaulted to true
            colors: colors
        });
    },
    Dashboard4.prototype.init = function() {

        //creating bar chart
        var $barData  = [
            { y: '2012', a: 87},
            { y: '2013', a: 75},
            { y: '2014', a: 50},
            { y: '2015', a: 75},
            { y: '2016', a: 50},
            { y: '2017', a: 38},
            { y: '2018', a: 72}
        ];
        this.createBarChart('morris-bar-example', $barData, 'y', ['a'], ["Statistics"], ['#02c0ce']);

        //creating area chart with dotted
        var $areaDotData = [
            { y: '2012', a: 10, b: 20 },
            { y: '2013', a: 75,  b: 65 },
            { y: '2014', a: 50,  b: 40 },
            { y: '2015', a: 75,  b: 65 },
            { y: '2016', a: 50,  b: 40 },
            { y: '2017', a: 75,  b: 65 },
            { y: '2018', a: 90, b: 60 }
        ];
        this.createAreaChartDotted('morris-area-with-dotted', 0, 0, $areaDotData, 'y', ['a', 'b'], ["Bitcoin","Litecoin"],['#ffffff'],['#999999'], ['#4a81d4', "#e3eaef"]);

        //creating donut chart
        var $donutData = [
                {label: " Total Sales ", value: 12},
                {label: " Campaign ", value: 30},
                {label: " Daily Sales ", value: 20}
            ];
        this.createDonutChart('morris-donut-example', $donutData, ['#4fc6e1','#6658dd', '#ebeff2']);
    },
    //init
    $.Dashboard4 = new Dashboard4, $.Dashboard4.Constructor = Dashboard4
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Dashboard4.init();
}(window.jQuery);