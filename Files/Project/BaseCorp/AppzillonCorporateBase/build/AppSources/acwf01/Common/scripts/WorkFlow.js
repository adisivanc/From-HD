apz.acwf01 = {};
apz.acwf01.workFlow = {};
apz.acwf01.workFlow.sOperation = "";
apz.acwf01.workFlow.sTaskObj = {};
apz.acwf01.workFlow.sCurrentWfDetails = {};
apz.acwf01.workFlow.getscrDetails = {};
apz.acwf01.workFlow.sCallBack = "";
apz.app.onLoad_WorkFlow = function(params) {
    debugger;
    if (apz.Login) {
        apz.acwf01.workFlow.sRoleId = apz.Login.sRoleId;
        apz.acwf01.workFlow.sCorporateId = apz.Login.sCorporateId;
        apz.acwf01.workFlow.sUserId = apz.Login.sUserId;
    }
    apz.acwf01.workFlow.sOperation = params.operation;
    apz.acwf01.workFlow.sReject = false;
    if(params.reject){
        apz.acwf01.workFlow.sReject = true;
    }
    apz.acwf01.workFlow.sTaskVariables = [];
    if (params.taskVariables) {
        apz.acwf01.workFlow.sTaskVariables = params.taskVariables;
    }
    //if (apz.acwf01.workFlow.sOperation == "CHECKACCESS") {
    if (apz.acwf01.workFlow.sOperation == "INITIALISE") {
        apz.acwf01.workFlow.sCallBack = params.callBack;
       //apz.acwf01.workFlow.checkAccess(params.workflowId, params.task);
       apz.acwf01.workFlow.fnInitialise(params);
       
    } else {
        apz.acwf01.workFlow.executeWorkFlow(params);
    }
};
apz.acwf01.workFlow.executeWorkFlow = function(params) {
    debugger;
    if (params.operation == "NEWTASK") {
        var lCallBackFn = params.callBack;
        apz.acwf01.workFlow.sTaskObj = params.currentTask;
        apz.acwf01.workFlow.sCurrentWfDetails = params.currentWfDetails;
        apz.acwf01.workFlow.updateMaster();
    } else if (params.operation == "NEWWORKFLOW") {
        if (params.callBack) {
            apz.acwf01.workFlow.sCallBack = params.callBack;
        }
        apz.acwf01.workFlow.fetchWorkflowDetails(params);
    } else if (params.operation == "NEXTTASK") {
        if (params.callBack) {
            apz.acwf01.workFlow.sCallBack = params.callBack;
        }
        apz.acwf01.workFlow.sTaskObj = params.currentTask;
        apz.acwf01.workFlow.sTaskObj.lastUser = apz.acwf01.workFlow.sTaskObj.actorId;
       // apz.acwf01.workFlow.sTaskObj.actorId = apz.acwf01.workFlow.sUserId;
       apz.acwf01.workFlow.sTaskObj.actorId = "";
        apz.acwf01.workFlow.sCurrentWfDetails = params.currentWfDetails;
        //apz.acwf01.workFlow.sCurrentWfDetails.actorId = apz.acwf01.workFlow.sUserId;
        apz.acwf01.workFlow.sCurrentWfDetails.actorId = "";
        apz.acwf01.workFlow.sCurrentWfDetails.endTs = apz.acwf01.workFlow.convertToMySQLTS();
        apz.acwf01.workFlow.updateMaster();
    } else if (params.operation == "SAVENEWWORKFLOW") {
        if (params.callBack) {
            apz.acwf01.workFlow.sCallBack = params.callBack;
        }
        apz.acwf01.workFlow.fetchWorkflowDetails(params);
    } else if (params.operation == "SAVETASK") {
        apz.acwf01.workFlow.sTaskObj = params.currentTask;
        apz.acwf01.workFlow.sTaskObj.lastUser = apz.acwf01.workFlow.sTaskObj.actorId;
        //apz.acwf01.workFlow.sTaskObj.actorId = apz.acwf01.workFlow.sUserId;
        apz.acwf01.workFlow.sTaskObj.actorId = "";
        apz.acwf01.workFlow.sCurrentWfDetails = params.currentWfDetails;
        //apz.acwf01.workFlow.sCurrentWfDetails.actorId = apz.acwf01.workFlow.sUserId;
        apz.acwf01.workFlow.sCurrentWfDetails.actorId = "";
        apz.acwf01.workFlow.updateMaster();
    } else if (params.operation == "CANCEL" || params.operation == "DISCARD") {
        if (params.callBack) {
            apz.acwf01.workFlow.sCallBack = params.callBack;
        }
        apz.acwf01.workFlow.sTaskObj = params.currentTask;
        apz.acwf01.workFlow.updateMasterStatus(params.operation);
    }
};
apz.acwf01.workFlow.fetchWorkflowDetails = function(params) {
    apz.acwf01.workFlow.getscrDetails = params;
    var lServerParams = {
        "ifaceName": "WorkFlowSeqNum_Query",
        "buildReq": "N",
        "req": "",
        "appId": "acwf01",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.workflowDetailsCB,
        "callBackObj": ""
    };
    var req = {};
    req.tbDbmiWorkflow = {};
    req.tbDbmiWorkflow.workflowId = params.taskDetails.workflowId;
    req.tbDbmiWorkflow.stageSeqNo = "1";
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.workflowDetailsCB = function(pResp) {
    debugger;
    var lParams = {};
    lParams.operation = apz.acwf01.workFlow.getscrDetails.operation;
    lParams.taskDetails = {};
    lParams.taskDetails.action = "";
    lParams.taskDetails.appId = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow.appId;
    lParams.taskDetails.screenId = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow.screenId;
    lParams.taskDetails.stageId = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow.stageId;
    lParams.taskDetails.stageSeqNo = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow.stageSeqNo;
    lParams.taskDetails.workflowId = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow.workflowId;
    lParams.taskDetails.taskDesc = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow.workflowDesc;
    lParams.taskDetails.taskType = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow.workflowDesc;
    lParams.taskDetails.referenceId = apz.acwf01.workFlow.getscrDetails.taskDetails.referenceId;
    lParams.taskDetails.createUserId = apz.Login.sUserId;
    lParams.taskDetails.screenData = apz.acwf01.workFlow.getscrDetails.taskDetails.screenData;
    lParams.taskDetails.userId = apz.Login.sUserId;
    lParams.taskDetails.versionNo = apz.acwf01.workFlow.getscrDetails.taskDetails.versionNo;
    apz.acwf01.workFlow.startWorkflow(lParams);
};
apz.acwf01.workFlow.startWorkflow = function(params) {
    debugger;
    apz.acwf01.workFlow.save(params);
};
apz.acwf01.workFlow.save = function(pTaskObj) {
    debugger;
    apz.acwf01.workFlow.sTaskObj = $.extend(true, {}, pTaskObj);
    var pObj = $.extend(true, {}, pTaskObj.taskDetails);
    debugger;
    var lServerParams = {
        "ifaceName": "WorkflowMasterSave_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "appId": "acwf01",
        "async": false,
        "callBack": apz.acwf01.workFlow.workflowMasterSaveCB,
        "callBackObj": {
            "screenId": pObj.screenId,
            "screenData": pObj.screenData
        }
    };
    var lDate = apz.acwf01.workFlow.convertToMySQLTS();
    var lInstanceId = pObj.workflowId + Math.floor(Math.random()*10000000) + lDate.replace(/[ :-]/g, "").slice("4")
    var req = {};
    req.tbDbmiWorkflowMaster = {};
    req.tbDbmiWorkflowMaster.appId = pObj.appId;
    req.tbDbmiWorkflowMaster.workflowId = pObj.workflowId;
    req.tbDbmiWorkflowMaster.instanceId = lInstanceId;
    req.tbDbmiWorkflowMaster.workflowName = pObj.taskType;
    req.tbDbmiWorkflowMaster.workflowType = pObj.taskType;
    req.tbDbmiWorkflowMaster.stageId = pObj.stageId;
    req.tbDbmiWorkflowMaster.stageSeqNo = pObj.stageSeqNo;
    if (apz.acwf01.workFlow.sOperation == "SAVENEWWORKFLOW") {
        req.tbDbmiWorkflowMaster.status = "SAVED";
    } else {
        req.tbDbmiWorkflowMaster.status = "INPROGRESS";
    }
    if(apz.acwf01.workFlow.sReject){
        req.tbDbmiWorkflowMaster.status = "REJECTED";
    }
    req.tbDbmiWorkflowMaster.actorId = apz.acwf01.workFlow.sUserId;
    req.tbDbmiWorkflowMaster.referenceId = pObj.referenceId;
    req.tbDbmiWorkflowMaster.startTs = lDate;
    req.tbDbmiWorkflowMaster.stageType = pObj.stageType;
    req.tbDbmiWorkflowMaster.initiatedBy = apz.acwf01.workFlow.sUserId;
    req.tbDbmiWorkflowMaster.versionNo = 1;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.workflowMasterSaveCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        apz.acwf01.workFlow.sTaskObj = pResp.res.acwf01__WorkflowMasterSave_Res.tbDbmiWorkflowMaster;
        var pWorkflowObj = apz.acwf01.workFlow.sTaskObj;
        var lServerParams = {
            "ifaceName": "WorkflowDetailSave_New",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "appId": "acwf01",
            "async": false,
            "callBack": apz.acwf01.workFlow.workflowDetailSaveCB,
            "callBackObj": "",
        };
        var req = {};
        req.tbDbmiWorkflowDetail = {};
        req.tbDbmiWorkflowDetail.instanceId = pWorkflowObj.instanceId;
        req.tbDbmiWorkflowDetail.workflowId = pWorkflowObj.workflowId;
        req.tbDbmiWorkflowDetail.appId = pWorkflowObj.appId;
        req.tbDbmiWorkflowDetail.stageSeqNo = pWorkflowObj.stageSeqNo;
        req.tbDbmiWorkflowDetail.screenId = pResp.callBackObj["screenId"];
        req.tbDbmiWorkflowDetail.actorId = pWorkflowObj.actorId;
        req.tbDbmiWorkflowDetail.action = pWorkflowObj.action;
        req.tbDbmiWorkflowDetail.screenData = pResp.callBackObj["screenData"];
        req.tbDbmiWorkflowDetail.startTs = pResp.res.acwf01__WorkflowMasterSave_Res.tbDbmiWorkflowMaster.startTs;
        req.tbDbmiWorkflowDetail.endTs = pResp.res.acwf01__WorkflowMasterSave_Res.tbDbmiWorkflowMaster.startTs;
        req.tbDbmiWorkflowDetail.versionNo = 1;
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    }
};
apz.acwf01.workFlow.workflowDetailSaveCB = function(pResp) {
    if (!pResp.errors) {
        apz.acwf01.workFlow.sCurrentWfDetails = pResp.res.acwf01__WorkflowDetailSave_Res.tbDbmiWorkflowDetail;
        if (apz.acwf01.workFlow.sOperation != "SAVENEWWORKFLOW") {
            if (apz.acwf01.workFlow.sTaskVariables != undefined && apz.acwf01.workFlow.sTaskVariables.length != 0) {
                apz.acwf01.workFlow.getNextStageFromRule();
            } else {
                apz.acwf01.workFlow.fetchWorkflowSeq();
            }
        } else {
            var msg = {
                "code": 'ACWF_TASK_SAVE'
            };
            apz.dispMsg(msg);
            apz.acwf01.workFlow.callWorkFlowCallBack(apz.acwf01.workFlow.sCurrentWfDetails, apz.acwf01.workFlow.sTaskObj);
        }
    }
};
apz.acwf01.workFlow.getNextStageFromRule = function() {
    debugger;
    var lObj = apz.acwf01.workFlow.sTaskObj;
    var ruleObj = {};
    ruleObj.corporateId = apz.acwf01.workFlow.sCorporateId;
    ruleObj.functionId = lObj.workflowId;
    ruleObj.stageId = lObj.stageId;
    ruleObj.stageSeqNo = lObj.stageSeqNo;
    ruleObj.taskVariables = apz.acwf01.workFlow.sTaskVariables;
    var lUserObj = {};
    lUserObj.ruleDetails = ruleObj;
    lUserObj.callBack = apz.acwf01.workFlow.getNextStageFromRuleCB;
    var lParams = {
        "appId": "acre01",
        "scr": "RuleExecute",
        "div": "acwf01__WorkFlow__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.acwf01.workFlow.getNextStageFromRuleCB = function(pResp) {
    debugger;
    apz.currAppId = 'acwf01';
    var lNextStage = pResp;
    if (lNextStage != "") {
        apz.acwf01.workFlow.getWorkflowDetails(lNextStage);
    }
};
apz.acwf01.workFlow.getWorkflowDetails = function(pStage) {
    debugger;
    var lObj = apz.acwf01.workFlow.sTaskObj;
    var lServerParams = {
        "ifaceName": "WorkFlowStageId_Query",
        "appId": "acwf01",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.getWorkflowDetailsCB,
        "callBackObj": ""
    };
    var req = {};
    req.tbDbmiWorkflow = {};
    req.tbDbmiWorkflow.workflowId = lObj.workflowId;
    req.tbDbmiWorkflow.stageId = pStage;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.getWorkflowDetailsCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lfetchNextStageObj = pResp.res.acwf01__WorkFlowStageId_Res.tbDbmiWorkflow;
        var lParams = {};
        lParams.operation = "NEWTASK";
        apz.acwf01.workFlow.sOperation = "NEWTASK";
        lParams.currentTask = apz.acwf01.workFlow.sTaskObj;
        lParams.currentWfDetails = apz.acwf01.workFlow.sCurrentWfDetails;
        if (lfetchNextStageObj.stageSeqNo < apz.acwf01.workFlow.sTaskObj.stageSeqNo) {
            lParams.currentTask.versionNo = apz.acwf01.workFlow.sTaskObj.versionNo + 1;
            lParams.currentWfDetails.versionNo = apz.acwf01.workFlow.sCurrentWfDetails.versionNo + 1;
            lParams.currentWfDetails.remarks = "";
        }
        lParams.currentTask.stageId = lfetchNextStageObj.stageId;
        lParams.currentTask.stageSeqNo = lfetchNextStageObj.stageSeqNo;
        lParams.currentTask.stageType = lfetchNextStageObj.stageType;
        lParams.currentTask.actorId = "";
        lParams.currentWfDetails.startTs = apz.acwf01.workFlow.convertToMySQLTS();
        lParams.currentWfDetails.appId = lfetchNextStageObj.appId;
        lParams.currentWfDetails.endTs = "";
        lParams.currentWfDetails.stageSeqNo = lfetchNextStageObj.stageSeqNo;
        lParams.currentWfDetails.screenId = lfetchNextStageObj.screenId;
        lParams.currentWfDetails.screenData = apz.acwf01.workFlow.sCurrentWfDetails.screenData;
        apz.acwf01.workFlow.executeWorkFlow(lParams);
    }else{
        apz.dispMsg({message:"Your request has been submitted for further approval.",type:"I"});
    }
};
apz.acwf01.workFlow.fetchWorkflowSeq = function() {
    debugger;
    var lObj = apz.acwf01.workFlow.sTaskObj;
    var lServerParams = {
        "ifaceName": "WorkFlowStageId_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "appId": "acwf01",
        "async": "true",
        "callBack": apz.acwf01.workFlow.fetchWorkflowSeqCB,
        "callBackObj": ""
    };
    var req = {};
    req.tbDbmiWorkflow = {};
    req.tbDbmiWorkflow.workflowId = lObj.workflowId;
    req.tbDbmiWorkflow.stageId = lObj.stageId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.fetchWorkflowSeqCB = function(pResp) {
    if (!pResp.errors) {
        var lNextSeq = parseInt(pResp.res.acwf01__WorkFlowStageId_Res.tbDbmiWorkflow.stageSeqNo) + 1;
        apz.acwf01.workFlow.fetchWorkflowStageBySeq(lNextSeq);
    }
};
apz.acwf01.workFlow.fetchWorkflowStageBySeq = function(pSeqNum) {
    debugger;
    var lObj = apz.acwf01.workFlow.sTaskObj;
    var lServerParams = {
        "ifaceName": "WorkFlowSeqNum_Query",
        "buildReq": "N",
        "req": "",
        "appId": "acwf01",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.fetchWorkflowStageBySeqCB,
        "callBackObj": ""
    };
    var req = {};
    req.tbDbmiWorkflow = {};
    req.tbDbmiWorkflow.workflowId = lObj.workflowId;
    req.tbDbmiWorkflow.stageSeqNo = pSeqNum;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.fetchWorkflowStageBySeqCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lfetchNextStageObj = pResp.res.acwf01__WorkFlowSeqNum_Res.tbDbmiWorkflow;
        var lParams = {};
        lParams.operation = "NEWTASK";
        apz.acwf01.workFlow.sOperation = "NEWTASK";
        lParams.currentTask = apz.acwf01.workFlow.sTaskObj;
        lParams.currentTask.stageType = lfetchNextStageObj.stageType;
        lParams.currentTask.stageId = lfetchNextStageObj.stageId;
        lParams.currentTask.stageSeqNo = lfetchNextStageObj.stageSeqNo;
        lParams.currentWfDetails = apz.acwf01.workFlow.sCurrentWfDetails;
        lParams.currentWfDetails.screenId = lfetchNextStageObj.screenId;
        lParams.currentWfDetails.appId = lfetchNextStageObj.appId;
        lParams.currentWfDetails.stageSeqNo = lfetchNextStageObj.stageSeqNo;
        lParams.currentWfDetails.screenData = apz.acwf01.workFlow.sCurrentWfDetails.screenData;
        lParams.currentWfDetails.startTs = apz.acwf01.workFlow.convertToMySQLTS();
        if (lfetchNextStageObj.stageId == "FINAL") {
            lParams.currentTask.status = "COMPLETED";
            lParams.currentTask.endTs = apz.acwf01.workFlow.convertToMySQLTS();
            lParams.currentWfDetails.endTs = apz.acwf01.workFlow.convertToMySQLTS();
        } else {
            lParams.currentWfDetails.endTs = "";
        }
        apz.acwf01.workFlow.executeWorkFlow(lParams);
    } else if (pResp.errors[0].errorCode == "APZ_FM_EX_038") {
        var lServerParams = {
            "ifaceName": "WorkflowMasterSave_Modify",
            "buildReq": "N",
            "appId": "acwf01",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.acwf01.workFlow.workflowCompletedCB
        };
        var req = {};
        req.tbDbmiWorkflowMaster = apz.acwf01.workFlow.sTaskObj;
        req.tbDbmiWorkflowMaster.status = "COMPLETED";
        req.tbDbmiWorkflowMaster.endTs = apz.acwf01.workFlow.convertToMySQLTS();
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    }
};
apz.acwf01.workFlow.workflowCompletedCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var msg = {
            "code": 'ACWF_COMP'
        };
        apz.dispMsg(msg);
        var lMasterObj = pResp.res.acwf01__WorkflowMasterSave_Res.tbDbmiWorkflowMaster;
        apz.acwf01.workFlow.callWorkFlowCallBack(apz.acwf01.workFlow.sCurrentWfDetails, lMasterObj);
    };
};
apz.acwf01.workFlow.convertToMySQLTS = function() {
    var starttime = new Date();
    var isotime = new Date((new Date(starttime)).toISOString());
    var fixedtime = new Date(isotime.getTime() - (starttime.getTimezoneOffset() * 60000));
    var formatedMysqlString = fixedtime.toISOString().slice(0, 19).replace('T', ' ');
    console.log(formatedMysqlString);
    return formatedMysqlString;
};
apz.acwf01.workFlow.updateMaster = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "WorkflowMasterSave_Modify",
        "buildReq": "N",
        "appId": "acwf01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.workflowMasterUpdateCB
    };
    var req = {};
    req.tbDbmiWorkflowMaster = apz.acwf01.workFlow.sTaskObj;
    if (apz.acwf01.workFlow.sOperation == "SAVETASK") {
        req.tbDbmiWorkflowMaster.status = "SAVED";
    }
    if(apz.acwf01.workFlow.sReject){
        req.tbDbmiWorkflowMaster.status = "REJECTED";
    }
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.updateMasterStatus = function(pStatus) {
    debugger
    var lServerParams = {
        "ifaceName": "WorkflowMasterSave_Modify",
        "buildReq": "N",
        "appId": "acwf01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.updateMasterStatusCB
    };
    var req = {};
    req.tbDbmiWorkflowMaster = apz.acwf01.workFlow.sTaskObj;
    req.tbDbmiWorkflowMaster.status = pStatus;
    req.tbDbmiWorkflowMaster.endTs = apz.acwf01.workFlow.convertToMySQLTS();
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
}
apz.acwf01.workFlow.updateMasterStatusCB = function(pResp) {
    debugger;
    apz.acpr01.ViewAddress.fnCancelDiscardCB();
}
apz.acwf01.workFlow.workflowMasterUpdateCB = function(pResp) {
    debugger;
    apz.acwf01.workFlow.workflowDetailsDelete(pResp);
};
apz.acwf01.workFlow.workflowDetailsDelete = function(pResp) {
    debugger;
    var lServerParams = {
        "ifaceName": "WorkflowDetailSave_Delete",
        "buildReq": "N",
        "appId": "acwf01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.workflowDetailsDeleteCB,
        "callBackObj": pResp.res.acwf01__WorkflowMasterSave_Res.tbDbmiWorkflowMaster
    };
    var lDate = apz.acwf01.workFlow.convertToMySQLTS();
    var req = {};
    req.tbDbmiWorkflowDetail = {};
    req.tbDbmiWorkflowDetail.appId = apz.acwf01.workFlow.sCurrentWfDetails.appId;
    req.tbDbmiWorkflowDetail.workflowId = apz.acwf01.workFlow.sCurrentWfDetails.workflowId;
    req.tbDbmiWorkflowDetail.stageSeqNo = apz.acwf01.workFlow.sCurrentWfDetails.stageSeqNo;
    req.tbDbmiWorkflowDetail.instanceId = apz.acwf01.workFlow.sCurrentWfDetails.instanceId;
    req.tbDbmiWorkflowDetail.versionNo = apz.acwf01.workFlow.sCurrentWfDetails.versionNo;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.workflowDetailsDeleteCB = function(pResp) {
    debugger;
    apz.acwf01.workFlow.workflowDetailsInsert(pResp);
};
apz.acwf01.workFlow.workflowDetailsInsert = function(pResp) {
    debugger;
    var lServerParams = {
        "ifaceName": "WorkflowDetailSave_New",
        "buildReq": "N",
        "appId": "acwf01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.workflowDetailsInsertCB,
        "callBackObj": pResp.callBackObj
    };
    var lDate = apz.acwf01.workFlow.convertToMySQLTS();
    var req = {};
    req.tbDbmiWorkflowDetail = apz.acwf01.workFlow.sCurrentWfDetails;
    req.tbDbmiWorkflowDetail.stageSeqNo = apz.acwf01.workFlow.sCurrentWfDetails.stageSeqNo;
    req.tbDbmiWorkflowDetail.screenId = apz.acwf01.workFlow.sCurrentWfDetails.screenId;
    req.tbDbmiWorkflowDetail.screenData = apz.acwf01.workFlow.sCurrentWfDetails.screenData;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.workflowDetailsInsertCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        if (apz.acwf01.workFlow.sOperation != "SAVETASK") {
            if (apz.acwf01.workFlow.sOperation == "NEXTTASK") {
                if (apz.acwf01.workFlow.sTaskVariables != undefined && apz.acwf01.workFlow.sTaskVariables.length != 0) {
                    apz.acwf01.workFlow.getNextStageFromRule();
                } else {
                    apz.acwf01.workFlow.fetchWorkflowSeq();
                }
            } else {
                debugger;
                if (apz.acwf01.workFlow.sTaskObj.stageType == "USERTASK") {
                    debugger;
                    var lServerParams = {
                        "ifaceName": "RoleFunctionAccess_Query",
                        "buildReq": "N",
                        "appId": "acwf01",
                        "req": "",
                        "paintResp": "N",
                        "async": "true",
                        "callBack": apz.acwf01.workFlow.RoleFunctionAccessCB,
                        "callBackObj": {
                            "lDetailObj": pResp.res.acwf01__WorkflowDetailSave_Res.tbDbmiWorkflowDetail,
                            "lMasterObj": pResp.callBackObj
                        }
                    };
                    var req = {};
                    req.tbDbmiCorpRoleOperations = {};
                    req.tbDbmiCorpRoleOperations.corporateId = apz.acwf01.workFlow.sCorporateId;
                    req.tbDbmiCorpRoleOperations.roleId = apz.acwf01.workFlow.sRoleId;
                    req.tbDbmiCorpRoleOperations.

                    function = apz.acwf01.workFlow.sTaskObj.workflowId;
                    req.tbDbmiCorpRoleOperations.operation = apz.acwf01.workFlow.sTaskObj.stageId;
                    lServerParams.req = req;
                    apz.server.callServer(lServerParams);
                } else {
                    var lDetailObj = pResp.res.acwf01__WorkflowDetailSave_Res.tbDbmiWorkflowDetail;
                    var lMasterObj = pResp.callBackObj;
                    apz.acwf01.workFlow.callWorkFlowCallBack(lDetailObj, lMasterObj);
                }
            }
        } else {
            var msg = {
                "code": 'ACWF_TASK_SAVE'
            };
            apz.dispMsg(msg);
            apz.acwf01.workFlow.callWorkFlowCallBack(apz.acwf01.workFlow.sCurrentWfDetails, apz.acwf01.workFlow.sTaskObj);
        }
    }
};
apz.acwf01.workFlow.RoleFunctionAccessCB = function(pResp) {
    debugger;
    var lFunctionAccess;
    if (!pResp.errors) {
        lFunctionAccess = true;
    } else if (pResp.errors[0].errorCode == "APZ_FM_EX_038") {
        lFunctionAccess = false;
    }
    var lDetailObj = pResp.callBackObj.lDetailObj;
    var lMasterObj = pResp.callBackObj.lMasterObj;
    apz.acwf01.workFlow.callWorkFlowCallBack(lDetailObj, lMasterObj, lFunctionAccess);
};
apz.acwf01.workFlow.callWorkFlowCallBack = function(pDetailObj, pMasterObj, pAccess) {
    debugger;
    var lRespObj = {};
    lRespObj.tbDbmiWorkflowDetail = pDetailObj;
    lRespObj.tbDbmiWorkflowMaster = pMasterObj;
    lRespObj.tbDbmiWorkflowMaster.remarks = "";
    if (pAccess != undefined) {
        lRespObj.stageAccess = pAccess;
    }
    apz.acwf01.workFlow.sCallBack(lRespObj);
};

