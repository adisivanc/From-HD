apz.acdp01.liquidateFD = {};
apz.app.onLoad_LiquidateFD = function(params) {
    debugger;
    apz.acdp01.liquidateFD.sCorporateId = apz.Login.sCorporateId;
    apz.acdp01.liquidateFD.sRoleId = apz.Login.sRoleId;
    if(params.data!=undefined){
        apz.acdp01.liquidateFD.lScrrefno = params.data.RefNo;
    }
     
    apz.acdp01.liquidateFD.fetchDetails(apz.acdp01.liquidateFD.sCorporateId);
};
apz.acdp01.liquidateFD.fetchDetails = function(pCorpId) {
    debugger;
    var lServerParams = {
        "ifaceName": "LiquidateFD_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acdp01.liquidateFD.fetchDetailsCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpDeposits = {};
    req.tbDbmiCorpDeposits.corporateId = pCorpId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acdp01.liquidateFD.fetchDetailsCB = function(pResp) {
    debugger;
    apz.resetCurrAppId("acdp01");
    apz.acdp01.liquidateFD.sDetails = pResp.res.acdp01__LiquidateFD_Req.tbDbmiCorpDeposits;
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var larrLength = pResp.res.acdp01__LiquidateFD_Req.tbDbmiCorpDeposits.length;
    for (var i = 0; i < larrLength; i++) {
        
        var strlen = pResp.res.acdp01__LiquidateFD_Req.tbDbmiCorpDeposits[i].refNum
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = pResp.res.acdp01__LiquidateFD_Req.tbDbmiCorpDeposits[i].refNum
        var result = apz.getMaskedValue(strlen, laccNo);
        
        var lfrmacc = {
            "val": pResp.res.acdp01__LiquidateFD_Req.tbDbmiCorpDeposits[i].refNum,
            "desc": result
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("acdp01__LiquidateFD__depositRef"), lfrmarr);
    apz.setElmValue("acdp01__LiquidateFD__depositRef",apz.acdp01.liquidateFD.lScrrefno);
    apz.acdp01.liquidateFD.fetchAccDetails();
};
apz.acdp01.liquidateFD.fetchAccDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.div = "acdp01__LiquidateFD__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acdp01__LiquidateFD__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acdp01.liquidateFD.fnRoleAccountCB;
    llaunch.userObj.data = {
        "corpID": apz.acdp01.liquidateFD.sCorporateId,
        "roleID": apz.acdp01.liquidateFD.sRoleId
    };
    apz.launchApp(llaunch);
};
apz.acdp01.liquidateFD.fnRoleAccountCB = function(params) {
    debugger;
    apz.resetCurrAppId("acdp01");
    var lfrmarr = [];
    var lObj = {
        "val": "Select Another Account",
        "desc": "Select Another Account"
    };
    lfrmarr.push(lObj);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        
        var strlen = params.data[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = params.data[i].accountNo
        var result = apz.getMaskedValue(strlen, laccNo);
        
        var lfrmacc = {
            "val": params.data[i].accountNo,
            "desc": result
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__principalCreditAcno"), lfrmarr);
};
apz.acdp01.liquidateFD.showData = function() {
    debugger;
    var lRefNum = apz.getElmValue("acdp01__LiquidateFD__depositRef");
    for (var i = 0; i < apz.acdp01.liquidateFD.sDetails.length; i++) {
        if (apz.acdp01.liquidateFD.sDetails[i].refNum == lRefNum) {
            apz.data.scrdata.acdp01__LiquidateFDDummy_Req = {};
            apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits = apz.acdp01.liquidateFD.sDetails[i];
        }
    }
    apz.setElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__refNum", lRefNum);
    apz.data.loadData("LiquidateFDDummy", "acdp01");
    apz.setElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__principalCreditAcno", apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits
        .principalCreditAcno);
    apz.acdp01.liquidateFD.getRevisedIR();
};
apz.acdp01.liquidateFD.getRevisedIR = function() {
    debugger;
    var principal = parseInt(apz.getElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__depositAmount").replace(/[^0-9\.-]+/g, ""));
    var roi = apz.getElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__roi") - 1;
    var Roi = (apz.getElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__roi") - 1) / 100;
    var CompoundedInterest = apz.getElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__interestPayable");
    var lObj = {
        "val": apz.getElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__startDate"),
        "fromFormat": "d-MMM-yyyy",
        "toFormat": "M/dd/yyyy"
    };
    lObj.val = apz.getElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__startDate");
    var firstDate = apz.formatDate(lObj);
    if (!apz.isNull(principal) && !apz.isNull(Roi) && !apz.isNull(CompoundedInterest)) {
        var n = 12 / CompoundedInterest;
        var startDay = new Date(firstDate);
        var endDay = new Date();
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = endDay.getTime() - startDay.getTime();
        var days = Math.abs(millisBetween / millisecondsPerDay);
        var t = days / 365;
        var A = principal * Math.pow((1 + (Roi / n)), (n * t));
        var totalAmount = Math.round(A * 100) / 100;
        var lInterestAmt = Math.round((totalAmount - principal) * 100) / 100;
        apz.setElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__revisedInterestRate", roi);
        //    apz.setElmValue("acdp01__LiquidateFD__penalty", Roi);
        apz.setElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__revisedInterest", lInterestAmt);
        var param = {
            "decimalSep": ".",
            "value":  totalAmount,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
        apz.setElmValue("acdp01__LiquidateFDDummy__i__tbDbmiCorpDeposits__liquidationAmt", apz.formatNumber(param));
    }
};
apz.acdp01.liquidateFD.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("LiquidateFDDummy", "acdp01");
    if (!apz.mockServer) {
        var taskObj = {};
        taskObj.workflowId = "LIDP";
        //taskObj.stageId = "VERIFY";
        taskObj.status = "U";
        //taskObj.userId = apz.Login.sUserId;
        taskObj.taskType = "LIQUIDATEFD_VERIFY";
        taskObj.versionNo = "1";
        //taskObj.appId = "acdp01";
        //taskObj.screenId = "LiquidateFD";
        taskObj.screenData = JSON.stringify(lscreenData);
        //taskObj.stageSeqNo = 1;
        taskObj.action = "";
        //taskObj.createUserId = apz.Login.sUserId;
        taskObj.referenceId = apz.acdp01.liquidateFD.sCorporateId + "__" + taskObj.workflowId;
        taskObj.taskDesc = taskObj.referenceId + "'s FD details have been submitted";
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.acdp01.liquidateFD.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__LiquidateFD__launchMicroServiceHere",
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
            "appId": "acdp01",
            "scr": "LiquidateFDApprove",
            "userObj": lReqObj,
            "div": "acdp01__LiquidateFD__FDLaunchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acdp01.liquidateFD.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acdp01";
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
                    "div": "acdp01__LiquidateFD__FDLaunchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
};
