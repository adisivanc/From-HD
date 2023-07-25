apz.lecr01.AddLC = {};
apz.lecr01.AddLC.selctedAccNo = "";
apz.lecr01.AddLC.sAction = "";
var invoiceClause = [{
    "val": "Certification",
    "desc": "Certification"
}, {
    "val": "Authentic",
    "desc": "Authentic"
}, {
    "val": "Conformity",
    "desc": "Conformity"
}];
var marinebillClause = [{
    "val": "Consignment",
    "desc": "Consignment"
}, {
    "val": "Freightpayment",
    "desc": "Freight payment"
}];
var vesselClause = [{
    "val": "Eligibility",
    "desc": "Eligibility"
}, {
    "val": "Classification",
    "desc": "Classification"
}];
var airwaybillClause = [{
    "val": "Consignment",
    "desc": "Consignment"
}, {
    "val": "Freightpayment",
    "desc": "Freight payment"
}];
var CMRClause = [{
    "val": "Consignment",
    "desc": "Consignment"
}, {
    "val": "Freightpayment",
    "desc": "Freight payment"
}];
var insuranceClause = [{
    "val": "Endorsement",
    "desc": "Endorsement"
}, {
    "val": "Claimspayable",
    "desc": "Claims payable"
}, {
    "val": "Institute cargo clause A all risks",
    "desc": "Institute cargo clause A all risks"
}, {
    "val": "Institute war clause cargo",
    "desc": "Institute war clause cargo"
}, {
    "val": "Institute strike clause cargo",
    "desc": "Institute strike clause cargo"
}, {
    "val": "Institute air cargo clause A",
    "desc": "Institute air cargo clause A"
}, {
    "val": "Institute war clause by air",
    "desc": "Institute war clause by air"
}, {
    "val": "Institute strike clause by air",
    "desc": "Institute strike clause by air"
}, {
    "val": "Institute Land transit clause all risks",
    "desc": "Institute Land transit clause all risks"
}, {
    "val": "War for transport by land",
    "desc": "War for transport by land"
}, {
    "val": "Strike riots civil commotion by land",
    "desc": "Strike riots civil commotion by land"
}, {
    "val": "War clause",
    "desc": "War clause"
}, {
    "val": "Institute cargo clauses of London Underwriters last edition",
    "desc": "Institute cargo clauses of London Underwriters last edition"
}];
var certificateClause = [{
    "val": "Certification",
    "desc": "Certification"
}, {
    "val": "Legalization",
    "desc": "Legalization"
}];
apz.app.onLoad_AddLC = function(params) {
    debugger;
    apz.lecr01.AddLC.sCorporateId = apz.Login.sCorporateId;
    apz.lecr01.AddLC.sUserId = apz.Login.sUserId;
    apz.lecr01.AddLC.sRoleId = apz.Login.sRoleId;
    apz.lecr01.AddLC.sDocuments = [];
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:first").addClass("active");
    $("#lecr01__AddLC__docsBrowse_li .icl,#lecr01__AddLC__docsTableul_ttl").addClass("sno");
    apz.lecr01.AddLC.getRoleAccountList();
    if (!apz.isObjectEmpty(params)) {
        if (params.currentTask) {
            apz.lecr01.AddLC.currentWfDetails = params.currentWfDetails;
            apz.lecr01.AddLC.currentTask = params.currentTask;
            apz.data.scrdata.lecr01__LCDetails_Req = JSON.parse(params.currentWfDetails.screenData).lecr01__LCDetails_Req;
            apz.lecr01.AddLC.selctedAccNo = JSON.parse(params.currentWfDetails.screenData).lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.collateralAccountNumber;
        } else {
            //apz.data.scrdata.lecr01__LCDetails_Req = params;
            apz.data.scrdata.lecr01__LCDetails_Req = {};
            apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit = params.lecr01__FetchLetterofCreditsService_Res.letterDetails;
            apz.lecr01.AddLC.selctedAccNo = params.lecr01__FetchLetterofCreditsService_Res.letterDetails.collateralAccountNumber;
            apz.lecr01.AddLC.sAction = params.sAction;
            if (params.lecr01__FetchLetterofCreditsService_Res.letterDocumentsLists) {
                apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments = params.lecr01__FetchLetterofCreditsService_Res.letterDocumentsLists;
            }
            if (params.lecr01__FetchLetterofCreditsService_Res.letterDocumentsLists) {
                apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments = params.lecr01__FetchLetterofCreditsService_Res.letterDocumentsLists;
            }
            if (params.lecr01__FetchLetterofCreditsService_Res.letterDraftsLists) {
                apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDrafts = params.lecr01__FetchLetterofCreditsService_Res.letterDraftsLists;
            }
            if (params.lecr01__FetchLetterofCreditsService_Res.letterCollateralList) {
                apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditCollateral = params.lecr01__FetchLetterofCreditsService_Res.letterCollateralList;
            }
        }
        apz.data.loadData("LCDetails", "lecr01");
    } else {
        apz.lecr01.AddLC.currentWfDetails = {};
        apz.lecr01.AddLC.currentTask = {};
        apz.data.scrdata.lecr01__LCDetails_Req = {};
        apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments = [];
        apz.setElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__corporateId", apz.lecr01.AddLC.sCorporateId);
        apz.setElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__userId", apz.lecr01.AddLC.sUserId);
        apz.setElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__referenceNumber", $.now());
        apz.setElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__status", "Active");
    }
    if (apz.lecr01.AddLC.sAction == "edit") {
        $("#lecr01__AddLC__txt_header").text("MODIFY LETTER OF CREDIT");
    } else {
        $("#lecr01__AddLC__txt_header").text("LETTER OF CREDIT");
    }
    //apz.data.createRow('lecr01__AddLC__tbl_drafts');
    apz.lecr01.AddLC.InitFileDragAndDrop("lecr01__AddLC__sc_col_158", "");
};
apz.lecr01.AddLC.InitFileDragAndDrop = function(lhtmlId, ltype) {
    debugger;
    var obj = $("#" + lhtmlId);
    obj.on('dragenter', function(e) {
        $(this).addClass('dragenter');
        e.stopPropagation();
        e.preventDefault();
    });
    obj.on('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });
    obj.on('drop', function(e) {
        debugger;
        $(this).addClass('dragenter');
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files;
        // console.log(event.dataTransfer.files[0]);
        //We need to send dropped files to Server
        apz.lecr01.AddLC.handleFileUpload(files, obj, ltype);
    });
    $(document).on('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });
    $(document).on('dragover', function(e) {
        $(this).addClass('dragenter');
        e.stopPropagation();
        e.preventDefault();
    });
    $(document).on('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });
};
apz.lecr01.AddLC.handleFileUpload = function(files, obj, ltype) {
    debugger;
    var lFiles = files;
    if (lFiles.length > 0 && !apz.isNull(apz.getElmValue("lecr01__AddLC__documentType"))) {
        for (var i = 0; i < lFiles.length; i++) {
            console.log(lFiles[i]);
            apz.lecr01.AddLC.sDocuments.push(lFiles[i]);
            var lobj = {
                "referenceNumber": apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__referenceNumber"),
                "documentType": $("#lecr01__AddLC__documentType").val(),
                "filename": lFiles[i].name,
                "corporateId": apz.lecr01.AddLC.sCorporateId,
                "userId": apz.lecr01.AddLC.sUserId
            };
            apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments.push(lobj);
        }
        apz.data.getContainerData({
            "containerId": "lecr01__AddLC__docsTable",
            "dataRecNo": "0",
            "action": "C"
        });
        apz.show("lecr01__AddLC__docsTable_table");
        apz.show("lecr01__AddLC__docsTable");
        apz.initFixedHeaderTables($("#lecr01__AddLC__docsTable_table"), true);
    }
}
apz.lecr01.AddLC.getRoleAccountList = function() {
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "lecr01__AddLC__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "lecr01__AddLC__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.lecr01.AddLC.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.lecr01.AddLC.sCorporateId,
        "roleID": apz.lecr01.AddLC.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.lecr01.AddLC.fnRoleAccountCB = function(params) {
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
    apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountNumber"), lfrmarr);
    if (apz.lecr01.AddLC.selctedAccNo != "") {
        apz.setElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountNumber", apz.lecr01.AddLC.selctedAccNo);
    }
};
apz.lecr01.AddLC.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "lecr01__AddLC__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "lecr01__AddLC__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.lecr01.AddLC.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountNumber")
    };
    apz.launchApp(llaunch);
};
apz.lecr01.AddLC.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("lecr01");
    var CurrAmt = params.data.availableBalance;
    apz.setElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountBalance", CurrAmt);
    apz.formatNumberControl(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountBalance"));
};
apz.lecr01.AddLC.showLC = function() {
    apz.show("lecr01__AddLC__lcDetailsRow");
    apz.hide("lecr01__AddLC__beneficaryDetailsRow");
    apz.hide("lecr01__AddLC__shippmentDetailsRow");
    apz.hide("lecr01__AddLC__docsreqdrow");
    apz.hide("lecr01__AddLC__docsRow");
    apz.hide("lecr01__AddLC__banksRow");
    apz.hide("lecr01__AddLC__instRow");
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:eq(0)").addClass("active");
};
apz.lecr01.AddLC.showBeneficary = function() {
    var isValid = true;
    var totalRec = apz.scrMetaData.containersMap['lecr01__AddLC__tbl_drafts'].totalRecs;
    for (var k = 0; k < totalRec; k++) {
        if ($("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__tenor_" + k).val() == "") {
            $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__tenor_" + k).addClass("err");
            isValid = false;
        }
        if ($("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFrom_" + k).val() == "") {
            $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFrom_" + k).addClass("err");
            isValid = false;
        }
        if ($("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__draftAmount_" + k).val() == "") {
            $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__draftAmount_" + k).addClass("err");
            isValid = false;
        }
        if ($("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__draweeBank_" + k).val() == "") {
            $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__draweeBank_" + k).addClass("err");
            isValid = false;
        }
        if ($("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFrom_" + k).val() == "Others" && $(
            "#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__specifyOthers_" + k).val() == "") {
            $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__specifyOthers_" + k).addClass("err");
            isValid = false;
        }
        if (($("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFrom_" + k).val() == "InvoiceDate" || $(
            "#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFrom_" + k).val() == "B/L Date") && $(
            "#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFromDate_" + k).val() == "") {
            $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFromDate_" + k).addClass("err");
            isValid = false;
        }
    }
    // if (apz.val.validateContainer("lecr01__AddLC__LCDetailsForm") && isValid) {
    apz.hide("lecr01__AddLC__lcDetailsRow");
    apz.show("lecr01__AddLC__beneficaryDetailsRow");
    apz.hide("lecr01__AddLC__shippmentDetailsRow");
    apz.hide("lecr01__AddLC__docsreqdrow");
    apz.hide("lecr01__AddLC__docsRow");
    apz.hide("lecr01__AddLC__banksRow");
    apz.hide("lecr01__AddLC__instRow");
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:eq(1)").addClass("active");
    $("#lecr01__AddLC__beneficaryBrd").attr("onclick", "apz.lecr01.AddLC.showBeneficary();");
    // } 
    // else {
    //     apz.dispMsg({
    //         "message": "Please provide value for mandatory field(s)",
    //         "type": "E"
    //     });
    // }
};
apz.lecr01.AddLC.showBanks = function() {
    apz.hide("lecr01__AddLC__lcDetailsRow");
    apz.hide("lecr01__AddLC__beneficaryDetailsRow");
    apz.show("lecr01__AddLC__banksRow");
    apz.hide("lecr01__AddLC__shippmentDetailsRow");
    apz.hide("lecr01__AddLC__docsreqdrow");
    apz.hide("lecr01__AddLC__docsRow");
    apz.hide("lecr01__AddLC__instRow");
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:eq(2)").addClass("active");
    $("#lecr01__AddLC__bankbrd").attr("onclick", "apz.lecr01.AddLC.showBanks();");
}
apz.lecr01.AddLC.showShipping = function() {
    debugger;
    // if (apz.val.validateContainer("lecr01__AddLC__beneficaryForm")) {
    //var phoneno = new RegExp("^[0-9]{10}$");
    //var phno = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__beneficaryContactNumber");
    // if (phoneno.test(phno)) {
    apz.hide("lecr01__AddLC__lcDetailsRow");
    apz.hide("lecr01__AddLC__beneficaryDetailsRow");
    apz.hide("lecr01__AddLC__banksRow");
    apz.show("lecr01__AddLC__shippmentDetailsRow");
    apz.hide("lecr01__AddLC__docsreqdrow");
    apz.hide("lecr01__AddLC__docsRow");
    apz.hide("lecr01__AddLC__instRow");
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:eq(3)").addClass("active");
    $("#lecr01__AddLC__shippingBrd").attr("onclick", "apz.lecr01.AddLC.showShipping();");
    //} 
    // else {
    //     apz.dispMsg({
    //         "message": "Invalid contact number",
    //         "type": "E"
    //     });
    // }
    //} 
    // else {
    //     apz.dispMsg({
    //         "message": "Please provide value for mandatory field(s)",
    //         "type": "E"
    //     });
    // }
};
apz.lecr01.AddLC.showDocumentsReqd = function() {
    //if (apz.val.validateContainer("lecr01__AddLC__LCshippmentForm")) {
    apz.hide("lecr01__AddLC__lcDetailsRow");
    apz.hide("lecr01__AddLC__beneficaryDetailsRow");
    apz.hide("lecr01__AddLC__banksRow");
    apz.hide("lecr01__AddLC__shippmentDetailsRow");
    apz.show("lecr01__AddLC__docsreqdrow");
    apz.hide("lecr01__AddLC__docsRow");
    apz.hide("lecr01__AddLC__instRow");
    //apz.data.createRow("lecr01__AddLC__docsreqd_tbl");
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:eq(4)").addClass("active");
    $("#lecr01__AddLC__DocsReqdbrd").attr("onclick", "apz.lecr01.AddLC.showDocumentsReqd();");
    // } else {
    //     apz.dispMsg({
    //         "message": "Please provide value for mandatory field(s)",
    //         "type": "E"
    //     });
    // }
}
apz.lecr01.AddLC.showDocuments = function() {
    apz.hide("lecr01__AddLC__lcDetailsRow");
    apz.hide("lecr01__AddLC__beneficaryDetailsRow");
    apz.hide("lecr01__AddLC__banksRow");
    apz.hide("lecr01__AddLC__shippmentDetailsRow");
    apz.hide("lecr01__AddLC__docsreqdrow");
    apz.show("lecr01__AddLC__docsRow");
    apz.hide("lecr01__AddLC__instRow");
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:eq(5)").addClass("active");
    $("#lecr01__AddLC__documentsBrd").attr("onclick", "apz.lecr01.AddLC.showDocuments();");
    debugger;
    var docsArray = [];
    var tRec = apz.scrMetaData.containersMap['lecr01__AddLC__docsreqd_tbl'].totalRecs;
    for (var i = 0; i < tRec; i++) {
        var docObj = {};
        docObj.val = $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__documentName_" + i).val();
        docObj.desc = $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__documentName_" + i).val();
        docsArray.push(docObj);
    }
    apz.populateDropdown(document.getElementById("lecr01__AddLC__documentType"), docsArray);
};
apz.lecr01.AddLC.showInstructions = function() {
    apz.hide("lecr01__AddLC__lcDetailsRow");
    apz.hide("lecr01__AddLC__beneficaryDetailsRow");
    apz.hide("lecr01__AddLC__banksRow");
    apz.hide("lecr01__AddLC__shippmentDetailsRow");
    apz.hide("lecr01__AddLC__docsRow");
    apz.hide("lecr01__AddLC__docsreqdrow");
    apz.show("lecr01__AddLC__instRow");
    $("#lecr01__AddLC__lcBrd li").removeClass("active");
    $("#lecr01__AddLC__lcBrd li:eq(6)").addClass("active");
    $("#lecr01__AddLC__instbrd").attr("onclick", "apz.lecr01.AddLC.showInstructions();");
}
apz.lecr01.AddLC.showVerify = function() {
    debugger;
    var lscreenData = apz.data.buildData("LCDetails", "lecr01");
    lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.status = "Active";
    lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.redClauseLc = $("#lecr01__LCDetails__i__tbDbmiCorpLetterCredit__redClauseLc").prop(
        "checked");
    if (lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDrafts) {
        for (var k = 0; k < lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDrafts.length; k++) {
            lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDrafts[k].referenceNumber = apz.getElmValue(
                "lecr01__LCDetails__i__tbDbmiCorpLetterCredit__referenceNumber");
            lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDrafts[k].corporateId = apz.lecr01.AddLC.sCorporateId;
            lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDrafts[k].userId = apz.lecr01.AddLC.sUserId;
        }
    }
    if (lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocsrequired) {
        for (var n = 0; n < lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocsrequired.length; n++) {
            lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocsrequired[n].referenceNumber = apz.getElmValue(
                "lecr01__LCDetails__i__tbDbmiCorpLetterCredit__referenceNumber");
            lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocsrequired[n].corporateId = apz.lecr01.AddLC.sCorporateId;
            lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocsrequired[n].userId = apz.lecr01.AddLC.sUserId;
        }
    }
    var lUserObj = {};
    
    if (!apz.mockServer) {
    if (!apz.isObjectEmpty(apz.lecr01.AddLC.currentTask)) {
        if (!apz.isNull(apz.lecr01.AddLC.currentTask.instanceId)) {
            apz.lecr01.AddLC.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lUserObj.currentTask = apz.lecr01.AddLC.currentTask;
            lUserObj.currentWfDetails = apz.lecr01.AddLC.currentWfDetails;
            lUserObj.callBack = apz.lecr01.AddLC.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        }
    } else {
        var taskObj = {};
        taskObj.workflowId = "ILOC";
        //taskObj.stageId = "DETAILS";
        taskObj.status = "U";
        //taskObj.userId = apz.Login.sUserId;
        taskObj.taskType = "REQUEST_LETTER_OF_CREDIT";
        taskObj.versionNo = "1";
        //taskObj.appId = "lecr01";
        //taskObj.screenId = "AddLC";
        taskObj.screenData = JSON.stringify(lscreenData);
        //taskObj.stageSeqNo = 1;
        taskObj.action = "";
        //taskObj.createUserId = apz.Login.sUserId;
        taskObj.referenceId = apz.lecr01.AddLC.sCorporateId + "__" + apz.Login.sUserId;
        taskObj.taskDesc = taskObj.referenceId + "'s Letter of Credit details have been submitted";
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.lecr01.AddLC.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
    }
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "lecr01__AddLC__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
    }
    
    else{
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        
         lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "lecr01",
            "scr": "AddLCVerify",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        
            if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
        apz.launchSubScreen(lParams);
    }
    apz.lecr01.AddLC.uploadFiles({
        "destination": "MasterLC",
        "sessionReq": "Y"
    });
    // }
};
apz.lecr01.AddLC.saveasdraft = function() {
    debugger;
    var lUserObj = {};
    var lscreenData = apz.data.buildData("LCDetails", "lecr01");
    lscreenData.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.status = "Draft";
    if (!apz.mockServer) {
        if (!apz.isObjectEmpty(apz.lecr01.AddLC.currentTask)) {
            if (!apz.isNull(apz.lecr01.AddLC.currentTask.instanceId)) {
                apz.lecr01.AddLC.currentWfDetails.screenData = JSON.stringify(lscreenData);
                lUserObj.currentTask = apz.lecr01.AddLC.currentTask;
                lUserObj.currentWfDetails = apz.lecr01.AddLC.currentWfDetails;
                lUserObj.callBack = apz.lecr01.AddLC.workflowMicroServiceCB;
                lUserObj.operation = "SAVETASK";
            }
        } else {
            var taskObj = {};
            taskObj.workflowId = "ILOC";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "IMPORT_LETTER_CREDIT";
            taskObj.versionNo = "1";
            //taskObj.appId = "lecr01";
            //taskObj.screenId = "AddLC";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.lecr01.AddLC.sCorporateId + "__" + apz.Login.sUserId;
            taskObj.taskDesc = taskObj.referenceId + "'s Letter of Credit details have been submitted";
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.lecr01.AddLC.workflowMicroServiceCB;
            lUserObj.operation = "SAVENEWWORKFLOW";
        }
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__AddLC__launchMicroServiceHere",
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
            "scr": "AddLCVerify",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
            if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
        apz.launchSubScreen(lParams);
    }
    apz.lecr01.AddLC.uploadFiles({
        "destination": "Draft",
        "sessionReq": "Y"
    });
};
apz.lecr01.AddLC.workflowMicroServiceCB = function(pNextStageObj) {
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
            apz.lecr01.AddLC.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
            apz.lecr01.AddLC.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        }
    }
};
apz.lecr01.AddLC.showDocumentReqOther = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDocument");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDocumentOther_ul");
    if (lval.indexOf("Others") >= 0) {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDocumentOther_ul");
    }
};
apz.lecr01.AddLC.showCrossDeliveryOptions = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDelivery");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentPort_ul");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncoterm_ul");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsurance_ul");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__portOfLoading_ul");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__portOfDischarge_ul");
    if (lval == "cross") {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentPort_ul");
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncoterm_ul");
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsurance_ul");
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__portOfLoading_ul");
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__portOfDischarge_ul");
    }
};
apz.lecr01.AddLC.showIncotermOther = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncoterm");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncotermOther_ul");
    if (lval == "Others") {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncotermOther_ul");
    }
};
apz.lecr01.AddLC.showApplicantOther = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsurance");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsuranceApplicant_ul");
    if (lval == "Applicant") {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsuranceApplicant_ul");
    }
};
apz.lecr01.AddLC.fnAddDocuments = function() {
    debugger;
    var lFiles = $("#lecr01__AddLC__docsBrowse").prop("files");
    if (lFiles.length > 0 && !apz.isNull(apz.getElmValue("lecr01__AddLC__documentType"))) {
        for (var i = 0; i < lFiles.length; i++) {
            apz.lecr01.AddLC.sDocuments.push(lFiles[i]);
            var lobj = {
                "referenceNumber": apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__referenceNumber"),
                "documentType": $("#lecr01__AddLC__documentType").val(),
                "filename": lFiles[i].name,
                "corporateId": apz.lecr01.AddLC.sCorporateId,
                "userId": apz.lecr01.AddLC.sUserId
            };
            apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments.push(lobj);
        }
        apz.data.getContainerData({
            "containerId": "lecr01__AddLC__docsTable",
            "dataRecNo": "0",
            "action": "C"
        });
        apz.show("lecr01__AddLC__docsTable_table");
        apz.show("lecr01__AddLC__docsTable");
        apz.initFixedHeaderTables($("#lecr01__AddLC__docsTable_table"), true);
    }
};
apz.lecr01.AddLC.fnDeleteDocuments = function(pthis) {
    var lPage = apz.scrMetaData.containersMap['lecr01__AddLC__docsTable'].currPage;
    var lRecord = (lPage - 1) * 10 + parseInt($(pthis).attr('rowno'));
    apz.lecr01.AddLC.sDocuments.splice(lRecord, 1);
    apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments.splice(lRecord, 1);
    apz.data.getContainerData({
        "containerId": "lecr01__AddLC__docsTable",
        "dataRecNo": "0",
        "action": "C"
    });
};
apz.lecr01.AddLC.uploadFiles = function(json) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var params = {};
        params.ifaceName = "appzillonUploadFile";
        params.scrName = apz.currScr;
        params.async = false;
        params.id = "00NEW";
        params.internal = true;
        var header = apz.server.getHeader(params);
        header = JSON.stringify(header);
        var formData = new FormData();
        var filesLength = apz.lecr01.AddLC.sDocuments.length;
        for (var x = 0; x < filesLength; x++) {
            formData.append("uploadfiles[]", apz.lecr01.AddLC.sDocuments[x]);
        }
        formData.append("destination", json.destination);
        formData.append("overWrite", "Y");
        formData.append("appzillonHeader", header);
        $.ajax({
            url: "AppzillonWeb",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: "POST",
            success: function(presp) {
                var responseJson = JSON.parse(presp);
                if (responseJson.result == "success") {
                    var resp = {};
                    resp.successMessage = responseJson.successMessage;
                    apz.lecr01.AddLC.uploadFilesCB(resp);
                } else if (presp.result == "failure") {
                    apz.dispMsg({
                        "code": "APZ-SMS-EX-003"
                    });
                } else {
                    apz.lecr01.AddLC.uploadFilesCB(responseJson);
                }
            },
            error: function(jqXHR, textStatus, errorMessage) {
                apz.lecr01.AddLC.uploadFilesCB(errorMessage);
            },
            async: true
        });
    }
};
apz.lecr01.AddLC.uploadFilesCB = function(pResp) {
    debugger;
};
apz.lecr01.AddLC.checkCollateralType = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__accountType");
    if (lval !== "") {
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountNumber_ext").removeClass("select-disabled");
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountNumber_ext").removeAttr("disabled");
    } else {
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountNumber_ext").addClass("select-disabled");
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCredit__collateralAccountNumber_ext").attr("disabled", true);
    }
};
apz.lecr01.AddLC.shippmentDateChange = function(obj, event) {
    var selectedDate = apz.getObjValue(obj);
    for (var date of apz.scrMetaData.uiInits.date) {
        if (date[0] == "lecr01__LCDetails__i__tbDbmiCorpLetterCredit__expiryDate") {
            var params = {};
            params.id = date[0];
            params.dataType = date[1];
            params.lookAndFeel = date[2];
            params.parentDisplay = date[3];
            params.style = date[4];
            params.parentPreset = date[5];
            params.parentMinDate = selectedDate;
            params.parentMaxDate = date[7];
            params.closeOnSel = date[8];
            params.multiSel = date[9];
            params.parentStartYear = date[10];
            params.parentEndYear = date[11];
            params.parentRangePick = date[12];
            apz.initDates(params);
        }
    }
};
apz.lecr01.AddLC.expiryDateChange = function(obj, event) {
    var selectedDate = apz.getObjValue(obj);
    for (var date of apz.scrMetaData.uiInits.date) {
        if (date[0] == "lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDate") {
            var params = {};
            params.id = date[0];
            params.dataType = date[1];
            params.lookAndFeel = date[2];
            params.parentDisplay = date[3];
            params.style = date[4];
            params.parentPreset = date[5];
            params.parentMinDate = date[6];
            params.parentMaxDate = selectedDate;
            params.closeOnSel = date[8];
            params.multiSel = date[9];
            params.parentStartYear = date[10];
            params.parentEndYear = date[11];
            params.parentRangePick = date[12];
            apz.initDates(params);
        }
    }
};
apz.lecr01.AddLC.fnChangeCreditfrom = function(pObj) {
    debugger;
    var lrowno = $(pObj).attr("rowno");
    var lval = pObj.value;
    //alert(lval);
    $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFromDate_" + lrowno).val("");
    if (lval == "Others") {
        //$("#lecr01__LCDetails__i__tbDbmiCorpLetterCredit__specifyOthers_"+lrowno).attr("disabled", false);
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFromDate_" + lrowno).attr("disabled", true);
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__specifyOthers_" + lrowno).attr("disabled", false);
    } else {
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__specifyOthers_" + lrowno).attr("disabled", true);
        $("#lecr01__LCDetails__i__tbDbmiCorpLetterCreditDrafts__creditDaysFromDate_" + lrowno).attr("disabled", false);
    }
}
apz.lecr01.AddLC.fnCreaterows = function(pObj, event) {
    debugger;
    var lrow = $(pObj).attr("rowno");
    $("#lecr01__AddLC__iconremove_" + lrow).removeClass("sno");
    $("#td_lecr01__AddLC__iconremove_" + lrow).removeClass("sno");
    $("#lecr01__AddLC__iconadd_" + lrow).addClass("sno");
    apz.data.createRow("lecr01__AddLC__docsreqd_tbl");
    //event.stopPropagation();
    var lrow1 = parseInt(lrow) + 1;
    // console.log(lrow1);
    // $("#lecr01__AddLC__iconremove_"+lrow1).addClass("sno");
    //  $("#td_lecr01__AddLC__iconremove_"+lrow1).addClass("sno");
    // $("#lecr01__AddLC__iconadd_"+lrow1).removeClass("sno");
}
apz.lecr01.AddLC.fnDeleterows = function(pObj, event) {
    //apz.data.removeRows("lecr01__AddLC__docsreqd_tbl")
    var lrow = $(pObj).attr("rowno");
    //apz.data.deleteRow("lecr01__AddLC__docsreqd_tbl", lrow);
    apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocsrequired.splice(lrow, 1);
    apz.data.getContainerData({
        "containerId": "lecr01__AddLC__docsreqd_tbl",
        "dataRecNo": "0",
        "action": "C"
    });
}
apz.lecr01.AddLC.fnSelectdoc = function(pObj) {
    debugger;
    var lrowno = $(pObj).attr("rowno");
    var lval = pObj.value;
    if (lval == "Signed Commercial Invoice") {
        apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno), invoiceClause);
    }
    if (lval == "Marine bill of lading") {
        apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno),
            marinebillClause);
    }
    if (lval == "Carrying vessel") {
        apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno), vesselClause);
    }
    if (lval == "Main airway bill") {
        apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno),
            airwaybillClause);
    }
    if (lval == "C.M.R") {
        apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno), CMRClause);
    }
    if (lval == "Insurance") {
        apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno),
            insuranceClause);
    }
    if (lval == "Certificate of origin") {
        apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno),
            certificateClause);
    }
    if (lval == "Packing List") {
        // apz.populateDropdown(document.getElementById("lecr01__LCDetails__i__tbDbmiCorpLetterCreditDocsrequired__clauseName_" + lrowno),
        //   certificateClause);
    }
}
apz.lecr01.AddLC.UploadAttachment = function() {
    $('#lecr01__AddLC__docsBrowse').click();
}
