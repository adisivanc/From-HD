apz.acdp01.depositSummary = {};
apz.acdp01.depositSummary.sAction = "";
apz.acdp01.depositSummary.sCorporateID = "";
apz.app.onLoad_DepositSummary = function(userObj) {
    debugger;
    apz.acdp01.depositSummary.sparams = userObj;
    
    
    
    
    apz.acdp01.depositSummary.sCorporateID = apz.Login.sCorporateId;
    var params = {
        "action": "Deposit Details"
    };
    apz.acdp01.depositSummary.fnRender(params);
   
};
apz.acdp01.depositSummary.fnRender = function(params) {
    apz.acdp01.depositSummary.fnRenderData(params);
    apz.acdp01.depositSummary.fnRenderActionButtons(params);
};
apz.acdp01.depositSummary.fnRenderActionButtons = function(params) {
    if (params.action == "Deposit Details") {
        $("#acdp01__DepositSummary__DepositSummaryList").css("cursor", "pointer");
    }
};
apz.acdp01.depositSummary.fnRenderData = function(params) {
    if (params.action == "Deposit Details") {
        apz.acdp01.depositSummary.sAction = "Deposit Details";
        var req = {
            "depositSummary": {
                "corpID": apz.acdp01.depositSummary.sCorporateID,
                "type": "All"
            }
        };
        req.action = "Query";
        req.table = "tb_dbmi_corp_deposits";
        var lParams = {
            "ifaceName": "FetchDeposits",
            "paintResp": "N",
            "appId": "acdp01",
            "buildReq": "N",
            "lReq": req
        };
        apz.acdp01.depositSummary.fnBeforCallServer(lParams);
    }
};
apz.acdp01.depositSummary.fnBeforCallServer = function(params) {
    debugger;
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acdp01.depositSummary.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acdp01.depositSummary.callServerCB = function(params) {
    debugger;
    if (apz.acdp01.depositSummary.sAction == "Deposit Details") {
        apz.acdp01.depositSummary.fnDepositSummaryCB(params);
    } else if (apz.acdp01.depositSummary.sAction == "Search") {
        apz.acdp01.depositSummary.fnDepositSummaryCB(params);
    }
};
apz.acdp01.depositSummary.fnDepositSummaryCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acdp01__FetchDeposits_Res.DepositStatus) {
            
            
            apz.data.scrdata.acdp01__FetchDeposits_Res = {};
        apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary = [];
        apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary = params.res.acdp01__FetchDeposits_Res.depositSummary;
        for (var i = 0; i < apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary.length; i++) {
            
            
            var strlen = apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary[i].fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary[i].fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
       
            apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary[i].maskAccNo = result;
            
        }
        apz.data.loadData("FetchDeposits", "acdp01");
            
            
        } else {
            var msg = {};
            msg.message = "No Records found";
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
apz.acdp01.depositSummary.fnOnSelectDeposit = function(lObj, event) {
    debugger;
    var lRow = parseInt($(lObj).attr('id').split('_')[5]);
    // var lRow = $(lObj).parent().parent().parent().parent().attr('rowno');
    var lScrData;
    var lRef = $("#acdp01__FetchDeposits__o__depositSummary__refNum_" + lRow).text();
    for (var i = 0; i < apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary.length; i++) {
        if (apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary[i].refNum == lRef) {
            lScrData = apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary[i];
            break;
        }
    }
    var params = {};
    params.appId = "acdp01";
    params.scr = "DepositDetails";
    params.userObj = {
        "data": {
            "depositData": lScrData
        }
    };
    params.div = "acdp01__DepositLauncher__DepositLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.acdp01.depositSummary.fnLaunchDeposit = function() {
    debugger;
    apz.hide("acdp01__DepositLauncher__gr_row_1");
    var params = {};
    params.appId = "acdp01";
    params.scr = "Deposits";
    params.div = "acdp01__DepositLauncher__DepositLauncher";
    params.layout = "All";
    
    
    apz.launchSubScreen(params);
};
apz.acdp01.depositSummary.search = function(event,searchby,seachvalue) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acdp01__DepositSummary__"+searchby);
        var lInput = apz.getElmValue("acdp01__DepositSummary__"+seachvalue);
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
        } else if (lType == "Currency") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "Currency";
            }
        }
        if (flag) {
            apz.acdp01.depositSummary.sAction = "Search";
            var req = {
                "depositSummary": {
                    "type": lSearchType,
                    "corpID": apz.Login.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_corp_deposits";
            var lParams = {
                "ifaceName": "FetchDeposits",
                "paintResp": "N",
                "appId": "acdp01",
                "buildReq": "N",
                "lReq": req
            };
            apz.acdp01.depositSummary.fnBeforCallServer(lParams);
        }
    }
};
apz.acdp01.depositSummary.launchTopupApp = function(pObj) {
    var lRowNo = $(pObj).attr("rowno");
    var lDepositSummary = apz.data.scrdata.acdp01__FetchDeposits_Res.depositSummary[lRowNo];
    var params = {};
    params.appId = "deptop";
    params.scr = "DepositTopup";
    params.layout = "All";
    params.description = "Top-up your Existing Deposit";
    // params.displayOrder = lOrder;
    params.userObj = lDepositSummary;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}

apz.acdp01.depositSummary.launchLiquidate = function(lObj) {
    var lRow = parseInt($(lObj).attr('id').split('_')[7]);
    // var lRow = $(lObj).parent().parent().parent().parent().attr('rowno');
    var lScrData;
    var lRef = $("#acdp01__FetchDeposits__o__depositSummary__refNum_" + lRow).text();
   
    var params = {};
    params.appId = "acdp01";
    params.scr = "LiquidateFD";
    params.layout = "All";
    params.description = "LIQUIDATE DEPOSIT";
    // params.displayOrder = lOrder;
     params.userObj = {
        "data": {
            "RefNo": lRef
        }
    };
    
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}
