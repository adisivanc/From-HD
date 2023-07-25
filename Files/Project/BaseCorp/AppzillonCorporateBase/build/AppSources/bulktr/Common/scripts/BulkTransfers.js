apz.bulktr.BulkTransfers = {};
apz.bulktr.BulkTransfers.getFromId = "";
apz.app.onLoad_BulkTransfers = function(params) {
    var params = {};
    params.appId = "bulktr";
    params.scr = "WithinBank";
    //params.layout = "All";
    params.div = "bulktr__BulkTransfers__launchdiv";
    //$("#bulktr__BulkTransfers__navigator").addClass('sno');
    
    if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    
      
    else{
        params.layout = "All";
    }
    $("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    apz.launchSubScreen(params);
};
apz.bulktr.BulkTransfers.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "bulktr__BulkTransfers__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__BulkTransfers__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.BulkTransfers.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.bulktr.BulkTransfers.sCorporateId,
        "roleID": apz.bulktr.BulkTransfers.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.bulktr.BulkTransfers.fnRoleAccountCB = function(params) {
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
    apz.populateDropdown(document.getElementById("bulktr__BulkTransfers__i__Details__fromAccount_0"), lfrmarr);
    // apz.bulktr.BulkTransfers.fetchbeneficiaryDetails();
}
apz.bulktr.BulkTransfers.fetchbeneficiaryDetails = function(pObj, event) {
    debugger;
    alert("k")
    var type = apz.getElmValue(pObj.id)
    var transfertype = "";
    if (type == "WithinBank") {
        transfertype = "Same";
    }
    if (type == "Domestic") {
        transfertype = "Other";
    }
    apz.bulktr.BulkTransfers.getFromId = pObj.id.split("_")[9];
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "bulktr__BulkTransfers__launchMicroService";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bulktr__BulkTransfers__launchMicroService";
    llaunch.userObj.control.callBack = apz.bulktr.BulkTransfers.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.bulktr.BulkTransfers.sCorporateId,
        "beneficaryType": transfertype,
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.bulktr.BulkTransfers.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("bulktr");
    apz.bulktr.BulkTransfers.sData = params.data;
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
    apz.populateDropdown(document.getElementById("bulktr__BulkTransfers__i__Details__toAccount_" + apz.bulktr.BulkTransfers.getFromId), lfrmarr);
};
apz.bulktr.BulkTransfers.SaveDetails = function(event) {
    debugger;
    alert("l")
    var proceed = true;
    var totalRec = apz.scrMetaData.containersMap['bulktr__BulkTransfers__tbBulktransfer'].totalRecs;
    if (apz.val.validateContainer("bulktr__BulkTransfers__tbBulktransfer")) {
        // workflow
        var lscreenData = apz.data.buildData("BulkTransfers", "bulktr");
        var taskObj = {};
        taskObj.workflowId = "BFTR";
        taskObj.status = "U";
        taskObj.taskType = "BulkTransfer_DETAILS";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = apz.bulktr.BulkTransfers.sCorporateId + "__" + apz.Login.sUserId;
        taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.bulktr.BulkTransfers.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__BulkTransfers__launchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else if (!apz.val.validateContainer("bulktr__BulkTransfers__tbBulktransfer")) {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
    event.stopPropagation();
}
apz.bulktr.BulkTransfers.workflowMicroServiceCB = function(pNextStageObj) {
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
apz.bulktr.BulkTransfers.ownAccount = function() {
    debugger;
    //$("#bulktr__BulkTransfers__launchrow").html("");
    var params = {};
    params.appId = "bulktr";
    params.scr = "OwnAccount";
    params.layout = "All";
    params.div = "bulktr__BulkTransfers__launchdiv";
    $("#bulktr__BulkTransfers__navigator").addClass('sno');
    $("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    apz.launchSubScreen(params);
};
apz.bulktr.BulkTransfers.WithinBank = function() {
    debugger;
    var params = {};
    params.appId = "bulktr";
    params.scr = "WithinBank";
    params.layout = "All";
    params.div = "bulktr__BulkTransfers__launchdiv";
    $("#bulktr__BulkTransfers__navigator").addClass('sno');
    $("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    apz.launchSubScreen(params);
};
apz.bulktr.BulkTransfers.Domestic = function() {
    debugger;
    var params = {};
    params.appId = "bulktr";
    params.scr = "Domestic";
    params.layout = "All";
    params.div = "bulktr__BulkTransfers__launchdiv";
    $("#bulktr__BulkTransfers__navigator").addClass('sno');
    $("#bulktr__BulkTransfers__launchrow").removeClass('sno');
    apz.launchSubScreen(params);
};
