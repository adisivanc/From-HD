apz.bulktr.WithinBank = {};
apz.bulktr.WithinBank.getFromAccId = "";
apz.bulktr.WithinBank.getBenAccId = "";
apz.bulktr.WithinBank.getWBBenDetails = {};
apz.bulktr.WithinBank.getOBBenDetails = {};
apz.bulktr.WithinBank.sCache = {};
var gupload_docs = [];
var gAllowedFileTypes = ["xls", "xlt", "xlm","xlsx"];
apz.app.onLoad_WithinBank = function(params) {
    debugger;
    apz.data.scrdata.bulktr__WithinBankDetails_Req = {};
    apz.hide("bulktr__BulkTransfers__mainheader");
   // apz.hide("bulktr_WithinBank__docs_uploadRow"); // Written by priyanka
     $("#bulktr__WithinBank__docs_uploadRow").addClass("sno");
    apz.bulktr.WithinBank.sCache = params;
    apz.bulktr.WithinBank.sCorporateId = apz.Login.sCorporateId;
    apz.bulktr.WithinBank.sRoleId = apz.Login.sRoleId;
    try{
    apz.bulktr.WithinBank.fetchDetails();
    apz.bulktr.WithinBank.fetchWBDetails();
    apz.bulktr.WithinBank.fetchOBDetails();
    }catch(e){
        
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
        var lfrmacc = {
            "val": params.data[i].accountNo,
            "desc": params.data[i].accountNo
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
        "beneficaryType": "Same",
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
            "desc": params.data[i].beneficaryName + "-" + params.data[i].accountNumber
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
            "desc": params.data[i].beneficaryName + "-" + params.data[i].accountNumber
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
        apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__toAccount_" + getId), apz.bulktr.WithinBank.getWBBenDetails
            .toAccount);
        apz.populateDropdown(document.getElementById("bulktr__WithinBankDetails__i__Details__benificiaryName_" + getId), apz.bulktr.WithinBank.getWBBenDetails
            .toBenName);
    }
    if (type == "Domestic") {
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
    var totalRec = apz.scrMetaData.containersMap['bulktr__WithinBank__tbwithinbank'].totalRecs;
    if (apz.val.validateContainer("bulktr__WithinBank__tbwithinbank")) {
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
    } else if (!apz.val.validateContainer("bulktr__WithinBank__tbwithinbank")) {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
};
apz.bulktr.WithinBank.workflowMicroServiceCB = function(pNextStageObj) {
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
    apz.launchApp(lparams);
};

//upload, drag and drop functionality

apz.bulktr.WithinBank.fnDocToggle = function() {
    //$("#bulktr_WithinBank__docs_uploadRow").removeClass("sno");
    $("#bulktr__WithinBank__docs_uploadRow").removeClass("sno")
    apz.bulktr.WithinBank.InitFileDragAndDrop("bulktr__WithinBank__docs_uploadCol", "");
    apz.bulktr.WithinBank.InitFileBrowser("bulktr__WithinBank__docBrowse", "");
};

apz.bulktr.WithinBank.InitFileDragAndDrop = function(lhtmlId, ltype) {
    debugger;
    var obj = $("#" + lhtmlId);
    obj.on('dragenter', function(e) {
        apz.bulktr.WithinBank.RemoveDragBorders();
        $(this).addClass('dragenter');
         $(this).addClass('draghighlight');
        e.stopPropagation();
        e.preventDefault();
    });
    obj.on('dragover', function(e) {
        //$(this).addClass('draghighlight');
        e.stopPropagation();
        e.preventDefault();
    });
    obj.on('drop', function(e) {
        debugger;
        apz.bulktr.WithinBank.RemoveDragBorders();
        $(this).addClass('dragenter');
         $(this).removeClass('draghighlight');
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files;
        //We need to send dropped files to Server
        apz.bulktr.WithinBank.handleFileUpload(files, obj, ltype);
    });
    $(document).on('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });
    $(document).on('dragover', function(e) {
        apz.bulktr.WithinBank.RemoveDragBorders();
        $(this).addClass('dragenter');
        e.stopPropagation();
        e.preventDefault();
    });
    $(document).on('drop', function(e) {
          $(this).removeClass('draghighlight');
        e.stopPropagation();
        e.preventDefault();
    });
};

apz.bulktr.WithinBank.RemoveDragBorders = function() {
    $('.drop').removeClass('drop');
    $('.dragover').removeClass('dragover');
    $('.dragenter').removeClass('dragenter');
     $("#draghighlight").removeClass('draghighlight');
};

apz.bulktr.WithinBank.handleFileUpload = function(files, obj, ltype) {
    for (var i = 0; i < files.length; i++) {
        apz.bulktr.WithinBank.GetBase64(files[i], ltype);
    }
};

apz.bulktr.WithinBank.GetBase64 = function(lfile, ltype) {
    debugger;
    var lflext = lfile.name.split('.')[1].trim();
    if (gAllowedFileTypes.indexOf(lflext) !== -1) {
        var lfr = new FileReader();
        lfr.onload = function(e) {
            var ldata = {};
            ldata.fileName = lfile.name;
            ldata.documentType = ltype;
            ldata.document = "";
            //upload
            /*var isMobile = /iPhone|iPad|iPod|Android|Mozilla|Chrome|Safari/i.test(navigator.userAgent);
            if (apz.isMobile) {
                apz.bulktr.WithinBank.DocsDataHandlerTablet(ldata, e.target.result);
            } else {
                apz.bulktr.WithinBank.DocsDataHandler(ldata, e.target.result);
            }*/
             apz.bulktr.WithinBank.DocsDataHandler(ldata, e.target.result);
        };
       
        lfr.readAsDataURL(lfile);
    } else {
        alert("Selected document type is not supported.");
    }
};

apz.bulktr.WithinBank.DocsDataHandler = function(lobj, ldata) {
    debugger;
    var lht1 = '<div id="';
    var lht2 = '';
    var lht3 = '_ctrl_grp_div" class="eobox tostyle docs-row"><ul class="srow"><li class="w100"><div class="ebox"><svg class="boxclose px24" id="';
    lht2 = '';
    var lht4 = '_btn" onclick = "apz.bulktr.WithinBank.RemoveDoc(';
    var lht5 = '';
    var lht6 = ');"><use xlink:href="#icon-close"/></svg> <img title="" style=" " class="ett-imge" src="apps/styles/themes/' + apz.theme +
        '/img/pdf.png" id="';
    lht2 = '';
    var lht7 = '" alt=""  scrolling="no" src="' + ldata + '" class=" upload-doc" style=" " apzcontrolid=""> </br >' + lobj.fileName +
        '</div></li></ul></div>';
    var ind1 = ldata.indexOf(':');
    var ind2 = ldata.indexOf('/');
    var ind3 = ldata.indexOf(';');
    var lextn = ldata.substr(ind2 + 1, ind3 - ind2 - 1);
    var lmimeType = ldata.substr(ind1 + 1, ind2 - ind1 - 1);
    lobj.extension = lextn;
    lobj.mimeType = lmimeType;
    var lbase64 = ldata.substr(ldata.indexOf(',') + 1, ldata.length);
    lobj.document = lbase64;
    gupload_docs.push(lobj);
    var llen = $('#bulktr__WithinBank__docs_uploadCol .docs-row iframe').length;
    lht2 = 'upload_doc_' + llen;
    lht5 = '1,' + llen;
    $(lht1 + lht2 + lht3 + lht2 + lht4 + lht5 + lht6 + lht2 + lht7).appendTo('#bulktr__WithinBank__docs_uploadCol');
    $('#bulktr__WithinBank__docs_uploadCol').removeClass('sno');
   // $('#' + lht2).after('<a class="boxclose1" id="" onclick="apz.RCorp.documents.PreviewDoc(' + lht5 + ');" disabled="disabled"></a>');
};

apz.bulktr.WithinBank.RemoveDoc = function(ltype, lId) {
    gupload_docs.splice(lId, 1);
    $('#upload_doc_' + lId + '_ctrl_grp_div').remove();
};

apz.bulktr.WithinBank.InitFileBrowser = function(lhtmlId, ltype) {
    debugger;
    $("#" + lhtmlId).change(function(e) {
        for (var i = 0; i < document.getElementById(lhtmlId).files.length; i++) {
            apz.bulktr.WithinBank.GetBase64(document.getElementById(lhtmlId).files[i], ltype);
        }
    });
};


apz.bulktr.WithinBank.fnBrowseClick = function() {
    var isMobile = /iPhone|iPad|iPod|Android|Mozilla|Chrome|Safari/i.test(navigator.userAgent);
    if (apz.isMobile) {
        apz.bulktr.WithinBank.OpenFile();
    } else {
        $('#bulktr__WithinBank__docBrowse').click();
    }
}

apz.bulktr.WithinBank.OpenFile = function() {
    var json = {
        "filter": "",
        "fileCategory": "DEFAULT",
        "location": "",
        "openFile": "N"
    };
    json.id = "bulktr__WithinBank__docBrowse_ul";
    json.callBack = apz.bulktr.WithinBank.fileBrowserCallback;
    apz.ns.filebrowser(json);
};

apz.bulktr.WithinBank.fileBrowserCallback = function(params) {
    var lfilePath = ljson.filePath;
    var lfileName = lfilePath.substr(lfilePath.lastIndexOf('/') + 1);
    var lfileType = lfileName.substr(lfileName.lastIndexOf('.') + 1);
    var ldata = {};
    ldata.fileName = lfileName;
    ldata.extension = lfileType;
    gUploadedFile.mimeType = "application";
    apz.bulktr.WithinBank.FileToBase64(lfilePath);
    $('#bulktr__WithinBank__docBrowse').removeClass("sno");
};

apz.bulktr.WithinBank.fnUploadExcelDoc = function() {
   var lmsg={};
    lmsg.code="SUCCESS_UPLOAD";
    apz.dispMsg(lmsg);
};
