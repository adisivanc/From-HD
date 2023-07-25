apz.intb01.otherBankINT = {};
apz.intb01.otherBankINT.sCurrentWfDetails = {};
apz.intb01.otherBankINT.sData = {};
apz.intb01.otherBankINT.accountCurrency = '';
apz.app.onLoad_OtherBankINT = function(lParams) {
    debugger;
    apz.hide("acft01__Transfers__MainHead");
     $(".filebox").next().addClass("sno");
    apz.intb01.otherBankINT.sCorporateId = apz.Login.sCorporateId;
    apz.intb01.otherBankINT.sRoleId = apz.Login.sRoleId;
    apz.intb01.otherBankINT.sDiv = lParams.div;
    apz.intb01.otherBankINT.sFrom = lParams.from;
    apz.intb01.otherBankINT.fetchDetails();
    apz.setElmValue("intb01__OtherBankInt__i__International__transactionDate", new Date().format('d-M-Y'));
    if (!apz.isNull(lParams.International)) {
        apz.data.scrdata.intb01__OtherBankInt_Req = lParams;
        apz.data.loadData("OtherBankInt", "intb01");
    }
    if (lParams.currentTask) {
        apz.intb01.otherBankINT.sCurrentTask = lParams.currentTask;
        var lscrData = JSON.parse(lParams.currentWfDetails.screenData).intb01__OtherBankInt_Req;
        apz.data.scrdata.intb01__OtherBankInt_Req = {};
        apz.data.scrdata.intb01__OtherBankInt_Req.International = lscrData.International;
        apz.data.loadData("OtherBankInt", "intb01");
    }
};
apz.intb01.otherBankINT.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "intb01__OtherBankINT__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "intb01__OtherBankINT__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.intb01.otherBankINT.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.intb01.otherBankINT.sCorporateId,
        "roleID": apz.intb01.otherBankINT.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.intb01.otherBankINT.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("intb01");
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
    apz.populateDropdown(document.getElementById("intb01__OtherBankInt__i__International__fromAccount"), lfrmarr);
    
        if (apz.intb01.otherBankINT.sCurrentTask) {
        apz.setElmValue("intb01__OtherBankInt__i__International__fromAccount", apz.data.scrdata.intb01__OtherBankInt_Req.International.fromAccount);
    }
    
    apz.intb01.otherBankINT.fetchbeneficiaryDetails();
};
apz.intb01.otherBankINT.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "intb01__OtherBankINT__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "intb01__OtherBankINT__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.intb01.otherBankINT.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.intb01.otherBankINT.sCorporateId,
        "beneficaryType": "International",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.intb01.otherBankINT.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("intb01");
    apz.intb01.otherBankINT.sData = params.data;
    var ldatalength = apz.intb01.otherBankINT.sData.length;
    // for (var j = 0; j < ldatalength; j = j + 3) {
    //         apz.intb01.otherBankINT.sData[j].currency = "USD";
    //     }
    //     for (var m = 1; m < ldatalength; m = m + 3) {
    //         apz.intb01.otherBankINT.sData[m].currency = "EUR";
    //     }
    //     for (var n = 2; n < ldatalength; n = n + 3) {
    //         apz.intb01.otherBankINT.sData[n].currency = "INR";
    //     }
    
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
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
    apz.populateDropdown(document.getElementById("intb01__OtherBankInt__i__International__toAccount"), lfrmarr);
    
        if (apz.intb01.otherBankINT.sCurrentTask) {
        apz.setElmValue("intb01__OtherBankInt__i__International__toAccount", apz.data.scrdata.intb01__OtherBankInt_Req.International.toAccount);
    }
};
apz.intb01.otherBankINT.changeNickname = function(pThis) {
    debugger;
    var lData = apz.intb01.otherBankINT.sData;
    var larrLength = lData.length;
    var lAccNum = apz.getElmValue("intb01__OtherBankInt__i__International__toAccount");
    for (var i = 0; i < larrLength; i++) {
        if (lAccNum == lData[i].accountNumber) {
            var lBenName = lData[i].beneficaryName;
            var lBenAddress = lData[i].benAddress;
            var lBenCountry = lData[i].benCountry;
            var lLswiftCode = lData[i].swiftCode;
            var lLBankName = lData[i].bankName;
            var lInterSwiftCode = lData[i].interSwiftCode;
            var lInterBankName = lData[i].interBankName;
            //var currency= lData[i].currency;
            apz.setElmValue("intb01__OtherBankInt__i__International__beneficaryName", lBenName);
            apz.setElmValue("intb01__OtherBankInt__i__International__benAddress", lBenAddress);
            apz.setElmValue("intb01__OtherBankInt__i__International__benCountry", lBenCountry);
            apz.setElmValue("intb01__OtherBankInt__i__International__swiftCode", lLswiftCode);
            apz.setElmValue("intb01__OtherBankInt__i__International__bankName", lLBankName);
            apz.setElmValue("intb01__OtherBankInt__i__International__interSwiftCode", lInterSwiftCode);
            apz.setElmValue("intb01__OtherBankInt__i__International__interBankName", lInterBankName);
            //apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", currency);
            if(lBenCountry == "UAE"){
                apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", "AED");
            }
            
           
            
             else if(lBenCountry == "Canada"){
                apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", "CAD");
            }
            
             else if(lBenCountry == "GERMANY"){
                apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", "EUR");
            }
            else{
                apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", "USD");
            }
        }
    }
    // hardcoded for ITAU demo
    // if (lAccNum == "1212176735") {
    //     apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", "USD");
    // }
    // if (lAccNum == "1221978739") {
    //     apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", "GBP");
    // }
    // if (lAccNum == "1221978740") {
    //     apz.setElmValue("intb01__OtherBankInt__i__International__amountCurrency", "EUR");
    // }
};
apz.intb01.otherBankINT.continuetoVerify = function() {
    debugger;
    if (apz.scrMetaData.nodesMap['intb01__OtherBankInt__i__International'].currRec == -1) {
        apz.scrMetaData.nodesMap['intb01__OtherBankInt__i__International'].currRec = 0;
    }
    if (apz.val.validateContainer('intb01__OtherBankINT__OtherBankINT') == false) {
        var msg = {
            "code": 'APZ_intb01_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("OtherBankInt", "intb01");
        
        lscreenData.intb01__OtherBankInt_Req.International.Document = apz.intb01.otherBankINT.ldoc;
        lscreenData.intb01__OtherBankInt_Req.International.DocumentName = apz.intb01.otherBankINT.ldocName;
        lscreenData.intb01__OtherBankInt_Req.International.DocumentType = apz.intb01.otherBankINT.ldocType;
        
        
        if (!apz.mockServer) {
            debugger;
            var taskObj = {};
            taskObj.workflowId = "FTINT";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "OTHERBANKINT_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "intb01";
            //taskObj.screenId = "OtherBankINT";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.intb01.otherBankINT.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.intb01.otherBankINT.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            lUserObj.taskVariables = [{
                "name": "amount",
                "value": lscreenData.intb01__OtherBankInt_Req.International.amount,
                "type": "Number"
            }, {
                "name": "user",
                "value": apz.Login.sUserId,
                "type": "String"
            }];
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "intb01__OtherBankINT__launchMicroServiceHere",
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
            lReqObj.currentTask = "";
            lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lReqObj.div = apz.intb01.otherBankINT.sDiv;
            var lParams = {
                "appId": "intb01",
                "scr": "OtherBankINTVerify",
                "userObj": lReqObj,
                "div": apz.intb01.otherBankINT.sDiv,
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.intb01.otherBankINT.workflowMicroServiceCB = function(pNextStageObj) {
    apz.currAppId = "acft01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.intb01.otherBankINT.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.intb01.otherBankINT.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acft01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};
apz.intb01.otherBankINT.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "intb01__OtherBankINT__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "intb01__OtherBankINT__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.intb01.otherBankINT.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("intb01__OtherBankInt__i__International__fromAccount")
    };
    apz.launchApp(llaunch);
};
apz.intb01.otherBankINT.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("intb01");
    apz.intb01.otherBankINT.accountCurrency = params.data.accountCurrency;
    
     var param = {
            "decimalSep": ".",
            "value":  params.data.availableBalance,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    
    var CurrAmt = params.data.accountCurrency + " " + apz.formatNumber(param);
    apz.setElmValue("intb01__OtherBankInt__i__International__balance", CurrAmt);
    $("#intb01__OtherBankINT__sc_row_24").removeClass("sno");
};
apz.intb01.otherBankINT.amount = function() {
    debugger;
    var convertedamt = apz.intb01.otherBankINT.calculateRemitterAmount();
    apz.intb01.otherBankINT.convertedAmt = convertedamt;
    var lAmount = parseFloat((apz.getElmValue("intb01__OtherBankInt__i__International__amount")).trim());
    //var lAvailableBal = parseFloat((apz.getElmValue("intb01__OtherBankInt__i__International__balance").split(' ')[1]).trim());
    var lAvailableBal = (apz.getElmValue("intb01__OtherBankInt__i__International__balance").split(' ')[1]).trim();
    //if (lAmount > lAvailableBal) {
    if (Number(convertedamt) > Number(apz.intb01.otherBankINT.unformatNumber(lAvailableBal))) {
        var msg = {
            "code": 'ACFT_AMOUNT',
            "callBack": apz.intb01.otherBankINT.amountCB
        };
        apz.dispMsg(msg);
    } else {
        $("#intb01__OtherBankINT__btnfxrate").removeClass("sno");
        $("#intb01__OtherBankINT__btnfxrate_ul").removeClass("sno");
    }
};
apz.intb01.otherBankINT.fnGetFXRate = function() {
    apz.toggleModal({
        "targetId": "intb01__OtherBankINT__fxmodal"
    });
    var tocurrecy = apz.getElmValue("intb01__OtherBankInt__i__International__amountCurrency");
    apz.setElmValue("intb01__OtherBankINT__frmacctcurrecy", apz.intb01.otherBankINT.accountCurrency);
    apz.setElmValue("intb01__OtherBankINT__transfercurrecy", tocurrecy);
    apz.setElmValue("intb01__OtherBankINT__fxrate", apz.intb01.otherBankINT.fxrate);
    apz.setElmValue("intb01__OtherBankINT__equicurrecy", apz.intb01.otherBankINT.fnformatNumber(apz.intb01.otherBankINT.convertedAmt));
}
apz.intb01.otherBankINT.fnCloseFXModal = function() {
    apz.toggleModal({
        "targetId": "intb01__OtherBankINT__fxmodal"
    });
}
apz.intb01.otherBankINT.amountCB = function() {
    apz.setElmValue("intb01__OtherBankInt__i__International__amount", "");
};
apz.intb01.otherBankINT.changeTransferType = function() {
    debugger;
    var lVal = apz.getElmValue("intb01__OtherBankInt__i__International__type");
    apz.hide("intb01__OtherBankInt__i__International__transactionDate_ul");
    if (lVal == "Schedule Payment") {
        apz.show("intb01__OtherBankInt__i__International__transactionDate_ul");
    }
};
apz.intb01.otherBankINT.calculateTimes = function() {
    var lTimes = 120;
    var lFrequency = apz.getElmValue("intb01__OtherBankInt__i__International__frequency");
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
    apz.populateDropdown(document.getElementById("intb01__OtherBankInt__i__International__noOfTimes"), lfrmarr);
};
apz.intb01.otherBankINT.calculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("intb01__OtherBankInt__i__International__startDate");
    var lFrequency = apz.getElmValue("intb01__OtherBankInt__i__International__frequency");
    var lTimes = apz.getElmValue("intb01__OtherBankInt__i__International__noOfTimes");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lTimes)) {
        var date = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        var lNum = lFrequency * (lTimes - 1);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("intb01__OtherBankInt__i__International__endDate", date.toString("dd-MMM-yyyy"));
    }
};
apz.intb01.otherBankINT.cancel = function() {
    debugger;
    if (apz.intb01.otherBankINT.sFrom == "taskflow") {
        apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    } else {
        $("#acft01__Transfers__navigator").removeClass('sno');
        $("#acft01__Transfers__launchPad").addClass('sno');
        apz.show("acft01__Transfers__MainHead");
    }
};
apz.intb01.otherBankINT.calculateRemitterAmount = function() {
    debugger;
    var currency = apz.getElmValue("intb01__OtherBankInt__i__International__amountCurrency");
    var amount = apz.getElmValue("intb01__OtherBankInt__i__International__amount");
    if ((currency != "Please Select" || currency != "") && !apz.isNull(amount)) {
        amount = parseFloat(apz.intb01.otherBankINT.unformatNumber(amount));
        var convertedamount = "";
        if (apz.intb01.otherBankINT.accountCurrency == "USD") {
            if (currency == "USD") {
                var rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.20;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1.09;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.00024;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.27;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "CAD") {
                rate = 0.78;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "INR") {
                rate = 0.014;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.24;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 2.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0098;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (apz.intb01.otherBankINT.accountCurrency == "EUR") {
            if (currency == "USD") {
                var rate = 0.88;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.11;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.22;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "CAD") {
                rate = 0.64;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "INR") {
                rate = 0.011;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.21;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 2.14;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0081;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (apz.intb01.otherBankINT.accountCurrency == "GBP") {
            if (currency == "USD") {
                var rate = 0.79;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 0.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.20;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "CAD") {
                rate = 0.58;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "INR") {
                rate = 0.010;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.18;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 1.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0070;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
         if (apz.intb01.otherBankINT.accountCurrency == "OMR") {
            if (currency == "USD") {
                var rate = 0.39;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 0.53;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 0.47;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.000095;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.10;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "CAD") {
                rate = 0.30;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "INR") {
                rate = 0.0053;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.095;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0038;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (apz.intb01.otherBankINT.accountCurrency == "MYR") {
            if (currency == "USD") {
                var rate = 4.09;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 5.43;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 4.86;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.040;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
        if (apz.intb01.otherBankINT.accountCurrency == "LEK") {
            if (currency == "USD") {
                var rate = 102.25;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 142.77;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 123.65;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.025;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 27.84;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "CAD") {
                rate = 80.56;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "INR") {
                rate = 1.41;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 25.29;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 265.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.intb01.otherBankINT.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        apz.intb01.otherBankINT.fxrate = rate;
        apz.setElmValue("intb01__OtherBankINT__fx_amount", amount);
        return convertedamount;
    }
};
apz.intb01.otherBankINT.unformatNumber = function(value) {
    var params = {};
    params.value = value;
    params.decimalSep = apz.decimalSep;
    params.mask = apz.numberMask;
    params.displayAsLiteral = "N";
    debugger;
    params.decimalPoints = apz.getDecimalPoints();
    debugger;
    value = apz.unFormatNumber(params);
    return value;
}

apz.intb01.otherBankINT.fnformatNumber = function(value){
    debugger;
     var param = {
            "decimalSep": ".",
            "value":  value,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };  
        
        return apz.formatNumber(param)
}
apz.intb01.otherBankINT.fnValidateRemarks = function(params, pthis) {
    debugger;
    var pid = $(pthis).attr("id");
    var str = apz.getElmValue(pid);
    if (str.length > 35) {
        str = str.substr(0, 35);
        apz.setElmValue(pid, str);
        $("#intb01__OtherBankINT__remarks" + params + "_ul").removeClass("sno");
    }
}


apz.intb01.otherBankINT.fnBrowseUpload = function(pthis){
    debugger;
    let fileObj = pthis.files[0];
    apz.intb01.otherBankINT.ldocName = fileObj.name;
     apz.intb01.otherBankINT.ldocType = fileObj.type;
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        var encodedImage = binaryStr.split(",").pop();
         apz.intb01.otherBankINT.ldoc = encodedImage;
       
        $("#" + pthis.id).val("");
    }
    apzFileReader.readAsDataURL(fileObj);
}
