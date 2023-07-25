apz.acft01.ownAccount = {};
apz.acft01.ownAccount.sCurrentWfDetails = {};
apz.app.onLoad_OwnAccount = function(lParams) {
    debugger;
    apz.hide("acft01__Transfers__MainHead");
    apz.acft01.ownAccount.sCorporateId = apz.Login.sCorporateId;
    apz.acft01.ownAccount.sRoleId = apz.Login.sRoleId;
    apz.acft01.ownAccount.sDiv = lParams.div;
    apz.acft01.ownAccount.sFrom = lParams.from;
    
    if (lParams.currentTask) {
        apz.acft01.ownAccount.sCurrentTask = lParams.currentTask;
        apz.acft01.ownAccount.sCurrentWfDetails = lParams.currentWfDetails;
        apz.acft01.ownAccount.sDiv = lParams.div;
        //apz.acft01.ownAccount.sDiv = "ACNR01__Navigator__launchPad";
        var lScreenData = JSON.parse(lParams.currentWfDetails.screenData).acft01__OwnAccount_Req;
        apz.data.scrdata.acft01__OwnAccount_Req = {};
        apz.data.scrdata.acft01__OwnAccount_Req.Details = lScreenData.Details;
        apz.data.loadData("OwnAccount", "acft01");
    } else {
        if (!apz.isNull(lParams.Details)) {
            apz.data.scrdata.acft01__OwnAccount_Req = lParams;
            apz.data.loadData("OwnAccount", "acft01");
        }
    }
    apz.acft01.ownAccount.fetchDetails();
    
};
apz.acft01.ownAccount.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "acft01__OwnAccount__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OwnAccount__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.ownAccount.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.acft01.ownAccount.sCorporateId,
        "roleID": apz.acft01.ownAccount.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.acft01.ownAccount.fnRoleAccountCB = function(params) {
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
    apz.populateDropdown(document.getElementById("acft01__OwnAccount__i__Details__fromaccount"), lfrmarr);
    apz.populateDropdown(document.getElementById("acft01__OwnAccount__i__Details__toaccount"), lfrmarr);
    if (apz.acft01.ownAccount.sCurrentTask) {
        apz.setElmValue("acft01__OwnAccount__i__Details__fromaccount", apz.data.scrdata.acft01__OwnAccount_Req.Details.fromaccount);
        apz.setElmValue("acft01__OwnAccount__i__Details__toaccount", apz.data.scrdata.acft01__OwnAccount_Req.Details.toaccount);
        apz.acft01.ownAccount.getAmount();
    }
    
    apz.setElmValue("acft01__OwnAccount__i__Details__transactionDate", new Date().format('d-M-Y'));
};
apz.acft01.ownAccount.continuetoVerify = function() {
    debugger;
    if (apz.scrMetaData.nodesMap['acft01__OwnAccount__i__Details'].currRec == -1) {
        apz.scrMetaData.nodesMap['acft01__OwnAccount__i__Details'].currRec = 0;
    }
    if (apz.val.validateContainer('acft01__OwnAccount__OwnAccDetails') == false) {
        var msg = {
            "code": 'APZ_ACFT01_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        debugger;
        var lscreenData = apz.data.buildData("OwnAccount", "acft01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "FTOA";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "OWNACCOUNT_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "acft01";
            //taskObj.screenId = "OwnAccount";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.acft01.ownAccount.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acft01.ownAccount.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            lUserObj.taskVariables = [{
                "name": "amount",
                "value": lscreenData.acft01__OwnAccount_Req.Details.amount,
                "type": "Number"
            }, {
                "name": "user",
                "value": apz.Login.sUserId,
                "type": "String"
            }];
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "acft01__OwnAccount__gr_col_6",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
            //acft01__OwnAccount__launchMicroServiceHere
            //acft01__OwnAccount__gr_col_6
        } else {
            var lReqObj = {};
            lReqObj.currentWfDetails = {};
            //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
            //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
            lReqObj.currentTask = "";
            lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lReqObj.div = apz.acft01.ownAccount.sDiv;
            var lParams = {
                "appId": "acft01",
                "scr": "OwnAccountVerify",
                "userObj": lReqObj,
                "div": apz.acft01.ownAccount.sDiv,
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.acft01.ownAccount.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acft01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.acft01.ownAccount.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.acft01.ownAccount.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
    // "div": "acft01__Transfers__launchPad",
    //apz.acft01.ownAccount.sDiv
    //actf01__TaskFlow__MicroAppRow
};
apz.acft01.ownAccount.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "acft01__OwnAccount__launchacctdtl";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OwnAccount__gr_col_6";
    llaunch.userObj.control.callBack = apz.acft01.ownAccount.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("acft01__OwnAccount__i__Details__fromaccount")
    };
    apz.launchApp(llaunch);
};
apz.acft01.ownAccount.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    
     var param = {
            "decimalSep": ".",
            "value":  params.data.availableBalance,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    
    var Currency = params.data.accountCurrency;
    var CurrAmt = params.data.accountCurrency + " " + apz.formatNumber(param);
    apz.setElmValue("acft01__OwnAccount__i__Details__balance", CurrAmt);
    apz.setElmValue("acft01__OwnAccount__i__Details__currency", Currency);
    $("#acft01__OwnAccount__sc_row_34").removeClass("sno");
};

