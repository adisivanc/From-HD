apz.achbul.InputACHBulkPayments = {};
apz.achbul.InputACHBulkPayments.getOBBenDetails = {};
apz.app.onLoad_InputACHBulkPayments = function(params) {
    debugger;
    apz.achbul.InputACHBulkPayments.sCache = params;
    apz.achbul.InputACHBulkPayments.sCorporateId = apz.Login.sCorporateId;
    apz.achbul.InputACHBulkPayments.sRoleId = apz.Login.sRoleId;
    apz.achbul.InputACHBulkPayments.fetchDetails();
    apz.achbul.InputACHBulkPayments.fetchOBDetails();
}
apz.app.onShown_InputACHBulkPayments = function(params) {
    debugger;
    setTimeout(function() {
        apz.achbul.InputACHBulkPayments.fnInitialize(apz.achbul.InputACHBulkPayments.sCache);
    }, 500);
};
apz.achbul.InputACHBulkPayments.fnInitialize = function(params) {
    debugger;
    if (!apz.isNull(params.data)) {
        if (!apz.isNull(params.data.fromOCR)) {
            if (params.data.fromOCR) {
                apz.data.scrdata.achbul__ACHBulkPayments_Req = {};
                apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments = {};
                apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments = params.data.tfrDtls;
                apz.data.loadData("ACHBulkPayments", "achbul");
                apz.achbul.InputACHBulkPayments.sCache = {};
                //$("#bulktr__WithinBank__addbenListRow").removeClass("sno");
            }
        }
    } else {
        apz.data.createRow('achbul__InputACHBulkPayments__tblPayments');
    }
};
apz.achbul.InputACHBulkPayments.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "achbul__InputACHBulkPayments__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "achbul__InputACHBulkPayments__launchMicroService";
    llaunch.userObj.control.callBack = apz.achbul.InputACHBulkPayments.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.achbul.InputACHBulkPayments.sCorporateId,
        "roleID": apz.achbul.InputACHBulkPayments.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.achbul.InputACHBulkPayments.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("achbul");
    var lfrmarr = [];
    var lObj = {
        "val": "",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        var strlen = params.data[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = params.data[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        var lfrmacc = {
            "val": params.data[i].accountNo,
            "desc": result
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("achbul__InputACHBulkPayments__FromAccountNo"), lfrmarr);
};
apz.achbul.InputACHBulkPayments.fetchOBDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "achbul__InputACHBulkPayments__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "achbul__InputACHBulkPayments__launchMicroService";
    llaunch.userObj.control.callBack = apz.achbul.InputACHBulkPayments.fetchOBDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.achbul.InputACHBulkPayments.sCorporateId,
        "beneficaryType": "Other",
        "action": "onload"
    };
    apz.launchApp(llaunch);
}
apz.achbul.InputACHBulkPayments.fetchOBDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("achbul");
    apz.achbul.InputACHBulkPayments.getOBBenDetails.fullList = params.data;
    var lfrmarr = [];
    var lToBenName = [];
    var lObj = {
        "val": "",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        var lfrmacc = {
            "val": params.data[i].accountNumber,
            "desc": params.data[i].beneficaryName + "-" + params.data[i].accountNumber
        };
        lfrmarr.push(lfrmacc);
    }
    apz.achbul.InputACHBulkPayments.getOBBenDetails.toAccount = lfrmarr;
    apz.populateDropdown(document.getElementById("achbul__ACHBulkPayments__i__tbDbmiCorpAchbulkpayments__toAccount_0"), lfrmarr);
};
apz.achbul.InputACHBulkPayments.fnExcelUpload = function() {
    debugger;
    debugger;
    var lParams = {
        "appId": "upldoc",
        "scr": "UploadXLDocument",
        "div": "ACNR01__Navigator__launchPad",
        "userObj": {
            "callBack": apz.achbul.InputACHBulkPayments.fnExcelUploadCB,
            "onXLUPloadCBmethod": apz.achbul.InputACHBulkPayments.fnExcelUploadCB,
            "backFunction": apz.achbul.InputACHBulkPayments.fnBackToInput
        }
    }
    apz.launchApp(lParams);
}
apz.achbul.InputACHBulkPayments.fnBackToInput = function() {
    debugger;
    var lparams = {};
    lparams.appId = "achbul";
    lparams.scr = "InputACHBulkPayments";
    lparams.layout = "All";
    lparams.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(lparams);
};
apz.achbul.InputACHBulkPayments.fnExcelUploadCB = function(params) {
    debugger;
    var lparams = {};
    lparams.appId = "achbul";
    lparams.scr = "InputACHBulkPayments";
    lparams.layout = "All";
    lparams.div = "ACNR01__Navigator__launchPad";
    //$("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    lparams.userObj = {
        "data": {
            "tfrDtls": params,
            "fromOCR": true
        }
    }
    apz.launchApp(lparams);
};
apz.achbul.InputACHBulkPayments.fnContinue = function() {
    debugger;
    apz.data.buildData("ACHBulkPayments", "achbul");
    var lscreenData = {
        "achbul__ACHBulkPayments_Req": apz.data.scrdata.achbul__ACHBulkPayments_Req
    };
    var lfromAccount = apz.getElmValue("achbul__InputACHBulkPayments__FromAccountNo");
    var ldata = [];
    if (lscreenData.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments.length > 0) {
        for (var i = 0; i < lscreenData.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments.length; i++) {
            lscreenData.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments[i].fromAccount = lfromAccount;
            lscreenData.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments[i].txnId = Date.now() + i;
        }
    }
    if (!apz.mockServer) {
        var taskObj = {};
        taskObj.workflowId = "ACHB";
        taskObj.status = "U";
        taskObj.taskType = "ACH_BULK_PAYMENTS";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = apz.achbul.InputACHBulkPayments.sCorporateId + "__" + apz.Login.sUserId;
        taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.achbul.InputACHBulkPayments.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achbul__InputACHBulkPayments__launchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "achbul",
            "scr": "VerifyACHBulkPayments",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
    //} 
};
apz.achbul.InputACHBulkPayments.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "achbul";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            var lReqObj = {};
            lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
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
                        "referenceId": lReqObj.currentTask.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};