/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Version: 3.0.0
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: eCommerce Dashboard
*/

!function($) {
    "use strict";

    var MorrisCharts = function() {};

    //creates area chart with dotted
    MorrisCharts.prototype.createAreaChartDotted = function(element, pointSize, lineWidth, data, xkey, ykeys, labels, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Area({
            element: element,
            pointSize: 3,
            lineWidth: 2,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            pointFillColors: Pfillcolor,
            pointStrokeColors: Pstockcolor,
            resize: true,
            behaveLikeLine: true,
            fillOpacity: 0.4,
            gridLineColor: '#eef0f2',
            lineColors: lineColors
        });
    },
    
    MorrisCharts.prototype.init = function() {

        //creating area chart with dotted
        var $areaDotData = [
            { y: '2008', a: 100, b: 90 , c: 40 },
            { y: '2009', a: 75,  b: 65 , c: 20 },
            { y: '2010', a: 50,  b: 40 , c: 50 },
            { y: '2011', a: 75,  b: 65 , c: 95 },
            { y: '2012', a: 50,  b: 40 , c: 22 },
            { y: '2013', a: 75,  b: 65 , c: 56 },
            { y: '2014', a: 100, b: 90 , c: 60 },
            { y: '2015', a: 100, b: 90 , c: 40 },
            { y: '2016', a: 75,  b: 65 , c: 20 },
            { y: '2017', a: 50,  b: 40 , c: 50 },
            { y: '2018', a: 75,  b: 65 , c: 95 },
            { y: '2019', a: 50,  b: 40 , c: 22 }
        ];
        this.createAreaChartDotted('morris-area-with-dotted', 0, 0, $areaDotData, 'y', ['a', 'b',"c"], ["Desktops","Tablets","Mobiles"],['#ffffff'],['#999999'], ['#ebeff2','#f1556c','#4a81d4']);

    },
    //init
    $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.MorrisCharts.init();
}(window.jQuery);