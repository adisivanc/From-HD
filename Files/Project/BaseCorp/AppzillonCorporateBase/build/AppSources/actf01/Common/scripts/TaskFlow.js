apz.actf01 = {};
apz.actf01.TaskFlow = {};
apz.actf01.TaskFlow.sCurrentTask = {};
apz.actf01.TaskFlow.puserObj = {};
apz.app.onLoad_TaskFlow = function(puserObj) {
    $("body").removeClass("dbcls");
    apz.actf01.TaskFlow.puserObj = puserObj;
    apz.actf01.TaskFlow.sCorporateId = apz.Login.sCorporateId;
    apz.actf01.TaskFlow.queryTasks();
};
apz.actf01.TaskFlow.queryTasks = function() {
    apz.startLoader();
    var lServerParams = {
        "ifaceName": "FetchTaskFlowDetails",
        "appId": "actf01",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.actf01.TaskFlow.taskFlowQueryCB,
        "callBackObj": "",
    };
    var req = {
        "TaskSummary": {
            "corporateId": apz.actf01.TaskFlow.sCorporateId
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_workflow_master";
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.app.onShown_TaskFlow = function() {
    $(".adr-ctr").addClass("sno");
};
apz.actf01.TaskFlow.taskFlowQueryCB = function(pResp) {
    debugger;
    apz.stopLoader();
    if (pResp.res.actf01__FetchTaskFlowDetails_Res.Status) {
        var lTasksArr = pResp.res.actf01__FetchTaskFlowDetails_Res.TaskSummary;
        var lTaskArrLength = lTasksArr.length;
        var lsaved = 0,
            linprogress = 0,
            lcompleted = 0;
        for (var i = 0; i < lTaskArrLength; i++) {
            lTasksArr[i].startTs = lTasksArr[i].startTs.substring(0, lTasksArr[i].startTs.length - 2);
            if (lTasksArr[i].status == "INPROGRESS") {
                linprogress++;
            } else if (lTasksArr[i].status == "COMPLETED") {
                lcompleted++;
            } else {
                lsaved++;
            }
        }
        var lmytsak = 0,
            alltasks = 0;
        for (var i = 0; i < lTaskArrLength; i++) {
            if (lTasksArr[i].actorId == apz.Login.sUser) {
                lmytsak++;
            } else {
                alltasks++;
            }
        }
        var larr = [];
        for (var i = 0; i < lTaskArrLength; i++) {
            var lobj = {
                "taskDate": lTasksArr[i].startTs.split(" ")[0],
                "value": 1,
                "type": "COMPLETED"
            };
            if (lTasksArr[i].status == "COMPLETED") {
                lobj.type = "Completed";
            } else {
                lobj.type = "Others";
            }
            larr.push(lobj);
        }
        for (var j = 0; j < lTaskArrLength; j = j + 3) {
            lTasksArr[j].priority = "Low";
        }
        for (var m = 1; m < lTaskArrLength; m = m + 3) {
            lTasksArr[m].priority = "Medium";
        }
        for (var n = 2; n < lTaskArrLength; n = n + 3) {
            lTasksArr[n].priority = "High";
        }
        apz.data.scrdata.actf01__TaskListDummy_Req = {};
        apz.data.scrdata.actf01__TaskListDummy_Req.tbDbmiWorkflowMaster = lTasksArr;
        apz.data.scrdata.actf01__TaskSummaryDummy_Res = {};
        apz.data.scrdata.actf01__TaskSummaryDummy_Res.taskSummary = larr;
        apz.data.scrdata.actf01__TaskSummaryDummy_Res.taskStatusSummary = [{
            "desc": "Inprogress",
            "value": linprogress
        }, {
            "desc": "Saved",
            "value": lsaved
        }, {
            "desc": "Completed",
            "value": lcompleted
        }];
        apz.data.scrdata.actf01__TaskSummaryDummy_Res.allTasksSummary = [{
            "desc": "All Tasks",
            "value": alltasks
        }, {
            "desc": "My Tasks",
            "value": lmytsak
        }];
        apz.data.loadData("TaskListDummy", "actf01");
        apz.data.loadData("TaskSummaryDummy", "actf01");
        if (apz.scrMetaData.containersMap['actf01__TaskFlow__Tasks_Table'].totalRecs <= apz.scrMetaData.containersMap['actf01__TaskFlow__Tasks_Table']
            .pageSize) {
            apz.hide("actf01__TaskFlow__Tasks_Table_pagination_ul");
        }
        for (var k = 0; k < lTaskArrLength; k++) {
            if (lTasksArr[k].priority == "High") {
                $("#actf01__TaskFlow__Tasks_Table_row_" + k).addClass("high");
            }
            if (lTasksArr[k].priority == "Medium") {
                $("#actf01__TaskFlow__Tasks_Table_row_" + k).addClass("medium");
            }
            if (lTasksArr[k].priority == "Low") {
                $("#actf01__TaskFlow__Tasks_Table_row_" + k).addClass("low");
            }
        }
        // alert(apz.actf01.TaskFlow.puserObj.taskid);
        debugger;
        if (apz.actf01.TaskFlow.puserObj.taskid != null || apz.actf01.TaskFlow.puserObj.taskid != undefined) {
            var lval = apz.actf01.TaskFlow.puserObj.taskid;
            apz.searchRecords("actf01__TaskFlow__Tasks_Table", lval);
            //apz.searchRecords("actf01__TaskFlow__Tasks_Table", "inprogress");
        }
        apz.actf01.TaskFlow.addStatusColor();
    }
};
apz.actf01.TaskFlow.fetchDetails = function(pthis) {
    debugger;
    var lPage = apz.scrMetaData.containersMap['actf01__TaskFlow__Tasks_Table'].currPage;
    var lRecord = (lPage - 1) * apz.scrMetaData.containersMap['actf01__TaskFlow__Tasks_Table'].pageSize + parseInt($(pthis).attr('rowno'));
    apz.actf01.TaskFlow.sCurrentTask = $.extend(true, {}, apz.data.scrdata.actf01__TaskListDummy_Req.tbDbmiWorkflowMaster[lRecord]);
    lUserObj = {};
    lUserObj.workflowId = apz.actf01.TaskFlow.sCurrentTask.workflowId;
    lUserObj.task = apz.actf01.TaskFlow.sCurrentTask.stageId;
    lUserObj.callBack = apz.actf01.TaskFlow.checkAccessCB;
    //lUserObj.operation = "CHECKACCESS";
    lUserObj.operation = "INITIALISE";
    lUserObj.action = "CHECKACCESS";
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "actf01__TaskFlow__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        apz.actf01.TaskFlow.fnGetWorkFlowDet();
    }
};
apz.actf01.TaskFlow.checkAccessCB = function(pResp) {
    apz.currAppId = "actf01";
    if (pResp) {
        apz.actf01.TaskFlow.fnGetWorkFlowDet();
    }
};
apz.actf01.TaskFlow.fnGetWorkFlowDet = function() {
    var lServerParams = {
        "ifaceName": "FetchWorkFlowDet_Query",
        "appId": "actf01",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.actf01.TaskFlow.fetchDetailsQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiWorkflowDetail = {};
    req.tbDbmiWorkflowDetail.instanceId = apz.actf01.TaskFlow.sCurrentTask.instanceId;
    req.tbDbmiWorkflowDetail.stageSeqNo = apz.actf01.TaskFlow.sCurrentTask.stageSeqNo;
    req.tbDbmiWorkflowDetail.versionNo = apz.actf01.TaskFlow.sCurrentTask.versionNo;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
}
apz.actf01.TaskFlow.fetchDetailsQueryCB = function(pResp) {
    debugger;
    var lUserObj = {};
    if (!apz.mockServer) {
        var lCurrentWfDetails = pResp.res.actf01__FetchWorkFlowDet_Res.tbDbmiWorkflowDetail[0];
        var ltbAstpWorkflowDet = pResp.res.actf01__FetchWorkFlowDet_Res.tbDbmiWorkflowDetail[0];
        lUserObj.scrData = JSON.parse(ltbAstpWorkflowDet.screenData);
        lUserObj.callBack = apz.actf01.TaskFlow.microAppCB;
        lUserObj.currentTask = apz.actf01.TaskFlow.sCurrentTask;
        lUserObj.currentWfDetails = lCurrentWfDetails;
        lUserObj.div = "actf01__TaskFlow__LaunchMicroApp";
        lUserObj.from = "taskflow";
        //lUserObj.div = "actf01__TaskFlow__MicroAppRow";
        $("#actf01__TaskFlow__TasksSummary").addClass("sno");
        $("#actf01__TaskFlow__LaunchMicroApp").removeClass("sno");
        var lParams = {
            "appId": ltbAstpWorkflowDet.appId,
            "scr": ltbAstpWorkflowDet.screenId,
            "div": "actf01__TaskFlow__LaunchMicroApp",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
        // actf01__TaskFlow__LaunchMicroApp
    } else {
        var wArray = pResp.res.actf01__FetchWorkFlowDet_Res.tbDbmiWorkflowDetail;
        let lfilterwArray = jQuery.grep(wArray, function(lObj) {
            return (lObj.instanceId == apz.actf01.TaskFlow.sCurrentTask.instanceId && lObj.stageSeqNo == apz.actf01.TaskFlow.sCurrentTask.stageSeqNo);
        });
        console.log(lfilterwArray);
        var lCurrentWfDetails = lfilterwArray[0];
        var ltbAstpWorkflowDet = lfilterwArray[0];
        if (ltbAstpWorkflowDet.screenId != "") {
            lUserObj.scrData = JSON.parse(ltbAstpWorkflowDet.screenData);
            lUserObj.callBack = apz.actf01.TaskFlow.microAppCB;
            lUserObj.currentTask = apz.actf01.TaskFlow.sCurrentTask;
            lUserObj.currentWfDetails = lCurrentWfDetails;
            lUserObj.div = "actf01__TaskFlow__LaunchMicroApp";
            lUserObj.from = "taskflow";
           
            
            
            $("#actf01__TaskFlow__TasksSummary").addClass("sno");
            $("#actf01__TaskFlow__LaunchMicroApp").removeClass("sno");
            var lParams = {
                "appId": ltbAstpWorkflowDet.appId,
                "scr": ltbAstpWorkflowDet.screenId,
                "div": "actf01__TaskFlow__LaunchMicroApp",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        }
    }
    // 
};
apz.actf01.TaskFlow.microAppCB = function(pResp) {
    debugger;
    apz.currAppId = "actf01";
};
apz.actf01.TaskFlow.searchKeyUp = function() {
    var lval = apz.getElmValue("actf01__TaskFlow__taskSearch");
    apz.searchRecords("actf01__TaskFlow__Tasks_Table", lval);
};
apz.app.updateChartBeforeRender = function(chartType, chartData, id, chart) {
    debugger;
    if (id == "actf01__TaskFlow__allStatus") {
        chartData.chart.showXAxisLine = '1';
        chartData.chart.showYAxisLine = '1';
    }
};
apz.actf01.TaskFlow.addStatusColor = function() {
    // var len = $("#actf01__TaskFlow__Tasks_Table_tbody tr").length;
    // for(var i=0;i<len;i++){
    //     var lval = apz.getElmValue("actf01__TaskListDummy__i__tbDbmiWorkflowMaster__status_"+i);
    //     if(lval == "COMPLETED") {
    //         $("#actf01__TaskListDummy__i__tbDbmiWorkflowMaster__status_"+i).addClass("suc");
    //     } else {
    //         $("#actf01__TaskListDummy__i__tbDbmiWorkflowMaster__status_"+i).addClass("inf");
    //     }
    // }
};
// apz.app.postChangePage = function(containerId, ind, obj) {
//     if (containerId == "actf01__TaskFlow__Tasks_Table") {
//         apz.actf01.TaskFlow.addStatusColor();
//     }
// };
apz.actf01.TaskFlow.genericSearch = function() {
    var lsearch = apz.getElmValue("actf01__TaskFlow__genericSearch");
    var lval = '';
    if (lsearch == "system") {
        lval = "SUBMIT";
    } else if (lsearch == "user") {
        lval = apz.Login.sUser;
    }
    apz.searchRecords("actf01__TaskFlow__Tasks_Table", lval);
};
