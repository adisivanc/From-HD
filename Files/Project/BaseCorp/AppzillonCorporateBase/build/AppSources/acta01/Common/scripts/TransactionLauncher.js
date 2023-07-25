apz.acta01 = {};
apz.acta01.transactionLauncher = {};
apz.app.onLoad_TransactionLauncher = function(userObj) {
    apz.acta01.transactionLauncher.sCorporateID = apz.Login.sCorporateId;
    apz.acta01.transactionLauncher.sRoleID = apz.Login.sRoleId;
    var params = {
        "action": "account"
    };
    apz.acta01.transactionLauncher.fnRender(params);
};
apz.acta01.transactionLauncher.fnRender = function(params) {
    apz.acta01.transactionLauncher.fnRenderData(params);
    apz.acta01.transactionLauncher.fnRenderActionButtons(params);
};
apz.acta01.transactionLauncher.fnRenderActionButtons = function(params) {
    if (params.action == "account") {
        $("#acta01__TransactionLauncher__AccountList").css("cursor", "pointer");
    }
};
apz.acta01.transactionLauncher.fnRenderData = function(params) {
    debugger;
    if (params.action == "account") {
        apz.acta01.transactionLauncher.sAction = "account";
        var llaunch = {};
        llaunch.appId = "roleAc";
        llaunch.scr = "RoleAccountDetails";
        llaunch.div = "acta01__TransactionLauncher__Transaction_launch";
        llaunch.layout = "All";
        llaunch.userObj = {};
        llaunch.userObj.action = "FetchRoleAccount";
        llaunch.userObj.control = {};
        llaunch.userObj.control.destroyDiv = "acta01__TransactionLauncher__Transaction_launch";
        llaunch.userObj.control.callBack = apz.acta01.transactionLauncher.fnRoleAccountCB;
        llaunch.userObj.data = {
            "corpID": apz.acta01.transactionLauncher.sCorporateID,
            "roleID": apz.acta01.transactionLauncher.sRoleID
        };
        apz.launchApp(llaunch);
    }
};
apz.acta01.transactionLauncher.fnRoleAccountCB = function(params) {
    debugger;
    if (params.status) {
        apz.resetCurrAppId("acta01");
        apz.data.scrdata.acta01__RoleAccountDetails_Res = {};
        apz.data.scrdata.acta01__RoleAccountDetails_Res.accountDetails = [];
        apz.data.scrdata.acta01__RoleAccountDetails_Res.accountDetails = params.data;
        apz.data.loadData("RoleAccountDetails", "acta01");
        if (params.data.length > 16) {
            $("#acta01__TransactionLauncher__AccountList_pagination_ul").removeClass("sno");
        } else {
            $("#acta01__TransactionLauncher__AccountList_pagination_ul").addClass("sno");
        }
    }
};
apz.acta01.transactionLauncher.fnOnAccountSummary = function(pObj) {
    debugger;
    var lRow = parseInt(pObj.id.split("_")[6]);
    var lAccNo = $("#acta01__RoleAccountDetails__o__accountDetails__accountNo_" + lRow).text();
    var params = {};
    params.appId = "acta01";
    params.scr = "TransactionSummary";
    params.userObj = {
        "data": {
            "accountNo": lAccNo
        }
    };
    params.div = "acta01__TransactionLauncher__Transaction_launch";
    params.layout = "All";
    apz.launchSubScreen(params);
    $("#acta01__TransactionLauncher__Transaction_master").addClass("sno");
};
apz.acta01.transactionLauncher.fnOnAccountDetailsSel = function(pObj,event) {
    debugger;
    var lRow = parseInt(pObj.id.split("_")[5]);
    var lAccNo = $("#acta01__RoleAccountDetails__o__accountDetails__accountNo_" + lRow).text();
    var params = {};
    params.appId = "acta01";
    params.scr = "TransactionDetails";
    params.userObj = {
        "data": {
            "accountNo": lAccNo
        }
    };
    params.div = "acta01__TransactionLauncher__Transaction_launch";
    params.layout = "All";
    apz.launchSubScreen(params);
    $("#acta01__TransactionLauncher__Transaction_master").addClass("sno");
    event.stopPropagation();
};
apz.acta01.transactionLauncher.fnSearch = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acta01__TransactionLauncher__SearchBy");
        var lInput = apz.getElmValue("acta01__TransactionLauncher__SearchValue");
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "AccountNo") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "AccountNo";
            }
        } else if (lType == "AccountType") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "AccountType";
            }
        }
        if (flag) {
            apz.acta01.transactionLauncher.sAction = "account";
            var llaunch = {};
            llaunch.appId = "roleAc";
            llaunch.scr = "RoleAccountDetails";
            llaunch.div = "acta01__TransactionLauncher__Transaction_launch";
            llaunch.layout = "All";
            llaunch.userObj = {};
            llaunch.userObj.action = "FetchRoleAccount";
            llaunch.userObj.control = {};
            llaunch.userObj.control.destroyDiv = "acta01__TransactionLauncher__Transaction_launch";
            llaunch.userObj.control.callBack = apz.acta01.transactionLauncher.fnRoleAccountCB;
            llaunch.userObj.data = {
                "corpID": apz.acta01.transactionLauncher.sCorporateID,
                "roleID": apz.acta01.transactionLauncher.sRoleID,
                "type": lSearchType,
                "value": lInput
            };
            apz.launchApp(llaunch);
        }
    }
};
