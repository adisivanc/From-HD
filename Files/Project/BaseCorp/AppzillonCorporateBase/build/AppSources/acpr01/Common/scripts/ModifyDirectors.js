apz.acpr01.ModifyDirectors = {};
apz.acpr01.ModifyDirectors.sDiv = "";
apz.app.onLoad_ModifyDirectors = function(params) {
    apz.acpr01.ModifyDirectors.sUserId = apz.Login.sUserId;
    apz.acpr01.ModifyDirectors.sDiv = params.div;
    apz.acpr01.sDirectorsData = [];
    var lDirectorsArr = [];
    var lDirectorsArrLength = [];
    var lRecordNo = "";
    
    if(params.currentTask){
        apz.acpr01.ModifyDirectors.sCurrentTask = params.currentTask;
        apz.acpr01.ModifyDirectors.sCurrentWfDetails = params.currentWfDetails;
        apz.acpr01.ModifyDirectors.sDiv = params.div;
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).acpr01__CorporateDirectorsModify_Req;
        lDirectorsArr = lScreenData.tbDbmiCorporateDirectors;
        lDirectorsArrLength = lDirectorsArr.length;
        lRecordNo = lDirectorsArrLength - 1;
        apz.data.scrdata.acpr01__CorporateDirectorsModify_Req = {};
       apz.data.scrdata.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateMaster = lScreenData.tbDbmiCorporateMaster;
        apz.data.scrdata.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateDirectors = lDirectorsArr[lRecordNo];
        apz.data.loadData("CorporateDirectorsModify", "acpr01");
    }
    else{
        lRecordNo = params.recordNo;
    apz.data.scrdata.acpr01__CorporateDirectorsModify_Req = {};
    apz.data.scrdata.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateMaster = params.CorpMasterData;
    apz.data.scrdata.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateDirectors = params.CorpDirectorsData[params.recordNo];
    apz.data.loadData("CorporateDirectorsModify", 'acpr01');
     lDirectorsArr = params.CorpDirectorsData;
        lDirectorsArrLength = lDirectorsArr.length;
    }
    //var lDirectorsLength = params.CorpDirectorsData.length;
    for (var i = 0; i < lDirectorsArrLength; i++) {
        if (i != lRecordNo) {
            apz.acpr01.sDirectorsData.push(lDirectorsArr[i]);
        }
    }
};
apz.acpr01.ModifyDirectors.saveDirectors = function() {
    debugger;
    if (apz.val.validateContainer('acpr01__ModifyDirectors__ModifyDirectorsForm') == false) {
        var msg = {
            "code": 'acpr_AdressModify'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("CorporateDirectorsModify", "acpr01");
        apz.acpr01.sDirectorsData.push(lscreenData.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateDirectors);
        lscreenData.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateDirectors = apz.acpr01.sDirectorsData;
        
          if (apz.acpr01.ModifyDirectors.sCurrentTask) {
            var lUserObj = {};
            lUserObj.currentTask = apz.acpr01.ModifyDirectors.sCurrentTask;
            lUserObj.currentWfDetails = apz.acpr01.ModifyDirectors.sCurrentWfDetails;
            lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lUserObj.callBack = apz.acpr01.ModifyDirectors.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        }
        else{
        var taskObj = {};
        taskObj.workflowId = "CPMD";
        taskObj.status = "U";
        taskObj.taskType = "MODIFY_COMPANY_DIRECTORS";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = lscreenData.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateMaster.corporateId;
        taskObj.taskDesc = taskObj.referenceId + "director's details has been modified";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.acpr01.ModifyDirectors.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        }
        
        
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acpr01__ModifyDirectors__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    }
};
apz.acpr01.ModifyDirectors.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acpr01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                 lObj.div = apz.acpr01.ModifyDirectors.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acpr01.ModifyDirectors.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                 var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acpr01.ModifyDirectors.sDiv,
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};
apz.acpr01.ModifyDirectors.Confirmation = function() {
    debugger;
    $("#acpr01__CorporateInfo__ProfileMain").removeClass("sno");
    $("#acpr01__CorporateInfo__ModifyScreen").addClass("sno");
};
apz.acpr01.ModifyDirectors.Cancel = function() {
    debugger;
    $("#acpr01__CorporateInfo__ProfileMain").removeClass("sno");
    $("#acpr01__CorporateInfo__ModifyScreen").addClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Main_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Sub_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__RegistrationDetails").removeClass("sno");
};
apz.app.postCreateRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acpr01__ModifyDirectors__ModifyDirectorsForm") {
        var lRecordNo = $("#acpr01__ModifyDirectors__ModifyDirectorsForm_cr").val();
        if (lRecordNo) {
            apz.data.scrdata.acpr01__CorporateDirectorsModify_Req.tbDbmiCorporateDirectors[lRecordNo - 1].corporateId = apz.acpr01.CorporateInfo.sCorporateId;
        }
    }
};
apz.app.preChangeRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acpr01__ModifyDirectors__ModifyDirectorsForm") {
        if (!apz.val.validateContainer('acpr01__ModifyDirectors__ModifyDirectorsForm')) {
            var msg = {
                "code": 'DIR_MIS'
            };
            apz.dispMsg(msg);
            return false;
        }
    }
};
