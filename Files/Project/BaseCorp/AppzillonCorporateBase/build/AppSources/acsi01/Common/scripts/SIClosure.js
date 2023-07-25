apz.acsi01.SIClosure = {};
apz.acsi01.SIClosure.sCurrentWfDetails = {};
apz.app.onLoad_SIClosure = function(params) {
    debugger;
    apz.hide("acsi01__StandingInstructions__SIRow");
    apz.acsi01.SIClosure.sCorporateId = apz.Login.sCorporateId;
    apz.data.scrdata.acsi01__SIClosure_Req = {};
    apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer = params.SIData;
    if (!apz.isNull(params.Status)) {
        apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.status = "Closed";
    }
    
    var strlen = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.maskAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.MaskToAccNo = result1;
    
    
    apz.data.loadData("SIClosure", "acsi01");
};
apz.acsi01.SIClosure.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("SIClosure", "acsi01");
    if (!apz.mockServer) {
        var taskObj = {};
        taskObj.workflowId = "SICS";
        //taskObj.stageId = "VERIFY";
        taskObj.status = "U";
        //taskObj.userId = apz.Login.sUserId;
        taskObj.taskType = "SICLOSURE_VERIFY";
        taskObj.versionNo = "1";
        //taskObj.appId = "acsi01";
        //taskObj.screenId = "SIClosure";
        taskObj.screenData = JSON.stringify(lscreenData);
        //taskObj.stageSeqNo = 1;
        taskObj.action = "";
        //taskObj.createUserId = apz.Login.sUserId;
        taskObj.referenceId = apz.acsi01.SIClosure.sCorporateId + "__" + taskObj.workflowId;
        taskObj.taskDesc = taskObj.referenceId + "'s SI details have been submitted";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.acsi01.SIClosure.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__SIClosure__launchMicroServiceHere",
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
        var lParams = {
            "appId": "acsi01",
            "scr": "SIClosureApprove",
            "userObj": lReqObj,
            "div": "acsi01__StandingInstructions__launchScreen",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acsi01.SIClosure.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acsi01";
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
                    "div": "acsi01__StandingInstructions__launchScreen",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acsi01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};
apz.acsi01.SIClosure.cancel = function() {
    debugger;
    apz.show("acsi01__StandingInstructions__SIRow");
    $("#acsi01__StandingInstructions__SIAdd").removeClass('sno');
    $("#acsi01__StandingInstructions__SummaryRow").removeClass('sno');
    $("#acsi01__StandingInstructions__launchScreenRow").addClass('sno');
};
