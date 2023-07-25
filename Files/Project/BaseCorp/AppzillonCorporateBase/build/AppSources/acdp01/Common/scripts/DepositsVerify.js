apz.acdp01.depositsVerify = {};
apz.acdp01.depositsVerify.sTaskObj = {};
apz.app.onLoad_DepositsVerify = function(params) {
    debugger;
    apz.acdp01.depositsVerify.sTaskObj = params;
    //apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits = JSON.parse(params.currentWfDetails.screenData).acdp01__Deposits_Req.tbDbmiCorpDeposits;
    apz.data.scrdata.acdp01__Deposits_Req = JSON.parse(params.currentWfDetails.screenData).acdp01__Deposits_Req;
    
        var strlen = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.maskAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.principalCreditAcno;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.principalCreditAcno;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.maskPrinciple = result1;
    
    apz.data.loadData("Deposits", "acdp01");
    
        
        
         
};
apz.acdp01.depositsVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "acdp01",
        "scr": "Deposits",
        "div": "acdp01__Deposits__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.acdp01__Deposits_Req
    };
    apz.launchSubScreen(lParams);
};
apz.acdp01.depositsVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("Deposits", "acdp01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.acdp01.depositsVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acdp01.depositsVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acdp01.depositsVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__DepositsVerify__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);;
        var lParams = {
            "appId": "acdp01",
            "scr": "DepositsApprove",
            "userObj": lReqObj,
            "div": "acdp01__DepositLauncher__DepositLauncher",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acdp01.depositsVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acdp01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": "acdp01__DepositLauncher__DepositLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acdp01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};
