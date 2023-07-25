apz.acru01 = {};
apz.acru01.RulesSummary = {};
apz.acru01.RulesSummary.sCorporateName = "ACME Corp";
apz.acru01.RulesSummary.sCorporationtype = "Private Limited";
apz.app.onLoad_RulesSummary = function() {
    debugger;
    if (apz.Login) {
        apz.acru01.RulesSummary.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acru01.RulesSummary.sCorporateId = "000FTAC4321";
    }
    var params = {};
    params.action = "onload";
    apz.acru01.RulesSummary.fnRender(params);
};
apz.acru01.RulesSummary.fnRender = function(params) {
    apz.acru01.RulesSummary.fnRenderData(params);
    apz.acru01.RulesSummary.fnRenderActionButtons(params);
}
apz.acru01.RulesSummary.fnRenderData = function(params) {
    if (params.action == "onload") {
        apz.acru01.RulesSummary.sAction = "search";
        var req = {
            "ruleDetails": {
                "type": "All",
                "corpID": apz.acru01.RulesSummary.sCorporateId
            }
        };
        req.action = "Query";
        req.table = "tb_dbmi_workflow_rule_master";
        var lParams = {
            "ifaceName": "RuleService",
            "paintResp": "N",
            "appId": "acru01",
            "buildReq": "N",
            "lReq": req
        };
        apz.startLoader();
        apz.acru01.RulesSummary.fnBeforCallServer(lParams);
    }
}
apz.acru01.RulesSummary.fnRenderActionButtons = function(params) {
    debugger;
    if (params.action == "onload") {
        $("#acru01__RulesSummary__RulesSummary .adr-ctr").addClass('sno');
       // apz.setElmValue("acru01__RulesSummary__corporateId", apz.acru01.RulesSummary.sCorporateId);
       // apz.setElmValue("acru01__RulesSummary__corporatename", apz.acru01.RulesSummary.sCorporateName);
      //  apz.setElmValue("acru01__RulesSummary__corporationType", apz.acru01.RulesSummary.sCorporationtype);
    }
}
apz.acru01.RulesSummary.fetchRuleDetails = function(pObj) {
    debugger;
    $("#acru01__RulesSummary__RulesSummaryRow").addClass('sno');
    $("#acru01__RulesSummary__RulesScreenLaunch").removeClass('sno');
    var lRuleFunction = $(pObj).closest('li').find('.functionID').text();
    var params = {};
    params.appId = "acru01";
    params.scr = "CorporateRules";
    params.layout = "All";
    params.div = "acru01__RulesSummary__RulesScreenLaunch";
    params.userObj = {
        "RuleFunction": lRuleFunction,
        "FunctionDesc": $(pObj).closest('li').find('.functionDesc').text()
    };
    apz.launchSubScreen(params);
};
apz.acru01.RulesSummary.editRule = function(pObj) {
    debugger;
    $("#acru01__RulesSummary__RulesSummaryRow").addClass('sno');
    $("#acru01__RulesSummary__RulesSummaryHeader").addClass('sno');
    $("#acru01__RulesSummary__RulesSummarySubHeader").addClass('sno');
    $("#acru01__RulesSummary__RulesScreenLaunch").removeClass('sno');
    // var lFunctionId = $(pObj).parent().parent().find('.functionID').text();
    var lPage = apz.scrMetaData.containersMap['acru01__RulesSummary__RulesSummary'].currPage;
    var lRecord = (lPage - 1) * 5 + parseInt($(pObj).attr('rowno'));
    var lRuleMasterObj = apz.data.scrdata.acru01__RuleMaster_Req.tbDbmiWorkflowRuleMaster[lRecord];
    var lRuleMasterData = {};
    lRuleMasterData.functionId = lRuleMasterObj.function_id;
    lRuleMasterData.corporateId = lRuleMasterObj.corporate_id;
    lRuleMasterData.functionDesc = lRuleMasterObj.WORKFLOW_DESC;
    var params = {};
    params.appId = "acru01";
    params.scr = "MaintainRules";
    params.layout = "All";
    params.div = "acru01__RulesSummary__RulesScreenLaunch";
    params.userObj = {
        "action": "Modify Rule",
        "ruleMasterData": lRuleMasterData,
        "div":"acru01__RulesSummary__RulesScreenLaunch"
    };
    apz.launchSubScreen(params);
    event.stopPropagation();
};
apz.acru01.RulesSummary.newRule = function() {
    $("#acru01__RulesSummary__RulesSummaryRow").addClass('sno');
    $("#acru01__RulesSummary__RulesScreenLaunch").removeClass('sno');
    $("#acru01__RulesSummary__RulesSummaryHeader").addClass('sno');
    $("#acru01__RulesSummary__RulesSummarySubHeader").addClass('sno');
    var params = {};
    params.appId = "acru01";
    params.scr = "RuleBuilder";
    params.layout = "All";
    params.div = "acru01__RulesSummary__RulesScreenLaunch";
    params.userObj = {
        "action": "New Function",
        "div":"acru01__RulesSummary__RulesScreenLaunch"
    };
    apz.launchSubScreen(params);
};
apz.acru01.RulesSummary.fnSearch = function(event) {
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acru01__RulesSummary__SearchBy");
        var lInput = apz.getElmValue("acru01__RulesSummary__SearchValue");
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "FunctionID") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "FunctionID";
            }
        } else if (lType == "Desc") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "Desc";
            }
        }
        if (flag) {
            apz.acru01.RulesSummary.sAction = "search";
            var req = {
                "ruleDetails": {
                    "type": lSearchType,
                    "corpID": apz.Login.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_workflow_rule_master";
            var lParams = {
                "ifaceName": "RuleService",
                "paintResp": "N",
                "appId": "acru01",
                "buildReq": "N",
                "lReq": req
            };
            apz.startLoader();
            apz.acru01.RulesSummary.fnBeforCallServer(lParams);
        }
    }
};
apz.acru01.RulesSummary.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acru01.RulesSummary.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acru01.RulesSummary.callServerCB = function(params) {
    debugger;
    if (apz.acru01.RulesSummary.sAction == "search") {
        apz.acru01.RulesSummary.fnFetchRuleDetailsCB(params);
    }
};
apz.acru01.RulesSummary.fnFetchRuleDetailsCB = function(params) {
    debugger;
    apz.stopLoader();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acru01__RuleService_Res.ruleStatus) {
            apz.data.scrdata.acru01__RuleMaster_Req = {};
            apz.data.scrdata.acru01__RuleMaster_Req.tbDbmiWorkflowRuleMaster = [];
            apz.data.scrdata.acru01__RuleMaster_Req.tbDbmiWorkflowRuleMaster = params.res.acru01__RuleService_Res.tbDbmiWorkflowRuleMaster;
            apz.data.loadData("RuleMaster", "acru01");
        } else {
            apz.data.clearMRMV("acru01__RulesSummary__RulesSummary");
            var msg = {};
            msg.message = "No Records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
