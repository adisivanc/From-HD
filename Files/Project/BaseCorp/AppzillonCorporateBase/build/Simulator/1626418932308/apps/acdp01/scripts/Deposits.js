apz.acdp01.deposits = {};
apz.acdp01.deposits.sCurrentWfDetails = {};
apz.acdp01.deposits.sfromCurrency;
apz.acdp01.deposits.sgetValue;
apz.acdp01.deposits.sparams = {};
apz.app.onLoad_Deposits = function(params) {
    debugger;
   apz.acdp01.deposits.sparams = params
    apz.acdp01.deposits.sCorporateId = apz.Login.sCorporateId;
    apz.acdp01.deposits.sRoleId = apz.Login.sRoleId;
    apz.hide("acdp01__DepositLauncher__DepHead");
    apz.acdp01.deposits.fetchDetails();
    //apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__maturityDate", new Date().format('d-M-Y'));
    var date = new Date().format('d-M-Y');
    var lObj = {
        "val": date,
        "fromFormat": "dd-MMM-yyyy",
        "toFormat": "dd/MM/yyyy"
    };
    var finalDate = apz.formatDate(lObj);
    apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__maturityDate", finalDate);
   // apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__startDate", new Date().format('d-M-Y'));
    apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__startDate", finalDate);
    apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__roi", 1);
};
apz.app.onShown_Deposits = function() {
   
    $(
        "#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayable,#acdp01__Deposits__i__tbDbmiCorpDeposits__maturityInstructions,#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayableMode,#acdp01__Deposits__i__tbDbmiCorpDeposits__principalCreditAcno,#acdp01__Deposits__i__tbDbmiCorpDeposits__maturityInstructions"
    ).attr("disabled", "disabled");
};
apz.acdp01.deposits.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "acdp01__Deposits__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acdp01__Deposits__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acdp01.deposits.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.acdp01.deposits.sCorporateId,
        "roleID": apz.acdp01.deposits.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.acdp01.deposits.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acdp01");
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
    apz.populateDropdown(document.getElementById("acdp01__Deposits__i__tbDbmiCorpDeposits__fromAccount"), lfrmarr);
    
    if(apz.acdp01.deposits.sparams.from == "OmniSearch"){
        var fromAccount = apz.acdp01.deposits.sparams.entities.entities[0].extractedValue[0]; //david
       apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__fromAccount",lfrmarr[1].val);
       
       var termPeriod = apz.acdp01.deposits.sparams.entities.entities[1].extractedValue[0]; //2 years
       var years = termPeriod[0].split(" ");
       if(termPeriod.length > 1)
       {
       var month = termPeriod[1].split(" ");
       }
       
     apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__years",years[0]);
     if(month != undefined){
         apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__months",month[0]);
     }
       
       var amount = apz.acdp01.deposits.sparams.entities.entities[2].extractedValue[0]; //1,000
       apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__depositAmount",amount);
       
       //var accountType = apz.acdp01.deposits.sparams.entities.entities[3].extractedValue[0]; //fixeddeposit
      
    }
    
    var lanotheracc = [];
    var lObj = {
        "val": "Select Another Account",
        "desc": "Select Another Account"
    };
    lanotheracc.push(lObj);
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
        lanotheracc.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("acdp01__Deposits__i__tbDbmiCorpDeposits__principalCreditAcno"), lanotheracc);
    apz.populateDropdown(document.getElementById("acdp01__Deposits__InterestAccount"), lanotheracc);
    apz.acdp01.deposits.getEntity();
};
apz.acdp01.deposits.getEntity = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "EntitiesQuery_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acdp01.deposits.entitiesQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acdp01.deposits.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acdp01.deposits.entitiesQueryCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lEntities = pResp.res.acdp01__EntitiesQuery_Res.tbDbmiCorpEntityMaster;
        var lEntitiesLength = lEntities.length;
        var lArr = [];
        for (var i = 0; i < lEntitiesLength; i++) {
            var lObj = {
                "val": lEntities[i].entityId,
                "desc": lEntities[i].entityId,
            };
            lArr.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acdp01__Deposits__i__tbDbmiCorpDeposits__accountEntity"), lArr);
    }
};
apz.acdp01.deposits.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "acdp01__Deposits__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acdp01__Deposits__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acdp01.deposits.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__fromAccount")
    };
    apz.launchApp(llaunch);
};
apz.acdp01.deposits.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acdp01");
    apz.acdp01.deposits.sfromCurrency = params.data.accountCurrency;
     var param = {
            "decimalSep": ".",
            "value":  params.data.availableBalance,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    var CurrAmt = params.data.accountCurrency + " " + apz.formatNumber(param);
    apz.setElmValue("acdp01__Deposits__availableBal", CurrAmt);
    var lFromAcc = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__fromAccount");
    apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__principalCreditAcno", lFromAcc);
    $("#acdp01__Deposits__sc_row_48").removeClass("sno");
};
apz.acdp01.deposits.getCurrency = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "CurrencyConversion_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acdp01.deposits.getCurrencyCB,
        "callBackObj": "",
    };
    var req = {};
    var lToCurrency = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__depositCurrency");
    req.tbDbmiCurrencyConversion = {};
    req.tbDbmiCurrencyConversion.fromCurrency = apz.acdp01.deposits.sfromCurrency;
    req.tbDbmiCurrencyConversion.toCurrency = lToCurrency;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acdp01.deposits.getCurrencyCB = function(pResp) {
    debugger;
    apz.acdp01.deposits.sgetValue = pResp.res.acdp01__CurrencyConversion_Res.tbDbmiCurrencyConversion.value;
};
apz.acdp01.deposits.showValue = function() {
    debugger;
    var lValue = apz.acdp01.deposits.sgetValue;
    var lAmt = parseInt(apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__depositAmount").replace(/[^0-9\.-]+/g, ""));
    var lGetValue = lAmt * lValue;
    apz.setElmValue("acdp01__Deposits__ownAccountCurrency", lGetValue);
    $("#acdp01__Deposits__i__tbDbmiCorpDeposits__maturityInstructions").removeAttr("disabled", "disabled");
    apz.acdp01.deposits.calculateMaturityValue();
};
apz.acdp01.deposits.getFDInterestRates = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "FDInterestRates_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acdp01.deposits.getFDInterestRatesCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.acdp01.deposits.getFDInterestRatesCB = function(pResp) {
    debugger;
    var params = {};
    params.targetId = "acdp01__Deposits__FDinterestRate";
    apz.toggleModal(params);
    apz.setTableHeight("acdp01__Deposits__FDInterestTable", false);
};
apz.acdp01.deposits.maturityInstructions = function() {
    debugger;
    var lMaturityInstructions = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__maturityInstructions");
    if (lMaturityInstructions == "Renew Principal and Interest") {
        $("#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayable").attr("disabled", "disabled");
        $("#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayableMode,#acdp01__Deposits__i__tbDbmiCorpDeposits__principalCreditAcno").removeAttr(
            "disabled");
        apz.acdp01.deposits.calculateMaturityValue();
    } else if (lMaturityInstructions == "Renew Principal only") {
        $(
            "#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayable,#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayableMode,#acdp01__Deposits__i__tbDbmiCorpDeposits__principalCreditAcno"
        ).removeAttr("disabled");
    } else if (lMaturityInstructions == "Do not Renew") {
        $(
            "#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayable,#acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayableMode,#acdp01__Deposits__i__tbDbmiCorpDeposits__principalCreditAcno"
        ).removeAttr("disabled");
    }
};
apz.acdp01.deposits.getDate = function() {
    debugger;
    var lYear = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__years");
    var lMonth = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__months");
    var lDays = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__days");
    var lDay = (lDays !== "") ? lDays : 0;
    var date = new Date().addDays(lDay).addMonths(lMonth).addYears(lYear).toLocaleString().split(",")[0];
    // var lObj = {
    //     "val": date,
    //     "fromFormat": "d/M/yyyy",
    //     "toFormat": "dd-MMM-yyyy"
    // };
    var lObj = {
        "val": date,
        "fromFormat": "d/M/yyyy",
        "toFormat": "dd/MM/yyyy"
    };
    var finalDate = apz.formatDate(lObj);
    apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__maturityDate", finalDate);
    apz.acdp01.deposits.calculateMaturityValue();
};
apz.acdp01.deposits.continuetoVerify = function() {
    debugger;
    // if (apz.val.validateContainer('acdp01__Deposits__Deposits') == false) {
    //     var msg = {
    //         "code": 'APZ_ACFT01_MANDATORY'
    //     };
    //     apz.dispMsg(msg);
    // } else 
        var lscreenData = apz.data.buildData("Deposits", "acdp01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "ACDP";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "DEPOSIT_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "acdp01";
            //taskObj.screenId = "Deposits";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.acdp01.deposits.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s Deposit details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acdp01.deposits.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "acdp01__Deposits__launchMicroServiceHere",
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
            apz.hide("acdp01__Deposits__gr_row_8");
            var lParams = {
                "appId": "acdp01",
                "scr": "DepositsVerify",
                "userObj": lReqObj,
                "div": "acdp01__DepositLauncher__DepositLauncher",
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    
};
apz.acdp01.deposits.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acdp01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                apz.hide("acdp01__Deposits__gr_row_8");
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": "acdp01__DepositLauncher__DepositLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
};
apz.acdp01.deposits.cancel = function() {
    debugger;
    var params = {};
    params.appId = "acdp01";
    params.scr = "DepositSummary";
    params.div = "acdp01__DepositLauncher__DepositLauncher";
    params.layout = "All";
    apz.show("acdp01__DepositLauncher__DepHead");
    apz.launchSubScreen(params);
};
apz.acdp01.deposits.liquidateFD = function() {
    debugger;
    var lParams = {
        "appId": "acdp01",
        "scr": "LiquidateFD",
        "div": "acdp01__Deposits__launchPad",
        "layout": "All",
        "type": "CF",
    };
    apz.launchSubScreen(lParams);
};
apz.acdp01.deposits.calculateMaturityValue = function() {
    debugger;
    //A = P(1 + r / n)(nt)
    var principal = parseInt(apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__depositAmount").replace(/[^0-9\.-]+/g, ""));
    var Roi = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__roi");
    var CompoundedInterest = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__interestPayable");
    // var lObj = {
    //     "val": apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__startDate"),
    //     "fromFormat": "d-MMM-yyyy",
    //     "toFormat": "M/dd/yyyy"
    // };
    var lObj = {
        "val": apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__startDate"),
        "fromFormat": "dd/MM/yyyy",
        "toFormat": "d-MMM-yyyy"
    };
    lObj.val = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__maturityDate");
    var firstDate = apz.formatDate(lObj);
    if (CompoundedInterest == "") {
        CompoundedInterest = 1;
        if (!apz.isNull(principal) && !apz.isNull(Roi) && !apz.isNull(CompoundedInterest)) {
            var n = "";
            if (CompoundedInterest == "atmaturity") {
                n = 12;
            } else {
                n = 12 / CompoundedInterest;
            }
            var startDay = new Date();
            var endDay = new Date(firstDate);
            var millisecondsPerDay = 1000 * 60 * 60 * 24;
            var millisBetween = startDay.getTime() - endDay.getTime();
            var days = Math.abs(millisBetween / millisecondsPerDay);
            var t = days / 365;
            var A = principal * Math.pow((1 + (Roi / n)), (n * t));
            var totalAmount = Math.round(A * 100) / 100;
            var lInterestAmt = Math.round((totalAmount - principal) * 100) / 100;
            var simpleinterest = Math.round(principal * t * Roi);
            if (CompoundedInterest == "atmaturity") {
                apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__interestAmount", lInterestAmt);
            } else {
                apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__interestAmount", simpleinterest);
            }
            apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__finalAmount", totalAmount);
        }
    }
    apz.acdp01.deposits.Daysbetween();
};
apz.acdp01.deposits.Daysbetween = function() {
    debugger;
    var lObj = {
        "val": apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__startDate"),
        "fromFormat": "d-MMM-yyyy",
        "toFormat": "M/dd/yyyy"
    };
    lObj.val = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__maturityDate");
    var firstDate = apz.formatDate(lObj);
    var startDay = new Date();
    var endDay = new Date(firstDate);
    var millisecondsPerDay = 1000 * 60 * 60 * 24;
    var millisBetween = startDay.getTime() - endDay.getTime();
    //var days = Math.abs(millisBetween / millisecondsPerDay);
    var days = parseInt(Math.abs(millisBetween / millisecondsPerDay));
    debugger;
    var period = '< 29 Days';
    if (days >= 30 && days < 90) {
        period = '30 days - 3 Months';
    } else if (days >= 90 && days < 180) {
        period = '3 Months 1 day - 6 Months';
    } else if (days >= 180 && days < 365) {
        period = '6 Months 1 day - < 1 Year';
    } else if (days >= 365 && days < 730) {
        period = '1 Yr to < 2 Yrs';
    } else if (days >= 730 && days < 1095) {
        period = '2 Yrs to < 3 Yrs';
    } else if (days >= 1095 && days < 1460) {
        period = '3 Yrs to < 4 Yrs';
    } else if (days >= 1460 && days < 1825) {
        period = '4 Yrs to < 5 Yrs';
    } else if (days >= 1825) {
        period = '>5 Yrs';
    }
    var req = {
        "GetRateofInterest": {
            "GetDays": period
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_interest_rates";
    var lServerParams = {
        "ifaceName": "FetchInterestRate",
        "buildReq": "N",
        "appId": "acdp01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acdp01.deposits.getInterestRatesCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.acdp01.deposits.getInterestRatesCB = function(pResp) {
    debugger;
    var currvalue = apz.getElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__depositCurrency");
    if (currvalue == "Please Select") {
        apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__roi", "0");
    } else {
        var IR = pResp.res.acdp01__FetchInterestRate_Res.InterestRateObj[currvalue];
        apz.setElmValue("acdp01__Deposits__i__tbDbmiCorpDeposits__roi", IR);
    }
};
