apz.acft01.withinBankVerify = {};
apz.acft01.withinBankVerify.sTaskObj = {};
apz.app.onLoad_WithinBankVerify = function(params) {
    debugger;
    apz.acft01.withinBankVerify.sTaskObj = params;
    apz.acft01.withinBankVerify.sDiv = params.div;
    apz.data.scrdata.acft01__WithinBankDetails_Req = JSON.parse(params.currentWfDetails.screenData).acft01__WithinBankDetails_Req;
    apz.acft01.withinBankVerify.getSiDetails(params);
    
    var strlen = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acft01__WithinBankDetails_Req.Details.maskFrmAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acft01__WithinBankDetails_Req.Details.maskToAccNo = result1;
    apz.data.loadData("WithinBankDetails", "acft01");
};
apz.acft01.withinBankVerify.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).acft01__WithinBankDetails_Req.Details.type;
    if (lVal == "Schedule Payment") {
        $("#acft01__WithinBankVerify__Date").removeClass("sno");
    }
};
apz.acft01.withinBankVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "acft01",
        "scr": "WithinBank",
        "div": "acft01__Transfers__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.acft01__WithinBankDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.acft01.withinBankVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("WithinBankDetails", "acft01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acft01.withinBankVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acft01.withinBankVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acft01.withinBankVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__WithinBankVerify__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lReqObj.div = apz.acft01.withinBankVerify.sDiv
        var lParams = {
            "appId": "acft01",
            "scr": "WithinBankApprove",
            "userObj": lReqObj,
            "div": apz.acft01.withinBankVerify.sDiv,
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acft01.withinBankVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acft01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.acft01.withinBankVerify.sDiv
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.acft01.withinBankVerify.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
};
