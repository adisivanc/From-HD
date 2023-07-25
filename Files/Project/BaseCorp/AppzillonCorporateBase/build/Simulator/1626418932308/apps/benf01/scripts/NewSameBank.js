apz.benf01.NewSameBank = {};
apz.app.onLoad_NewSameBank = function(params) {
    apz.benf01.NewSameBank.sCorporateId = apz.Login.sCorporateId;
    apz.setElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__corporateId", apz.benf01.NewSameBank.sCorporateId);
    apz.setElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__beneficaryType", "Same");
    if (!apz.isNull(params.tbDbmiCorpRoleBeneficary)) {
        apz.data.scrdata.benf01__BeneficaryDetails_Req = params;
        apz.data.loadData("BeneficaryDetails", "benf01");
    }
};
apz.benf01.NewSameBank.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer('benf01__NewSameBank__addBeneficaryForm') == false) {
        var msg = {
            "code": 'benf01_mand'
        };
        apz.dispMsg(msg);
    } else if (apz.getElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__accountNumber") != apz.getElmValue(
        "benf01__NewSameBank__reEnterAccNo")) {
        var msg = {
            "code": 'benf01_account'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("BeneficaryDetails", "benf01");
        var taskObj = {};
         taskObj.workflowId = "BNSB";
        //taskObj.stageId = "INPUT";
        taskObj.status = "U";
        //taskObj.userId = apz.Login.sUserId;
        taskObj.taskType = "NEW_BENEFICARY_SAME";
        taskObj.versionNo = "1";
        //taskObj.appId = "benf01";
        //taskObj.screenId = "ViewSameBank";
        taskObj.screenData = JSON.stringify(lscreenData);
        //taskObj.stageSeqNo = 1;
        taskObj.action = "";
        taskObj.referenceId = lscreenData.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary.corporateId + "__" + taskObj.workflowId;
        taskObj.taskDesc = "New beneficary has been added with referenceId" + taskObj.referenceId;
        //taskObj.createUserId = apz.Login.sUserId;
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.benf01.NewSameBank.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "benf01__NewSameBank__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    }
};
apz.benf01.NewSameBank.workflowMicroServiceCB = function(pRespObj) {
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
apz.benf01.NewSameBank.fnCancel = function() {
    apz.show("benf01__Beneficiary__benHead");
    apz.show("benf01__Beneficiary__benfRow");
    $("#benf01__Beneficiary__benLaunchRow").html("");
    apz.benf01.Beneficiary.sameBank();
};
apz.benf01.NewSameBank.ValEmail = function(pThis) {
    debugger;
    var lEmail = $(pThis).val();
    var pattern = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$");
    if (!pattern.test(lEmail)) {
        var msg = {
            "code": "INVALIDEmail"
        };
        apz.dispMsg(msg);
    }
};