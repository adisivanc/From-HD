apz.lecr01.Guarantees = {};
apz.lecr01.Guarantees.sAction = "";
apz.lecr01.Guarantees.sCorporateId = "000FTAC4321";
apz.lecr01.Guarantees.sWorkflowId = "GUID";
apz.app.onLoad_Guarantees = function(params) {
    apz.lecr01.Guarantees.sCorporateId = apz.Login.sCorporateId;
    //  apz.lecr01.Guarantees.fnFetchGuaranteeDetails();
    apz.hide("lecr01__Guarantees__guaranteeDrafttableul_ttl");
    var params = {
        "action": "Guarantees Details"
    };
    apz.lecr01.Guarantees.fnRender(params);
};
apz.lecr01.Guarantees.fnRender = function(params) {
    apz.lecr01.Guarantees.fnRenderData(params);
};
apz.lecr01.Guarantees.fnRenderData = function(params) {
    if (params.action == "Guarantees Details") {
        apz.lecr01.Guarantees.sAction = "Guarantees Details";
        var req = {
            "guaranteeSummary": {
                "corporateId": apz.lecr01.Guarantees.sCorporateId,
                "type": "All"
            }
        };
        req.action = "Query";
        req.table = "tb_dbmi_corp_guarantee_issuance";
        var lParams = {
            "ifaceName": "FetchGuaranteeDetails",
            "paintResp": "Y",
            "appId": "lecr01",
            "buildReq": "N",
            "lReq": req
        };
        apz.lecr01.Guarantees.fnBeforCallServer(lParams);
    }
};
apz.lecr01.Guarantees.fnBeforCallServer = function(params) {
    debugger;
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.lecr01.Guarantees.fnFetchGuaranteeDetailsCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
// apz.lecr01.Guarantees.fnFetchGuaranteeDetails = function(params) {
//     debugger;
//     apz.startLoader();
//     var req = {
//         "guaranteeSummary": {
//             "corporateId": apz.lecr01.Guarantees.sCorporateId,
//              "type":"All"
//         }
//     };
//     req.action = "Query";
//     req.table = "tb_dbmi_corp_guarantee_issuance";
//     var lServerParams = {
//         "ifaceName": "FetchGuaranteeDetails",
//         "buildReq": "N",
//         "appId": "lecr01",
//         "req": req,
//         "paintResp": "Y",
//         "async": "true",
//         "callBack": apz.lecr01.Guarantees.fnFetchGuaranteeDetailsCB,
//         "callBackObj": "",
//     };
//     apz.server.callServer(lServerParams);
// };
apz.lecr01.Guarantees.fnFetchGuaranteeDetailsCB = function(params) {
    debugger;
    if (apz.lecr01.Guarantees.sAction == "Guarantees Details") {
        apz.lecr01.Guarantees.fnGuaranteesCB(params);
    } else if (apz.lecr01.Guarantees.sAction == "Search") {
        apz.lecr01.Guarantees.fnGuaranteesCB(params);
    }
};
apz.lecr01.Guarantees.fnGuaranteesCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.lecr01__FetchGuaranteeDetails_Res.Status) {
            
            var data = params.res.lecr01__FetchGuaranteeDetails_Res.guaranteeSummary;
            for(var i=0;i<data.length;i++){
                if(data[i].referenceNumber == "1519979100023"){
                $("#lecr01__Guarantees__btnEdit_" + i).addClass("sno");
                $("#lecr01__Guarantees__btnClosure_" + i).addClass("sno");
                }
            }
            
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
apz.lecr01.Guarantees.fnAddGuarantee = function() {
    debugger;
    apz.hide("lecr01__LCSummary__lcRow");
    apz.hide("lecr01__LCSummary__tradefinancerow");
     apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__GuaranteesRow");
     apz.hide("lecr01__LCSummary__MobGuaranteesRow");
    var params = {};
    params.appId = "lecr01";
    params.scr = "AddGuarantee";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    apz.launchSubScreen(params);
};
apz.lecr01.Guarantees.fnGuaranteeDetails = function(pthis,pAction) {
    debugger;
    apz.hide("lecr01__LCSummary__lcRow");
    apz.show("lecr01__LCSummary__tradefinancerow");
    apz.show("lecr01__LCSummary__Mobtradefinancerow");
    var lrowno = $(pthis).attr("rowno");
    var lrefno = $("#lecr01__FetchGuaranteeDetails__o__guaranteeSummary__referenceNumber_"+lrowno+"_txtcnt").text();
    //var lrefno = apz.getObjValue(pthis);
    var params = {};
    params.appId = "lecr01";
    params.scr = "GuaranteesDetails";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    if(pAction=="CLOSE"){
        params.userObj.close = true;
    }
     if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    apz.launchSubScreen(params);
};
apz.lecr01.Guarantees.fnGuaranteeEditDetails = function(pthis) {
    debugger;
    apz.hide("lecr01__LCSummary__lcRow");
    apz.hide("lecr01__LCSummary__tradefinancerow");
    apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    var lrow = $(pthis).attr("rowno");
    var lrefno = apz.getElmValue("lecr01__GuaranteeList__i__tbDbmiCorpGuaranteeIssuance__referenceNumber_" + lrow);
    var params = {};
    params.appId = "lecr01";
    params.scr = "ModifyGuarantee";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    apz.launchSubScreen(params);
};
apz.lecr01.Guarantees.fnSearch = function(event,GSearchBy,GSearch) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("lecr01__LCSummary__"+GSearchBy);
        var lInput = apz.getElmValue("lecr01__LCSummary__"+GSearch);
        var lSearchType;
        var flag = true;
        if (lType == "Search By") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "Reference Number") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "referenceNumber";
            }
        } else if (lType == "Counter Party") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "beneficaryCompanyName";
            }
        } else if (lType == "Currency") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "currency";
            }
        }
        if (flag) {
            apz.lecr01.Guarantees.sAction = "Search";
            var req = {
                "guaranteeSummary": {
                    "type": lSearchType,
                    "corporateId": apz.lecr01.Guarantees.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_corp_guarantee_issuance";
            var lParams = {
                "ifaceName": "FetchGuaranteeDetails",
                "paintResp": "Y",
                "appId": "lecr01",
                "buildReq": "N",
                "lReq": req
            };
            apz.lecr01.Guarantees.fnBeforCallServer(lParams);
        }
    }
};
apz.lecr01.Guarantees.fnEditGuarantee = function(pObj){
debugger;
    apz.hide("lecr01__LCSummary__lcRow");
    apz.hide("lecr01__LCSummary__tradefinancerow");
    apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__GuaranteesRow");
    apz.hide("lecr01__LCSummary__MobGuaranteesRow");
    var lrow = $(pObj).attr("rowno");
    var lrefno = $("#lecr01__FetchGuaranteeDetails__o__guaranteeSummary__referenceNumber_"+lrow+"_txtcnt").text();
   var lServerParams = {
        "ifaceName": "FetchGuaranteeDetails",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.lecr01.Guarantees.fnEditGuaranteeCB,
        "callBackObj": "",
    };
    var req = {
        "guaranteeDetails": {
            "referenceNumber": lrefno
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_guarantee_issuance";
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
//guaranteeDetails
}

apz.lecr01.Guarantees.fnEditGuaranteeCB = function(pResp){
 debugger;
    if (!pResp.errors) {
        var result = pResp.res;
        result.sAction = "edit";
        var lParams = {
            "appId": "lecr01",
            "scr": "AddGuarantee",
            "div": "lecr01__LCSummary__subScreenLauncher",
            "layout": "All",
            "type": "CF",
            "userObj": result
        };
        apz.launchSubScreen(lParams);
    }
}
