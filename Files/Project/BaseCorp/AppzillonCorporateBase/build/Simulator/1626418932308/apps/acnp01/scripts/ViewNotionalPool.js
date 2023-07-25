apz.acnp01.viewNotionalPool = {};
apz.acnp01.viewNotionalPool.sCorporateId = "";
apz.acnp01.viewNotionalPool.sAction = "";
apz.app.onLoad_ViewNotionalPool = function(params) {
    apz.acnp01.viewNotionalPool.sCurrentTask = params.currentTask;
    apz.acnp01.viewNotionalPool.sCurrentWfDetails = params.currentWfDetails;
    apz.data.scrdata.acnp01__NotionalPoolInsert_Req = {};
    apz.data.scrdata.acnp01__NotionalPoolInsert_Req.tbDbmiCorpNotionalPool =JSON.parse(params.currentWfDetails.screenData).tbDbmiCorpNotionalPool;
    apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req = {};
    apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc = JSON.parse(params.currentWfDetails.screenData).tbDbmiCorpNotionalPoolAcc;
    apz.data.loadData("NotionalPoolAccInsert", 'acnp01');
    apz.data.loadData("NotionalPoolInsert", 'acnp01');
};

apz.acnp01.viewNotionalPool.Approve = function(){
    debugger;
     if (!apz.mockServer) {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acnp01__ViewNotionalPool__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acnp01.viewNotionalPool.sCurrentTask,
            "currentWfDetails": apz.acnp01.viewNotionalPool.sCurrentWfDetails,
            "callBack": apz.acnp01.viewNotionalPool.approveCB
        }
    };
    apz.launchApp(lParams);
     }
     
     else{
         var lObj = {};
        lObj.referenceId = "CNNP000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchApp(lParams);
     }
      
};

apz.acnp01.viewNotionalPool.approveCB = function(pRespObj) {
    debugger;
    apz.currAppId = 'acnp01';
    apz.acnp01.viewNotionalPool.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acnp01.viewNotionalPool.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acnp01.viewNotionalPool.insertNotionalPool(pRespObj);
        }
    }
};

apz.acnp01.viewNotionalPool.insertNotionalPool = function(pNextStageObj){
    debugger;
    var lReqJson = {};
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_notional_pool";
    //lReqJson.Insertdata = pNextStageObj.tbDbmiWorkflowDetail;
    lReqJson.Insertdata = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData);
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "NotionalPoolInsert",
        "buildReq": "N",
        "appId": "acnp01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acnp01.viewNotionalPool.insertNotionalPoolCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};


apz.acnp01.viewNotionalPool.insertNotionalPoolCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acnp01__ViewNotionalPool__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acnp01.viewNotionalPool.sCurrentTask,
                "currentWfDetails": apz.acnp01.viewNotionalPool.sCurrentWfDetails,
                "callBack": apz.acnp01.viewNotionalPool.submitCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acnp01.viewNotionalPool.submitCB = function(pRespObj) {
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
apz.acnp01.viewNotionalPool.Reject = function(){
    debugger;
    
      
};
