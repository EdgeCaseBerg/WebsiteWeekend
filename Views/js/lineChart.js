<script type="text/javascript">
    var lineChartData = $.parseJSON($('#chartDat').val());
    // var lineChartData = $('#chartDat').val();
    console.log(lineChartData);
    for(var ii=0; ii<lineChartData.length; ii++){
        lineChartData[ii].date = new Date(lineChartData[ii].date)
    }

            AmCharts.ready(function () {
                var chart = new AmCharts.AmSerialChart();
                chart.dataProvider = lineChartData;
                chart.pathToImages = "js/amcharts/images/";
                chart.categoryField = "date";

                // sometimes we need to set margins manually
                // autoMargins should be set to false in order chart to use custom margin values
                chart.autoMargins = false;
                chart.marginRight = 0;
                chart.marginLeft = 0;
                chart.marginBottom = 0;
                chart.marginTop = 0;

                // AXES
                // category                
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.inside = true;
                categoryAxis.gridAlpha = 0;
                categoryAxis.tickLength = 0;
                categoryAxis.axisAlpha = 0;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.dashLength = 4;
                valueAxis.axisAlpha = 0;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.type = "line";
                graph.valueField = "value";
                graph.lineColor = "red";
                 // graph.lineColor = "#D2CB00";
                // graph.customBullet = "http://cochinherald.com/assets/images/dot_indicator_small.png"; // bullet for all data points
                graph.bulletSize = 9; // bullet image should be a rectangle (width = height)
                // graph.customBulletField = "customBullet"; // this will make the graph to display custom bullet (red star)
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chart.addChartCursor(chartCursor);

                // WRITE
                chart.write("chartdiv");
            });
        </script>