apz.acwf01.workFlow.fnInitialise = function(params){
    if(params.action == "CHECKACCESS"){
        apz.acwf01.workFlow.checkAccess(params.workflowId,params.task)
    }
}



apz.acwf01.workFlow.checkAccess = function(pWorkflowId, pOperation) {
    debugger;
    var lServerParams = {
        "ifaceName": "RoleFunctionAccess_Query",
        "buildReq": "N",
        "appId": "acwf01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acwf01.workFlow.checkAccessCB,
        "callBackObj": {}
    };
    var req = {};
    req.tbDbmiCorpRoleOperations = {};
    req.tbDbmiCorpRoleOperations.corporateId = apz.acwf01.workFlow.sCorporateId;
    req.tbDbmiCorpRoleOperations.roleId = apz.acwf01.workFlow.sRoleId;
    req.tbDbmiCorpRoleOperations.

    function = pWorkflowId;
    req.tbDbmiCorpRoleOperations.operation = pOperation;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acwf01.workFlow.checkAccessCB = function(pResp) {
    var lAccess;
    if (!pResp.errors) {
        lAccess = true;
    } else if (pResp.errors[0].errorCode == "APZ_FM_EX_038") {
        lAccess = false;
        var params = {
            'code': 'ACCESS_DEN'
        };
        apz.dispMsg(params);
    } else {
        lAccess = false;
    }
    apz.acwf01.workFlow.sCallBack(lAccess);
};
