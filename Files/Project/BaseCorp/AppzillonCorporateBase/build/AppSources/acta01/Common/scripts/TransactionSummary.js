apz.acta01.transactionSummary = {};
apz.acta01.transactionSummary.sAction = "";
apz.app.onLoad_TransactionSummary = function(userObj) {
    apz.acta01.transactionSummary.sCorporateID = apz.Login.sCorporateId;
    apz.acta01.transactionSummary.sRoleID = apz.Login.sRoleId;
    apz.acta01.transactionSummary.sAccountNo = userObj.data.accountNo;
    var params = {
        "action": "account"
    };
    apz.acta01.transactionSummary.fnRender(params);
};
apz.acta01.transactionSummary.fnRender = function(params) {
    apz.acta01.transactionSummary.fnRenderData(params);
    apz.acta01.transactionSummary.fnRenderActionButtons(params);
};
apz.acta01.transactionSummary.fnRenderActionButtons = function(params) {
    if (params.action == "account") {
        $("#acta01__TransactionSummary__TransactionSummaryList").css("cursor", "pointer");
        $("#acta01__TransactionLauncher__Transaction_header").addClass("sno");
    }
};
apz.acta01.transactionSummary.fnRenderData = function(params) {
    debugger;
    if (params.action == "account") {
        apz.acta01.transactionSummary.sAction = "account";
        var llaunch = {};
        llaunch.appId = "acclt";
        llaunch.scr = "AccountDetails";
        llaunch.div = "acta01__TransactionSummary__TransactionSummaryLaunch";
        llaunch.layout = "All";
        llaunch.userObj = {};
        llaunch.userObj.action = "";
        llaunch.userObj.control = {};
        llaunch.userObj.control.destroyDiv = "acta01__TransactionSummary__TransactionSummaryLaunch";
        llaunch.userObj.control.callBack = apz.acta01.transactionSummary.fnRoleAccountDetailsCB;
        llaunch.userObj.data = {
            "accountNo": apz.acta01.transactionSummary.sAccountNo
        };
        apz.launchApp(llaunch);
    }
};
apz.acta01.transactionSummary.fnRoleAccountDetailsCB = function(params) {
    debugger;
    if (params.status) {
        apz.resetCurrAppId("acta01");
        apz.data.scrdata.acta01__FetchAccountDetails_Res = {};
        apz.data.scrdata.acta01__FetchAccountDetails_Res.accountDetails = {};
        apz.data.scrdata.acta01__FetchAccountDetails_Res.accountDetails = params.data;
        apz.data.loadData("FetchAccountDetails", "acta01");
        apz.acta01.transactionSummary.fnFetchTransactionSummary(params.data.accountNo);
    }
};
apz.acta01.transactionSummary.fnFetchTransactionSummary = function(lAccNo) {
    apz.acta01.transactionSummary.sAction = "summary";
    var req = {};
    req.transactionDetails = {
        "accountno": lAccNo,
        "queryType": "Summary"
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_account_transactions";
    var lParams = {
        "ifaceName": "TransactionDetails",
        "paintResp": "Y",
        "appId": "acta01",
        "buildReq": "N",
        "lReq": req
    };
    apz.acta01.transactionSummary.fnBeforCallServer(lParams);
};
apz.acta01.transactionSummary.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acta01.transactionSummary.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acta01.transactionSummary.callServerCB = function(params) {
    debugger;
    if (apz.acta01.transactionSummary.sAction == "summary") {
        apz.acta01.transactionSummary.fnFetchTransactionSummaryCB(params);
    }
};
apz.acta01.transactionSummary.fnFetchTransactionSummaryCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acta01__TransactionDetails_Res.Status) {
            apz.acta01.transactionSummary.fnRenderIndicator();
            if (params.res.acta01__TransactionDetails_Res.accountTransactionSummary.length > 5) {
                $("#acta01__TransactionSummary__SummaryList_pagination_ul").removeClass("sno");
            } else {
                $("#acta01__TransactionSummary__SummaryList_pagination_ul").addClass("sno");
            }
        } else {
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.acta01.transactionSummary.fnViewDetails = function() {
    var params = {};
    params.appId = "acta01";
    params.scr = "TransactionDetails";
    params.div = "acta01__TransactionLauncher__Transaction_launch";
    params.layout = "All";
    params.userObj = {
        "data": {
            "accountNo": apz.acta01.transactionSummary.sAccountNo
        }
    };
    apz.launchSubScreen(params);
};
apz.acta01.transactionSummary.fnRenderIndicator = function() {
    debugger;
    for (var i = 0; i < apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionSummary.length; i++) {
        if (!apz.isNull(apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionSummary[i].indicator)) {
            apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionSummary[i].indicator = apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionSummary[
                i].indicator + ".png";
        }
    }
    apz.data.loadData("TransactionDetails", "acta01");
};
apz.acta01.transactionSummary.fnCancel = function() {
    $("#acta01__TransactionLauncher__Transaction_master").removeClass("sno");
    $("#acta01__TransactionLauncher__Transaction_header").removeClass("sno");
    $("#acta01__TransactionLauncher__Transaction_launch").html("");
};
