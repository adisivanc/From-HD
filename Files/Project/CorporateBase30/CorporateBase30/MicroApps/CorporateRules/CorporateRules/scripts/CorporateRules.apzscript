apz.acru01.CorporateRules = {};

apz.acru01.CorporateRules.sCorporateName = "ACME Crop";
apz.acru01.CorporateRules.sCorporationtype = "Private Limited";
apz.app.onLoad_CorporateRules = function(params) {
     $("#acru01__RulesSummary__RulesSummarySubHeader").addClass('sno');
     $("#acru01__RulesSummary__RulesSummaryHeader").addClass('sno');
    if(apz.Login){
    apz.acru01.CorporateRules.sCorporateId = apz.Login.sCorporateId;
    }
    else{
        apz.acru01.CorporateRules.sCorporateId = "000FTAC4321";
    }
    var lFunctionId = params.RuleFunction;
    apz.acru01.CorporateRules.fetchRuleDetails(lFunctionId);
    /*apz.setElmValue("acru01__CorporateRules__corporateId",apz.acru01.CorporateRules.sCorporateId);
    apz.setElmValue("acru01__CorporateRules__corporatename",apz.acru01.CorporateRules.sCorporateName);
    apz.setElmValue("acru01__CorporateRules__corporationType",apz.acru01.CorporateRules.sCorporationtype);
    */
    apz.setElmValue("acru01__CorporateRules__ruleName",params.FunctionDesc);
};
apz.app.onShown_CorporateRules = function() {
};
apz.acru01.CorporateRules.fetchRuleDetails = function(pFunction) {
    debugger;
    // $("#acru01__CorporateRules__Rules_List_Panel_ul .lbl").text("View "+pFunction+" Rules");
    var lServerParams = {
        "ifaceName": "RuleDetails_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acru01.CorporateRules.fetchRuleDetailsCB,
    };
    var req = {};
    req.tbDbmiWorkflowRuleDetail = {};
    req.tbDbmiWorkflowRuleDetail.corporateId = apz.acru01.CorporateRules.sCorporateId;
    req.tbDbmiWorkflowRuleDetail.functionId = pFunction;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acru01.CorporateRules.fetchRuleDetailsCB = function(pResp) {
    debugger;
    if(pResp.errors){
        if(pResp.errors[0].errorCode == "APZ_FM_EX_038"){
            apz.data.scrdata.acru01__RuleDetails_Req = {};
            apz.data.loadData("RuleDetails");
        }
    }
};

/*
apz.acru01.CorporateRules.newRule = function() {
    var params = {
        "targetId": "acru01__CorporateRules__ModifyRuleModal"
    };
    apz.toggleModal(params);
    var params = {};
    params.appId = "acru01";
    params.scr = "MaintainRules";
params.layout = "All";
    params.div = "acru01__CorporateRules__LaunhPad";
    
    params.userObj = {
        "action": "new rule",
        "functionId":$("#acru01__CorporateRules__Rules_List_Panel_ul .lbl").text()
    };
    apz.launchSubScreen(params);
};

apz.acru01.CorporateRules.modifyRule = function() {
    var lSelectedRuleRowNo = $("#acru01__CorporateRules__RulesList").find('.active').attr('id').split('_')[6];
    var params = {
        "targetId": "acru01__CorporateRules__ModifyRuleModal"
    };
    apz.toggleModal(params);
    var params = {};
    params.appId = "acru01";
    params.scr = "MaintainRules";
params.layout= "All";
    params.div = "acru01__CorporateRules__LaunhPad";
    params.userObj = {
        "action": "modify rule",
        "functionId": $("#acru01__CorporateRules__Rules_List_Panel_ul .lbl").text()
        
    };
    apz.launchSubScreen(params);
};
*/


apz.acru01.CorporateRules.Cancel = function(){
    $("#acru01__RulesSummary__RulesSummaryRow").removeClass('sno');
    $("#acru01__RulesSummary__RulesScreenLaunch").addClass('sno');
    $("#acru01__RulesSummary__RulesSummaryHeader").removeClass('sno');
    $("#acru01__RulesSummary__RulesSummarySubHeader").removeClass('sno');
};
