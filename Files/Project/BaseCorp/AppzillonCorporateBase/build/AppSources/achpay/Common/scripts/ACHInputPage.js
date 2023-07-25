apz.achpay.ACHInputPage = {};
apz.achpay.ACHInputPage.sAcctNo = "";
apz.app.onLoad_ACHInputPage = function() {
    debugger;
    apz.achpay.ACHInputPage.sCorporateId = apz.Login.sCorporateId;
    apz.achpay.ACHInputPage.sRoleId = apz.Login.sRoleId;
    
    apz.achpay.ACHInputPage.fetchDetails();
    apz.data.loadJsonData("SECCode", "achpay");
    apz.data.loadJsonData("TransactionCode", "achpay");
}
apz.achpay.ACHInputPage.fnloadSECCodeModal = function() {
    debugger;
    apz.toggleModal({
        targetId: "achpay__ACHInputPage__SECCodeModal"
    });
}
apz.achpay.ACHInputPage.fnSelectSECCode = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var SECCode = apz.data.scrdata.achpay__SECCode_Res.SECCodeDetails[lrow].code;
    apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__secCode", SECCode);
    apz.toggleModal({
        targetId: "achpay__ACHInputPage__SECCodeModal"
    });
}
apz.achpay.ACHInputPage.fnloadTransactionCodeModal = function() {
    debugger;
    apz.toggleModal({
        targetId: "achpay__ACHInputPage__TransactionCodeModal"
    });
}
apz.achpay.ACHInputPage.fnSelectTransactionCode = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var transactionCode = apz.data.scrdata.achpay__TransactionCode_Res.TransactionCodeDetails[lrow].numericCode;
    apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__transactionCode", transactionCode);
    apz.toggleModal({
        targetId: "achpay__ACHInputPage__TransactionCodeModal"
    });
}
apz.achpay.ACHInputPage.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "achpay__ACHInputPage__LaunchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "achpay__ACHInputPage__LaunchMicroService";
    llaunch.userObj.control.callBack = apz.achpay.ACHInputPage.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.achpay.ACHInputPage.sCorporateId,
        "roleID": apz.achpay.ACHInputPage.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.achpay.ACHInputPage.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("achpay");
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
    apz.populateDropdown(document.getElementById("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__fromAcctno"), lfrmarr);
    apz.achpay.ACHInputPage.fetchbeneficiaryDetails();
    //apz.populateDropdown(document.getElementById("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__beneficiaryAcctno"), lfrmarr);
};
apz.achpay.ACHInputPage.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "achpay__ACHInputPage__LaunchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "achpay__ACHInputPage__LaunchMicroService";
    llaunch.userObj.control.callBack = apz.achpay.ACHInputPage.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.achpay.ACHInputPage.sCorporateId,
        "beneficaryType": "Other",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.achpay.ACHInputPage.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("achpay");
    apz.achpay.ACHInputPage.sData = params.data;
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var lObj1 = {
        "val": "Add New Beneficiary",
        "desc": "Add New Beneficiary"
    };
    lfrmarr.push(lObj1);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        var strlen = params.data[i].accountNumber;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = params.data[i].accountNumber;
        var result = apz.getMaskedValue(strlen, laccNo);
        var lfrmacc = {
            "val": params.data[i].accountNumber,
            "desc": params.data[i].beneficaryName + "-" + result
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__beneficiaryAcctno"), lfrmarr);
    apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__transferCurrency","USD");
    // if (apz.acft01.otherBankDOM.sCurrentTask) {
    //     apz.setElmValue("acft01__OtherBankDom__i__Domestic__toAccount", apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.toAccount);
    // }
    if (apz.achpay.ACHInputPage.sAcctNo != "") {
        apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__beneficiaryAcctno", apz.achpay.ACHInputPage.sAcctNo);
        
        apz.achpay.ACHInputPage.fnContinue();
        apz.achpay.ACHInputPage.sAcctNo = "";
    }
};
apz.achpay.ACHInputPage.fnSelectFromAcct = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "achpay__ACHInputPage__LaunchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "achpay__ACHInputPage__LaunchMicroService";
    llaunch.userObj.control.callBack = apz.achpay.ACHInputPage.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__fromAcctno")
    };
    apz.launchApp(llaunch);
};
apz.achpay.ACHInputPage.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("achpay");
    var Currency = params.data.accountCurrency;
    apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__accountCurrecy", Currency);
    apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__accountholderName", params.data.mainAccountHolder);
    apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__cfId", "80345789230");
};
apz.achpay.ACHInputPage.fnSelectBenAcct = function() {
    debugger;
    var lcreditacct = apz.getElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__beneficiaryAcctno")
    if (lcreditacct == "Add New Beneficiary") {
        $("#achpay__ACHInputPage__addbenrow").removeClass('sno');
    } else {
        $("#achpay__ACHInputPage__addbenrow").addClass('sno');
        apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__creditorAcctno", lcreditacct);
        //apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__recievingDif", "128923734");
        var lData = apz.achpay.ACHInputPage.sData;
        var larrLength = lData.length;
        for (var i = 0; i < larrLength; i++) {
            if (lcreditacct == lData[i].accountNumber) {
                var labaNumber = lData[i].abaNumber;
                apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__recievingDif", labaNumber);
            }
        }
    }
}

