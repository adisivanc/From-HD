apz.acru01.MaintainRules = {};
apz.acru01.MaintainRules.sRuleMasterData = {};
apz.acru01.MaintainRules.sDiv = "";
apz.acru01.MaintainRules.sAction = "";
apz.app.onLoad_MaintainRules = function(params) {
    debugger;
    if(apz.Login){
    apz.acru01.MaintainRules.sCorporateId = apz.Login.sCorporateId;
    apz.acru01.MaintainRules.sUserId = apz.Login.sUserId;
    }
    else{
        apz.acru01.MaintainRules.sCorporateId = "000FTAC4321";
    apz.acru01.MaintainRules.sUserId = "User0001";
    }
    apz.acru01.MaintainRules.sDiv = params.div;
    apz.acru01.MaintainRules.sAction = params.action;
    apz.acru01.MaintainRules.sRuleMasterData = params.ruleMasterData;
    
      if (params.currentTask) {
        apz.acru01.MaintainRules.sCurrentTask = params.currentTask;
        apz.acru01.MaintainRules.sCurrentWfDetails = params.currentWfDetails;
        apz.acru01.MaintainRules.sDiv = params.div;
       
      var lScreenData = JSON.parse(params.currentWfDetails.screenData).tbDbmiWorkflowRuleDetail;
        apz.data.scrdata.acru01__RuleDetails_Req = {};
        apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail = lScreenData;
         apz.data.loadData("RuleDetails", 'acru01');
        
    }
    
    else{
    if (params.action == "Modify Rule") {
        //$("#acru01__MaintainRules__functionId").text(params.ruleMasterData.functionDesc);
        apz.setElmValue("acru01__MaintainRules__functionId",params.ruleMasterData.functionDesc);
        var lServerParams = {
            "ifaceName": "RuleDetails_Query",
            "buildReq": "N",
            "req": "",
            "paintResp": "Y",
            "callBack": apz.acru01.MaintainRules.fetchRuleDetailsCB,
        };
        var req = {};
        req.tbDbmiWorkflowRuleDetail = {};
        req.tbDbmiWorkflowRuleDetail.corporateId = apz.acru01.MaintainRules.sCorporateId;
        req.tbDbmiWorkflowRuleDetail.functionId = apz.acru01.MaintainRules.sRuleMasterData.functionId;
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    } else if (params.action == "New Function") {
        apz.data.scrdata.acru01__RuleDetails_Req = {};
        apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail = [];
        apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail.push(params.stageDetails);
        apz.data.loadData("RuleDetails", 'acru01');
        //$("#acru01__MaintainRules__functionId").text(params.ruleMasterData.functionId);
        apz.setElmValue("acru01__MaintainRules__functionId",apz.acru01.MaintainRules.sRuleMasterData.functionDesc);
    }
    }
};
apz.acru01.MaintainRules.fetchRuleDetailsCB = function() {
    debugger;
};
apz.acru01.MaintainRules.saveRule = function() {
    debugger;
    var lScreenData = {};
    lScreenData.tbDbmiWorkflowRuleMaster = apz.acru01.MaintainRules.sRuleMasterData;
    lScreenData.tbDbmiWorkflowRuleDetail = apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail;
    var taskObj = {};
    taskObj.workflowId = "CRSR";
    taskObj.status = "U";
    taskObj.taskType = "RULE_DETAILS";
    taskObj.versionNo = "1";
    taskObj.screenData = JSON.stringify(lScreenData);
    taskObj.action = "";
    taskObj.referenceId = apz.acru01.MaintainRules.sCorporateId + "__" + apz.acru01.MaintainRules.sRuleMasterData.functionId;
    taskObj.taskDesc = taskObj.referenceId + " has been modified";
    var lUserObj = {};
    lUserObj.operation = "NEWWORKFLOW";
    lUserObj.taskDetails = taskObj;
    lUserObj.callBack = apz.acru01.MaintainRules.saveRuleCB;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acru01__MaintainRules__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.acru01.MaintainRules.saveRuleCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acru01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData.tbDbmiWorkflowRuleMaster = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData).tbDbmiWorkflowRuleMaster;
                lObj.scrData.tbDbmiWorkflowRuleDetail = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData).tbDbmiWorkflowRuleDetail;
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acru01.MaintainRules.sDiv;
                lObj.action = apz.acru01.MaintainRules.sAction;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acru01.MaintainRules.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId":pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
        
};
apz.acru01.MaintainRules.goToRulesSummary = function() {
    $("#acru01__RulesSummary__RulesSummaryRow").removeClass('sno');
    $("#acru01__RulesSummary__RulesScreenLaunch").addClass('sno');
    apz.setTableHeight("acru01__RulesSummary__RulesSummary", false);
};
apz.acru01.MaintainRules.editRule = function(pObj) {
    debugger;
    //var lFunctionId = $(pObj).parent().parent().facru01__RulesSummary__ind('.functionID').text();
    $("#acru01__MaintainRules__Rule_Details_Row").addClass('sno');
    $("#acru01__MaintainRules__MaintainRules_Header").addClass('sno');
    $("#acru01__MaintainRules__MaintainRules_Sub_Header").addClass('sno');
    $("#acru01__MaintainRules__Launch_Modify_Rule").removeClass("sno");
    var lPage = apz.scrMetaData.containersMap['acru01__MaintainRules__Rule_Summary_Table'].currPage;
    var lRecord = (lPage - 1) * 5 + parseInt($(pObj).attr('rowno'));
    var lData = apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail[lRecord];
    var params = {};
    params.appId = "acru01";
    params.scr = "RuleBuilder";
    params.layout = "All";
    params.div = "acru01__MaintainRules__Launch_Modify_Rule";
    params.userObj = {
        "StageDetails": lData,
        "RecordNo": lRecord,
        "action": "Modify Rule"
    };
    apz.launchSubScreen(params);
};
apz.acru01.MaintainRules.cancel = function() {
    debugger;
    $("#acru01__RulesSummary__RulesSummaryRow").removeClass('sno');
    $("#acru01__RulesSummary__RulesScreenLaunch").addClass('sno');
    $("#acru01__RulesSummary__RulesSummaryHeader").removeClass('sno');
    $("#acru01__RulesSummary__RulesSummarySubHeader").removeClass('sno');
    apz.setTableHeight("acru01__RulesSummary__RulesSummary", false);
};
apz.acru01.MaintainRules.updateRuleData = function(pRecord, pStageData) {
    debugger;
    $("#acru01__MaintainRules__Rule_Details_Row").removeClass("sno");
    $("#acru01__MaintainRules__Launch_Modify_Rule").addClass('sno');
    apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail[pRecord] = {};
    apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail[pRecord] = pStageData;
    apz.data.loadData("RuleDetails", 'acru01');
     $("#acru01__MaintainRules__MaintainRules_Header").removeClass('sno');
    $("#acru01__MaintainRules__MaintainRules_Sub_Header").removeClass('sno');
};
apz.acru01.MaintainRules.addFunction = function(pRuleMaster, pStageData) {
    apz.acru01.MaintainRules.sRuleMasterData = pRuleMaster;
    apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail = [];
};
apz.app.postCreateRow = function(pContainerId) {
    debugger;
    if (pContainerId == "acru01__MaintainRules__Rule_Summary_Table") {
        $("#acru01__MaintainRules__Rule_Details_Row").addClass('sno');
        $("#acru01__MaintainRules__MaintainRules_Header").addClass('sno');
        $("#acru01__MaintainRules__MaintainRules_Sub_Header").addClass('sno');
        $("#acru01__MaintainRules__Launch_Modify_Rule").removeClass("sno");
        var lRecorNo = apz.scrMetaData.containersMap['acru01__MaintainRules__Rule_Summary_Table'].totalRecs - 1;
        apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail[lRecorNo].corporateId = apz.acru01.MaintainRules.sCorporateId;
        apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail[lRecorNo].functionId = apz.acru01.MaintainRules.sRuleMasterData.functionId;
        var params = {};
        params.appId = "acru01";
        params.scr = "RuleBuilder";
        params.layout = "All";
        params.div = "acru01__MaintainRules__Launch_Modify_Rule";
        params.userObj = {
            "RecordNo": lRecorNo,
            "StageDetails": apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail[lRecorNo],
            "action": "Modify Rule"
        };
        apz.launchSubScreen(params);
    }
};
