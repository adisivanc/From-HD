apz.card01.newCardRequest = {};
apz.card01.newCardRequest.sAction = "";
apz.app.onLoad_NewCardRequest = function(userObj) {
    debugger;
    apz.card01.newCardRequest.sMasterAccountNo = userObj.data.masterAccount;
    apz.card01.newCardRequest.sMasterAccountName = userObj.data.accountName;
    apz.card01.newCardRequest.sCategory = userObj.data.category;
    //  apz.Login.sUserId = "user0001";
    //  apz.Login.sCorporateId = "000FTAC4321";
    var params = {
        "action": "Launch"
    };
    apz.card01.newCardRequest.fnRender(params);
};
apz.app.onShown_NewCardRequest = function(userObj) {
    debugger;
    apz.card01.cards.fnAdjustHeight();
};
apz.card01.newCardRequest.fnRender = function(params) {
    apz.card01.newCardRequest.fnRenderData(params);
    apz.card01.newCardRequest.fnRenderActionButtons(params);
};
apz.card01.newCardRequest.fnRenderActionButtons = function(params) {
    if (params.action == "Launch") {
        
        $("#card01__Cards__BreadcrumbBtn3").parent().removeClass("sno");
        $(".active").removeClass("active");
        $("#card01__Cards__BreadcrumbBtn3").parent().addClass("active");
        $("#card01__Cards__BreadcrumbBtn3").text("New Card Request");
        if (apz.card01.newCardRequest.sCategory == "Virtual Cards") {
            $("#card01__NewCardRequest__i__cardDetails__cashLimit_ul").addClass("sno");
        } else if (apz.card01.newCardRequest.sCategory == "Travel Cards") {
            $("#card01__NewCardRequest__i__cardDetails__userType_ul").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__emailId_ul").addClass("sno");
        } else {
            $("#card01__NewCardRequest__i__cardDetails__validity_ul").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__userType_ul").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__userType_ul").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__emailId_ul").addClass("sno");
        }
    }
};
apz.card01.newCardRequest.fnRenderData = function(params) {
    if (params.action == "Launch") {
        apz.setElmValue("card01__NewCardRequest__i__cardDetails__masterAccount", apz.card01.newCardRequest.sMasterAccountNo);
        
         var strlen = apz.card01.newCardRequest.sMasterAccountNo;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = apz.card01.newCardRequest.sMasterAccountNo;
                var result = apz.getMaskedValue(strlen, laccNo);
                
        
        apz.setElmValue("card01__NewCardRequest__i__cardDetails__maskAccNo", result);
        
        
        
    }
};
apz.card01.newCardRequest.fnNewRequest = function() {
    debugger;
    if (apz.val.validateScreen("NewCardRequest")) {
        if (apz.card01.newCardRequest.sCategory == "Virtual Cards") {
            if (apz.card01.newCardRequest.fnValidateEmail()) {
                apz.card01.newCardRequest.fnCard();
            } else {
                var param = {};
                param.message = "Please enter valid Email";
                param.code = "E";
                apz.dispMsg(param);
            }
        } else {
            apz.card01.newCardRequest.fnCard();
        }
    } else {
        var lMsg = {};
        lMsg.message = "Please enter all mandatory fields";
        lMsg.code = "E";
        apz.dispMsg(lMsg);
    }
};
apz.card01.newCardRequest.fnValidateEmail = function() {
    var lStatus = true;
    var lEmail = apz.getElmValue("card01__NewCardRequest__i__cardDetails__emailId");
    var atpos = lEmail.indexOf("@");
    var dotpos = lEmail.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= lEmail.length) {
        lStatus = false;
    }
    return lStatus;
};
apz.card01.newCardRequest.fnCard = function() {
     var lscreenData = apz.data.buildData("NewCardRequest", "card01");
    var taskObj = {};
    taskObj.workflowId = "CCIN";
    //taskObj.stageId = "INPUT";
    taskObj.status = "U";
    //taskObj.userId = apz.Login.sUserId;
    taskObj.taskType = "REQUEST_NEW_CARD";
    taskObj.versionNo = "1";
    //taskObj.appId = "card01";
    //taskObj.screenId = "NewCardRequest";
    taskObj.screenData = JSON.stringify(lscreenData);
    //taskObj.stageSeqNo = 1;
    taskObj.action = "";
    taskObj.referenceId = apz.Login.sCorporateId + "__" + apz.Login.sUserId;
    taskObj.taskDesc = "New Card has been added with referenceId" + taskObj.referenceId;
    //taskObj.createUserId = apz.Login.sUserId;
    //taskObj.createUserId = apz.Login.sUserId;
    var lUserObj = {};
    lUserObj.taskDetails = taskObj;
    lUserObj.callBack = apz.card01.newCardRequest.workflowMicroServiceCB;
    lUserObj.operation = "NEWWORKFLOW";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "card01__NewCardRequest__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.card01.newCardRequest.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "card01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.data = {};
                lObj.data.masterAccount = apz.card01.newCardRequest.sMasterAccountNo;
                lObj.data.accountName = apz.card01.newCardRequest.sMasterAccountName;
                lObj.data.category = apz.card01.newCardRequest.sCategory;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "card01__Cards__CardLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "card01__Cards__CardLauncher",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};
apz.card01.newCardRequest.fnCancel = function() {
    /*var params = {};
    params.appId = "card01";
    params.scr = "AccountDetails";
    pa
    params.userObj = {
        "data": {
            "accountNo": apz.card01.newCardRequest.sMasterAccountNo,
            "category": apz.card01.categoryDetails.sCategory,
            "corporateID": apz.card01.categoryDetails.sCorporateID
        }
    };
    params.div = "card01__Cards__CardLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);*/
    $("#card01__Cards__BreadcrumbBtn2").trigger("click");
};
