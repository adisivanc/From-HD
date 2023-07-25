apz.acft01.otherBankDOM = {};
apz.acft01.otherBankDOM.sCurrentWfDetails = {};
apz.acft01.otherBankDOM.sData = {};
apz.acft01.otherBankDOM.sCurrencyVal = {};
 apz.acft01.otherBankDOM.sAcctNo = "";
apz.app.onLoad_OtherBankDOM = function(lParams) {
    debugger;
     $(".filebox").next().addClass("sno");
     $("#acft01__OtherBankDOM__sc_row_36").addClass('sno');
    apz.hide("acft01__Transfers__MainHead");
    apz.hide("acft01__OtherBankDOM__charge_type");
    apz.hide("acft01__OtherBankDOM__ach_details");
    apz.acft01.otherBankDOM.sCorporateId = apz.Login.sCorporateId;
    apz.acft01.otherBankDOM.sRoleId = apz.Login.sRoleId;
    apz.acft01.otherBankDOM.sUserID = apz.Login.sUserId;
    apz.acft01.otherBankDOM.sFtType = "DOM";
    apz.acft01.otherBankDOM.sDiv = lParams.div;
    apz.acft01.otherBankDOM.sFrom = lParams.from;
    //apz.acft01.otherBankDOM.sDiv = "ACNR01__Navigator__launchPad";
    if (lParams.currentTask) {
        apz.acft01.otherBankDOM.sCurrentTask = lParams.currentTask;
        apz.acft01.otherBankDOM.sCurrentWfDetails = lParams.currentWfDetails;
        apz.acft01.otherBankDOM.sDiv = lParams.div;
        //apz.acft01.otherBankDOM.sDiv = "ACNR01__Navigator__launchPad";
        var lScreenData = JSON.parse(lParams.currentWfDetails.screenData).acft01__OtherBankDom_Req;
        apz.data.scrdata.acft01__OtherBankDom_Req = {};
        apz.data.scrdata.acft01__OtherBankDom_Req.Domestic = lScreenData.Domestic;
        apz.data.loadData("OtherBankDom", "acft01");
    } else {
        if (!apz.isNull(lParams.Domestic)) {
            apz.data.scrdata.acft01__OtherBankDom_Req = lParams;
            apz.data.loadData("OtherBankDom", "acft01");
        }
    }
    if(lParams.from == "omniSearch"){
        apz.acft01.otherBankDOM.omniBen = lParams.beneName;
        apz.acft01.otherBankDOM.omniAmount = lParams.amount;
    }
   
    apz.acft01.otherBankDOM.fetchDetails();
};
apz.acft01.otherBankDOM.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "acft01__OtherBankDOM__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OtherBankDOM__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.otherBankDOM.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.acft01.otherBankDOM.sCorporateId,
        "roleID": apz.acft01.otherBankDOM.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.acft01.otherBankDOM.fnRoleAccountCB = function(params) {
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
    apz.populateDropdown(document.getElementById("acft01__OtherBankDom__i__Domestic__fromAccount"), lfrmarr);
    apz.populateDropdown(document.getElementById("acft01__OtherBankDOM__ach_acc"), lfrmarr);
    if (apz.acft01.otherBankDOM.sCurrentTask) {
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__fromAccount", apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.fromAccount);
    }
    apz.acft01.otherBankDOM.fetchbeneficiaryDetails();
};
apz.acft01.otherBankDOM.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "acft01__OtherBankDOM__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OtherBankDOM__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.otherBankDOM.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.acft01.otherBankDOM.sCorporateId,
        "beneficaryType": "Other",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.acft01.otherBankDOM.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    apz.acft01.otherBankDOM.sData = params.data;
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
        
        if(apz.acft01.otherBankDOM.sFrom == "omniSearch"){
            if(params.data[i].beneficaryName.toLowerCase() == apz.acft01.otherBankDOM.omniBen){
                apz.acft01.otherBankDOM.omniBenAcct = params.data[i].accountNumber;
            }
        }
    }
    apz.populateDropdown(document.getElementById("acft01__OtherBankDom__i__Domestic__toAccount"), lfrmarr);
    if (apz.acft01.otherBankDOM.sCurrentTask) {
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__toAccount", apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.toAccount);
    }
    if (apz.acft01.otherBankDOM.sAcctNo != "") {
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__toAccount", apz.acft01.otherBankDOM.sAcctNo);
        apz.acft01.otherBankDOM.continuetoVerify();
        apz.acft01.otherBankDOM.sAcctNo = "";
    }
     if ( apz.acft01.otherBankDOM.sFrom == "omniSearch") {
          apz.setElmValue("acft01__OtherBankDom__i__Domestic__amount", apz.acft01.otherBankDOM.omniAmount);
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__toAccount", apz.acft01.otherBankDOM.omniBenAcct);
       
    }
    
    apz.acft01.otherBankDOM.fetchFavouriteFTDetails();
};
apz.acft01.otherBankDOM.changeNickname = function(pThis) {
    debugger;
    var lAccNum = apz.getElmValue("acft01__OtherBankDom__i__Domestic__toAccount");
    if (lAccNum == "Add New Beneficiary") {
         $("#acft01__OtherBankDOM__sc_row_36").removeClass('sno');
        $("#acft01__OtherBankDOM__benrow1").removeClass('sno');
        $("#acft01__OtherBankDOM__benrow2").removeClass('sno');
        //$("#acft01__OtherBankDOM__benrow3").removeClass('sno');
    } else {
          $("#acft01__OtherBankDOM__sc_row_36").addClass('sno');
        $("#acft01__OtherBankDOM__benrow1").addClass('sno');
        $("#acft01__OtherBankDOM__benrow2").addClass('sno');
        //$("#acft01__OtherBankDOM__benrow3").addClass('sno');
        var lData = apz.acft01.otherBankDOM.sData;
        var lCurrVal = apz.acft01.otherBankDOM.sCurrencyVal;
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__currency", lCurrVal);
        var larrLength = lData.length;
        for (var i = 0; i < larrLength; i++) {
            if (lAccNum == lData[i].accountNumber) {
                var lAccBrnch = lData[i].branchName;
                var lIfscCode = lData[i].ifscCode;
                var lBankName = lData[i].bankName;
                var lBenName = lData[i].beneficaryName;
                apz.setElmValue("acft01__OtherBankDom__i__Domestic__ifscCode", lIfscCode);
                apz.setElmValue("acft01__OtherBankDom__i__Domestic__bankName", lBankName);
                apz.setElmValue("acft01__OtherBankDom__i__Domestic__beneficiaryName", lBenName);
            }
        }
    }
};
apz.acft01.otherBankDOM.continuetoVerify = function() {
    debugger;
    if (apz.scrMetaData.nodesMap['acft01__OtherBankDom__i__Domestic'].currRec == -1) {
        apz.scrMetaData.nodesMap['acft01__OtherBankDom__i__Domestic'].currRec = 0;
    }
    if (apz.val.validateContainer('acft01__OtherBankDOM__OtherBankDOM') == false) {
        var msg = {
            "code": 'APZ_ACFT01_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        debugger;
        apz.data.buildData("OtherBankDOM", "acft01");
        var lscreenData = {
            acft01__OtherBankDom_Req: apz.data.scrdata.acft01__OtherBankDom_Req
        };
        
        lscreenData.acft01__OtherBankDom_Req.Domestic.Document = apz.acft01.otherBankDOM.ldoc;
        lscreenData.acft01__OtherBankDom_Req.Domestic.DocumentName = apz.acft01.otherBankDOM.ldocName;
        lscreenData.acft01__OtherBankDom_Req.Domestic.DocumentType = apz.acft01.otherBankDOM.ldocType;
        
        
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "FTDOM";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "OTHERBANKDOM_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "acft01";
            //taskObj.screenId = "OtherBankDOM";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.acft01.otherBankDOM.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s Funds Transfer details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acft01.otherBankDOM.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            lUserObj.taskVariables = [{
                "name": "amount",
                "value": lscreenData.acft01__OtherBankDom_Req.Domestic.amount,
                "type": "Number"
            }, {
                "name": "user",
                "value": apz.Login.sUserId,
                "type": "String"
            }];
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "acft01__OtherBankDOM__launchMicroServiceHere",
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
            lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lReqObj.div = apz.acft01.otherBankDOM.sDiv;
            var lParams = {
                "appId": "acft01",
                "scr": "OtherBankDOMNetRes",
                "userObj": lReqObj,
                "div": apz.acft01.otherBankDOM.sDiv,
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.acft01.otherBankDOM.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acft01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                lReqObj.div = apz.acft01.otherBankDOM.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": apz.acft01.otherBankDOM.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acft01.otherBankDOM.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acft01.otherBankDOM.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acft01__OtherBankDom_Req.Domestic;
    var lJson = {};
    lJson.fromAccount = lTransferDetails.fromAccount;
    lJson.toAccount = lTransferDetails.toAccount;
    lJson.transferType = lTransferDetails.transferType;
    lJson.txnDesc = lTransferDetails.remarks;
    lJson.amount = lTransferDetails.amount;
    lJson.currency = lTransferDetails.currency;
    lJson.beneficiaryId = lTransferDetails.toAccount;
    var lReqJson = {};
    lReqJson.fundsTransferDetails = lJson;
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbtp_funds_transfer";
    lReqJson.callBack = apz.acft01.otherBankDOM.executeServiceTaskCB;
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    lReqJson.Wfdetails = lReqObj;
    // var lServerParams = {
    //     "ifaceName": "FTService",
    //     "buildReq": "N",
    //     "req": "",
    //     "paintResp": "N",
    //     "async": "true",
    //     "callBack": apz.acft01.otherBankDOM.executeServiceTaskCB,
    //     "callBackObj": {
    //         "userObj": lReqObj
    //     }
    // };
    // var req = {};
    // lServerParams.req = lReqJson;
    //apz.server.callServer(lServerParams);
    var lParams = {
        "appId": "ftserv",
        "scr": "FTService",
        "div": "acft01__OtherBankDOM__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lReqJson
    };
    apz.launchApp(lParams);
};
apz.acft01.otherBankDOM.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        //apz.acft01.otherBankDOM.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        apz.acft01.otherBankDOM.sTxnId = pResp.res.ftserv__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OtherBankDOM__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acft01.otherBankDOM.submitCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acft01.otherBankDOM.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            var lObj = {};
            lObj.referenceId = apz.acft01.otherBankDOM.sTxnId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "acft01__OtherBankDOM__divtask",
                "layout": "All"
            };
            $("#acft01__OtherBankDOM__rowheader").addClass("sno");
            apz.launchApp(lParams);
        }
    }
};
apz.acft01.otherBankDOM.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "acft01__OtherBankDOM__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OtherBankDOM__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acft01.otherBankDOM.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("acft01__OtherBankDom__i__Domestic__fromAccount")
    };
    apz.launchApp(llaunch);
};
apz.acft01.otherBankDOM.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    // var Currency = params.data.accountCurrency;
    apz.acft01.otherBankDOM.sCurrencyVal = params.data.accountCurrency;
    var param = {
            "decimalSep": ".",
            "value":  params.data.availableBalance,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    
    var CurrAmt = params.data.accountCurrency + " " + apz.formatNumber(param);
    // apz.setElmValue("acft01__OtherBankDom__i__Domestic__currency", Currency);
    apz.setElmValue("acft01__OtherBankDom__i__Domestic__balance", CurrAmt);
    $("#acft01__OtherBankDOM__sc_row_21").removeClass("sno");
};
apz.acft01.otherBankDOM.amount = function() {
    debugger;
    var convertedamt = apz.acft01.otherBankDOM.calculateRemitterAmount();
    var lAmount = parseInt(apz.getElmValue("acft01__OtherBankDom__i__Domestic__amount").replace(/[^0-9\.-]+/g, ""))
    //var lAvailableBal = parseFloat((apz.getElmValue("acft01__OtherBankDom__i__Domestic__balance").split(' ')[1]).trim());
    var lAvailableBal = (apz.getElmValue("acft01__OtherBankDom__i__Domestic__balance").split(' ')[1]).trim();
    //if (lAmount > lAvailableBal) {
    var lformatAvailbalance = apz.acft01.otherBankDOM.unformatNumber(lAvailableBal);
    if (Number(convertedamt) > Number(lformatAvailbalance)) {
        var msg = {
            "code": 'ACFT_AMOUNT',
            "callBack": apz.acft01.otherBankDOM.amountCB
        };
        apz.dispMsg(msg);
    }
};
apz.acft01.otherBankDOM.amountCB = function() {
    apz.setElmValue("acft01__OtherBankDom__i__Domestic__amount", "");
};
apz.acft01.otherBankDOM.calculateRemitterAmount = function() {
    debugger;
    var currency = apz.getElmValue("acft01__OtherBankDom__i__Domestic__currency");
    var amount = apz.getElmValue("acft01__OtherBankDom__i__Domestic__amount");
    if ((currency != "Please Select" || currency != "") && !apz.isNull(amount)) {
        amount = parseFloat(apz.acft01.otherBankDOM.unformatNumber(amount));
        var convertedamount = "";
        if (apz.acft01.otherBankDOM.sCurrencyVal == "USD") {
            if (currency == "USD") {
                var rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.20;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1.09;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.00024;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "MYR") {
                rate = 0.24;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 2.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
             else if (currency == "AED") {
                rate = 0.27;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
             else if (currency == "LEK") {
                rate = 0.0098;
                convertedamount = (amount * rate).toFixed(2);
                amount = "USD " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (apz.acft01.otherBankDOM.sCurrencyVal == "EUR") {
            if (currency == "USD") {
                var rate = 0.88;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1.11;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.21;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 2.15;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
            else if (currency == "AED") {
                rate = 0.22;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0081;
                convertedamount = (amount * rate).toFixed(2);
                amount = "EUR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        if (apz.acft01.otherBankDOM.sCurrencyVal == "GBP") {
            if (currency == "USD") {
                var rate = 0.79;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 0.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.18;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 1.90;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.20;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0070;
                convertedamount = (amount * rate).toFixed(2);
                amount = "GBP " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
        if (apz.acft01.otherBankDOM.sCurrencyVal == "OMR") {
            if (currency == "USD") {
                var rate = 0.39
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 0.53;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 0.47;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 0.095;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "OMR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "AED") {
                rate = 0.10;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEK") {
                rate = 0.0038;
                convertedamount = (amount * rate).toFixed(2);
                amount = "OMR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
        if (apz.acft01.otherBankDOM.sCurrencyVal == "MYR") {
            if (currency == "USD") {
                var rate = 4.09;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 5.43;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 4.86;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "MYR") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "LEk") {
                rate = 0.040;
                convertedamount = (amount * rate).toFixed(2);
                amount = "MYR " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        
         if (apz.acft01.otherBankDOM.sCurrencyVal == "LEK") {
            if (currency == "USD") {
                var rate = 102.25;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "GBP") {
                rate = 142.77;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "EUR") {
                rate = 123.65;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            } else if (currency == "KHR") {
                rate = 0.025;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "MYR") {
                rate = 25.29;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            else if (currency == "OMR") {
                rate = 265.60;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
             else if (currency == "AED") {
                rate = 27.84;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
            
             else if (currency == "LEK") {
                rate = 1;
                convertedamount = (amount * rate).toFixed(2);
                amount = "LEK " + apz.acft01.otherBankDOM.fnformatNumber((amount * rate).toFixed(2)) + " (Offered Rate = " + rate + ")";
            }
        }
        apz.setElmValue("acft01__OtherBankDOM__fx_amount", amount);
        return convertedamount;
    }
};
apz.acft01.otherBankDOM.unformatNumber = function(value) {
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


apz.acft01.otherBankDOM.fnformatNumber = function(value){
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
apz.acft01.otherBankDOM.changeTransferType = function() {
    var lVal = apz.getElmValue("acft01__OtherBankDom__i__Domestic__type");
    apz.hide("acft01__OtherBankDom__i__Domestic__transactionDate_ul");
    if (lVal == "Schedule Payment") {
        apz.show("acft01__OtherBankDom__i__Domestic__transactionDate_ul");
    }
};
apz.acft01.otherBankDOM.calculateTimes = function() {
    var lTimes = 120;
    var lFrequency = apz.getElmValue("acft01__OtherBankDom__i__Domestic__frequency");
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
    apz.populateDropdown(document.getElementById("acft01__OtherBankDom__i__Domestic__noOfTimes"), lfrmarr);
};
apz.acft01.otherBankDOM.calculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("acft01__OtherBankDom__i__Domestic__startDate");
    var lFrequency = apz.getElmValue("acft01__OtherBankDom__i__Domestic__frequency");
    var lTimes = apz.getElmValue("acft01__OtherBankDom__i__Domestic__noOfTimes");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lTimes)) {
        var date = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        var lNum = lFrequency * (lTimes - 1);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__endDate", date.toString("dd-MMM-yyyy"));
    }
};
apz.acft01.otherBankDOM.cancel = function() {
    debugger;
    if (apz.acft01.otherBankDOM.sFrom == "taskflow") {
        apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    } else {
        $("#acft01__Transfers__navigator").removeClass('sno');
        $("#acft01__Transfers__launchPadRow").addClass('sno');
        apz.show("acft01__Transfers__MainHead");
    }
};
apz.acft01.otherBankDOM.showChargeType = function() {
    apz.data.buildData("OtherBankDom", "acft01");
    if (apz.val.validateContainer('acft01__OtherBankDOM__OtherBankDOM') == false) {
        var msg = {
            "code": 'APZ_ACFT01_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        apz.data.loadJsonData("OtherBankDOMCharges");
        apz.hide("acft01__OtherBankDOM__transfer_details");
        apz.show("acft01__OtherBankDOM__charge_type");
        apz.hide("acft01__OtherBankDOM__ach_details");
    }
};
apz.acft01.otherBankDOM.selectedCharge = function(pObj) {
    var lRowNo = $(pObj).attr("rowno");
    var lType = apz.data.scrdata.acft01__OtherBankDOMChargeType_Res.ChargeType[lRowNo].type;
    if (lType == "ACH") {
        apz.hide("acft01__OtherBankDOM__transfer_details");
        apz.hide("acft01__OtherBankDOM__charge_type");
        apz.show("acft01__OtherBankDOM__ach_details");
    } else {
        apz.acft01.otherBankDOM.continuetoVerify();
    }
};
apz.acft01.otherBankDOM.cancelChargeSel = function() {
    apz.show("acft01__OtherBankDOM__transfer_details");
    apz.hide("acft01__OtherBankDOM__charge_type");
    apz.hide("acft01__OtherBankDOM__ach_details");
};
apz.acft01.otherBankDOM.cancelACH = function() {
    apz.hide("acft01__OtherBankDOM__transfer_details");
    apz.show("acft01__OtherBankDOM__charge_type");
    apz.hide("acft01__OtherBankDOM__ach_details");
};
apz.acft01.otherBankDOM.fetchFavouriteFTDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "favftr";
    llaunch.scr = "FTFavourite";
    llaunch.div = "acft01__OtherBankDOM__fav_ft_launcher";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchFavourites";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OtherBankDOM__fav_ft_launcher";
    llaunch.userObj.control.callBack = apz.acft01.otherBankDOM.fnFavouriteFTCB;
    llaunch.userObj.data = {
        "corpID": apz.acft01.otherBankDOM.sCorporateId,
        "userID": apz.acft01.otherBankDOM.sUserID,
        "ftType": apz.acft01.otherBankDOM.sFtType
    };
    apz.launchApp(llaunch);
};
apz.acft01.otherBankDOM.fnFavouriteFTCB = function(params) {
    debugger;
    apz.resetCurrAppId("acft01");
    try {
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__fromAccount", params.data.fromAccount);
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__toAccount", params.data.toAccount);
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__amount", apz.acft01.otherBankDOM.formatNumber(params.data.amount));
    } catch (e) {}
    apz.setElmValue("acft01__OtherBankDom__i__Domestic__transactionDate", new Date().format('d-M-Y'));
};
apz.acft01.otherBankDOM.nameFavouriteFTDetail = function() {
    var lmsg = {
        "message": "Please give the template a unique name for your reference",
        "type": "P",
        "callBack": apz.acft01.otherBankDOM.nameFavouriteFTDetailCB
    };
    apz.dispMsg(lmsg);
};
apz.acft01.otherBankDOM.nameFavouriteFTDetailCB = function(params) {
    if (params.choice) {
        var lname = params.val;
        if (!apz.isNull(lname)) {
            apz.acft01.otherBankDOM.saveFavouriteFTDetails(lname);
        } else {
            var lmsg = {
                "message": "Please enter a valid name which is not blank and has not been used to label a template before",
                "type": "E"
            };
            apz.dispMsg(lmsg);
        }
    }
}
apz.acft01.otherBankDOM.saveFavouriteFTDetails = function(pName) {
    debugger;
    var llaunch = {};
    llaunch.appId = "favftr";
    llaunch.scr = "FTFavouriteManipulate";
    llaunch.div = "acft01__OtherBankDOM__fav_ft_add_launcher";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchFavourites";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acft01__OtherBankDOM__fav_ft_add_launcher";
    llaunch.userObj.control.callBack = apz.acft01.otherBankDOM.saveFavouriteFTDetailsCB;
    llaunch.userObj.data = {
        "corpID": apz.acft01.otherBankDOM.sCorporateId,
        "userID": apz.acft01.otherBankDOM.sUserID,
        "ftType": apz.acft01.otherBankDOM.sFtType,
        "fromAccount": apz.getElmValue("acft01__OtherBankDom__i__Domestic__fromAccount"),
        "toAccount": apz.getElmValue("acft01__OtherBankDom__i__Domestic__toAccount"),
        "amount": apz.getElmValue("acft01__OtherBankDom__i__Domestic__amount"),
        "name": pName
    };
    apz.launchApp(llaunch);
};
apz.acft01.otherBankDOM.saveFavouriteFTDetailsCB = function(pResp) {
    debugger;
    apz.acft01.otherBankDOM.fetchFavouriteFTDetails();
}
apz.acft01.otherBankDOM.formatNumber = function(value) {
    var params = {};
    params.value = value;
    params.decimalSep = apz.decimalSep;
    params.mask = apz.numberMask;
    params.displayAsLiteral = "N";
    debugger;
    params.decimalPoints = apz.getDecimalPoints();
    debugger;
    value = apz.formatNumber(params);
    return value;
}
apz.acft01.otherBankDOM.fnCancelBeneficiary = function() {
    debugger;
      $("#acft01__OtherBankDOM__sc_row_36").addClass('sno');
    $("#acft01__OtherBankDOM__benrow1").addClass('sno');
    $("#acft01__OtherBankDOM__benrow2").addClass('sno');
   // $("#acft01__OtherBankDOM__benrow3").addClass('sno');
    apz.setElmValue("acft01__OtherBankDom__i__Domestic__toAccount", "Please Select");
}
apz.acft01.otherBankDOM.fnAddBeneficiary = function() {
    debugger;
    apz.setElmValue("acft01__AddBeneficiary__i__tbDbmiCorpRoleBeneficary__corporateId", apz.acft01.otherBankDOM.sCorporateId);
    var ldata = apz.data.buildData("AddBeneficiary", "acft01").acft01__AddBeneficiary_Req.tbDbmiCorpRoleBeneficary;
    ldata.beneficaryType = "Other";
    
    if (apz.getElmValue("acft01__AddBeneficiary__i__tbDbmiCorpRoleBeneficary__accountNumber") != apz.getElmValue(
        "acft01__OtherBankDOM__reEnterAccNo")) {
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
        "callBack": apz.acft01.otherBankDOM.fnAddBeneficiaryCB,
        "callBackObj": ldata,
    };
    var req = {};
    req.tbDbmiCorpRoleBeneficary = ldata
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    }
}
apz.acft01.otherBankDOM.fnAddBeneficiaryCB = function(params) {
    debugger;
    if (params.errors == undefined) {
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__ifscCode", params.callBackObj.ifscCode);
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__bankName", params.callBackObj.bankName);
        apz.setElmValue("acft01__OtherBankDom__i__Domestic__beneficiaryName", params.callBackObj.beneficaryName);
        apz.acft01.otherBankDOM.sAcctNo = params.callBackObj.accountNumber;
        $("#acft01__OtherBankDOM__benrow1 input").val("");
         $("#acft01__OtherBankDOM__benrow2 input").val("");
        apz.acft01.otherBankDOM.fetchbeneficiaryDetails();
        
    } else {
        var msg = {
            "message": "Something went wrong",
            "type": "E"
        };
        apz.dispMsg(msg);
    }
}


apz.acft01.otherBankDOM.fnBrowseUpload = function(pthis) {
    debugger;
    let fileObj = pthis.files[0];
    apz.acft01.otherBankDOM.ldocName = fileObj.name;
     apz.acft01.otherBankDOM.ldocType = fileObj.type;
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        var encodedImage = binaryStr.split(",").pop();
         apz.acft01.otherBankDOM.ldoc = encodedImage;
        // apz.acft01.otherBankDOM.fnGetBase64({
        //     encodedImage
        // })
        $("#" + pthis.id).val("");
    }
    apzFileReader.readAsDataURL(fileObj);
}


apz.acft01.otherBankDOM.continuetoVerifywithBen = function(){
    debugger;
    var lAccNum = apz.getElmValue("acft01__OtherBankDom__i__Domestic__toAccount");
    if (lAccNum == "Add New Beneficiary"){
        apz.acft01.otherBankDOM.fnAddBeneficiary();
    }
    
    else{
        apz.acft01.otherBankDOM.continuetoVerify();
    }
}
