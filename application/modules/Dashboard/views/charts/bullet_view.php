<!--chart_container-->
<div id="<?php echo $chart_name; ?>_container"></div>

<!--highcharts_configuration-->
<script type="text/javascript">
    $(function(){
        var chartDIV = '<?php echo $chart_name."_container"; ?>'

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