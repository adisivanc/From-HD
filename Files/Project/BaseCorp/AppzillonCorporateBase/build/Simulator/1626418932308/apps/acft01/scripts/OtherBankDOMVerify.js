apz.acft01.otherBankDOMVerify = {};
apz.acft01.otherBankDOMVerify.sTaskObj = {};
apz.app.onLoad_OtherBankDOMVerify = function(params) {
    debugger;
    apz.acft01.otherBankDOMVerify.sTaskObj = params;
    apz.acft01.otherBankDOMVerify.sDiv = params.div;
    //apz.acft01.otherBankDOMVerify.sDiv = "ACNR01__Navigator__launchPad";
     apz.data.scrdata.acft01__OtherBankDom_Req = {};
    apz.data.scrdata.acft01__OtherBankDom_Req.Domestic = JSON.parse(params.currentWfDetails.screenData).acft01__OtherBankDom_Req.Domestic;
    apz.acft01.otherBankDOMVerify.getSiDetails(params);
    
     var strlen = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.maskFrmAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.maskToAccNo = result1;
    
    apz.data.loadData("OtherBankDom", "acft01");
};
apz.acft01.otherBankDOMVerify.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).acft01__OtherBankDom_Req.Domestic.type;
    if (lVal == "Schedule Payment") {
        $("#acft01__OtherBankDOMVerify__Date").removeClass("sno");
    }
};
apz.acft01.otherBankDOMVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "acft01",
        "scr": "OtherBankDOM",
        "div": "acft01__Transfers__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.acft01__OtherBankDom_Req
    };
    apz.launchSubScreen(lParams);
};
apz.acft01.otherBankDOMVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankDom", "acft01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acft01.otherBankDOMVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acft01.otherBankDOMVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acft01.otherBankDOMVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OtherBankDOMVerify__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lReqObj.div = apz.acft01.otherBankDOMVerify.sDiv;
        var lParams = {
            "appId": "acft01",
            "scr": "OtherBankDOMAML",
            "userObj": lReqObj,
            "div": apz.acft01.otherBankDOMVerify.sDiv,
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acft01.otherBankDOMVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    debugger;
    apz.currAppId = "acft01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.acft01.otherBankDOMVerify.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.acft01.otherBankDOMVerify.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else { // apz.acft01.ownAccountApprove.executeServiceTask();
                var lObj = {};
                lObj.referenceId = "ODOM_" + pNextStageObj.tbDbmiWorkflowDetail.appId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "acft01__OtherBankDOMVerify__launchdiv",
                    "layout": "All"
                };
                $("#acft01__OtherBankDOMVerify__rowheader").addClass("sno");
                $("#acft01__OtherBankDOMVerify__rowdetail").addClass("sno");
                $("#acft01__OtherBankDOMVerify__gr_row_2").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
