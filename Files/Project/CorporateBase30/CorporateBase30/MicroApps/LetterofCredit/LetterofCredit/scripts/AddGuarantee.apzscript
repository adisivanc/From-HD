apz.lecr01.AddGuarantee = {};
apz.lecr01.AddGuarantee.sAction = "";
apz.lecr01.AddGuarantee.selctedAccNo = "";
apz.app.onLoad_AddGuarantee = function(params) {
    debugger;
    apz.lecr01.AddGuarantee.sCorporateId = apz.Login.sCorporateId;
    apz.lecr01.AddGuarantee.sUserId = apz.Login.sUserId;
    apz.lecr01.AddGuarantee.sRoleId = apz.Login.sRoleId;
    $("#lecr01__AddGuarantee__guaranteeBrd li").removeClass("active");
    $("#lecr01__AddGuarantee__guaranteeBrd li:first").addClass("active");
    $("#lecr01__AddGuarantee__docsUpload_li .icl").addClass("sno");
    apz.lecr01.AddGuarantee.getRoleAccountList();
    if (!apz.isObjectEmpty(params)) {
        if (params.currentTask) {
            apz.lecr01.AddGuarantee.currentWfDetails = params.currentWfDetails;
            apz.lecr01.AddGuarantee.currentTask = params.currentTask;
            apz.data.scrdata.lecr01__GuaranteeDetails_Req = JSON.parse(params.currentWfDetails.screenData).lecr01__GuaranteeDetails_Req;
            apz.lecr01.AddGuarantee.selctedAccNo = JSON.parse(params.currentWfDetails.screenData).lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance
                .collateralAccountNumber;
        } else {
            //apz.data.scrdata.lecr01__GuaranteeDetails_Req = params;
            apz.data.scrdata.lecr01__GuaranteeDetails_Req = {};
            apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance = params.lecr01__FetchGuaranteeDetails_Res.guaranteeDetails;
            apz.lecr01.AddGuarantee.selctedAccNo = params.lecr01__FetchGuaranteeDetails_Res.guaranteeDetails.collateralAccountNumber;
            apz.lecr01.AddGuarantee.sAction = params.sAction;
            if (params.lecr01__FetchGuaranteeDetails_Res.guaranteeDocs) {
                apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeDocuments = params.lecr01__FetchGuaranteeDetails_Res.guaranteeDocs;
            }
        }
        apz.data.loadData("GuaranteeDetails", "lecr01");
    } else {
        apz.lecr01.AddGuarantee.currentWfDetails = {};
        apz.lecr01.AddGuarantee.currentTask = {};
        apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__corporateId", apz.lecr01.AddGuarantee.sCorporateId);
        apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__userId", apz.lecr01.AddGuarantee.sUserId);
        apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__referenceNumber", $.now());
        apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__status", "Active");
    }
    if (apz.lecr01.AddGuarantee.sAction == "edit") {
        $("#lecr01__AddGuarantee__txt_header").text("MODIFY GUARANTEE");
    } else {
        $("#lecr01__AddGuarantee__txt_header").text("GUARANTEE");
    }
};
apz.lecr01.AddGuarantee.getRoleAccountList = function() {
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "lecr01__AddGuarantee__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "lecr01__AddGuarantee__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.lecr01.AddGuarantee.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.lecr01.AddGuarantee.sCorporateId,
        "roleID": apz.lecr01.AddGuarantee.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.lecr01.AddGuarantee.fnRoleAccountCB = function(params) {
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
    apz.populateDropdown(document.getElementById("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountNumber"), lfrmarr);
    if (apz.lecr01.AddGuarantee.selctedAccNo != "") {
        apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountNumber", apz.lecr01.AddGuarantee.selctedAccNo);
    }
};
apz.lecr01.AddGuarantee.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "lecr01__AddGuarantee__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "lecr01__AddGuarantee__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.lecr01.AddGuarantee.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountNumber")
    };
    apz.launchApp(llaunch);
};
apz.lecr01.AddGuarantee.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("lecr01");
    var CurrAmt = params.data.availableBalance;
    apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountBalance", CurrAmt);
    apz.formatNumberControl(document.getElementById("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountBalance"));
};
apz.lecr01.AddGuarantee.showGuarantee = function() {
    if (apz.val.validateContainer("lecr01__AddGuarantee__beneficaryForm")) {
        var phoneno = new RegExp("^[0-9]{10}$");
        var phno = apz.getElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__beneficaryContactNumber");
        if (phoneno.test(phno)) {
            apz.hide("lecr01__AddGuarantee__beneficaryDetails");
            apz.hide("lecr01__AddGuarantee__bankDetailsRow");
            apz.show("lecr01__AddGuarantee__guaranteeDetailsRow");
            $("#lecr01__AddGuarantee__guaranteeBrd li").removeClass("active");
            $("#lecr01__AddGuarantee__guaranteeBrd li:eq(1)").addClass("active");
            $("#lecr01__AddGuarantee__guaranteeDetBrd").attr("onclick", "apz.lecr01.AddGuarantee.showGuarantee();");
        } else {
            apz.dispMsg({
                "message": "Invalid contact number",
                "type": "E"
            });
        }
    } else {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
};
apz.lecr01.AddGuarantee.showVerify = function() {
    debugger;
    if (apz.val.validateContainer("lecr01__AddGuarantee__guaranteeForm")) {
        var lscreenData = apz.data.buildData("GuaranteeDetails", "lecr01");
        lscreenData.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance.status = "Active";
        lscreenData.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeDocuments = [];
        if ($("#lecr01__AddGuarantee__docsUpload_li #selectedfiles p").length > 0) {
            for (var i = 0; i < $("#lecr01__AddGuarantee__docsUpload_li #selectedfiles p").length; i++) {
                lscreenData.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeDocuments.push({
                    "dcoumentName": $("#lecr01__AddGuarantee__docsUpload_li #selectedfiles p:eq(" + i + ")").text().split(",")[0]
                });
            }
        }
        if (!apz.mockServer) {
            var lUserObj = {};
            if (!apz.isObjectEmpty(apz.lecr01.AddGuarantee.currentTask)) {
                if (!apz.isNull(apz.lecr01.AddGuarantee.currentTask.instanceId)) {
                    apz.lecr01.AddGuarantee.currentWfDetails.screenData = JSON.stringify(lscreenData);
                    lUserObj.currentTask = apz.lecr01.AddGuarantee.currentTask;
                    lUserObj.currentWfDetails = apz.lecr01.AddGuarantee.currentWfDetails;
                    lUserObj.callBack = apz.lecr01.AddGuarantee.workflowMicroServiceCB;
                    lUserObj.operation = "NEXTTASK";
                }
            } else {
                var taskObj = {};
                taskObj.workflowId = "GUID";
                //taskObj.stageId = "DETAILS";
                taskObj.status = "U";
                //taskObj.userId = apz.Login.sUserId;
                taskObj.taskType = "REQUEST_GUARANTEE_DETAILS";
                taskObj.versionNo = "1";
                //taskObj.appId = "lecr01";
                //taskObj.screenId = "AddGuarantee";
                taskObj.screenData = JSON.stringify(lscreenData);
                //taskObj.stageSeqNo = 1;
                taskObj.action = "";
                //taskObj.createUserId = apz.Login.sUserId;
                taskObj.referenceId = apz.lecr01.AddGuarantee.sCorporateId + "__" + apz.Login.sUserId;
                taskObj.taskDesc = taskObj.referenceId + "'s Guarantee details have been submitted";
                lUserObj.taskDetails = taskObj;
                lUserObj.callBack = apz.lecr01.AddGuarantee.workflowMicroServiceCB;
                lUserObj.operation = "NEWWORKFLOW";
            }
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "lecr01__AddGuarantee__launchMicroServiceHere",
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
                "appId": "lecr01",
                "scr": "GuaranteeVerify",
                "userObj": lReqObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
             if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
            apz.launchSubScreen(lParams);
        }
        apz.lecr01.AddGuarantee.uploadDocuments();
    } else {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
};
apz.lecr01.AddGuarantee.saveasdraft = function() {
    debugger;
    if (apz.val.validateContainer("lecr01__AddGuarantee__guaranteeForm")) {
        var lscreenData = apz.data.buildData("GuaranteeDetails", "lecr01");
        lscreenData.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance.status = "Draft";
        lscreenData.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeDocuments = [];
        if ($("#lecr01__AddGuarantee__docsUpload_li #selectedfiles p").length > 0) {
            for (var i = 0; i < $("#lecr01__AddGuarantee__docsUpload_li #selectedfiles p").length; i++) {
                lscreenData.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeDocuments.push({
                    "dcoumentName": $("#lecr01__AddGuarantee__docsUpload_li #selectedfiles p:eq(" + i + ")").text().split(",")[0]
                });
            }
        }
        if (!apz.mockServer) {
            var lUserObj = {};
            if (!apz.isObjectEmpty(apz.lecr01.AddGuarantee.currentTask)) {
                if (!apz.isNull(apz.lecr01.AddGuarantee.currentTask.instanceId)) {
                    apz.lecr01.AddGuarantee.currentWfDetails.screenData = JSON.stringify(lscreenData);
                    lUserObj.currentTask = apz.lecr01.AddGuarantee.currentTask;
                    lUserObj.currentWfDetails = apz.lecr01.AddGuarantee.currentWfDetails;
                    lUserObj.callBack = apz.lecr01.AddGuarantee.workflowMicroServiceCB;
                    lUserObj.operation = "SAVETASK";
                }
            } else {
                var taskObj = {};
                taskObj.workflowId = "GUID";
                //taskObj.stageId = "DETAILS";
                taskObj.status = "U";
                //taskObj.userId = apz.Login.sUserId;
                taskObj.taskType = "GUARANTEE_ISSUANCE_DETAILS";
                taskObj.versionNo = "1";
                //taskObj.appId = "lecr01";
                //taskObj.screenId = "AddGuarantee";
                taskObj.screenData = JSON.stringify(lscreenData);
                //taskObj.stageSeqNo = 1;
                taskObj.action = "";
                //taskObj.createUserId = apz.Login.sUserId;
                taskObj.referenceId = apz.lecr01.AddGuarantee.sCorporateId + "__" + apz.Login.sUserId;
                taskObj.taskDesc = taskObj.referenceId + "'s Guarantee details have been submitted";
                lUserObj.taskDetails = taskObj;
                lUserObj.callBack = apz.lecr01.AddGuarantee.workflowMicroServiceCB;
                lUserObj.operation = "SAVENEWWORKFLOW";
            }
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "lecr01__AddGuarantee__launchMicroServiceHere",
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
                "appId": "lecr01",
                "scr": "GuaranteeVerify",
                "userObj": lReqObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
            apz.launchSubScreen(lParams);
        }
        apz.lecr01.AddGuarantee.uploadDocuments();
    } else {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
};
apz.lecr01.AddGuarantee.workflowMicroServiceCB = function(pNextStageObj) {
    apz.currAppId = "lecr01";
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
                    "div": "ACNR01__Navigator__launchPad",
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
                        "referenceId": pNextStageObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
        if (pNextStageObj.tbDbmiWorkflowMaster.status == "SAVED") {
            apz.lecr01.AddGuarantee.currentWfDetails = pNextStageObj.currentWfDetails;
            apz.lecr01.AddGuarantee.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        }
    }
};
apz.lecr01.AddGuarantee.calculateExpiryDate = function() {
    debugger;
    var lval = apz.getElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__claimPeriod");
    if (lval !== "") {
        var date = new Date();
        date.setMonth(lval);
        apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__expiryDate", date.toString("dd-MMM-yyyy"));
    }
};
apz.lecr01.AddGuarantee.showBeneficaryBrd = function() {
    $("#lecr01__AddGuarantee__guaranteeBrd li").removeClass("active");
    $("#lecr01__AddGuarantee__guaranteeBrd li:eq(0)").addClass("active");
    apz.show("lecr01__AddGuarantee__beneficaryDetails");
    apz.hide("lecr01__AddGuarantee__guaranteeDetailsRow");
    apz.hide("lecr01__AddGuarantee__bankDetailsRow");
};
apz.lecr01.AddGuarantee.checkCollateralType = function() {
    var lval = apz.getElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__accountType");
    if (lval !== "") {
        $("#lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountNumber_ext").removeClass("select-disabled");
        $("#lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountNumber_ext").removeAttr("disabled");
    } else {
        $("#lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountNumber_ext").addClass("select-disabled");
        $("#lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__collateralAccountNumber_ext").attr("disabled", true);
    }
};
apz.lecr01.AddGuarantee.checkGuaranteeFormat = function() {
    var lval = apz.getElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__guaranteeFormat");
    apz.hide("lecr01__AddGuarantee__docsUpload_ul");
    if (lval == "upload") {
        apz.show("lecr01__AddGuarantee__docsUpload_ul");
    }
};
apz.lecr01.AddGuarantee.uploadDocuments = function() {
    if (!$("#lecr01__AddGuarantee__docsUpload_ul").hasClass("sno")) {
        if ($("#lecr01__AddGuarantee__docsUpload").prop("files").length > 0) {
            var json = {};
            json.fieldID = "lecr01__AddGuarantee__docsUpload_ul";
            json.callBack = apz.lecr01.AddGuarantee.uploadDocumentsCB;
            json.fileName = "";
            json.overWrite = "Y";
            json.destination = "MasterGuarantee";
            apz.ns.uploadFile(json);
        } else {
            var msg = {};
            msg.code = "APZ-CNT-009";
            apz.dispMsg(msg);
        }
    }
};
apz.lecr01.AddGuarantee.uploadDocumentsCB = function(pResp) {
    debugger;
};
apz.lecr01.AddGuarantee.showBankDetails = function() {
    apz.hide("lecr01__AddGuarantee__guaranteeDetailsRow");
    apz.hide("lecr01__AddGuarantee__beneficaryDetails");
    apz.show("lecr01__AddGuarantee__bankDetailsRow");
};
