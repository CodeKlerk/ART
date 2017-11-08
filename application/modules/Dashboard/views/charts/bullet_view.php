<!--chart_container-->
<div id="<?php echo $chart_name; ?>_container"></div>

<!--highcharts_configuration-->
<script type="text/javascript">
    $(function(){
        var chartDIV = '<?php echo $chart_name."_container"; ?>'


        // Highcharts.chart(chartDIV, {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: '<?php echo $chart_title; ?>'
        //     },
        //     subtitle: {
        //         text: '<?php echo $chart_source; ?>'
        //     },
        //     credits: false,
        //     xAxis: {
        //         categories: <?php echo $chart_categories; ?>,
        //         crosshair: true
        //     },
        //     yAxis: {
        //         min: 0,
        //         title: {
        //             text: '<?php echo $chart_yaxis_title; ?>'
        //         }
        //     },
        //     tooltip: {
        //         pointFormat: '{point.key} <b>{point.y:,.0f}</b>',
        //         shared: true,
        //         useHTML: true
        //     },
        //     plotOptions: {
        //         column: {
        //             pointPadding: 0.2,
        //             borderWidth: 0,
        //             colorByPoint: true,
        //             dataLabels: {
        //                 enabled: true
        //             }
        //         },
        //     },
        //     series: [{
        //         name: '<?php echo $chart_xaxis_title; ?>',
        //         colorByPoint: true,
        //         data: <?php echo $chart_series_data; ?>
        //     }],
        // });



        Highcharts.setOptions({
            chart: {
                inverted: true,
                marginLeft: 135,
                type: 'bullet'
            },
            title: {
                text: "<?php echo $chart_title; ?>"
            },
            legend: {
                enabled: false
            },
            yAxis: {
                gridLineWidth: 0
            },
            plotOptions: {
                series: {
                    pointPadding: 0.25,
                    borderWidth: 0,
                    color: '#000',
                    targetOptions: {
                        width: '200%'
                    }
                }
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            }
        });



        Highcharts.chart(chartDIV, {
            xAxis: {
                categories: ['<span class="hc-cat-title"><?php echo $chart_title; ?></span><br/>%']
            },
            yAxis: {
                plotBands: [{
                    from: 0,
                    to: 20,
                    color: '#666'
                }, {
                    from: 20,
                    to: 25,
                    color: '#999'
                }, {
                    from: 25,
                    to: 100,
                    color: '#bbb'
                }],
                labels: {
                    format: '{value}%'
                },
                title: null
            },
            series: [{
                data: [{
                    y: 22,
                    target: 27
                }] 
            }],
    tooltip: {
        pointFormat: '<b>{point.y}</b> (with target at {point.target})'
    }
});


    });
</script>        