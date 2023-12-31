/**
 *
 * Highcharts - deeper practice for real statistics
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Script Tutorials
 * http://www.script-tutorials.com/
 */

// on document ready
$(document).ready(function() {

   // prepare an empty Highcharts object
   var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            showAxes: true,
            height: 700
        },
        title: {
            text: 'Marital Status (United States: 2011)',
        },
        credits: {
            text: 'By Script Tutorials'
        },
        xAxis: {
            title: {
               text: 'Categories'
            }
        },
        yAxis: {
            title: {
               text: 'Amount'
            }
        }
     });

    $('.switcher').click(function () {
        var id = $(this).attr('id');

        // display Loading message
        chart.showLoading('Getting stat data ....');

        if (id != 'multiple') {

            // get stat data (json)
            $.getJSON('data.php?id=' + id, function(aData) {

                // remove all existing series
                while (chart.series.length) {
                    chart.series[0].remove();
                }

                // re-set categories for X axe
                var categories = [];
                $.each(aData.categories, function(idx, res) {
                    categories.push(res);
                });
                chart.xAxis[0].setCategories(categories);
                chart.yAxis[0].axisTitle.attr({
                    text: 'Amount of ' + aData.name + 's (thousands)'
                });

                // gather data (values) and prepare a new Series array
                var seriesValData = [];
                $.each(aData.values, function(idx, res) {
                    seriesValData.push([res.name, parseFloat(res.val)]);
                });

                var seriesValues = {
                    name: aData.name,
                    data: seriesValData,
                    type: 'column'
                }

                // gather data (percentages) and prepare a new Series array
                var seriesPerData = [];
                $.each(aData.percentages, function(idx, res) {
                    seriesPerData.push([res.name, parseFloat(res.val)]);
                });

                var seriesPercentages = {
                    name: aData.name + ' (%)',
                    data: seriesPerData,
                    type: 'pie',
                    size: '40%',
                    center: ['60%', '30%'],
                    showInLegend: true
                }

                // hide Loading, add both series and redraw our chart
                chart.hideLoading();
                chart.addSeries(seriesValues, false);
                chart.addSeries(seriesPercentages, false);
                chart.redraw();
            });
        } else {

            // get stat data (json)
            $.getJSON('data2.php', function(aData) {

                // remove all existing series
                while (chart.series.length) {
                    chart.series[0].remove();
                }

                // re-set categories for X axe
                var categories = [];
                $.each(aData.categories, function(idx, res) {
                    categories.push(res);
                });
                chart.xAxis[0].setCategories(categories);
                chart.yAxis[0].axisTitle.attr({
                    text: 'Percentage'
                });

                // hide Loading
                chart.hideLoading();

                $.each(aData.series, function(idx, ser) {

                    // gather data (percentages) and prepare a new Series array
                    var seriesValData = [];
                    $.each(ser.values, function(idx, res) {
                        seriesValData.push([res.name, parseFloat(res.val)]);
                    });

                    var seriesValues = {
                        name: ser.name,
                        data: seriesValData,
                        type: 'column',
                    }
                    // and add the series into chart
                    chart.addSeries(seriesValues, false);
                });

                // add both series and redraw our chart
                chart.redraw();
            });
        }
    });
});