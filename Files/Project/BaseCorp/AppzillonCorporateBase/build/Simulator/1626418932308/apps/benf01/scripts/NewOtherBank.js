apz.benf01.NewOtherBank = {};
apz.app.onLoad_NewOtherBank = function(params) {
    debugger;
    apz.benf01.NewOtherBank.sCorporateId = apz.Login.sCorporateId;
    apz.setElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__corporateId", apz.benf01.NewOtherBank.sCorporateId);
    apz.setElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__beneficaryType", "Other");
    apz.benf01.NewOtherBank.sFrom = params.from;
    
    if (params.currentTask) {
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).benf01__BeneficaryDetails_Req;
        apz.data.scrdata.benf01__BeneficaryDetails_Req = {};
        apz.data.scrdata.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = lScreenData.tbDbmiCorpRoleBeneficary;
        apz.data.loadData("BeneficaryDetails", "benf01");
    }
};
apz.benf01.NewOtherBank.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer('benf01__NewOtherBank__addBeneficaryForm') == false) {
        var msg = {
            "code": 'benf01_mand'
        };
        apz.dispMsg(msg);
    } else if (apz.getElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__accountNumber") != apz.getElmValue(
        "benf01__NewOtherBank__reEnterAccNo")) {
        var msg = {
            "code": 'benf01_account'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("BeneficaryDetails", "benf01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "BNOB";
            //taskObj.stageId = "INPUT";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "NEW_BENEFICARY_OTHER";
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
            lUserObj.callBack = apz.benf01.NewOtherBank.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "benf01__NewOtherBank__LaunchMicroService",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        } else {
            
             var lObj = {};
             lObj.currentWfDetails = {};
                //lObj.scrData = {};
                //lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                // lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                // lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.currentTask = "";
                lObj.scrData = lscreenData;
                var lParams = {
                    "appId": "benf01",
                    "scr": "VerifyOtherBank",
                    "userObj": lObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
        }
    }
};
apz.benf01.NewOtherBank.workflowMicroServiceCB = function(pRespObj) {
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
                    //"callBack": apz.benf01.NewOtherBank.Confirmation
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
apz.benf01.NewOtherBank.fnCancel = function() {
    
    if(apz.benf01.NewOtherBank.sFrom == "taskflow"){
      apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    }else{
    apz.show("benf01__Beneficiary__benHead");
    apz.show("benf01__Beneficiary__benfRow");
    apz.show("benf01__Beneficiary__rowdom_intbtn");
    $("#benf01__Beneficiary__benLaunchRow").html("");
    apz.benf01.Beneficiary.otherBankDOM();
    }
};
apz.benf01.NewOtherBank.ValEmail = function(pThis) {
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
