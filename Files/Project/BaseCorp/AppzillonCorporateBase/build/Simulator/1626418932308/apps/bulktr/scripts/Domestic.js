apz.bulktr.Domestic = {};
apz.bulktr.Domestic.getFromAccId = "";
apz.bulktr.Domestic.getBenAccId = "";
apz.app.onLoad_Domestic = function(params) {
    apz.hide("bulktr__BulkTransfers__mainheader");
    apz.bulktr.Domestic.sCorporateId = apz.Login.sCorporateId;
    apz.bulktr.Domestic.sRoleId = apz.Login.sRoleId;
    apz.bulktr.Domestic.fetchDetails();
    apz.data.createRow('bulktr__Domestic__tbDomestic');
};
apz.bulktr.Domestic.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "bulktr__Domestic__LaunchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__Domestic__LaunchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.Domestic.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.bulktr.Domestic.sCorporateId,
        "roleID": apz.bulktr.Domestic.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.bulktr.Domestic.fnRoleAccountCB = function(params) {
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
        var lfrmacc = {
            "val": params.data[i].accountNo,
            "desc": params.data[i].accountNo
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("bulktr__OtherBankDom__i__Domestic__fromAccount_0"), lfrmarr);
    apz.bulktr.Domestic.fetchbeneficiaryDetails();
};
apz.bulktr.Domestic.OnchangeFrmAcc = function(pObj, event) {
    apz.bulktr.Domestic.getFromAccId = pObj.id;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "bulktr__Domestic__LaunchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__Domestic__LaunchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.Domestic.OnchangeFrmAccCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue(pObj.id)
    };
    apz.launchApp(llaunch);
}
apz.bulktr.Domestic.OnchangeFrmAccCB = function(params) {
    apz.resetCurrAppId("bulktr");
    var getId = apz.bulktr.Domestic.getFromAccId.split("_")[9];
    var AvailBal = params.data.accountCurrency + " " + params.data.availableBalance;
    apz.setElmValue("bulktr__Domestic__AvailBal_" + getId, AvailBal);
}
apz.bulktr.Domestic.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "bulktr__Domestic__LaunchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__Domestic__LaunchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.Domestic.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.bulktr.Domestic.sCorporateId,
        "beneficaryType": "Other",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.bulktr.Domestic.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("bulktr");
    apz.bulktr.Domestic.sData = params.data;
    var lfrmarr = [];
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
    apz.populateDropdown(document.getElementById("bulktr__OtherBankDom__i__Domestic__toAccount_0"), lfrmarr);
};
apz.bulktr.Domestic.OnchangeToAcc = function(pObj, event) {
    var lData = apz.bulktr.Domestic.sData;
    apz.bulktr.Domestic.getBenAccId = pObj.id;
    var getId = pObj.id.split("_")[9];
    var larrLength = lData.length;
    var lAccNum = apz.getElmValue(pObj.id);
    for (var i = 0; i < larrLength; i++) {
        if (lAccNum == lData[i].accountNumber) {
            var lIfscCode = lData[i].ifscCode;
            var lBankName = lData[i].bankName;
            apz.setElmValue("bulktr__OtherBankDom__i__Domestic__bankName_" + getId, lBankName);
            apz.setElmValue("bulktr__OtherBankDom__i__Domestic__ifscCode_" + getId, lIfscCode);
        }
    }
}
apz.bulktr.Domestic.cancel = function() {
    debugger;
    $("#bulktr__BulkTransfers__navigator").removeClass('sno');
    $("#bulktr__BulkTransfers__launchrow").addClass('sno');
    apz.show("bulktr__BulkTransfers__mainheader");
}
apz.bulktr.Domestic.SaveDetails = function() {
    // debugger;
    var proceed = true;
    var valtranAmt = true;
    var totalRec = apz.scrMetaData.containersMap['bulktr__Domestic__tbDomestic'].totalRecs;
    for (var k = 0; k < totalRec; k++) {
        
         var obj = {};
        obj.value = $("#bulktr__OtherBankDom__i__Domestic__amount_" + k).val().toString();
        obj.decimalSep = ".";
        obj.displayAsLiteral = "N"
        var result = "";
        result = parseInt(apz.unFormatNumber(obj));
        if (parseInt($("#bulktr__Domestic__AvailBal_" + k).val().split(" ")[1]) < result) {
            
            valtranAmt = false;
        } 
    }
    if (apz.val.validateContainer("bulktr__Domestic__tbDomestic") && valtranAmt) {
        // workflow
        var lscreenData = apz.data.buildData("OtherBankDom", "bulktr");
        var taskObj = {};
        taskObj.workflowId = "BTDO";
        taskObj.status = "U";
        //taskObj.userId = apz.Login.sUserId;
        taskObj.taskType = "OTHERBANKDOM_DETAILS";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = apz.Login.sCorporateId + "__" + apz.Login.sUserId;
        taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.bulktr.Domestic.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__Domestic__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else if (!apz.val.validateContainer("bulktr__Domestic__tbDomestic")) {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    } else if (valtranAmt == false) {
        apz.dispMsg({
            "message": "Transfer Amount is greater than Available Balance",
            "type": "E"
        });
         for (var k = 0; k < totalRec; k++) {
        
         var obj = {};
        obj.value = $("#bulktr__OtherBankDom__i__Domestic__amount_" + k).val().toString();
        obj.decimalSep = ".";
        obj.displayAsLiteral = "N"
        var result = "";
        result = parseInt(apz.unFormatNumber(obj));
        if (parseInt($("#bulktr__Domestic__AvailBal_" + k).val().split(" ")[1]) < result) {
            $("#bulktr__OtherBankDom__i__Domestic__amount_" + k).addClass("err");
            valtranAmt = false;
        } else {
            $("#bulktr__OtherBankDom__i__Domestic__amount_" + k).removeClass("err");
        }
    }
    }
}
apz.bulktr.Domestic.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "bulktr";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
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
                apz.launchSubScreen(lParams);
            }
        }
    }
};
