apz.acsi01 = {};
apz.acsi01.standingInstructions = {};
apz.acsi01.standingInstructions.sAction = "";
apz.acsi01.standingInstructions.sSI = {};
apz.app.onLoad_StandingInstructions = function() {
    debugger;
    $(".adr-ctr").addClass("sno");
    apz.acsi01.standingInstructions.sCorporateId = apz.Login.sCorporateId;
    var params = {
        "action": "SI Details"
    };
    apz.acsi01.standingInstructions.fnRender(params);
};
apz.acsi01.standingInstructions.fnRender = function(params) {
    apz.acsi01.standingInstructions.fnRenderData(params);
};
apz.acsi01.standingInstructions.fnRenderData = function(params) {
    if (params.action == "SI Details") {
        apz.acsi01.standingInstructions.sAction = "SI Details";
        var req = {
            "SISummary": {
                "corporateId": apz.acsi01.standingInstructions.sCorporateId,
                "type": "All"
            }
        };
        req.action = "Query";
        req.table = "tb_dbtp_si_funds_transfer";
        var lParams = {
            "ifaceName": "SISummary",
            "paintResp": "N",
            "appId": "acsi01",
            "buildReq": "N",
            "lReq": req
        };
        apz.acsi01.standingInstructions.fnBeforCallServer(lParams);
    }
};
apz.acsi01.standingInstructions.fnBeforCallServer = function(params) {
    debugger;
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acsi01.standingInstructions.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsi01.standingInstructions.callServerCB = function(params) {
    debugger;
    if (apz.acsi01.standingInstructions.sAction == "SI Details") {
        apz.acsi01.standingInstructions.fnSISummaryCB(params);
    } else if (apz.acsi01.standingInstructions.sAction == "Search") {
        apz.acsi01.standingInstructions.fnSISummaryCB(params);
    }
};
apz.acsi01.standingInstructions.fnSISummaryCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acsi01__SISummary_Res.SIStatus) {
            apz.data.scrdata.acsi01__SISummary_Res = {};
            apz.data.scrdata.acsi01__SISummary_Res.SISummary = [];
            apz.data.scrdata.acsi01__SISummary_Res.SISummary = params.res.acsi01__SISummary_Res.SISummary;
            for (var i = 0; i < apz.data.scrdata.acsi01__SISummary_Res.SISummary.length; i++) {
                var strlen = apz.data.scrdata.acsi01__SISummary_Res.SISummary[i].toAccount;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = apz.data.scrdata.acsi01__SISummary_Res.SISummary[i].toAccount;
                var result = apz.getMaskedValue(strlen, laccNo);
                apz.data.scrdata.acsi01__SISummary_Res.SISummary[i].maskAccNo = result;
            }
            apz.data.loadData("SISummary", "acsi01");
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
apz.acsi01.standingInstructions.search = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acsi01__StandingInstructions__SearchBy");
        var lInput = apz.getElmValue("acsi01__StandingInstructions__search");
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
        } else if (lType == "ReferenceNo") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "ReferenceNo";
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
            apz.acsi01.standingInstructions.sAction = "Search";
            var req = {
                "SISummary": {
                    "type": lSearchType,
                    "corporateId": apz.Login.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbtp_si_funds_transfer";
            var lParams = {
                "ifaceName": "SISummary",
                "paintResp": "N",
                "appId": "acsi01",
                "buildReq": "N",
                "lReq": req
            };
            apz.acsi01.standingInstructions.fnBeforCallServer(lParams);
        }
    }
};
apz.acsi01.standingInstructions.closeSI = function(pObj, event) {
    debugger;
    var lRowNo = $(pObj).attr('rowno');
    apz.acsi01.standingInstructions.sSI = apz.data.scrdata.acsi01__SISummary_Res.SISummary[lRowNo];
    var params = {};
    params.appId = "acsi01";
    params.scr = "SIClosure";
    params.layout = "All";
    params.div = "acsi01__StandingInstructions__launchScreen";
    params.userObj = {
        "SIData": apz.acsi01.standingInstructions.sSI,
        "Status": "Closed"
    };
    $("#acsi01__StandingInstructions__SIAdd").addClass('sno');
    $("#acsi01__StandingInstructions__SummaryRow").addClass('sno');
    $("#acsi01__StandingInstructions__launchScreenRow").removeClass('sno');
    apz.launchInDiv(params);
    event.stopPropagation();
};
apz.acsi01.standingInstructions.modifySI = function(pObj) {
    debugger;
    var lRowNo = $(pObj).attr('rowno');
    apz.acsi01.standingInstructions.sSI = apz.data.scrdata.acsi01__SISummary_Res.SISummary[lRowNo];
    var params = {};
    params.appId = "acsi01";
    params.scr = "ModifySI";
    params.layout = "All";
    params.div = "acsi01__StandingInstructions__launchScreen";
    params.userObj = {
        "SIData": apz.acsi01.standingInstructions.sSI
    };
    $("#acsi01__StandingInstructions__SIAdd").addClass('sno');
    $("#acsi01__StandingInstructions__SummaryRow").addClass('sno');
    $("#acsi01__StandingInstructions__launchScreenRow").removeClass('sno');
    apz.launchInDiv(params);
};
apz.acsi01.standingInstructions.createSI = function() {
    debugger;
    var params = {};
    params.appId = "acsi01";
    params.scr = "NewSI";
    params.layout = "All";
    params.div = "acsi01__StandingInstructions__launchScreen";
    $("#acsi01__StandingInstructions__SIAdd").addClass('sno');
    $("#acsi01__StandingInstructions__SIRow").addClass('sno');
    $("#acsi01__StandingInstructions__SummaryRow").addClass('sno');
    $("#acsi01__StandingInstructions__launchScreenRow").removeClass('sno');
    apz.launchSubScreen(params);
};
apz.acsi01.standingInstructions.fnOnSelectSI = function(lObj, event) {
    debugger;
    var lRow = parseInt(lObj.id.split("_")[6]);
    var lScrData;
    var lRef = $("#acsi01__SISummary__o__SISummary__txnId_" + lRow).text();
    for (var i = 0; i < apz.data.scrdata.acsi01__SISummary_Res.SISummary.length; i++) {
        if (apz.data.scrdata.acsi01__SISummary_Res.SISummary[i].txnId == lRef) {
            lScrData = apz.data.scrdata.acsi01__SISummary_Res.SISummary[i];
            break;
        }
    }
    var params = {};
    params.appId = "acsi01";
    params.scr = "SIDetails";
    params.userObj = {
        "data": {
            "SIData": lScrData
        }
    };
    params.div = "acsi01__StandingInstructions__launchScreen";
    params.layout = "All";
    $("#acsi01__StandingInstructions__SIAdd").addClass('sno');
    $("#acsi01__StandingInstructions__SummaryRow").addClass('sno');
    $("#acsi01__StandingInstructions__launchScreenRow").removeClass('sno');
    apz.launchSubScreen(params);
    event.stopPropagation();
};
