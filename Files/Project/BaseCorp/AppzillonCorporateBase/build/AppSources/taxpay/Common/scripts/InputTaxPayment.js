apz.taxpay.InputTaxPayment = {};

apz.app.onLoad_InputTaxPayment = function() {
    debugger;
    apz.taxpay.InputTaxPayment.sCorporateId = apz.Login.sCorporateId;
    apz.taxpay.InputTaxPayment.sRoleId = apz.Login.sRoleId;
    apz.data.loadJsonData("typeCodeSuffix","taxpay");
    apz.data.loadJsonData("paymentType","taxpay");
    apz.data.loadJsonData("typeCode","taxpay");
    apz.taxpay.InputTaxPayment.fetchDetails();
    
}

apz.taxpay.InputTaxPayment.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "taxpay__InputTaxPayment__LaunchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "taxpay__InputTaxPayment__LaunchMicroService";
    llaunch.userObj.control.callBack = apz.taxpay.InputTaxPayment.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.taxpay.InputTaxPayment.sCorporateId,
        "roleID": apz.taxpay.InputTaxPayment.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.taxpay.InputTaxPayment.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("taxpay");
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
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
    apz.populateDropdown(document.getElementById("taxpay__TaxPayment__i__tbDbmiCorpTaxpayments__debitAccountno"), lfrmarr);
   
};

apz.taxpay.InputTaxPayment.fnValidatePhoneNo = function(pthis) {
    debugger;
    var lphno = apz.getElmValue("taxpay__TaxPayment__i__tbDbmiCorpTaxpayments__phoneNo");
    var str = lphno.replace(/[^0-9]/g, '');
    apz.setElmValue("taxpay__TaxPayment__i__tbDbmiCorpTaxpayments__phoneNo", str);
    //  var digits = el.value.match(/\d{1,10}/) || [""];
    // el.value = digits[0];
}

apz.taxpay.InputTaxPayment.fnValidateTaxid = function(el) {
    debugger;
    
     var digits = el.value.match(/\d{1,10}/) || [""];
    el.value = digits[0];
}

apz.taxpay.InputTaxPayment.fnContinue = function() {
    debugger;
    var lscreenData = apz.data.buildData("TaxPayment", "taxpay");
    var lUserObj = {};
    if (!apz.mockServer) {
        var taskObj = {};
        taskObj.workflowId = "TAXP";
        taskObj.status = "U";
        taskObj.taskType = "Add_Tax_Payment";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = apz.taxpay.InputTaxPayment.sCorporateId + "__" + taskObj.workflowId;
        taskObj.taskDesc = taskObj.referenceId + "'s Tax Payment details have been submitted";
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.taxpay.InputTaxPayment.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "taxpay__InputTaxPayment__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "taxpay",
            "scr": "VerifyTaxPayment",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
}
apz.taxpay.InputTaxPayment.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "taxpay";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                // lReqObj.div = apz.acft01.otherBankDOM.sDiv;
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
                        "referenceId": pNextStageObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
}


apz.taxpay.InputTaxPayment.fnloadpaymentTypeModal = function() {
    debugger;
    apz.toggleModal({
        targetId: "taxpay__InputTaxPayment__paymentTypeModal"
    });
    
    
}


apz.taxpay.InputTaxPayment.fnloadtypeCodeModal = function() {
    debugger;
    apz.toggleModal({
        targetId: "taxpay__InputTaxPayment__typeCodeModal"
    });
}



apz.taxpay.InputTaxPayment.fnloadtypeCodeSuffixModal = function() {
    debugger;
    apz.toggleModal({
        targetId: "taxpay__InputTaxPayment__typeCodeSuffixModal"
    });
}


apz.taxpay.InputTaxPayment.fnSelectpaymentType = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var paymentType = apz.data.scrdata.taxpay__PaymentType_Res.PaymentDetails[lrow].payment;
    apz.setElmValue("taxpay__TaxPayment__i__tbDbmiCorpTaxpayments__paymentType", paymentType);
    apz.toggleModal({
        targetId: "taxpay__InputTaxPayment__paymentTypeModal"
    });
}

apz.taxpay.InputTaxPayment.fnSelecttypeCode = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var typeCode = apz.data.scrdata.taxpay__TypeCode_Res.TypeCodeDetails[lrow].code;
    apz.setElmValue("taxpay__TaxPayment__i__tbDbmiCorpTaxpayments__typeCode", typeCode);
    apz.toggleModal({
        targetId: "taxpay__InputTaxPayment__typeCodeModal"
    });
}

apz.taxpay.InputTaxPayment.fnSelecttypeCodeSuffix = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var typeCodeSuffix = apz.data.scrdata.taxpay__TypeCodeSuffix_Res.TypeCodeSuffixDetails[lrow].code;
    apz.setElmValue("taxpay__TaxPayment__i__tbDbmiCorpTaxpayments__typeCodeSuffix", typeCodeSuffix);
    apz.toggleModal({
        targetId: "taxpay__InputTaxPayment__typeCodeSuffixModal"
    });
}
