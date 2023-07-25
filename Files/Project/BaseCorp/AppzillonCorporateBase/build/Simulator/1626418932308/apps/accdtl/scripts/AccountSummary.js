apz.accdtl = {};
apz.accdtl.accountSummary = {};
apz.accdtl.accountSummary.sAction = "";
apz.app.onLoad_AccountSummary = function(userObj) {
     $("body").removeClass("dbcls");
    apz.accdtl.accountSummary.sCorporateID = apz.Login.sCorporateId;
    apz.accdtl.accountSummary.sRoleID = apz.Login.sRoleId;
    var params = {
        "action": "account"
    };
    apz.accdtl.accountSummary.fnRender(params);
};
apz.accdtl.accountSummary.fnRender = function(params) {
    apz.accdtl.accountSummary.fnRenderData(params);
    apz.accdtl.accountSummary.fnRenderActionButtons(params);
};
apz.accdtl.accountSummary.fnRenderActionButtons = function(params) {
    if (params.action == "account") {
        $("#accdtl__AccountSummary__AccountList").css("cursor", "pointer");
    }
};
apz.accdtl.accountSummary.fnRenderData = function(params) {
    debugger;
    if (params.action == "account") {
        apz.accdtl.accountSummary.sAction = "account";
        var llaunch = {};
        llaunch.appId = "roleAc";
        llaunch.scr = "RoleAccountDetails";
        llaunch.div = "accdtl__AccountSummary__AccountLaunch";
        llaunch.layout = "All";
        llaunch.userObj = {};
        llaunch.userObj.action = "FetchRoleAccount";
        llaunch.userObj.control = {};
        llaunch.userObj.control.destroyDiv = "accdtl__AccountSummary__AccountLaunch";
        llaunch.userObj.control.callBack = apz.accdtl.accountSummary.fnRoleAccountCB;
        llaunch.userObj.data = {
            "corpID": apz.accdtl.accountSummary.sCorporateID,
            "roleID": apz.accdtl.accountSummary.sRoleID
        };
        apz.launchApp(llaunch);
    }
};
apz.accdtl.accountSummary.fnRoleAccountCB = function(params) {
    debugger;
    if (params.status) {
        apz.resetCurrAppId("accdtl");
        apz.data.scrdata.accdtl__RoleAccountDetails_Res = {};
        apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails = [];
        apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails = params.data;
        for (var i = 0; i < apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails.length; i++) {
            apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails[i].currentBalance = apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails[i].availableBalance;
            
            
            var strlen = apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        //apz.setElmValue("accdtl__FetchAccountDetails__o__accountDetails__accountNo", result);
            
            apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails[i].maskAccNo = result;
              if (apz.deviceGroup == "Mobile") {
                $("#accdtl__AccountSummary__el_btn_1_" + i).addClass("sno");
            }
        }
        apz.data.loadData("RoleAccountDetails", "accdtl");
        if (params.data.length > 16) {
            $("#accdtl__AccountSummary__AccountList_pagination_ul").removeClass("sno");
        } else {
            $("#accdtl__AccountSummary__AccountList_pagination_ul").addClass("sno");
        }
    //      if (apz.deviceGroup == "Mobile") {
    //   $("#accdtl__AccountSummary__ct_lst_1_pagination_ul").addClass("sno");
    //      }
    debugger;
        apz.data.scrdata.accdtl__AccountsChartDummy_Res = {};
        var chkAccCount = 0;
         var curAccCount = 0;
        var savAccCount = 0;
       // apz.data.scrdata.accdtl__AccountsChartDummy_Res.tbDbmiCorpRoleAccount = apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails;
        var chartData = apz.data.scrdata.accdtl__RoleAccountDetails_Res.accountDetails;
       var chartDataResult =chartData.slice(0,5);
        
        for(var m=0;m<chartDataResult.length;m++){
            if(chartDataResult[m].accountType == "Savings"){
                savAccCount = savAccCount + 1;
                 chartDataResult[m].chatLabel =  "Sav " +savAccCount+" "+chartDataResult[m].accountCurrency;
            }
            
            if(chartDataResult[m].accountType == "Checking"){
                chkAccCount = chkAccCount + 1;
                chartDataResult[m].chatLabel = "Chk " +chkAccCount+" "+chartDataResult[m].accountCurrency;
            }
            
            if(chartDataResult[m].accountType == "Current"){
                curAccCount = curAccCount + 1;
                chartDataResult[m].chatLabel = "Cur "+curAccCount+" "+chartDataResult[m].accountCurrency;
            }
           
        }
        apz.data.scrdata.accdtl__AccountsChartDummy_Res.tbDbmiCorpRoleAccount = chartDataResult;
        apz.data.loadData("AccountsChartDummy", "accdtl");
    }
    apz.accdtl.accountSummary.getPersonaDashboard();
};
apz.accdtl.accountSummary.fnOnAccountSelect = function(pObj, event) {
    debugger;
    var lRow = parseInt(pObj.id.split("_")[6]);
    var lAccNo = $("#accdtl__RoleAccountDetails__o__accountDetails__accountNo_" + lRow).text();
    var params = {};
    params.appId = "accdtl";
    params.scr = "AccountView";
    params.userObj = {
        "data": {
            "accountNo": lAccNo
        }
    };
    params.div = "accdtl__AccountSummary__AccountLaunch";
     if (apz.deviceGroup == "Mobile") {
        
            params.layout = "Mobile";
        }
        else{
            params.layout = "All";
        }
    //params.layout = "All";
    apz.launchSubScreen(params);
    $("#accdtl__AccountSummary__AccountDetailsMaster").addClass("sno");
};
apz.accdtl.accountSummary.fnSearch = function(event,searchby,searchvalue) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("accdtl__AccountSummary__"+searchby);
        var lInput = apz.getElmValue("accdtl__AccountSummary__"+searchvalue);
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
            apz.accdtl.accountSummary.sAction = "account";
            var llaunch = {};
            llaunch.appId = "roleAc";
            llaunch.scr = "RoleAccountDetails";
            llaunch.div = "accdtl__AccountSummary__AccountLaunch";
            llaunch.layout = "All";
            llaunch.userObj = {};
            llaunch.userObj.action = "FetchRoleAccount";
            llaunch.userObj.control = {};
            llaunch.userObj.control.destroyDiv = "accdtl__AccountSummary__AccountLaunch";
            llaunch.userObj.control.callBack = apz.accdtl.accountSummary.fnRoleAccountCB;
            llaunch.userObj.data = {
                "corpID": apz.accdtl.accountSummary.sCorporateID,
                "roleID": apz.accdtl.accountSummary.sRoleID,
                "type": lSearchType,
                "value": lInput
            };
            apz.launchApp(llaunch);
        }
    }
};
apz.accdtl.accountSummary.getTxnDetails = function(pObj, event) {
    debugger;
    $("#accdtl__AccountSummary__account_header").addClass("sno");
    $("#accdtl__AccountSummary__new_account_header").addClass("sno");
    $("#accdtl__AccountSummary__AccountDetailsMaster").addClass("sno");
    var test = pObj.id.split("_");
    var lRow = parseInt(pObj.id.split("_")[7]);
    //accdtl__RoleAccountDetails__o__accountDetails__accountNo_1
    var lAccNo = $("#accdtl__RoleAccountDetails__o__accountDetails__accountNo_" + lRow).text();
    var params = {};
    params.appId = "acta01";
    params.scr = "TransactionDetails";
    params.userObj = {
        "data": {
            "accountNo": lAccNo
        }
    };
    params.div = "accdtl__AccountSummary__AccountLaunch";
    params.layout = "All";
    apz.launchApp(params);
    // apz.launchSubScreen(params);
    event.stopPropagation();
};
apz.app.updateChartBeforeRender = function(gChartType, gChartData, gId, gChart) {
    debugger;
    if (gId == "accdtl__AccountSummary__ct_cht_1") {
        for (var i = 0; i < gChartData.data.length; i++) {
            //gChartData.data[i].displayValue = apz.accdtl.accountSummary.unitConversion(gChartData.data[i].value) + " USD";
            //gChartData.data[i].displayValue = apz.accdtl.accountSummary.unitConversion(gChartData.data[i].value) + " " + apz.data.scrdata.accdtl__AccountsChartDummy_Res.tbDbmiCorpRoleAccount[i].accountCurrency;
           // gChartData.data[i].tooltext = gChartData.data[i].label + ", $displayValue";
        }
    }
}
apz.accdtl.accountSummary.unitConversion = function(datavalue) {
    return Math.abs(Number(datavalue)) >= 1.0e+9 ? (Math.abs(Number(datavalue)) / 1.0e+9).toFixed(2) + "B" : Math.abs(Number(datavalue)) >= 1.0e+6 ?
        (Math.abs(Number(datavalue)) / 1.0e+6).toFixed(2) + "M" : Math.abs(Number(datavalue)) >= 1.0e+3 ? (Math.abs(Number(datavalue)) / 1.0e+3).toFixed(
        2) + "K" : Math.abs(Number(datavalue)).toFixed(2);
}
apz.accdtl.accountSummary.getPersonaDashboard = function() {
    var lServerParams = {
        "ifaceName": "GetPersonaDashboard",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.accdtl.accountSummary.getPersonaDashboardCB
    };
    var req = {};
    req.userId = apz.Login.sUserId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.accdtl.accountSummary.getPersonaDashboardCB = function(pResp) {
    try {
        if (!pResp.errors) {
            var lDesign = pResp.res.accdtl__GetPersonaDashboard_Res[0].design;
            if (lDesign == "D1") {
                $(".D1").addClass("sno");
            }
        }
    } catch (e) {
        apz.dashboard.getCorpDashboard(pResp.callBackObj.dashboardId);
    }
};
