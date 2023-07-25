apz.ACDB01.AdminDashboard = {};
apz.ACDB01.AdminDashboard.sAction = "";
apz.app.onLoad_AdminDashboard = function(params) {
    //apz.data.loadJsonData("DashboardDummy2", "ACDB01");
    var params = {
        "action": "My Tasks"
    };
    apz.ACDB01.AdminDashboard.fnRender(params);
};
apz.ACDB01.AdminDashboard.fnRender = function(params) {
    apz.ACDB01.AdminDashboard.fnRenderActionButtons(params);
    apz.ACDB01.AdminDashboard.fnRenderData(params);
};
apz.ACDB01.AdminDashboard.fnRenderActionButtons = function(params) {
    debugger;
    if (params.action == "My Tasks") {
        apz.setElmValue("ACDB01__AdminDashboard__TaskSelect", "Today");
        apz.ACDB01.AdminDashboard.fnSearch();
        apz.setElmValue("ACDB01__AdminDashboard__totalUsers", "320");
        apz.setElmValue("ACDB01__AdminDashboard__activeUsers", "220");
        apz.setElmValue("ACDB01__AdminDashboard__totalRoles", "20");
        apz.setElmValue("ACDB01__AdminDashboard__totalRules", "120");
        apz.setElmValue("ACDB01__AdminDashboard__corporateId", apz.Login.sCorporateId);
        if(apz.Login.sCorporateId!="WARBUCKS"){
            apz.setElmValue("ACDB01__AdminDashboard__CorporateName", "ACME Corporation");
            
        }else{
            apz.setElmValue("ACDB01__AdminDashboard__CorporateName", "Warbucks Industries");
        }
        
        apz.setElmValue("ACDB01__AdminDashboard__CorporateType", "CORPORATION");
        
    }
};
apz.ACDB01.AdminDashboard.fnRenderData = function(params) {
    if (params.action == "My Tasks") {}
};
apz.ACDB01.AdminDashboard.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.ACDB01.AdminDashboard.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.ACDB01.AdminDashboard.callServerCB = function(params) {
    if (apz.ACDB01.AdminDashboard.sAction == "My Tasks") {
        apz.ACDB01.AdminDashboard.fnFetchTaskDetailsCB(params);
    }
};
apz.ACDB01.AdminDashboard.fnFetchTaskDetailsCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.ACDB01__MyTasks_Res.Status) {
        var lTasksArr = params.res.ACDB01__MyTasks_Res.tasks;
        var lTaskArrLength = lTasksArr.length;
        for (var i = 0; i < lTaskArrLength; i++) {
            lTasksArr[i].startTs = lTasksArr[i].startTs.substring(0,lTasksArr[i].startTs.length-2);
        }
        apz.data.scrdata.ACDB01__MyTasks_Res = {};
        apz.data.scrdata.ACDB01__MyTasks_Res.tasks = lTasksArr;
        apz.data.loadData("MyTasks","ACDB01");
            if (params.res.ACDB01__MyTasks_Res.tasks.length > 5) {
                $("#ACDB01__AdminDashboard__DashBoard_TaskTable_pagination_ul").removeClass("sno");
            } else {
                $("#ACDB01__AdminDashboard__DashBoard_TaskTable_pagination_ul").addClass("sno");
            }
        } else {
            var msg = {};
            msg.message = "No Records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.ACDB01.AdminDashboard.showScreens = function(pScreen) {
    var params = {};
    if (pScreen == "users") {
        params.appId = "acus01";
        params.scr = "UserList";
    } else if (pScreen == "roles") {
        params.appId = "acrl01";
        params.scr = "RolesList";
    } else if (pScreen == "rules") {
        params.appId = "acru01";
        params.scr = "RulesSummary";
    }
    params.layout = "All";
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
};
apz.ACDB01.AdminDashboard.showActiveUserScreens = function() {
    var params = {};
    params.appId = "ACDB01";
    params.scr = "ActiveUsersDashboard";
    params.layout = "All";
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchSubScreen(params);
};
apz.ACDB01.AdminDashboard.fnSearch = function() {
    debugger;
    apz.ACDB01.AdminDashboard.sAction = "My Tasks";
    var lType = apz.getElmValue("ACDB01__AdminDashboard__TaskSelect");
    var req = {};
    req.action = "Query";
    req.table = "tb_dbmi_my_tasks";
    req.tasks = {
        "flag": lType
    };
    var lParams = {
        "ifaceName": "MyTasks",
        "paintResp": "N",
        "appId": "ACDB01",
        "buildReq": "N",
        "lReq": req
    };
    apz.ACDB01.AdminDashboard.fnBeforCallServer(lParams);
};
