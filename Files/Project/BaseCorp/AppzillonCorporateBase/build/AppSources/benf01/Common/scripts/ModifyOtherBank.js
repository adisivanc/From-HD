apz.benf01.ModifyOtherBank = {};
apz.app.onLoad_ModifyOtherBank = function(params) {
    apz.benf01.ModifyOtherBank.sCorporateId = apz.Login.sCorporateId;
    var req = {};
    req.beneficiaryDetails = {
        "corporateId": apz.benf01.ModifyOtherBank.sCorporateId,
        "beneficaryType": "Other",
        "accountNumber": params.accountNumber
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_role_beneficary";
    var lServerParams = {
        "ifaceName": "FetchBeneficaryService",
        "buildReq": "N",
        "appId": "benf01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.benf01.ModifyOtherBank.fetchBeneficaryDetailsQueryCB,
        "callBackObj": "",
    };
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.benf01.ModifyOtherBank.fetchBeneficaryDetailsQueryCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.benf01__FetchBeneficaryService_Res.Status) {
            apz.data.scrdata.benf01__BeneficaryDetails_Req = {};
            apz.data.scrdata.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = params.res.benf01__FetchBeneficaryService_Res.beneficiaryDetails;
            apz.data.loadData("BeneficaryDetails", "benf01");
        }
    }
};
apz.benf01.ModifyOtherBank.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer('benf01__ModifyOtherBank__addBeneficaryForm') == false) {
        var msg = {
            "code": 'benf01_mand'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("BeneficaryDetails", "benf01");
        var taskObj = {};
        taskObj.workflowId = "BNOB";
        taskObj.stageId = "INPUT";
        taskObj.status = "U";
        taskObj.userId = "USER001";
        taskObj.taskType = "MODFY_BENEFICARY_OTHER";
        taskObj.versionNo = "1";
        taskObj.appId = "benf01";
        taskObj.screenId = "ViewSameBank";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.stageSeqNo = 1;
        taskObj.action = "";
        taskObj.referenceId = lscreenData.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary.corporateId + "__" + lscreenData.benf01__BeneficaryDetails_Req
            .tbDbmiCorpRoleBeneficary.accountNumber;
        taskObj.taskDesc = "Modified beneficary has been added with referenceId" + taskObj.referenceId;
        taskObj.createUserId = "USER001";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.benf01.ModifyOtherBank.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "benf01__ModifyOtherBank__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    }
};
apz.benf01.ModifyOtherBank.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "benf01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var msg = {
                    "code": 'benfo1_approve',
                    //"callBack": apz.benf01.ModifyOtherBank.Confirmation
                };
                apz.dispMsg(msg);
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
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
apz.benf01.ModifyOtherBank.fnCancel = function() {
    apz.show("benf01__Beneficiary__benHead");
    apz.show("benf01__Beneficiary__benfRow");
    $("#benf01__Beneficiary__benLaunchRow").html("");
    apz.benf01.Beneficiary.otherBankDOM();
};
