apz.bein01.NewOtherBankINT = {};
apz.app.onLoad_NewOtherBankINT = function(params) {
    apz.bein01.NewOtherBankINT.sCorporateId = apz.Login.sCorporateId;
    apz.setElmValue("bein01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__corporateId", apz.bein01.NewOtherBankINT.sCorporateId);
    apz.setElmValue("bein01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__beneficaryType", "International");
    apz.bein01.NewOtherBankINT.sFrom = params.from;
    
    if (params.currentTask) {
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).bein01__BeneficaryDetails_Req;
        apz.data.scrdata.bein01__BeneficaryDetails_Req = {};
        apz.data.scrdata.bein01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = lScreenData.tbDbmiCorpRoleBeneficary;
        apz.data.loadData("BeneficaryDetails", "bein01");
    }
};
apz.bein01.NewOtherBankINT.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer('bein01__NewOtherBankINT__addBeneficaryForm') == false) {
        var msg = {
            "code": 'bein01_mand'
        };
        apz.dispMsg(msg);
    } else if (apz.getElmValue("bein01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__accountNumber") != apz.getElmValue(
        "bein01__NewOtherBankINT__reEnterAccNo")) {
        var msg = {
            "code": 'bein01_account'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("BeneficaryDetails", "bein01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "BNIB";
            //taskObj.stageId = "INPUT";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "NEW_BENEFICARY_INTERNATIONAL";
            taskObj.versionNo = "1";
            //taskObj.appId = "bein01";
            //taskObj.screenId = "ViewOtherBankINT";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            taskObj.referenceId = lscreenData.bein01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary.corporateId + "__" + taskObj.workflowId
            taskObj.taskDesc = "New beneficary has been added with referenceId" + taskObj.referenceId;
            //taskObj.createUserId = apz.Login.sUserId;
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.bein01.NewOtherBankINT.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "bein01__NewOtherBankINT__LaunchMicroService",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        } else {
            var lObj = {};
            lObj.scrData = {};
            lObj.scrData = lscreenData;
            // lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
            // lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
            lObj.currentTask = "";
            lObj.currentWfDetails = {};
            var lParams = {
                "appId": "bein01",
                "scr": "VerifyOtherBankINT",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.bein01.NewOtherBankINT.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "bein01";
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
                // var msg = {
                //     "code": 'benfo1_approve',
                //     //"callBack": apz.bein01.NewOtherBankINT.Confirmation
                // };
                // apz.dispMsg(msg);
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
apz.bein01.NewOtherBankINT.fnCancel = function() {
   
    if(apz.bein01.NewOtherBankINT.sFrom == "taskflow"){
      apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    }else{
    apz.show("benf01__Beneficiary__benHead");
    apz.show("benf01__Beneficiary__benfRow");
    apz.show("benf01__Beneficiary__rowdom_intbtn");
    
    $("#benf01__Beneficiary__benLaunchRow").html("");
    apz.benf01.Beneficiary.otherBankINT();
    }
};
apz.bein01.NewOtherBankINT.ValEmail = function(pThis) {
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
apz.bein01.NewOtherBankINT.ValPhNo = function(pThis) {
    debugger;
    var lPhNo = $(pThis).val();
    var lPhnoLength = lPhNo.length;
    var phoneno = new RegExp("^[\+]{0,1}[0-9]{1,3}[\-]{0,1}[0-9]{8,13}$");
    if (lPhnoLength > 0 && !phoneno.test(lPhNo)) {
        var msg = {
            "code": "INVALIDPhoneNo"
        };
        apz.dispMsg(msg);
    }
};



apz.bein01.NewOtherBankINT.fnSelectBenCountry = function(){
    debugger;
    var benCountry = apz.getElmValue("bein01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__benCountry");
    apz.setElmValue("bein01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__transferCurrency",benCountry)
}