apz.acft01.ownAccount.getConversionAmt = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "CurrencyConversion_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acft01.ownAccount.getCurrencyCB,
        "callBackObj": "",
    };
    var req = {};
    var lFromCurrency = apz.getElmValue("acft01__OwnAccount__i__Details__currency");
    var lToCurrency = apz.getElmValue("acft01__OwnAccount__i__Details__toAccountCurrency");
    req.tbDbmiCurrencyConversion = {};
    req.tbDbmiCurrencyConversion.fromCurrency = lFromCurrency;
    req.tbDbmiCurrencyConversion.toCurrency = lToCurrency;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acft01.ownAccount.getCurrencyCB = function(pResp) {
    var lValue = pResp.res.acft01__CurrencyConversion_Res.tbDbmiCurrencyConversion.value;
    var lAmt = apz.getElmValue("acft01__OwnAccount__i__Details__amount");
    var lGetValue = lAmt * lValue;
    apz.setElmValue("acft01__OwnAccount__i__Details__conversionAmt", lGetValue);
    apz.acft01.ownAccount.amount();
};
apz.acft01.ownAccount.amount = function() {
    debugger;
    var convertedamt = apz.acft01.ownAccount.calculateRemitterAmount();
    var lAmount = parseInt(apz.getElmValue("acft01__OwnAccount__i__Details__amount").replace(/[^0-9\.-]+/g, ""));
    //var lAvailableBal = parseFloat((apz.getElmValue("acft01__OwnAccount__i__Details__balance").split(' ')[1]).trim());
    var lAvailableBal = (apz.getElmValue("acft01__OwnAccount__i__Details__balance").split(' ')[1]).trim();
    //if (lAmount > lAvailableBal) {
    var lformatAvailbalance = apz.acft01.ownAccount.unformatNumber(lAvailableBal);
    if (Number(convertedamt) > Number(lformatAvailbalance)) {
        var msg = {
            "code": 'ACFT_AMOUNT',
            "callBack": apz.acft01.ownAccount.amountCB
        };
        apz.dispMsg(msg);
    }
};
apz.acft01.ownAccount.amountCB = function() {
    apz.setElmValue("acft01__OwnAccount__i__Details__amount", "");
};
apz.acft01.ownAccount.calculateRemitterAmount = function() {
    debugger;
    var currency = apz.getElmValue("acft01__OwnAccount__i__Details__toAccountCurrency");
    var amount = apz.getElmValue("acft01__OwnAccount__i__Details__amount");
    var sCurrencyVal = apz.getElmValue("acft01__OwnAccount__i__Details__currency");
    if ((currency != "Please Select" || currency != "") && !apz.isNull(amount)) {
        amount = parseFloat(apz.acft01.ownAccount.unformatNumber(amount));
        var convertedamount = "";
        if (sCurrencyVal == "USD") {
            if (currency == "USD") {
                var rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.20;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1.09;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.00024;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.24;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 2.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
            else if (currency == "LEK") {
                rate = 0.0098;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (sCurrencyVal == "EUR") {
            if (currency == "USD") {
                var rate = 0.88;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.11;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.21;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 2.15;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
            else if (currency == "LEK") {
                rate = 0.0081;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (sCurrencyVal == "GBP") {
            if (currency == "USD") {
                var rate = 0.79;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 0.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.18;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 1.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0070;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
        
          if (sCurrencyVal == "OMR") {
              if (currency == "USD") {
                  var rate = 0.38;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "OMR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              } else if (currency == "GBP") {
                  rate = 0.53;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "OMR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              } else if (currency == "EUR") {
                  rate = 0.47;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "OMR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              } else if (currency == "OMR") {
                  rate = 1;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "OMR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              }
              else if (currency == "LEK") {
                  rate = 0.0038;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "OMR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              }
          }
        
          if (sCurrencyVal == "MYR") {
              if (currency == "USD") {
                  var rate = 4.09;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "MYR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              } else if (currency == "GBP") {
                  rate = 5.43;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "MYR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              } else if (currency == "EUR") {
                  rate = 4.86;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "MYR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              } else if (currency == "MYR") {
                  rate = 1;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "MYR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              }
              else if (currency == "OMR") {
                  rate = 10.53;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "MYR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              }
              else if (currency == "LEK") {
                  rate = 0.040;
                  convertedamount = (amount * rate).toFixed(2);
                  amount = "MYR " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
              }
          }
          
          
           if (sCurrencyVal == "LEK") {
            if (currency == "USD") {
                var rate = 102.25;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 142.77;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 123.65;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.025;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 25.29;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 265.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
            else if (currency == "LEK") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.ownAccount.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
          
        apz.setElmValue("acft01__OwnAccount__fxamount", amount);
        return convertedamount;
    }
};
apz.acft01.ownAccount.unformatNumber = function(value) {
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

apz.acft01.ownAccount.fnformatNumber = function(value){
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
apz.acft01.ownAccount.changeTransferType = function() {
    debugger;
    var lVal = apz.getElmValue("acft01__OwnAccount__i__Details__type");
    apz.hide("acft01__OwnAccount__i__Details__transactionDate_ul");
    if (lVal == "Schedule Payment") {
        apz.show("acft01__OwnAccount__i__Details__transactionDate_ul");
    }
};
apz.acft01.ownAccount.calculateTimes = function() {
    var lTimes = 120;
    var lFrequency = apz.getElmValue("acft01__OwnAccount__i__Details__frequency");
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
    apz.populateDropdown(document.getElementById("acft01__OwnAccount__i__Details__noOfTimes"), lfrmarr);
};
apz.acft01.ownAccount.calculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("acft01__OwnAccount__i__Details__startDate");
    var lFrequency = apz.getElmValue("acft01__OwnAccount__i__Details__frequency");
    var lTimes = apz.getElmValue("acft01__OwnAccount__i__Details__noOfTimes");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lTimes)) {
        var date = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        var lNum = lFrequency * (lTimes - 1);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("acft01__OwnAccount__i__Details__endDate", date.toString("dd-MMM-yyyy"));
    }
};
apz.acft01.ownAccount.cancel = function() {
    debugger;
    if(apz.acft01.ownAccount.sFrom == "taskflow"){
      apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    }
    
    else{
        
    $("#acft01__Transfers__navigator").removeClass('sno');
    $("#acft01__Transfers__launchPadRow").addClass('sno');
    apz.show("acft01__Transfers__MainHead");
}
};
apz.acft01.ownAccount.getToAccCurrency = function() {
    
    //apz.startLoader();
   
         var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "acft01__OwnAccount__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OwnAccount__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.ownAccount.getToAccCurrencyCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("acft01__OwnAccount__i__Details__toaccount")
    };
    apz.launchApp(llaunch);
        
    
   
};
apz.acft01.ownAccount.getToAccCurrencyCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    var Currency = params.data.accountCurrency;
    var CurrAmt = params.data.availableBalance;
    var lAccName = params.data.accountName;
    apz.setElmValue("acft01__OwnAccount__i__Details__toAccountCurrency", Currency);
    apz.setElmValue("acft01__OwnAccount__i__Details__accountName", lAccName);
    $("#acft01__OwnAccount__sc_row_35").removeClass("sno");
    apz.stopLoader();
};
