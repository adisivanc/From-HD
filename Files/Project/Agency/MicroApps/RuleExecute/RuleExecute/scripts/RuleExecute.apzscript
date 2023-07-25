apz.acre01 = {};
apz.acre01.ruleExecute = {};
apz.acre01.ruleExecute.sRuleObj = {};
apz.app.onLoad_RuleExecute = function(params) {
    debugger;
    apz.acre01.ruleExecute.fetchRuleDetails(params);
};
apz.acre01.ruleExecute.fetchRuleDetails = function(pObj) {
    apz.acre01.ruleExecute.sRuleObj = pObj;
    var lObj = pObj.ruleDetails;
    debugger;
    var lServerParams = {
        "ifaceName": "RuleExecute",
        "buildReq": "N",
        "appId": "acre01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acre01.ruleExecute.fetchRuleDetailsCB,
        "callBackObj": ""
    };
    var req = {};
    req.action = "Query";
    req.table = "tb_dbmi_workflow_rule_detail";
    req.tbDbmiWorkflowRuleDetail = {};
    req.tbDbmiWorkflowRuleDetail.corporateId = lObj.corporateId;
    req.tbDbmiWorkflowRuleDetail.functionId = lObj.functionId;
    req.tbDbmiWorkflowRuleDetail.stageId = lObj.stageId;
    req.tbDbmiWorkflowRuleDetail.variableArr = lObj.taskVariables;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acre01.ruleExecute.fetchRuleDetailsCB = function(pResp) {
    debugger;
    var lNextStage = "";
    lNextStage = pResp.res.acre01__RuleExecute_Res.nextStage;
    /*if (!pResp.errors) {
        try {
            lNextStage = pResp.nextStage;
        } catch (pEx) {}
    } else if (pResp.errors[0].errorCode == "APZ_FM_EX_038") {
        lNextStage = "";
    }
    */
    apz.acre01.ruleExecute.sRuleObj.callBack(lNextStage);
};
