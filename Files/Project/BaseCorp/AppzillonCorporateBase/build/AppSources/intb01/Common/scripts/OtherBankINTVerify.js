apz.intb01.otherBankINTVerify = {};
apz.intb01.otherBankINTVerify.sTaskObj = {};
apz.app.onLoad_OtherBankINTVerify = function(params) {
    debugger;
    apz.intb01.otherBankINTVerify.sTaskObj = params;
    apz.intb01.otherBankINTVerify.sDiv = params.div;
    apz.data.scrdata.intb01__OtherBankInt_Req = {};
    apz.data.scrdata.intb01__OtherBankInt_Req.International = JSON.parse(params.currentWfDetails.screenData).intb01__OtherBankInt_Req.International;
    apz.intb01.otherBankINTVerify.getSiDetails(params);
    
    var strlen = apz.data.scrdata.intb01__OtherBankInt_Req.International.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.intb01__OtherBankInt_Req.International.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.intb01__OtherBankInt_Req.International.maskFrmAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.intb01__OtherBankInt_Req.International.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.intb01__OtherBankInt_Req.International.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.intb01__OtherBankInt_Req.International.maskToAccNo = result1;
    
    apz.data.loadData("OtherBankInt", "intb01");
};
apz.intb01.otherBankINTVerify.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).intb01__OtherBankInt_Req.International.type;
    if (lVal == "Schedule Payment") {
        $("#intb01__OtherBankINTVerify__Date").removeClass("sno");
    }
};
apz.intb01.otherBankINTVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "intb01",
        "scr": "OtherBankINT",
        "div": "intb01__OtherBankINT__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.intb01__OtherBankInt_Req
    };
    apz.launchSubScreen(lParams);
};
apz.intb01.otherBankINTVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankInt", "intb01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.intb01.otherBankINTVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.intb01.otherBankINTVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.intb01.otherBankINTVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "intb01__OtherBankINTVerify__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
       // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lReqObj.div = apz.intb01.otherBankINTVerify.sDiv;
        var lParams = {
            "appId": "intb01",
            "scr": "OtherBankINTApprove",
            "userObj": lReqObj,
            "div": apz.intb01.otherBankINTVerify.sDiv,
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.intb01.otherBankINTVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "intb01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.intb01.otherBankINTVerify.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.intb01.otherBankINTVerify.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acft01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};