apz.achpay.ACHInputPage.fnContinueNewBen = function(){
    debugger;
    var lAccNum = apz.getElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__beneficiaryAcctno");
    if (lAccNum == "Add New Beneficiary"){
        apz.achpay.ACHInputPage.fnAddBeneficiary();
    }
    
    else{
        apz.achpay.ACHInputPage.fnContinue();
    }
}


apz.achpay.ACHInputPage.fnAddBeneficiary = function(){
    debugger;
     apz.setElmValue("achpay__AddBeneficiary__i__tbDbmiCorpRoleBeneficary__corporateId", apz.achpay.ACHInputPage.sCorporateId);
    var ldata = apz.data.buildData("AddBeneficiary", "achpay").achpay__AddBeneficiary_Req.tbDbmiCorpRoleBeneficary;
    ldata.beneficaryType = "Other";
    
    if (apz.getElmValue("achpay__AddBeneficiary__i__tbDbmiCorpRoleBeneficary__accountNumber") != apz.getElmValue(
        "achpay__ACHInputPage__reEnterAccNo")) {
        var msg = {
            "message": 'Please enter the correct account number'
        };
        apz.dispMsg(msg);
    } 
    
    else{
    
    var lServerParams = {
        "ifaceName": "AddBeneficiary_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.achpay.ACHInputPage.fnAddBeneficiaryCB,
        "callBackObj": ldata,
    };
    var req = {};
    req.tbDbmiCorpRoleBeneficary = ldata
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    }
}

apz.achpay.ACHInputPage.fnAddBeneficiaryCB = function(params) {
    debugger;
    if (params.errors == undefined) {
       
        apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__creditorAcctno", params.callBackObj.accountNumber);
    apz.setElmValue("achpay__ACHPaymentDetails__i__tbDbmiCorpAchpayments__recievingDif", params.callBackObj.abaNumber);
        
        apz.achpay.ACHInputPage.sAcctNo = params.callBackObj.accountNumber;
        $("#achpay__ACHInputPage__benrow1 input").val("");
         $("#achpay__ACHInputPage__benrow2 input").val("");
        apz.achpay.ACHInputPage.fetchbeneficiaryDetails();
        
    } else {
        var msg = {
            "message": "Something went wrong",
            "type": "E"
        };
        apz.dispMsg(msg);
    }
}

apz.achpay.ACHInputPage.fnContinue = function() {
    debugger;
    var lscreenData = apz.data.buildData("ACHPaymentDetails", "achpay");
    var lUserObj = {};
    if (!apz.mockServer) {
        var taskObj = {};
        taskObj.workflowId = "ACHP";
        taskObj.status = "U";
        taskObj.taskType = "Add_ACH_Payment";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = apz.achpay.ACHInputPage.sCorporateId + "__" + taskObj.workflowId;
        taskObj.taskDesc = taskObj.referenceId + "'s ACH Payment details have been submitted";
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.achpay.ACHInputPage.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achpay__ACHInputPage__LaunchMicroService",
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
            "appId": "achpay",
            "scr": "ACHVerifyPage",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
}
apz.achpay.ACHInputPage.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "achpay";
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
apz.achpay.ACHInputPage.fnBulkUpload = function() {
    debugger;
    var lParams = {
        "appId": "achbul",
        "scr": "InputACHBulkPayments",
        "div": "ACNR01__Navigator__launchPad",
        "layout": "All",
    };
    apz.launchApp(lParams);
}
