apz.ficl01.CreditLineList = {};
apz.app.onLoad_CreditLineList = function(params) {
    apz.ficl01.CreditLineList.getCreditLineList();
    $("#ficl01__CreditLineList__lineListRow").css({"paddingTop":"15px","paddingLeft":"15px","paddingRight":"10px"});
};
apz.ficl01.CreditLineList.getCreditLineList = function() {
    var req = {
        "CreditLineList": {
            "corporateId": apz.Login.sCorporateId,
            "type":"All"
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_credit_line";
    var lServerParams = {
        "ifaceName": "FetchCreditLineService",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.CreditLineList.getCreditLineListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.ficl01.CreditLineList.getCreditLineListCB = function(pResp) {
    debugger;
    if (pResp.status === true && pResp.resFull.appzillonHeader.status === true) {
        if (pResp.res.ficl01__FetchCreditLineService_Res.Status) {} else {
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": pResp.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
}
apz.ficl01.CreditLineList.getDetails = function(pthis) {
    debugger;
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    // apz.hide("ficl01__FCSummary__lineHeader");
    
    apz.hide("ficl01__CreditLineList__lineHeader");
     apz.show("ficl01__CreditLineList__subScreenLauncher");
     apz.hide("ficl01__CreditLineList__lineListRow");
     
    console.log(pthis.id.split("_"));
    var lRow = parseInt(pthis.id.split("_")[7]);
    var lrefno = $("#ficl01__FetchCreditLineService__o__CreditLineList__lineId_" + lRow).text();
    //var lrefno = apz.getObjValue(pthis);
    var params = {};
    params.appId = "ficl01";
    params.scr = "CreditLineDetails";
    params.layout = "All";
    params.div = "ficl01__CreditLineList__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    apz.launchSubScreen(params);
};
apz.ficl01.CreditLineList.addCreditLine = function() {
    debugger;
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.hide("ficl01__FCSummary__limitsHeaderRow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    // apz.hide("ficl01__FCSummary__lineHeader");
    
     apz.hide("ficl01__CreditLineList__lineHeader");
     apz.show("ficl01__CreditLineList__subScreenLauncher");
     apz.hide("ficl01__CreditLineList__lineListRow");
    var params = {};
    params.appId = "ficl01";
    params.scr = "AddCreditLine";
    params.layout = "All";
    params.div = "ficl01__CreditLineList__subScreenLauncher";
    apz.launchSubScreen(params);
};

apz.ficl01.CreditLineList.fnSearch = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("ficl01__CreditLineList__SearchBy");
        var lInput = apz.getElmValue("ficl01__CreditLineList__SearchValue");
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
        } else if (lType == "LineId") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "LineId";
            }
        } else if (lType == "All") {
            lSearchType = "All";
        }
        
        if (flag) {
     
    
     var req = {
        "CreditLineList": {
            "corporateId": apz.Login.sCorporateId,
            "type": lSearchType,
            "value": lInput
        }
    };
     req.action = "Query";
    req.table = "tb_dbmi_corp_credit_line";
    var lServerParams = {
        "ifaceName": "FetchCreditLineService",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.CreditLineList.getCreditLineListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
        }
    }
}