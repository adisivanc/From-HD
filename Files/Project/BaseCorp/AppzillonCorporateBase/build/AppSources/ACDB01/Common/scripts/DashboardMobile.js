apz.DashboardMobile = {};
apz.app.onLoad_DashboardMobile = function() {
    debugger;
    // apz.data.loadJsonData("HighPriority");
    // apz.data.loadJsonData("MediumPriority");
    // apz.data.loadJsonData("LowPriority");
    $("body").addClass("dbcls");
}
apz.app.onShown_DashboardMobile = function() {
    setTimeout(function() {
        apz.data.loadJsonData("DashboardStaticData", "ACDB01");
    }, 300);
}
apz.DashboardMobile.fnQuicklinks = function(lappId, lscr) {
    debugger;
    var params = {};
    params.appId = lappId;
    params.scr = lscr;
    if (lscr == "Cards") {
        params.layout = "Mobile";
    }
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}
apz.app.updateChartBeforeRender = function(gChartType, gChartData, gId, gChart) {
    debugger;
    gChartData.chart.captionFontBold = 0;
    gChartData.chart.baseFont = "Roboto";
    gChartData.chart.usePlotGradientColor = 0;
    debugger;
    if (gId == "ACDB01__DashboardMobile__chthigh") {
        gChartData.chart.defaultCenterLabel = "10 <br/> High";
        // gChart.removeEventListener("centerLabelClick",apz.DashboardMobile.drilldownchart);
        // gChart.addEventListener("centerLabelClick", apz.DashboardMobile.drilldownchart);
        gChart.removeEventListener("chartClick", apz.DashboardMobile.drilldownchart);
        gChart.addEventListener("chartClick", apz.DashboardMobile.drilldownchart);
        //  gChart.removeEventListener("dataPlotClick",apz.DashboardMobile.drilldownchart);
        // gChart.addEventListener("dataPlotClick", apz.DashboardMobile.drilldownchart);
        setTimeout(function() {
            $("#ACDB01__DashboardMobile__chthigh tspan:nth-child(1)").attr('style', 'font-size:20px;font-weight:bold;');
        }, 1000);
    }
    if (gId == "ACDB01__DashboardMobile__chtmedium") {
        gChartData.chart.defaultCenterLabel = "8 <br/> Medium";
        // gChart.removeEventListener("centerLabelClick",apz.DashboardMobile.drilldownchart);
        // gChart.addEventListener("centerLabelClick", apz.DashboardMobile.drilldownchart);
        gChart.removeEventListener("chartClick", apz.DashboardMobile.drilldownchart);
        gChart.addEventListener("chartClick", apz.DashboardMobile.drilldownchart);
        //  gChart.removeEventListener("dataPlotClick",apz.DashboardMobile.drilldownchart);
        // gChart.addEventListener("dataPlotClick", apz.DashboardMobile.drilldownchart);
        setTimeout(function() {
            $("#ACDB01__DashboardMobile__chtmedium tspan:nth-child(1)").attr('style', 'font-size:20px;font-weight:bold;');
        }, 1000);
    }
    if (gId == "ACDB01__DashboardMobile__chtlow") {
        gChartData.chart.defaultCenterLabel = "7 <br/> Low";
        // gChart.removeEventListener("centerLabelClick",apz.DashboardMobile.drilldownchart);
        // gChart.addEventListener("centerLabelClick", apz.DashboardMobile.drilldownchart);
        gChart.removeEventListener("chartClick", apz.DashboardMobile.drilldownchart);
        gChart.addEventListener("chartClick", apz.DashboardMobile.drilldownchart);
        //  gChart.removeEventListener("dataPlotClick",apz.DashboardMobile.drilldownchart);
        // gChart.addEventListener("dataPlotClick", apz.DashboardMobile.drilldownchart);
        setTimeout(function() {
            $("#ACDB01__DashboardMobile__chtlow tspan:nth-child(1)").attr('style', 'font-size:20px;font-weight:bold;');
        }, 1000);
    }
}
apz.DashboardMobile.drilldownchart = function(ev, props) {
    debugger;
    ev.stopPropagation();
    var taskPriority
    if (ev.sender.id == "ACDB01__DashboardMobile__chthigh") {
        taskPriority = "high";
    } else if (ev.sender.id == "ACDB01__DashboardMobile__chtmedium") {
        taskPriority = "medium";
    } else if (ev.sender.id == "ACDB01__DashboardMobile__chtlow") {
        taskPriority = "low";
    }
    var params = {};
    params.appId = "actf01";
    params.scr = "TaskFlow";
    params.layout = "Mobile";
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = {
        "taskid": taskPriority,
    }
    //apz.launchApp(params);
    apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "Mobile", "");
}
