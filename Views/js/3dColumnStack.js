
 var chart;

            // var chartData = [{
            //     country: "Josh",
            //     year2004: 3.5,
            // }, {
            //     country: "Jimmy",
            //     year2004: 1.7,
            // }, {
            //     country: "Einstein",
            //     year2004: 3.8,
            // }, {
            //     country: "God",
            //     year2004: 4.1,
            // }, {
            //     country: "Katie",
            //     year2004: 2.8,
            // }, {
            //     country: "Dana",
            //     year2004: 2.6,
            // }, {
            //     country: "Chris",
            //     year2004: 1.4,
            // }, {
            //     country: "Jason",
            //     year2004: 2.6,
            // }];


console.log(chartData);

AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "purpose";
                chart.color = "#222";
                chart.fontSize = 14;
                chart.startDuration = 1;
                chart.plotAreaFillAlphas = 0.2;
                // the following two lines makes chart 3D
                chart.angle = 30;
                chart.depth3D = 60;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.2;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridColor = "#FFFFFF";
                categoryAxis.axisColor = "#FFFFFF";
                categoryAxis.axisAlpha = 1;
                categoryAxis.dashLength = 5;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "3d"; // This line makes chart 3D stacked (columns are placed one behind another)
                valueAxis.gridAlpha = 0.7;
                valueAxis.gridColor = "#ddd";
                valueAxis.axisColor = "#bbb";
                valueAxis.axisAlpha = 0.5;
                valueAxis.dashLength = 5;
                valueAxis.title = ""
                valueAxis.titleColor = "#777";
                valueAxis.unit = " people";
                valueAxis.precision = 0;
                chart.addValueAxis(valueAxis);

                // GRAPHS         
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.title = "Number of Logins";
                graph1.valueField = "qty";
                graph1.type = "column";
                graph1.lineAlpha = 0;
                graph1.lineColor = "#D2CB00";
                graph1.fillAlphas = 1;
                graph1.balloonText = "GDP grow in [[category]] (2004): [[value]]";
                chart.addGraph(graph1);

                // second graph
                var graph2 = new AmCharts.AmGraph();
                graph2.title = "2005";
                graph2.valueField = "year2005";
                graph2.type = "column";
                graph2.lineAlpha = 0;
                graph2.lineColor = "#BEDF66";
                graph2.fillAlphas = 1;
                graph2.balloonText = "GDP grow in [[category]] (2005): [[value]]";
                chart.addGraph(graph2);

                chart.write("chartdiv");
            });