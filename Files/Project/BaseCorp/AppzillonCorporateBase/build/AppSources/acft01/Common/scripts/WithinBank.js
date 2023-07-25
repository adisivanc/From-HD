apz.acft01.withinBank = {};
apz.acft01.withinBank.sCurrentWfDetails = {};
apz.acft01.withinBank.sData = {};
apz.acft01.withinBank.sCurrencyVal = {};
apz.acft01.withinBank.sAcctNo = "";
apz.app.onLoad_WithinBank = function(lParams) {
    debugger;
    apz.hide("acft01__Transfers__MainHead");
     $(".filebox").next().addClass("sno");
    apz.acft01.withinBank.sCorporateId = apz.Login.sCorporateId;
    apz.acft01.withinBank.sRoleId = apz.Login.sRoleId;
    apz.acft01.withinBank.sDiv = lParams.div;
    apz.acft01.withinBank.sFrom = lParams.from;
    if (lParams.currentTask) {
        apz.acft01.withinBank.sCurrentTask = lParams.currentTask;
        apz.acft01.withinBank.sCurrentWfDetails = lParams.currentWfDetails;
        apz.acft01.withinBank.sDiv = lParams.div;
        var lScreenData = JSON.parse(lParams.currentWfDetails.screenData).acft01__WithinBankDetails_Req;
        apz.data.scrdata.acft01__WithinBankDetails_Req = {};
        apz.data.scrdata.acft01__WithinBankDetails_Req.Details = lScreenData.Details;
        apz.data.loadData("WithinBankDetails", "acft01");
    } else if (!apz.isNull(lParams.Details)) {
        apz.data.scrdata.acft01__WithinBankDetails_Req = lParams;
        apz.data.loadData("WithinBankDetails", "acft01");
    }
    apz.acft01.withinBank.fetchDetails();
    apz.setElmValue("acft01__WithinBankDetails__i__Details__transactionDate", new Date().format('d-M-Y'));
};
apz.acft01.withinBank.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "acft01__WithinBank__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__WithinBank__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.withinBank.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.acft01.withinBank.sCorporateId,
        "roleID": apz.acft01.withinBank.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.acft01.withinBank.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
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
    apz.populateDropdown(document.getElementById("acft01__WithinBankDetails__i__Details__fromAccount"), lfrmarr);
    if (apz.acft01.withinBank.sCurrentTask) {
        apz.setElmValue("acft01__WithinBankDetails__i__Details__fromAccount", apz.data.scrdata.acft01__WithinBankDetails_Req.Details.fromAccount);
    }
    apz.acft01.withinBank.fetchbeneficiaryDetails();
};
apz.acft01.withinBank.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "acft01__WithinBank__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__WithinBank__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.withinBank.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.acft01.withinBank.sCorporateId,
        "beneficaryType": "Same",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.acft01.withinBank.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    apz.acft01.withinBank.sData = params.data;
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
     var lObj1 = {
        "val": "Add New Beneficiary",
        "desc": "Add New Beneficiary"
    };
    lfrmarr.push(lObj1);
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
    apz.populateDropdown(document.getElementById("acft01__WithinBankDetails__i__Details__toAccount"), lfrmarr);
    if (apz.acft01.withinBank.sCurrentTask) {
        apz.setElmValue("acft01__WithinBankDetails__i__Details__toAccount", apz.data.scrdata.acft01__WithinBankDetails_Req.Details.toAccount);
    }
    
    if (apz.acft01.withinBank.sAcctNo != "") {
        apz.setElmValue("acft01__WithinBankDetails__i__Details__toAccount", apz.acft01.withinBank.sAcctNo);
        apz.acft01.withinBank.continuetoVerify();
        apz.acft01.withinBank.sAcctNo = "";
    }
};
apz.acft01.withinBank.changeNickname = function(pThis) {
    debugger;
    var lAccNum = apz.getElmValue("acft01__WithinBankDetails__i__Details__toAccount");
    if (lAccNum == "Add New Beneficiary") {
        $("#acft01__WithinBank__benrow").removeClass('sno');
    } else {
        $("#acft01__WithinBank__benrow").addClass('sno');
        var lData = apz.acft01.withinBank.sData;
        var lCurrVal = apz.acft01.withinBank.sCurrencyVal;
        apz.setElmValue("acft01__WithinBankDetails__i__Details__currency", lCurrVal);
        var larrLength = lData.length;
        var lAccNum = apz.getElmValue("acft01__WithinBankDetails__i__Details__toAccount");
        for (var i = 0; i < larrLength; i++) {
            if (lAccNum == lData[i].accountNumber) {
                var lAccBrnch = lData[i].branchName;
                var lBenName = lData[i].beneficaryName;
                apz.setElmValue("acft01__WithinBankDetails__i__Details__accountBranch", lAccBrnch);
                apz.setElmValue("acft01__WithinBankDetails__i__Details__beneficiaryName", lBenName);
            }
        }
        $("#acft01__WithinBank__sc_row_39").removeClass("sno");
    }
};
apz.acft01.withinBank.continuetoVerify = function() {
    debugger;
    if (apz.scrMetaData.nodesMap['acft01__WithinBankDetails__i__Details'].currRec == -1) {
        apz.scrMetaData.nodesMap['acft01__WithinBankDetails__i__Details'].currRec = 0;
        apz.scrMetaData.nodesMap['acft01__WithinBankDetails__i__Beneficiary'].currRec = 0;
    }
    if (apz.val.validateContainer('acft01__WithinBank__WithinBankDetails') == false) {
        var msg = {
            "code": 'APZ_ACFT01_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("WithinBankDetails", "acft01");
         lscreenData.acft01__WithinBankDetails_Req.Details.Document = apz.acft01.withinBank.ldoc;
        lscreenData.acft01__WithinBankDetails_Req.Details.DocumentName = apz.acft01.withinBank.ldocName;
        lscreenData.acft01__WithinBankDetails_Req.Details.DocumentType = apz.acft01.withinBank.ldocType;
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "FTWB";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "WITHINBANK_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "acft01";
            //taskObj.screenId = "WithinBank";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.acft01.withinBank.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acft01.withinBank.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "acft01__WithinBank__launchMicroServiceHere",
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
            lReqObj.div = apz.acft01.withinBank.sDiv;
            var lParams = {
                "appId": "acft01",
                "scr": "WithinBankVerify",
                "userObj": lReqObj,
                "div": apz.acft01.withinBank.sDiv,
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.acft01.withinBank.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acft01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.acft01.withinBank.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.acft01.withinBank.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
};
apz.acft01.withinBank.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "acft01__WithinBank__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__WithinBank__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.withinBank.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("acft01__WithinBankDetails__i__Details__fromAccount")
    };
    apz.launchApp(llaunch);
};
apz.acft01.withinBank.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    // var Currency = params.data.accountCurrency;
    apz.acft01.withinBank.sCurrencyVal = params.data.accountCurrency;
    var param = {
            "decimalSep": ".",
            "value":  params.data.availableBalance,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    
    var CurrAmt = params.data.accountCurrency + " " + apz.formatNumber(param);
    apz.setElmValue("acft01__WithinBank__amountVal", CurrAmt);
    // apz.setElmValue("acft01__WithinBankDetails__i__Details__currency", Currency);
    $("#acft01__WithinBank__sc_row_40").removeClass("sno");
};
apz.acft01.withinBank.amount = function() {
    debugger;
    var convertedamt = apz.acft01.withinBank.calculateRemitterAmount();
    var lAmount = parseInt(apz.getElmValue("acft01__WithinBankDetails__i__Details__amount").replace(/[^0-9\.-]+/g, ""));
    //var lAvailableBal = parseFloat((apz.getElmValue("acft01__WithinBank__amountVal").split(' ')[1]).trim());
    var lAvailableBal = (apz.getElmValue("acft01__WithinBank__amountVal").split(' ')[1]).trim();
    // if (lAmount > lAvailableBal) {
    //     var msg = {
    //         "code": 'ACFT_AMOUNT',
    //         "callBack": apz.acft01.withinBank.amountCB
    //     };
    //     apz.dispMsg(msg);
    // }
    
    var lformatAvailbalance = apz.acft01.withinBank.unformatNumber(lAvailableBal);
    if (Number(convertedamt) > Number(lformatAvailbalance)) {
        var msg = {
            "code": 'ACFT_AMOUNT',
            "callBack": apz.acft01.withinBank.amountCB
        };
        apz.dispMsg(msg);
    }
};
apz.acft01.withinBank.amountCB = function() {
    apz.setElmValue("acft01__WithinBankDetails__i__Details__amount", "");
};

apz.acft01.withinBank.calculateRemitterAmount = function() {
    debugger;
    var currency = apz.getElmValue("acft01__WithinBankDetails__i__Details__currency");
    var amount = apz.getElmValue("acft01__WithinBankDetails__i__Details__amount");
    if ((currency != "Please Select" || currency != "") && !apz.isNull(amount)) {
        amount = parseFloat(apz.acft01.withinBank.unformatNumber(amount));
        var convertedamount = "";
        if (apz.acft01.withinBank.sCurrencyVal == "USD") {
            if (currency == "USD") {
                var rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.20;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1.09;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.00024;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "MYR") {
                rate = 0.24;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 2.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
             else if (currency == "AED") {
                rate = 0.27;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
             else if (currency == "LEK") {
                rate = 0.0098;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (apz.acft01.withinBank.sCurrencyVal == "EUR") {
            if (currency == "USD") {
                var rate = 0.88;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.11;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.21;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 2.15;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
            else if (currency == "AED") {
                rate = 0.22;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
            else if (currency == "LEK") {
                rate = 0.0081;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (apz.acft01.withinBank.sCurrencyVal == "GBP") {
            if (currency == "USD") {
                var rate = 0.79;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 0.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.18;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 1.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.20;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0070;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
        if (apz.acft01.withinBank.sCurrencyVal == "OMR") {
            if (currency == "USD") {
                var rate = 0.39
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 0.53;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 0.47;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.095;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.10;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0038;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
        if (apz.acft01.withinBank.sCurrencyVal == "MYR") {
            if (currency == "USD") {
                var rate = 4.09;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 5.43;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 4.86;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.040;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
        if (apz.acft01.withinBank.sCurrencyVal == "LEK") {
            if (currency == "USD") {
                var rate = 102.25;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 142.77;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 123.65;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.025;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "MYR") {
                rate = 25.29;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 265.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
             else if (currency == "LEK") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.withinBank.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        apz.setElmValue("acft01__WithinBank__fx_amount", amount);
        return convertedamount;
    }
};

apz.acft01.withinBank.changeTransferType = function() {
    var lVal = apz.getElmValue("acft01__WithinBankDetails__i__Details__type");
    apz.hide("acft01__WithinBankDetails__i__Details__transactionDate_ul");
    if (lVal == "Schedule Payment") {
        apz.show("acft01__WithinBankDetails__i__Details__transactionDate_ul");
    }
};
apz.acft01.withinBank.calculateTimes = function() {
    var lTimes = 120;
    var lFrequency = apz.getElmValue("acft01__WithinBankDetails__i__Details__frequency");
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
    apz.populateDropdown(document.getElementById("acft01__WithinBankDetails__i__Details__noOfTimes"), lfrmarr);
};
apz.acft01.withinBank.calculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("acft01__WithinBankDetails__i__Details__startDate");
    var lFrequency = apz.getElmValue("acft01__WithinBankDetails__i__Details__frequency");
    var lTimes = apz.getElmValue("acft01__WithinBankDetails__i__Details__noOfTimes");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lTimes)) {
        var date = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        var lNum = lFrequency * (lTimes - 1);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("acft01__WithinBankDetails__i__Details__endDate", date.toString("dd-MMM-yyyy"));
    }
};
apz.acft01.withinBank.cancel = function() {
    debugger;
    if(apz.acft01.withinBank.sFrom == "taskflow"){
      apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    }else{
    $("#acft01__Transfers__navigator").removeClass('sno');
    $("#acft01__Transfers__launchPadRow").addClass('sno');
    apz.show("acft01__Transfers__MainHead");
    }
};


apz.acft01.withinBank.fnBrowseUpload = function(pthis){
    debugger;
    let fileObj = pthis.files[0];
    apz.acft01.withinBank.ldocName = fileObj.name;
     apz.acft01.withinBank.ldocType = fileObj.type;
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        var encodedImage = binaryStr.split(",").pop();
         apz.acft01.withinBank.ldoc = encodedImage;
       
        $("#" + pthis.id).val("");
    }
    apzFileReader.readAsDataURL(fileObj);
}

apz.acft01.withinBank.continuetoVerifyWithben = function(){
    debugger;
     var lAccNum = apz.getElmValue("acft01__WithinBankDetails__i__Details__toAccount");
    if (lAccNum == "Add New Beneficiary"){
        apz.acft01.withinBank.fnAddBeneficiary();
    }
    
    else{
        apz.acft01.withinBank.continuetoVerify();
    }
}

apz.acft01.withinBank.fnAddBeneficiary = function() {
    debugger;
    apz.setElmValue("acft01__AddBeneficiary__i__tbDbmiCorpRoleBeneficary__corporateId", apz.acft01.withinBank.sCorporateId);
    var ldata = apz.data.buildData("AddBeneficiary", "acft01").acft01__AddBeneficiary_Req.tbDbmiCorpRoleBeneficary;
    ldata.beneficaryType = "Same";
    
    if (apz.getElmValue("acft01__AddBeneficiary__i__tbDbmiCorpRoleBeneficary__accountNumber") != apz.getElmValue(
        "acft01__WithinBank__reEnterAccno")) {
        var msg = {
            "message": 'Please enter the correct account number'
        };
        apz.dispMsg(msg);
    } 
    
    else{
    
    var lServerParams = {
        "ifaceName": "AddBeneficiary_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acft01.withinBank.fnAddBeneficiaryCB,
        "callBackObj": ldata,
    };
    var req = {};
    req.tbDbmiCorpRoleBeneficary = ldata
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    }
}
apz.acft01.withinBank.fnAddBeneficiaryCB = function(params) {
    debugger;
    if (params.errors == undefined) {
        // apz.setElmValue("acft01__OtherBankDom__i__Domestic__ifscCode", params.callBackObj.ifscCode);
        // apz.setElmValue("acft01__OtherBankDom__i__Domestic__bankName", params.callBackObj.bankName);
        // apz.setElmValue("acft01__OtherBankDom__i__Domestic__beneficiaryName", params.callBackObj.beneficaryName);
        apz.acft01.withinBank.sAcctNo = params.callBackObj.accountNumber;
        $("#acft01__WithinBank__benrow1 input").val("");
         $("#acft01__WithinBank__benrow2 input").val("");
        apz.acft01.withinBank.fetchbeneficiaryDetails();
        
    } else {
        var msg = {
            "message": "Something went wrong",
            "type": "E"
        };
        apz.dispMsg(msg);
    }
}


apz.acft01.withinBank.unformatNumber = function(value) {
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

apz.acft01.withinBank.fnformatNumber = function(value){
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
