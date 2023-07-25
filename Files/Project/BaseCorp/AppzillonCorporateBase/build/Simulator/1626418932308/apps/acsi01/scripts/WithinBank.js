apz.acsi01.withinBank = {};
apz.acsi01.withinBank.sCurrentWfDetails = {};
apz.acsi01.withinBank.sData = {};
apz.acsi01.withinBank.sCurrencyVal = {};
apz.app.onLoad_WithinBank = function(lParams) {
    debugger;
    apz.hide("acsi01__NewSI__SIRowSub");
    apz.acsi01.withinBank.sCorporateId = apz.Login.sCorporateId;
    apz.acsi01.withinBank.sRoleId = apz.Login.sRoleId;
    apz.acsi01.withinBank.fetchDetails();
    apz.setElmValue("acsi01__WithinBankDetails__i__Details__startDate", new Date().format('d/m/Y'));
    if (!apz.isNull(lParams.Details)) {
        apz.data.scrdata.acsi01__WithinBankDetails_Req = lParams;
        apz.data.loadData("WithinBankDetails", "acsi01");
    }
};
apz.acsi01.withinBank.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "acsi01__WithinBank__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acsi01__WithinBank__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acsi01.withinBank.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.acsi01.withinBank.sCorporateId,
        "roleID": apz.acsi01.withinBank.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.acsi01.withinBank.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acsi01");
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
    // for (var i = 0; i < larrLength; i++) {
    //     var lfrmacc = {
    //         "val": params.data[i].accountNo,
    //         "desc": params.data[i].accountNo
    //     };
    //     lfrmarr.push(lfrmacc);
    // }
    apz.populateDropdown(document.getElementById("acsi01__WithinBankDetails__i__Details__fromAccount"), lfrmarr);
    apz.acsi01.withinBank.fetchbeneficiaryDetails();
};
apz.acsi01.withinBank.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "acsi01__WithinBank__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acsi01__WithinBank__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acsi01.withinBank.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.acsi01.withinBank.sCorporateId,
        "beneficaryType": "Same",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.acsi01.withinBank.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("acsi01");
    apz.acsi01.withinBank.sData = params.data;
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
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
    apz.populateDropdown(document.getElementById("acsi01__WithinBankDetails__i__Details__toAccount"), lfrmarr);
};
apz.acsi01.withinBank.changeNickname = function(pThis) {
    debugger;
    var lData = apz.acsi01.withinBank.sData;
    var lCurrVal = apz.acsi01.withinBank.sCurrencyVal;
    apz.setElmValue("acsi01__WithinBankDetails__i__Details__currency", lCurrVal);
    var larrLength = lData.length;
    var lAccNum = apz.getElmValue("acsi01__WithinBankDetails__i__Details__toAccount");
    for (var i = 0; i < larrLength; i++) {
        if (lAccNum == lData[i].accountNumber) {
            var lAccBrnch = lData[i].branchName;
            var lBenName = lData[i].beneficaryName;
            apz.setElmValue("acsi01__WithinBankDetails__i__Details__accountBranch", lAccBrnch);
            apz.setElmValue("acsi01__WithinBankDetails__i__Details__beneficiaryName", lBenName);
        }
    }
    $("#acsi01__WithinBank__sc_row_45").removeClass("sno");
};
apz.acsi01.withinBank.continuetoVerify = function() {
    debugger;
    if (apz.scrMetaData.nodesMap['acsi01__WithinBankDetails__i__Details'].currRec == -1) {
        apz.scrMetaData.nodesMap['acsi01__WithinBankDetails__i__Details'].currRec = 0;
        apz.scrMetaData.nodesMap['acsi01__WithinBankDetails__i__Beneficiary'].currRec = 0;
    }
    if (apz.val.validateContainer('acsi01__WithinBank__WithinBankDetails') == false) {
        var msg = {
            "code": 'APZ_acsi01_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("WithinBankDetails", "acsi01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "SIWB";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "WITHINBANK_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "acsi01";
            //taskObj.screenId = "WithinBank";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.acsi01.withinBank.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s SI details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acsi01.withinBank.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "acsi01__WithinBank__launchMicroServiceHere",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        }
        
        else{
            var lReqObj = {};
            lReqObj.currentWfDetails = {};
                //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.currentTask = "";
                lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
                var lParams = {
                    "appId": "acsi01",
                    "scr": "WithinBankVerify",
                    "userObj": lReqObj,
                    "div": "acsi01__StandingInstructions__launchScreen",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
        }
    }
};
apz.acsi01.withinBank.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acsi01";
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
                    "div": "acsi01__StandingInstructions__launchScreen",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acsi01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};
apz.acsi01.withinBank.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "acsi01__WithinBank__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acsi01__WithinBank__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acsi01.withinBank.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("acsi01__WithinBankDetails__i__Details__fromAccount")
    };
    apz.launchApp(llaunch);
};
apz.acsi01.withinBank.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acsi01");
    apz.acsi01.withinBank.sCurrencyVal = params.data.accountCurrency;
    // var Currency = params.data.accountCurrency;
    var CurrAmt = params.data.accountCurrency + " " + params.data.availableBalance;
    apz.setElmValue("acsi01__WithinBank__amountVal", CurrAmt);
    //apz.setElmValue("acsi01__WithinBankDetails__i__Details__currency", Currency);
    $("#acsi01__WithinBank__sc_row_44").removeClass("sno");
    
};
apz.acsi01.withinBank.amount = function() {
    debugger;
    var lAmount = parseFloat((apz.getElmValue("acsi01__WithinBankDetails__i__Details__amount")).trim());
    var lAvailableBal = parseFloat((apz.getElmValue("acsi01__WithinBank__amountVal").split(' ')[1]).trim());
    if (lAmount > lAvailableBal) {
        var msg = {
            "code": 'ACFT_AMOUNT',
            "callBack": apz.acsi01.withinBank.amountCB
        };
        apz.dispMsg(msg);
    }
};
apz.acsi01.withinBank.amountCB = function() {
    apz.setElmValue("acsi01__WithinBankDetails__i__Details__amount", "");
};
apz.acsi01.withinBank.calculateTimes = function() {
    var lTimes = 120;
    var lFrequency = apz.getElmValue("acsi01__WithinBankDetails__i__Details__frequency");
    var lNum = lTimes / lFrequency;
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    for (var i = 1; i <= lNum; i++) {
        var lfrmacc = {
            "val": i,
            "desc": i
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("acsi01__WithinBankDetails__i__Details__noOfTimes"), lfrmarr);
};
apz.acsi01.withinBank.calculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("acsi01__WithinBankDetails__i__Details__startDate");
    
     var initial = apz.formatDate({
            "val": lStartDate,
            "fromFormat": "dd/MM/yyyy",
            "toFormat": "yyyy/MM/dd"
        });
    var lFrequency = apz.getElmValue("acsi01__WithinBankDetails__i__Details__frequency");
    var lTimes = apz.getElmValue("acsi01__WithinBankDetails__i__Details__noOfTimes");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lTimes)) {
        // var date = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        // var lNum = lFrequency * (lTimes - 1);
        // var lMon = date.getMonth() + lNum;
        // var lEnddate = date.setMonth(lMon);
        // apz.setElmValue("acsi01__WithinBankDetails__i__Details__endDate", date.toString("dd-MMM-yyyy"));
        // var nxtdate = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        // nxtdate.setMonth(lFrequency);
        // apz.setElmValue("acsi01__WithinBankDetails__i__Details__nextExecutionDate", nxtdate.toString("dd-MMM-yyyy"));
        
         var date = new Date(initial);
        var lNum = lFrequency * (lTimes);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("acsi01__WithinBankDetails__i__Details__endDate", new Date(lEnddate).toString("dd/MM/yyyy"));
        var nxtdate = new Date(initial);
        nxtdate.setMonth(lFrequency);
         apz.setElmValue("acsi01__WithinBankDetails__i__Details__nextExecutionDate", new Date(nxtdate).toString("dd/MM/yyyy"));
    }
};
apz.acsi01.withinBank.cancel = function() {
    debugger;
    $("#acsi01__NewSI__MainRow").removeClass('sno');
    $("#acsi01__NewSI__launchPad").addClass('sno');
    apz.show("acsi01__NewSI__SIRowSub");
};
