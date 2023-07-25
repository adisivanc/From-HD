apz.bulktr.OwnAccount = {};
apz.bulktr.OwnAccount.getFromAccId = "";
apz.app.onLoad_OwnAccount = function(params) {
    apz.hide("bulktr__BulkTransfers__mainheader");
    apz.bulktr.OwnAccount.sCorporateId = apz.Login.sCorporateId;
    apz.bulktr.OwnAccount.sRoleId = apz.Login.sRoleId;
    apz.bulktr.OwnAccount.fetchDetails();
    apz.data.createRow("bulktr__OwnAccount__tbTransfer");
};
apz.app.onShown_OwnAccount = function() {
    //$("#bulktr__BulkTransfers__launchrow").html("");
    //apz.bulktr.OwnAccount.fetchDetails();
};
apz.bulktr.OwnAccount.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "bulktr__OwnAccount__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__OwnAccount__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.OwnAccount.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.bulktr.OwnAccount.sCorporateId,
        "roleID": apz.bulktr.OwnAccount.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.bulktr.OwnAccount.fnRoleAccountCB = function(params) {
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
    apz.populateDropdown(document.getElementById("bulktr__OwnAccount__i__Details__fromAccount_0"), lfrmarr);
    apz.populateDropdown(document.getElementById("bulktr__OwnAccount__i__Details__toAccount_0"), lfrmarr);
    
    apz.data.getContainerData({"containerId":"bulktr__OwnAccount__tbTransfer"})
}
apz.bulktr.OwnAccount.fnOnchangeFrmAcc = function(pObj, event) {
    debugger;
    apz.bulktr.OwnAccount.getFromAccId = pObj.id;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "bulktr__OwnAccount__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__OwnAccount__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.OwnAccount.OnchangeFrmAccCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue(pObj.id)
    };
    apz.launchApp(llaunch);
}
apz.bulktr.OwnAccount.OnchangeFrmAccCB = function(params) {
    debugger;
    apz.resetCurrAppId("bulktr");
    var getId = apz.bulktr.OwnAccount.getFromAccId.split("_")[9];
    var AvailBal = params.data.accountCurrency + " " + params.data.availableBalance;
    apz.setElmValue("bulktr__OwnAccount__AvailBal_" + getId, AvailBal);
}
apz.bulktr.OwnAccount.cancel = function() {
    debugger;
    $("#bulktr__BulkTransfers__navigator").removeClass('sno');
    $("#bulktr__BulkTransfers__launchrow").addClass('sno');
    apz.show("bulktr__BulkTransfers__mainheader");
    //$("#bulktr__BulkTransfers__launchrow").html("");
}
apz.bulktr.OwnAccount.SaveDetails = function() {
    debugger;
    var proceed = true;
    var valtranAmt = true;
    var totalRec = apz.scrMetaData.containersMap['bulktr__OwnAccount__tbTransfer'].totalRecs;
    for (var k = 0; k < totalRec; k++) {
        var obj = {};
        obj.value = $("#bulktr__OwnAccount__i__Details__amount_" + k).val().toString();
        obj.decimalSep = ".";
        obj.displayAsLiteral = "N"
        var result = "";
        result = parseInt(apz.unFormatNumber(obj));
        // if (parseInt($("#bulktr__OwnAccount__AvailBal_" + k).val().split(" ")[1]) < result) {
        //     $("#bulktr__OwnAccount__i__Details__amount_" + k).addClass("err");
        //     valtranAmt = false;
        // } else {
        //     $("#bulktr__OwnAccount__i__Details__amount_" + k).removeClass("err");
        // }
        if (parseInt($("#bulktr__OwnAccount__AvailBal_" + k).val().split(" ")[1]) < result) {
            valtranAmt = false;
        }
    }
    if (apz.val.validateContainer("bulktr__OwnAccount__tbTransfer") && valtranAmt) {
        // workflow
        var lscreenData = apz.data.buildData("OwnAccount", "bulktr");
        var taskObj = {};
        taskObj.workflowId = "BTOW";
        taskObj.status = "U";
        taskObj.taskType = "OWNACCOUNT_INPUT";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = apz.bulktr.OwnAccount.sCorporateId + "__" + apz.Login.sUserId;
        taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.bulktr.OwnAccount.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__OwnAccount__launchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else if (!apz.val.validateContainer("bulktr__OwnAccount__tbTransfer")) {
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
            obj.value = $("#bulktr__OwnAccount__i__Details__amount_" + k).val().toString();
            obj.decimalSep = ".";
            obj.displayAsLiteral = "N"
            var result = "";
            result = parseInt(apz.unFormatNumber(obj));
            if (parseInt($("#bulktr__OwnAccount__AvailBal_" + k).val().split(" ")[1]) < result) {
                $("#bulktr__OwnAccount__i__Details__amount_" + k).addClass("err");
                //valtranAmt = false;
            } else {
                $("#bulktr__OwnAccount__i__Details__amount_" + k).removeClass("err");
            }
        }
    }
};
apz.bulktr.OwnAccount.workflowMicroServiceCB = function(params) {
    debugger;
    apz.currAppId = "bulktr";
    if (params.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (params.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (params.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = params.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = params.tbDbmiWorkflowDetail;
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
}
