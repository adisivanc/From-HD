apz.acsi01.ownAccount = {};
apz.acsi01.ownAccount.sCurrentWfDetails = {};
apz.app.onLoad_OwnAccount = function(lParams) {
    debugger;
    apz.hide("acsi01__NewSI__SIRowSub");
    apz.acsi01.ownAccount.sCorporateId = apz.Login.sCorporateId;
    apz.acsi01.ownAccount.sRoleId = apz.Login.sRoleId;
    apz.acsi01.ownAccount.sDiv = lParams.div;
    apz.acsi01.ownAccount.fetchDetails();
    apz.setElmValue("acsi01__OwnAccount__i__Details__startDate", new Date().format('d/m/Y'));
    if (!apz.isNull(lParams.Verify)) {
        apz.data.scrdata.acsi01__OwnAccount_Req.Details = lParams.Verify;
    }
    
    if (lParams.currentTask) {
      
        var lScreenData = JSON.parse(lParams.currentWfDetails.screenData).acsi01__OwnAccount_Req;
        apz.data.scrdata.acsi01__OwnAccount_Req = {};
        apz.data.scrdata.acsi01__OwnAccount_Req.Details = lScreenData.Details;
        apz.data.loadData("OwnAccount", "acsi01");
    } 
};
apz.acsi01.ownAccount.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "acsi01__OwnAccount__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acsi01__OwnAccount__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acsi01.ownAccount.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.acsi01.ownAccount.sCorporateId,
        "roleID": apz.acsi01.ownAccount.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.acsi01.ownAccount.fnRoleAccountCB = function(params) {
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
    
    apz.populateDropdown(document.getElementById("acsi01__OwnAccount__i__Details__fromaccount"), lfrmarr);
    apz.acsi01.ownAccount.fnGetLoanAccounts(lfrmarr);
    //apz.populateDropdown(document.getElementById("acsi01__OwnAccount__i__Details__toaccount"), lfrmarr);
};

