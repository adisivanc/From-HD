apz.bulktr.WithinBank = {};
apz.bulktr.WithinBank.getFromAccId = "";
apz.bulktr.WithinBank.getBenAccId = "";
apz.bulktr.WithinBank.getWBBenDetails = {};
apz.bulktr.WithinBank.getOBBenDetails = {};
apz.bulktr.WithinBank.sCache = {};
apz.bulktr.WithinBank.BanListtArr = [];
apz.app.onLoad_WithinBank = function(params) {
    debugger;
    apz.data.scrdata.bulktr__WithinBankDetails_Req = {};
    apz.hide("bulktr__BulkTransfers__mainheader");
    apz.bulktr.WithinBank.sCache = params;
    apz.bulktr.WithinBank.sCorporateId = apz.Login.sCorporateId;
    apz.bulktr.WithinBank.sRoleId = apz.Login.sRoleId;
    apz.bulktr.WithinBank.fetchDetails();
    apz.bulktr.WithinBank.fetchWBDetails();
    apz.bulktr.WithinBank.fetchOBDetails();
    
    
    if (params.currentTask) {
       
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).bulktr__WithinBankDetails_Req;
        apz.data.scrdata.bulktr__WithinBankDetails_Req = {};
        apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster = lScreenData.TxnMaster;
        apz.data.loadData("WithinBankDetails", "bulktr");
    }
    
};
apz.app.onShown_WithinBank = function(params) {
    debugger;
    setTimeout(function() {
        apz.bulktr.WithinBank.fnInitialize(apz.bulktr.WithinBank.sCache);
    }, 500);
};
apz.bulktr.WithinBank.fnInitialize = function(params) {
    //$("#bulktr__WithinBank__tbwithinbank_add_btn").click();
    if (!apz.isNull(params.data)) {
        if (!apz.isNull(params.data.fromOCR)) {
            if (params.data.fromOCR) {
                /*for (var i = 0; i < params.data.tfrDtls.length; i++) {
                    $("#bulktr__WithinBank__tbwithinbank_row_" + i).click();
                    if (i == 0) {
                        apz.setElmValue("bulktr__WithinBank__FromAccountNo", params.data.tfrDtls[i].fromAccount);
                    }
                    apz.setElmValue("bulktr__WithinBankDetails__i__Details__type_" + i, params.data.tfrDtls[i].type);
                    apz.setElmValue("bulktr__WithinBankDetails__i__Details__toAccount_" + i, params.data.tfrDtls[i].toAccount);
                    apz.setElmValue("bulktr__WithinBankDetails__i__Details__currency_" + i, params.data.tfrDtls[i].currency);
                    apz.setElmValue("bulktr__WithinBankDetails__i__Details__amount_" + i, params.data.tfrDtls[i].amount);
                    if (i < params.data.tfrDtls.length - 1) {
                        apz.data.createRow('bulktr__WithinBank__tbwithinbank');
                    }
                }*/
                apz.data.scrdata.bulktr__WithinBankDetails_Req = {};
                apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster = {};
                apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster.Details = params.data.tfrDtls;
                apz.data.loadData("WithinBankDetails", "bulktr");
                apz.bulktr.WithinBank.sCache = {};
                $("#bulktr__WithinBank__addbenListRow").removeClass("sno");
            }
        }
    } else {
        apz.data.createRow('bulktr__WithinBank__tbwithinbank');
    }
    //apz.data.createRow('bulktr__WithinBank__tbwithinbank');
    apz.setElmValue("bulktr__WithinBank__FromAccountNo", apz.getElmValue("bulktr__WithinBankDetails__i__Details__fromAccount_0"));
    apz.setElmValue("bulktr__WithinBankDetails__i__TxnMaster__appId", apz.currAppId);
    apz.setElmValue("bulktr__WithinBankDetails__i__TxnMaster__userId", apz.Login.sCorporateId);
    apz.setElmValue("bulktr__WithinBankDetails__i__TxnMaster__customerId", apz.Login.sCorporateId);
    apz.setElmValue("bulktr__WithinBankDetails__i__TxnMaster__txnType", "BTWB");
    apz.setElmValue("bulktr__WithinBankDetails__i__TxnMaster__txnStatus", "U");
    
};
apz.bulktr.WithinBank.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "bulktr__WithinBank__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__WithinBank__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.WithinBank.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.bulktr.WithinBank.sCorporateId,
        "roleID": apz.bulktr.WithinBank.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.bulktr.WithinBank.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("bulktr");
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
    apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__fromAccount_0"), lfrmarr);
    apz.populateDropdown(document.getElementById("bulktr__WithinBank__FromAccountNo"), lfrmarr);
    //apz.bulktr.WithinBank.fetchbeneficiaryDetails();
};
apz.bulktr.WithinBank.fetchWBDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "bulktr__WithinBank__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__WithinBank__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.WithinBank.fetchWBDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.bulktr.WithinBank.sCorporateId,
        "beneficaryType": "Other",
        "action": "onload"
    };
    apz.launchApp(llaunch);
}
apz.bulktr.WithinBank.fetchWBDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("bulktr");
    //apz.bulktr.WithinBank.sData = params.data;
    apz.bulktr.WithinBank.getWBBenDetails.fullList = params.data;
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
            "desc": params.data[i].beneficaryName + "-" + params.data[i].iban
        };
        lfrmarr.push(lfrmacc);
    }
    apz.bulktr.WithinBank.getWBBenDetails.toAccount = lfrmarr;
    lToBenName.push(lObj);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        var lBen = {
            "val": params.data[i].beneficaryName,
            "desc": params.data[i].beneficaryName
        };
        lToBenName.push(lBen);
    }
    apz.bulktr.WithinBank.getWBBenDetails.toBenName = lToBenName;
    //apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__toAccount_0"), lfrmarr);
};
apz.bulktr.WithinBank.fetchOBDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "bulktr__WithinBank__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__WithinBank__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.WithinBank.fetchOBDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.bulktr.WithinBank.sCorporateId,
        "beneficaryType": "Other",
        "action": "onload"
    };
    apz.launchApp(llaunch);
}
apz.bulktr.WithinBank.fetchOBDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("bulktr");
    //apz.bulktr.WithinBank.sData = params.data;
    apz.bulktr.WithinBank.getOBBenDetails.fullList = params.data;
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
            "desc": params.data[i].beneficaryName + "-" + params.data[i].iban
        };
        lfrmarr.push(lfrmacc);
    }
    apz.bulktr.WithinBank.getOBBenDetails.toAccount = lfrmarr;
    lToBenName.push(lObj);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        var lBen = {
            "val": params.data[i].beneficaryName,
            "desc": params.data[i].beneficaryName
        };
        lToBenName.push(lBen);
    }
    apz.bulktr.WithinBank.getOBBenDetails.toBenName = lToBenName;
    //apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__toAccount_0"), lfrmarr);
};
apz.bulktr.WithinBank.fetchbeneficiaryDetails = function(pObj, event) {
    var type = apz.getElmValue(pObj.id)
    var getId = pObj.id.split("_")[9];
    if (type == "WithinBank") {
        
          if (apz.deviceGroup == "Mobile") {
                   apz.populateDropdown(document.getElementById("bulktr__WithinBank__mobBeneficiaryddl"), apz.bulktr.WithinBank.getOBBenDetails
            .toAccount);
             }
        apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__toAccount_" + getId), apz.bulktr.WithinBank.getWBBenDetails
            .toAccount);
        apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__benificiaryName_" + getId), apz.bulktr.WithinBank.getWBBenDetails
            .toBenName);
            
             if (apz.deviceGroup == "Mobile") {
                  apz.populateDropdown(document.getElementById("bulktr__WithinBank__mobBeneficiaryddl"), apz.bulktr.WithinBank.getWBBenDetails
            .toAccount);
             }
            
    }
    if (type == "Domestic") {
        
          if (apz.deviceGroup == "Mobile") {
                   apz.populateDropdown(document.getElementById("bulktr__WithinBank__mobBeneficiaryddl"), apz.bulktr.WithinBank.getOBBenDetails
            .toAccount);
             }
        apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__toAccount_" + getId), apz.bulktr.WithinBank.getOBBenDetails
            .toAccount);
        apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__benificiaryName_" + getId), apz.bulktr.WithinBank.getOBBenDetails
            .toBenName);
            
            
    }
};
apz.bulktr.WithinBank.fnOnchangeFrmAcc = function(pObj, event) {
    debugger;
    //bulktr__OwnAccount__i__Details__fromaccount_0
    apz.bulktr.WithinBank.getFromAccId = pObj.id;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "bulktr__WithinBank__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__WithinBank__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.WithinBank.OnchangeFrmAccCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue(pObj.id)
    };
    apz.launchApp(llaunch);
};
apz.bulktr.WithinBank.OnchangeFrmAccCB = function(params) {
    debugger;
    apz.resetCurrAppId("bulktr");
    //var getId = apz.bulktr.WithinBank.getFromAccId.split("_")[9];
    var AvailBal = params.data.accountCurrency + " " + params.data.availableBalance;
    apz.setElmValue("bulktr__WithinBank__AvailBal", AvailBal);
    $(".avalbal").removeClass("sno");
};
apz.bulktr.WithinBank.fnOnchangeBenAcc = function(pObj) {
    debugger;
    var lData = {};
    var ltfrType = apz.getElmValue("bulktr__WithinBankDetails__i__Details__type_" + $("#" + pObj.id).attr("rowno"));
    if (ltfrType == "WithinBank") {
        lData = apz.bulktr.WithinBank.getWBBenDetails.fullList;
    } else {
        lData = apz.bulktr.WithinBank.getOBBenDetails.fullList;
    }
    apz.bulktr.WithinBank.getBenAccId = pObj.id;
    var getId = pObj.id.split("_")[9];
    var larrLength = lData.length;
    var lAccNum = apz.getElmValue(pObj.id);
    for (var i = 0; i < larrLength; i++) {
        if (lAccNum == lData[i].accountNumber) {
            var lAccBrnch = lData[i].branchName;
            var lBenName = lData[i].beneficaryName;
            // apz.setElmValue("bulktr__WithinBank__benBranch_" + getId, lAccBrnch);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__bankName_" + getId, lData[i].bankName);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__ifscCode_" + getId, lData[i].ifscCode);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__swiftCode_" + getId, lData[i].swiftCode);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__beneficiaryType_" + getId, lData[i].beneficaryType);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__emailId_" + getId, lData[i].emailId);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__accountType_" + getId, lData[i].accountType);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__benAddr_" + getId, lData[i].benAddress);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__benCountry_" + getId, lData[i].benCountry);
            apz.setElmValue("bulktr__WithinBankDetails__i__Details__benificiaryName_" + getId, lBenName);
            break;
        }
    }
};
apz.bulktr.WithinBank.cancel = function() {
    debugger;
    $("#bulktr__BulkTransfers__navigator").removeClass('sno');
    $("#bulktr__BulkTransfers__launchrow").addClass('sno');
    apz.show("bulktr__BulkTransfers__mainheader");
};
apz.bulktr.WithinBank.SaveDetails = function() {
    debugger;
    var proceed = true;
  //  var totalRec = apz.scrMetaData.containersMap['bulktr__WithinBank__tbwithinbank'].totalRecs;
   // if (apz.val.validateContainer("bulktr__WithinBank__tbwithinbank")) {
        // workflow
        apz.data.buildData("WithinBankDetails", "bulktr");
        var lscreenData = {
            "bulktr__WithinBankDetails_Req": apz.data.scrdata.bulktr__WithinBankDetails_Req
        };
        var lfromAccount = apz.getElmValue("bulktr__WithinBank__FromAccountNo");
        var lTotAmount = 0;
        var ldata = [];
        if (lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.Details.length > 0) {
            for (var i = 0; i < lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.Details.length; i++) {
                if (lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.Details[i].type != "") {
                    lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.Details[i].fromAccount = lfromAccount;
                   
                    lTotAmount = lTotAmount + parseFloat(lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.Details[i].amount);
                    ldata.push(lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.Details[i]);
                    //ldata[i].fromAccount = lfromAccount;
                }
            }
            lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.Details = ldata;
        }
        lscreenData.bulktr__WithinBankDetails_Req.TxnMaster.amount = lTotAmount;
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "BTWB";
            taskObj.status = "U";
            taskObj.taskType = "WITHINBANK_DETAILS";
            taskObj.versionNo = "1";
            taskObj.screenData = JSON.stringify(lscreenData);
            taskObj.action = "";
            taskObj.referenceId = apz.bulktr.WithinBank.sCorporateId + "__" + apz.Login.sUserId;
            taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.bulktr.WithinBank.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "bulktr__WithinBank__launchMicroService",
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
                "appId": "bulktr",
                "scr": "WithinBankVerify",
                "userObj": lReqObj,
                "div": "bulktr__BulkTransfers__launchdiv",
                "layout": "All"
            };
             if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
            
            apz.launchSubScreen(lParams);
        }
    //} 
    
    // else if (!apz.val.validateContainer("bulktr__WithinBank__tbwithinbank")) {
    //     apz.dispMsg({
    //         "message": "Please provide value for mandatory field(s)",
    //         "type": "E"
    //     });
    // }
};
apz.bulktr.WithinBank.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "bulktr";
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
                    "div": "bulktr__BulkTransfers__launchdiv",
                    "layout": "All"
                };
                if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
                
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
apz.bulktr.WithinBank.fnScanAndUpload = function() {
    var lParams = {
        "appId": "upldoc",
        "scr": "UploadDocument",
        "div": "bulktr__BulkTransfers__launchdiv",
        "userObj": {
            "callBack": apz.bulktr.WithinBank.fnScanAndUploadCB,
            "onOCRUPloadCBmethod": apz.bulktr.WithinBank.fnScanAndUploadCB,
            "backFunction": apz.bulktr.WithinBank.fnBackToInput
        }
    }
    apz.launchApp(lParams);
};
apz.bulktr.WithinBank.fnScanAndUploadCB = function(params) {
    debugger;
    var lparams = {};
    lparams.appId = "bulktr";
    lparams.scr = "WithinBank";
    lparams.layout = "All";
    lparams.div = "bulktr__BulkTransfers__launchdiv";
    $("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    lparams.userObj = {
        "data": {
            "tfrDtls": params,
            "fromOCR": true
        }
    }
    apz.launchApp(lparams);
};
apz.bulktr.WithinBank.fnBackToInput = function() {
    debugger;
    var lparams = {};
    lparams.appId = "bulktr";
    lparams.scr = "WithinBank";
    lparams.layout = "All";
    lparams.div = "bulktr__BulkTransfers__launchdiv";
    $("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    // lparams.userObj = {
    //     "data": {
    //         "tfrDtls": params,
    //         "fromOCR": true
    //     }
    // }
    
    if (apz.deviceGroup == "Mobile") {
        lparams.layout = "Mobile";
    }
    apz.launchApp(lparams);
};
apz.bulktr.WithinBank.fnExcelUpload = function() {
    debugger;
    var lParams = {
        "appId": "upldoc",
        "scr": "UploadXLDocument",
        "div": "bulktr__BulkTransfers__launchdiv",
        "userObj": {
            "callBack": apz.bulktr.WithinBank.fnExcelUploadCB,
            "onXLUPloadCBmethod": apz.bulktr.WithinBank.fnExcelUploadCB,
            "backFunction": apz.bulktr.WithinBank.fnBackToInput
        }
    }
    apz.launchApp(lParams);
};
apz.bulktr.WithinBank.fnExcelUploadCB = function(params) {
    debugger;
    var lparams = {};
    lparams.appId = "bulktr";
    lparams.scr = "WithinBank";
    lparams.layout = "All";
    lparams.div = "bulktr__BulkTransfers__launchdiv";
    $("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    lparams.userObj = {
        "data": {
            "tfrDtls": params,
            "fromOCR": true
        }
    }
    
    if (apz.deviceGroup == "Mobile") {
        lparams.layout = "Mobile";
    }
    apz.launchApp(lparams);
};


apz.bulktr.WithinBank.fnOnchangeBenAccMob = function(pObj) {
    debugger;
    var lData = {};
    var ltfrType = apz.getElmValue(pObj.id);
    if (ltfrType == "WithinBank") {
        lData = apz.bulktr.WithinBank.getWBBenDetails.fullList;
    } else {
        lData = apz.bulktr.WithinBank.getOBBenDetails.fullList;
    }
    apz.bulktr.WithinBank.getBenAccId = pObj.id;
   // var getId = pObj.id.split("_")[9];
    var larrLength = lData.length;
    var lAccNum = apz.getElmValue(pObj.id);
    for (var i = 0; i < larrLength; i++) {
        if (lAccNum == lData[i].accountNumber) {
            var lAccBrnch = lData[i].branchName;
            var lBenName = lData[i].beneficaryName;
            // apz.setElmValue("bulktr__WithinBank__benBranch_" + getId, lAccBrnch);
            apz.setElmValue("bulktr__WithinBank__MobbankNam", lData[i].bankName);
            apz.setElmValue("bulktr__WithinBank__MobifscCode", lData[i].ifscCode);
            apz.setElmValue("bulktr__WithinBank__MobswiftCode", lData[i].swiftCode);
            apz.setElmValue("bulktr__WithinBank__MobbeneficiaryType", lData[i].beneficaryType);
            apz.setElmValue("bulktr__WithinBank__MobemailId" , lData[i].emailId);
            apz.setElmValue("bulktr__WithinBank__MobaccountType" , lData[i].accountType);
            apz.setElmValue("bulktr__WithinBank__MobbenAddr" , lData[i].benAddress);
            apz.setElmValue("bulktr__WithinBank__MobbenCountry" , lData[i].benCountry);
            apz.setElmValue("bulktr__WithinBank__MobenificiaryName", lBenName);
            break;
        }
    }
};

apz.bulktr.WithinBank.fnShowBenForm = function() {
    debugger;
    $("#bulktr__WithinBank__addBenForm").removeClass("sno");
 //$("#bulktr__WithinBank__addbenListRow").addClass("sno")
 apz.setElmValue("bulktr__WithinBank__el_rdo_1", "");
 apz.setElmValue("bulktr__WithinBank__mobBeneficiaryddl", "");
 apz.setElmValue("bulktr__WithinBank__el_dpd_3", "");
 apz.setElmValue("bulktr__WithinBank__el_inp_4", "");
 apz.setElmValue("bulktr__WithinBank__el_dpd_6", "");
 apz.setElmValue("bulktr__WithinBank__el_txa_2", "");
}

apz.bulktr.WithinBank.fnHideBenForm = function() {
    debugger;
    $("#bulktr__WithinBank__addBenForm").addClass("sno");
 //$("#bulktr__WithinBank__addbenListRow").addClass("sno")
 apz.setElmValue("bulktr__WithinBank__el_rdo_1", "");
 apz.setElmValue("bulktr__WithinBank__mobBeneficiaryddl", "");
 apz.setElmValue("bulktr__WithinBank__el_dpd_3", "");
 apz.setElmValue("bulktr__WithinBank__el_inp_4", "");
 apz.setElmValue("bulktr__WithinBank__el_dpd_6", "");
 apz.setElmValue("bulktr__WithinBank__el_txa_2", "");
}


apz.bulktr.WithinBank.fnAddtoBenList = function() {
    debugger;
    var lobj = {};
    lobj.froAccount = apz.getElmValue("bulktr__WithinBank__FromAccountNo");
    lobj.type = apz.getElmValue("bulktr__WithinBank__el_rdo_1");
    lobj.typeText = apz.getElmValue("bulktr__WithinBank__el_rdo_1");
    lobj.toAccount = apz.getElmValue("bulktr__WithinBank__mobBeneficiaryddl");
    lobj.currency = apz.getElmValue("bulktr__WithinBank__el_dpd_3");
    lobj.amount = apz.getElmValue("bulktr__WithinBank__el_inp_4");
    lobj.chargeTo = apz.getElmValue("bulktr__WithinBank__el_dpd_6");
    lobj.remarks = apz.getElmValue("bulktr__WithinBank__el_txa_2");
    lobj.benificiaryName = apz.getElmValue("bulktr__WithinBank__MobenificiaryName");
    lobj.bankName = apz.getElmValue("bulktr__WithinBank__MobbankNam");
    lobj.ifscCode = apz.getElmValue("bulktr__WithinBank__MobifscCode");
    lobj.swiftCode = apz.getElmValue("bulktr__WithinBank__MobswiftCode");
    lobj.beneficiaryType = apz.getElmValue("bulktr__WithinBank__MobbeneficiaryType");
    lobj.emailId = apz.getElmValue("bulktr__WithinBank__MobemailId");
    lobj.accountType = apz.getElmValue("bulktr__WithinBank__MobaccountType");
    lobj.benAddr = apz.getElmValue("bulktr__WithinBank__MobbenAddr");
    // lobj.phNo = apz.getElmValue("bulktr__WithinBank__MobemailId");
    lobj.benCountry = apz.getElmValue("bulktr__WithinBank__MobbenCountry");
    
    apz.bulktr.WithinBank.BanListtArr.push(lobj);
    
    apz.data.scrdata.bulktr__WithinBankDetails_Req = {};
    apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster = {};
        apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster.Details = apz.bulktr.WithinBank.BanListtArr;
        apz.data.loadData("WithinBankDetails", "bulktr");
        $("#bulktr__WithinBank__addBenForm").addClass("sno");
        $("#bulktr__WithinBank__addbenListRow").removeClass("sno");
        
}

apz.bulktr.WithinBank.fnDeleteBenList = function(pthis) {
debugger;
apz.bulktr.WithinBank.lrow = $(pthis).attr("rowno");
apz.bulktr.WithinBank.BanListtArr.splice(apz.bulktr.WithinBank.lrow, 1);

     apz.data.scrdata.bulktr__WithinBankDetails_Req = {};
    apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster = {};
        apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster.Details = apz.bulktr.WithinBank.BanListtArr;
        apz.data.loadData("WithinBankDetails", "bulktr");
}
