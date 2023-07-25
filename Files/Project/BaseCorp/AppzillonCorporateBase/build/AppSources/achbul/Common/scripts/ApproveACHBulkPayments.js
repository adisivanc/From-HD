apz.achbul.ApproveACHBulkPayments = {};
apz.app.onLoad_ApproveACHBulkPayments = function(params) {
    debugger;
    apz.achbul.ApproveACHBulkPayments.sCorporateId = apz.Login.sCorporateId;
    apz.achbul.ApproveACHBulkPayments.sUserID = apz.Login.sUserId;
    apz.achbul.ApproveACHBulkPayments.sTaskObj = params;
    apz.data.scrdata.achbul__ACHBulkPayments_Req = JSON.parse(params.currentWfDetails.screenData).achbul__ACHBulkPayments_Req;
    apz.data.loadData("ACHBulkPayments", "achbul");
    
     if(apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments.length !=0){
    var fromAcctNo = apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments[0].fromAccount;
    apz.setElmValue("achbul__ApproveACHBulkPayments__el_dpd_1",fromAcctNo);
    var llength = apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments.length;
    for(var i=0;i<llength;i++){
        $("#achbul__ACHBulkPayments__i__tbDbmiCorpAchbulkpayments__toAccount_"+ i).val(apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments[i].toAccount);
    }
    }
}


apz.achbul.ApproveACHBulkPayments.fnApprove = function(){
    debugger;
     var lscreenData = apz.data.buildData("ACHBulkPayments", "achbul");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.achbul.ApproveACHBulkPayments.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.achbul.ApproveACHBulkPayments.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.achbul.ApproveACHBulkPayments.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achbul__ApproveACHBulkPayments__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "EXAC000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchApp(lParams);
    }
}

apz.achbul.ApproveACHBulkPayments.workflowMicroServiceCB = function(pNextStageObj){
    debugger;
     apz.currAppId = "achbul";
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
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.lecr01.AddLCApprove.executeServiceTask();
            }
        } else if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            apz.achbul.ApproveACHBulkPayments.executeServiceTask(pNextStageObj);
        }
    }
}


apz.achbul.ApproveACHBulkPayments.executeServiceTask= function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments;
   
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    // var lServerParams = {
    //     "ifaceName": "ACHBulkPayments_New",
    //     "buildReq": "N",
    //     "req": "",
    //     "paintResp": "N",
    //     "async": "true",
    //     "callBack": apz.achbul.ApproveACHBulkPayments.executeServiceTaskCB,
    //     "callBackObj": {
    //         "userObj": lReqObj
    //     }
    // };
    
    var lServerParams = {
        "ifaceName": "InsertACHBulkPayments_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.achbul.ApproveACHBulkPayments.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    req.tbDbmiCorpAchbulkpayments = lTransferDetails;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};

apz.achbul.ApproveACHBulkPayments.executeServiceTaskCB = function(pResp) {
    debugger;
    //if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achbul__ApproveACHBulkPayments__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.achbul.ApproveACHBulkPayments.sTaskObj.currentTask,
                "currentWfDetails": apz.achbul.ApproveACHBulkPayments.sTaskObj.currentWfDetails,
                "callBack": apz.achbul.ApproveACHBulkPayments.submitCB
            }
        };
        apz.launchApp(lParams);
    // } 
    
    // else {
    //     var msg = {
    //         "code": pResp.errors[0].errorCode
    //     };
    //     apz.dispMsg(msg);
    // }
};

apz.achbul.ApproveACHBulkPayments.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            //if (pRespObj.stageAccess) {
            var lObj = {};
            lObj.referenceId = pRespObj.tbDbmiWorkflowMaster.referenceId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchApp(lParams);
            //}
        }
    }
};
