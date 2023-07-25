apz.acft01.ownAccountVerify = {};
apz.acft01.ownAccountVerify.sTaskObj = {};
apz.app.onLoad_OwnAccountVerify = function(params) {
    debugger;
    apz.acft01.ownAccountVerify.sTaskObj = params;
    apz.acft01.ownAccountVerify.sDiv = params.div;
   //apz.acft01.ownAccountVerify.sDiv = "ACNR01__Navigator__launchPad";
    apz.data.scrdata.acft01__OwnAccount_Req = JSON.parse(params.currentWfDetails.screenData).acft01__OwnAccount_Req;
    apz.acft01.ownAccountVerify.getSiDetails(params);
    
    var strlen = apz.data.scrdata.acft01__OwnAccount_Req.Details.fromaccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__OwnAccount_Req.Details.fromaccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acft01__OwnAccount_Req.Details.maskFrmAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acft01__OwnAccount_Req.Details.toaccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__OwnAccount_Req.Details.toaccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acft01__OwnAccount_Req.Details.maskToAccNo = result1;
    
   
    
    apz.data.loadData("OwnAccount", "acft01");
};
apz.acft01.ownAccountVerify.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).acft01__OwnAccount_Req.Details.type;
    if (lVal == "Schedule Payment") {
        $("#acft01__OwnAccountVerify__Date").removeClass("sno");
    }
};
apz.acft01.ownAccountVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "acft01",
        "scr": "OwnAccount",
        "div": "acft01__Transfers__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.acft01__OwnAccount_Req
    };
    apz.launchSubScreen(lParams);
};
apz.acft01.ownAccountVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OwnAccount", "acft01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acft01.ownAccountVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acft01.ownAccountVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acft01.ownAccountVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OwnAccountVerify__launchMicroServiceHere",
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
        lReqObj.div = apz.acft01.ownAccountVerify.sDiv;
        var lParams = {
            "appId":"acft01",
            "scr": "OwnAccountApprove",
            "userObj": lReqObj,
            "div": apz.acft01.ownAccountVerify.sDiv,
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acft01.ownAccountVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acft01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.acft01.ownAccountVerify.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.acft01.ownAccountVerify.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
    //"div": "acft01__Transfers__launchPad",
    //actf01__TaskFlow__MicroAppRow
    //apz.acft01.ownAccountVerify.sDiv
};