apz.acsi01.ownAccount.fnGetLoanAccounts = function(lroleaccounts){
    debugger;
    var req = {};
    req.tbDbmiCorpLoanMaster = {
        "corporateId": apz.acsi01.ownAccount.sCorporateId
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_loan_master";
    var lReq = {
        "ifaceName": "LoanSummary",
        "paintResp": "N",
        "buildReq": "N",
        "req": req,
        "appId": "acsi01",
        "async": false,
        "callBack": apz.acsi01.ownAccount.fnGetLoanAccountsCB,
        "callBackObj": lroleaccounts
    };
    apz.server.callServer(lReq);
}

apz.acsi01.ownAccount.fnGetLoanAccountsCB = function(params){
    debugger;
    var laccounts = params.callBackObj;
    var loanAccounts = params.res.acsi01__LoanSummary_Res.tbDbmiCorpLoanMaster;
    apz.acsi01.ownAccount.loanAccounts = params.res.acsi01__LoanSummary_Res.tbDbmiCorpLoanMaster;
    for(var i=0;i<loanAccounts.length;i++){
         var lfrmacc = {
            "val": loanAccounts[i].accountNo,
            "desc": loanAccounts[i].accountNo
        };
        laccounts.push(lfrmacc);
    }
    
    var larrLength = laccounts.length;
    for (var i = 0; i < larrLength; i++) {
        var strlen = laccounts[i].desc;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = laccounts[i].desc;
        var result = apz.getMaskedValue(strlen, laccNo);
        laccounts[i].desc = result;
    }
    
    apz.populateDropdown(document.getElementById("acsi01__OwnAccount__i__Details__toaccount"), laccounts);
    
}
apz.acsi01.ownAccount.fetchDetailsQueryCB = function(params) {
    debugger;
    var ltoarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    ltoarr.push(lObj);
    var larrLength = params.res.acsi01__OwnAccount_Res.Details.length;
    for (var i = 0; i < larrLength; i++) {
        var ltoacc = {
            "val": params.res.acsi01__OwnAccount_Res.Details[i].toaccount,
            "desc": params.res.acsi01__OwnAccount_Res.Details[i].toaccount
        };
        ltoarr.push(ltoacc);
    }
    apz.populateDropdown(document.getElementById("acsi01__OwnAccount__i__Details__toaccount"), ltoarr);
};
apz.acsi01.ownAccount.continuetoVerify = function() {
    debugger;
    if (apz.scrMetaData.nodesMap['acsi01__OwnAccount__i__Details'].currRec == -1) {
        apz.scrMetaData.nodesMap['acsi01__OwnAccount__i__Details'].currRec = 0;
    }
    if (apz.val.validateContainer('acsi01__OwnAccount__OwnAccDetails') == false) {
        var msg = {
            "code": 'APZ_acsi01_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        debugger;
        var lscreenData = apz.data.buildData("OwnAccount", "acsi01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "SIOA";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "OWNACCOUNT_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "acsi01";
            //taskObj.screenId = "OwnAccount";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.acsi01.ownAccount.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s SI details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acsi01.ownAccount.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "acsi01__OwnAccount__launchMicroServiceHere",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        } else {
            var lReqObj = {};
            lReqObj.currentWfDetails = {};
            //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
            //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
            //acsi01__StandingInstructions__launchScreen
            lReqObj.currentTask = "";
            lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lReqObj.div = apz.acsi01.ownAccount.sDiv;
            var lParams = {
                "appId": "acsi01",
                "scr": "OwnAccountVerify",
                "userObj": lReqObj,
                "div": apz.acsi01.ownAccount.sDiv,
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.acsi01.ownAccount.workflowMicroServiceCB = function(pNextStageObj) {
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
apz.acsi01.ownAccount.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "acsi01__OwnAccount__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acsi01__OwnAccount__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acsi01.ownAccount.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("acsi01__OwnAccount__i__Details__fromaccount")
    };
    apz.launchApp(llaunch);
};
apz.acsi01.ownAccount.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acsi01");
    
    var param = {
            "decimalSep": ".",
            "value":  params.data.availableBalance,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    
    var Currency = params.data.accountCurrency;
    //var CurrAmt = params.data.accountCurrency + " " + apz.formatNumber(param);
    var CurrAmt = params.data.accountCurrency + " " + params.data.availableBalance;
    apz.setElmValue("acsi01__OwnAccount__amountVal", CurrAmt);
    apz.setElmValue("acsi01__OwnAccount__i__Details__currency", Currency);
    $("#acsi01__OwnAccount__sc_row_35").removeClass("sno");
};
apz.acsi01.ownAccount.getConversionAmt = function() {
    debugger;
    apz.resetCurrAppId("acsi01");
    var lServerParams = {
        "ifaceName": "CurrencyConversion_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acsi01.ownAccount.getCurrencyCB,
        "callBackObj": "",
    };
    var req = {};
    var lFromCurrency = apz.getElmValue("acsi01__OwnAccount__i__Details__currency");
    var lToCurrency = apz.getElmValue("acsi01__OwnAccount__i__Details__toAccCurrency");
    req.tbDbmiCurrencyConversion = {};
    req.tbDbmiCurrencyConversion.fromCurrency = lFromCurrency;
    req.tbDbmiCurrencyConversion.toCurrency = lToCurrency;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acsi01.ownAccount.getCurrencyCB = function(pResp) {
    var lValue = pResp.res.acsi01__CurrencyConversion_Res.tbDbmiCurrencyConversion.value;
    var lAmt = apz.getElmValue("acsi01__OwnAccount__i__Details__amount");
    var lGetValue = lAmt * lValue;
    apz.setElmValue("acsi01__OwnAccount__i__Details__conversionAmt", lGetValue);
    apz.acsi01.ownAccount.amount();
};
apz.acsi01.ownAccount.amount = function() {
    debugger;
    var lAmount = parseInt(apz.getElmValue("acsi01__OwnAccount__i__Details__amount").replace(/[^0-9\.-]+/g, ""))
    // var lAvailableBal = parseFloat((apz.getElmValue("acsi01__OwnAccount__amountVal").split(' ')[1]).trim());
    var lAvailableBal = parseFloat((apz.getElmValue("acsi01__OwnAccount__amountVal").split(' ')[1]).trim());
    if (lAmount > lAvailableBal) {
        var msg = {
            "code": 'ACFT_AMOUNT',
            "callBack": apz.acsi01.ownAccount.amountCB
        };
        apz.dispMsg(msg);
    }
};
apz.acsi01.ownAccount.amountCB = function() {
    apz.setElmValue("acsi01__OwnAccount__i__Details__amount", "");
};
apz.acsi01.ownAccount.calculateTimes = function() {
    var lTimes = 120;
    var lFrequency = apz.getElmValue("acsi01__OwnAccount__i__Details__frequency");
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
    apz.populateDropdown(document.getElementById("acsi01__OwnAccount__i__Details__noOfTimes"), lfrmarr);
};
apz.acsi01.ownAccount.calculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("acsi01__OwnAccount__i__Details__startDate");
    
    var initial = apz.formatDate({
            "val": lStartDate,
            "fromFormat": "dd/MM/yyyy",
            "toFormat": "yyyy/MM/dd"
        });
    var lFrequency = apz.getElmValue("acsi01__OwnAccount__i__Details__frequency");
    var lTimes = apz.getElmValue("acsi01__OwnAccount__i__Details__noOfTimes");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lTimes)) {
        // var date = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        // var lNum = lFrequency * (lTimes - 1);
        // var lMon = date.getMonth() + lNum;
        // var lEnddate = date.setMonth(lMon);
        // apz.setElmValue("acsi01__OwnAccount__i__Details__endDate", date.toString("dd-MMM-yyyy"));
        // var nxtdate = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        // nxtdate.setMonth(lFrequency);
        // apz.setElmValue("acsi01__OwnAccount__i__Details__nextExecutionDate", nxtdate.toString("dd-MMM-yyyy"));
        
        var date = new Date(initial);
        var lNum = lFrequency * (lTimes);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("acsi01__OwnAccount__i__Details__endDate", new Date(lEnddate).toString("dd/MM/yyyy"));
        var nxtdate = new Date(initial);
        nxtdate.setMonth(lFrequency);
         apz.setElmValue("acsi01__OwnAccount__i__Details__nextExecutionDate", new Date(nxtdate).toString("dd/MM/yyyy"));
        
    }
};
apz.acsi01.ownAccount.cancel = function() {
    debugger;
    $("#acsi01__NewSI__MainRow").removeClass('sno');
    $("#acsi01__NewSI__launchPad").addClass('sno');
    apz.show("acsi01__NewSI__SIRowSub");
};
apz.acsi01.ownAccount.getToAccCurrency = function() {
    debugger;
    var accountType = "RoleAcount";
    var laccounts = apz.acsi01.ownAccount.loanAccounts;
    var accountNo = apz.getElmValue("acsi01__OwnAccount__i__Details__toaccount");
    for (var i = 0; i < laccounts.length; i++) {
        if (laccounts[i].accountNo == accountNo) {
            accountType = "LoanAccount";
            apz.setElmValue("acsi01__OwnAccount__i__Details__toAccCurrency", laccounts[i].currency);
            apz.setElmValue("acsi01__OwnAccount__i__Details__accountName", laccounts[i].accountName);
            break;
        }
    }
    $("#acsi01__OwnAccount__sc_row_29").removeClass("sno");
    if (accountType == "RoleAcount") {
        var llaunch = {};
        llaunch.appId = "acclt";
        llaunch.scr = "AccountDetails";
        llaunch.div = "acsi01__OwnAccount__launchMicroServiceHere";
        llaunch.layout = "All";
        llaunch.userObj = {};
        llaunch.userObj.action = "";
        llaunch.userObj.control = {};
        llaunch.userObj.control.destroyDiv = "acsi01__OwnAccount__launchMicroServiceHere";
        llaunch.userObj.control.callBack = apz.acsi01.ownAccount.getToAccCurrencyCB;
        llaunch.userObj.data = {
            "accountNo": apz.getElmValue("acsi01__OwnAccount__i__Details__toaccount")
        };
        apz.launchApp(llaunch);
    }
};
apz.acsi01.ownAccount.getToAccCurrencyCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    var Currency = params.data.accountCurrency;
    var lAccName = params.data.accountName;
    apz.setElmValue("acsi01__OwnAccount__i__Details__toAccCurrency", Currency);
    apz.setElmValue("acsi01__OwnAccount__i__Details__accountName", lAccName);
};
