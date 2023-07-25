apz.siint1.otherBankINT = {};
apz.siint1.otherBankINT.sCurrentWfDetails = {};
apz.siint1.otherBankINT.sData = {};
apz.app.onLoad_SIOtherBankINT = function(lParams) {
    debugger;
    apz.hide("acsi01__NewSI__SIRowSub");
    apz.siint1.otherBankINT.sCorporateId = apz.Login.sCorporateId;
    apz.siint1.otherBankINT.sRoleId = apz.Login.sRoleId;
    apz.siint1.otherBankINT.fetchDetails();
    apz.setElmValue("siint1__OtherBankInt__i__International__startDate", new Date().format('d/m/Y'));
    if (!apz.isNull(lParams.International)) {
        apz.data.scrdata.siint1__OtherBankInt_Req = lParams;
        apz.data.loadData("OtherBankInt", "siint1");
    }
};
apz.siint1.otherBankINT.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "siint1__SIOtherBankINT__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "siint1__SIOtherBankINT__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.siint1.otherBankINT.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.siint1.otherBankINT.sCorporateId,
        "roleID": apz.siint1.otherBankINT.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.siint1.otherBankINT.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("siint1");
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
    apz.populateDropdown(document.getElementById("siint1__OtherBankInt__i__International__fromAccount"), lfrmarr);
    apz.siint1.otherBankINT.fetchbeneficiaryDetails();
};
apz.siint1.otherBankINT.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "siint1__SIOtherBankINT__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "siint1__SIOtherBankINT__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.siint1.otherBankINT.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.siint1.otherBankINT.sCorporateId,
        "beneficaryType": "International",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.siint1.otherBankINT.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("siint1");
    apz.siint1.otherBankINT.sData = params.data;;
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
    
    // for (var i = 0; i < larrLength; i++) {
    //     var lfrmacc = {
    //         "val": params.data[i].accountNumber,
    //         "desc": params.data[i].beneficaryName + "-" + params.data[i].accountNumber
    //     };
    //     lfrmarr.push(lfrmacc);
    // }
    apz.populateDropdown(document.getElementById("siint1__OtherBankInt__i__International__toAccount"), lfrmarr);
};
apz.siint1.otherBankINT.changeNickname = function(pThis) {
    debugger;
    var lData = apz.siint1.otherBankINT.sData;
    var larrLength = lData.length;
    var lAccNum = apz.getElmValue("siint1__OtherBankInt__i__International__toAccount");
    for (var i = 0; i < larrLength; i++) {
        if (lAccNum == lData[i].accountNumber) {
            var lBenName = lData[i].beneficaryName;
            var lBenAddress = lData[i].benAddress;
            var lBenCountry = lData[i].benCountry;
            var lLswiftCode = lData[i].swiftCode;
            var lLBankName = lData[i].bankName;
            var lInterSwiftCode = lData[i].interSwiftCode;
            var lInterBankName = lData[i].interBankName;
            apz.setElmValue("siint1__OtherBankInt__i__International__beneficaryName", lBenName);
            apz.setElmValue("siint1__OtherBankInt__i__International__benAddress", lBenAddress);
            apz.setElmValue("siint1__OtherBankInt__i__International__benCountry", lBenCountry);
            apz.setElmValue("siint1__OtherBankInt__i__International__swiftCode", lLswiftCode);
            apz.setElmValue("siint1__OtherBankInt__i__International__bankName", lLBankName);
            apz.setElmValue("siint1__OtherBankInt__i__International__interSwiftCode", lInterSwiftCode);
            apz.setElmValue("siint1__OtherBankInt__i__International__interBankName", lInterBankName);
        }
    }
};
apz.siint1.otherBankINT.continuetoVerify = function() {
    debugger;
    if (apz.scrMetaData.nodesMap['siint1__OtherBankInt__i__International'].currRec == -1) {
        apz.scrMetaData.nodesMap['siint1__OtherBankInt__i__International'].currRec = 0;
    }
    if (apz.val.validateContainer('siint1__SIOtherBankINT__OtherBankINT') == false) {
        var msg = {
            "code": 'APZ_siint1_MANDATORY'
        };
        apz.dispMsg(msg);
    } else {
        debugger;
        var lscreenData = apz.data.buildData("OtherBankInt", "siint1");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "SIINT";
            //taskObj.stageId = "DETAILS";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "OTHERBANKINT_DETAILS";
            taskObj.versionNo = "1";
            //taskObj.appId = "siint1";
            //taskObj.screenId = "SIOtherBankINT";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            //taskObj.createUserId = apz.Login.sUserId;
            taskObj.referenceId = apz.siint1.otherBankINT.sCorporateId + "__" + taskObj.workflowId;
            taskObj.taskDesc = taskObj.referenceId + "'s SI details have been submitted";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.siint1.otherBankINT.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "siint1__SIOtherBankINT__launchMicroServiceHere",
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
                "appId": "siint1",
                "scr": "OtherBankINTVerify",
                "userObj": lReqObj,
                "div": "acsi01__NewSI__launchPad",
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.siint1.otherBankINT.workflowMicroServiceCB = function(pNextStageObj) {
    apz.currAppId = "acft01";
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
                    "div": "acsi01__NewSI__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acft01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};
apz.siint1.otherBankINT.getAmount = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acclt";
    llaunch.scr = "AccountDetails";
    llaunch.div = "siint1__SIOtherBankINT__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "siint1__SIOtherBankINT__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.siint1.otherBankINT.getAmountCB;
    llaunch.userObj.data = {
        "accountNo": apz.getElmValue("siint1__OtherBankInt__i__International__fromAccount")
    };
    apz.launchApp(llaunch);
};
apz.siint1.otherBankINT.getAmountCB = function(params) {
    debugger;
    apz.resetCurrAppId("siint1");
    var CurrAmt = params.data.accountCurrency + " " + params.data.availableBalance;
    apz.setElmValue("siint1__SIOtherBankINT__amountVal", CurrAmt);
    $("#siint1__SIOtherBankINT__sc_row_28").removeClass("sno");
};
apz.siint1.otherBankINT.amount = function() {
    debugger;
    var lAmount = parseFloat((apz.getElmValue("siint1__OtherBankInt__i__International__amount")).trim());
    var lAvailableBal = parseFloat((apz.getElmValue("siint1__SIOtherBankINT__amountVal").split(' ')[1]).trim());
    if (lAmount > lAvailableBal) {
        var msg = {
            "code": 'ACFT_AMOUNT',
            "callBack": apz.siint1.otherBankINT.amountCB
        };
        apz.dispMsg(msg);
    }
};
apz.siint1.otherBankINT.amountCB = function() {
    apz.setElmValue("siint1__OtherBankInt__i__International__amount", "");
};
apz.siint1.otherBankINT.calculateTimes = function() {
    var lTimes = 120;
    var lFrequency = apz.getElmValue("siint1__OtherBankInt__i__International__frequency");
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
    apz.populateDropdown(document.getElementById("siint1__OtherBankInt__i__International__noOfTimes"), lfrmarr);
};
apz.siint1.otherBankINT.calculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("siint1__OtherBankInt__i__International__startDate");
    
     var initial = apz.formatDate({
            "val": lStartDate,
            "fromFormat": "dd/MM/yyyy",
            "toFormat": "yyyy/MM/dd"
        });
    var lFrequency = apz.getElmValue("siint1__OtherBankInt__i__International__frequency");
    var lTimes = apz.getElmValue("siint1__OtherBankInt__i__International__noOfTimes");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lTimes)) {
        // var date = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        // var lNum = lFrequency * (lTimes - 1);
        // var lMon = date.getMonth() + lNum;
        // var lEnddate = date.setMonth(lMon);
        // apz.setElmValue("siint1__OtherBankInt__i__International__endDate", date.toString("dd-MMM-yyyy"));
        // var nxtdate = Date.parseExact(encodeURIComponent(lStartDate), "dd-MMM-yyyy");
        // nxtdate.setMonth(lFrequency);
        // apz.setElmValue("siint1__OtherBankInt__i__International__nextExecutionDate", nxtdate.toString("dd-MMM-yyyy"));
        
        var date = new Date(initial);
        var lNum = lFrequency * (lTimes);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("siint1__OtherBankInt__i__International__endDate", new Date(lEnddate).toString("dd/MM/yyyy"));
        var nxtdate = new Date(initial);
        nxtdate.setMonth(lFrequency);
         apz.setElmValue("siint1__OtherBankInt__i__International__nextExecutionDate", new Date(nxtdate).toString("dd/MM/yyyy"));
    }
};
apz.siint1.otherBankINT.cancel = function() {
    debugger;
    $("#acsi01__NewSI__MainRow").removeClass('sno');
    $("#acsi01__NewSI__launchPad").addClass('sno');
    apz.show("acsi01__NewSI__SIRowSub");
};
