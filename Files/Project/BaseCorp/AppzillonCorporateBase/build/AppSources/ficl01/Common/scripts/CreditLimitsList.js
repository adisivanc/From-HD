apz.ficl01.CreditLimitsList = {};
apz.app.onLoad_CreditLimitsList = function(params) {
    $("body").removeClass("dbcls");
    apz.ficl01.CreditLimitsList.getCreditLimitList();
};
apz.ficl01.CreditLimitsList.getCreditLimitList = function() {
    debugger;
    var req = {
        "CreditLimitList": {
            "corporateId": apz.Login.sCorporateId,
            "type": "All"
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_credit_limit";
    var lServerParams = {
        "ifaceName": "FetchCreditLimitService",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.CreditLimitsList.getCreditLimitListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.ficl01.CreditLimitsList.getCreditLimitListCB = function(pResp) {
    debugger;
    if (pResp.status === true && pResp.resFull.appzillonHeader.status === true) {
        if (pResp.res.ficl01__FetchCreditLimitService_Res.Status) {
            debugger;
            var chartarr = [];
            var limitAmount = 0;
            var AvailableAmount = 0;
            var UtilisedAmount = 0;
            var ldata = pResp.res.ficl01__FetchCreditLimitService_Res.CreditLimitList;
            for (var i = 0; i < ldata.length; i++) {
                limitAmount = Number(limitAmount) + Number(ldata[i].limitAmount);
                AvailableAmount = Number(AvailableAmount) + Number(ldata[i].availableAmount);
                UtilisedAmount = Number(UtilisedAmount) + (Number(ldata[i].limitAmount) - Number(ldata[i].availableAmount));
                var lobj1 = {};
                lobj1.limitId = ldata[i].limitId;
                lobj1.limitType = ldata[i].limitType;
                lobj1.availableAmount = ldata[i].availableAmount;
                lobj1.limitAmount = ldata[i].limitAmount;
                lobj1.utilisedAmount = Number(ldata[i].limitAmount) - Number(ldata[i].availableAmount);
                lobj1.amount = (Number(ldata[i].limitAmount) - Number(ldata[i].availableAmount)).toString();
                lobj1.amountType = "utilisedamount";
                chartarr.push(lobj1);
                var lobj = {};
                lobj.limitId = ldata[i].limitId;
                lobj.limitType = ldata[i].limitType;
                lobj.availableAmount = ldata[i].availableAmount;
                lobj.limitAmount = ldata[i].limitAmount;
                lobj.utilisedAmount = Number(ldata[i].limitAmount) - Number(ldata[i].availableAmount);
                lobj.amount = ldata[i].availableAmount;
                lobj.amountType = "availableamont";
                chartarr.push(lobj);
            }
            limitAmount = apz.ficl01.CreditLimitsList.fnFormatNumber(limitAmount);
             AvailableAmount = apz.ficl01.CreditLimitsList.fnFormatNumber(AvailableAmount);
              UtilisedAmount = apz.ficl01.CreditLimitsList.fnFormatNumber(UtilisedAmount);
            apz.setElmValue("ficl01__CreditLimitsList__limittxt", limitAmount);
            apz.setElmValue("ficl01__CreditLimitsList__utilisedtxt", AvailableAmount);
            apz.setElmValue("ficl01__CreditLimitsList__availabletxt", UtilisedAmount);
            apz.data.scrdata.ficl01__CreditlimitChartDummy_Res = {};
            apz.data.scrdata.ficl01__CreditlimitChartDummy_Res.LimitList = chartarr;
            apz.data.loadData("CreditlimitChartDummy", "ficl01");
        } else {
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
};
apz.ficl01.CreditLimitsList.getDetails = function(pthis) {
    debugger;
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    // apz.hide("ficl01__FCSummary__limHeader");
    // $("#ficl01__FCSummary__el_txt_1").text("Credit Limit");
    apz.hide("ficl01__CreditLimitsList__limHeader");
      apz.hide("ficl01__CreditLimitsList__MoblimHeader");
      apz.hide("ficl01__CreditLimitsList__limchart");
    apz.show("ficl01__CreditLimitsList__subScreenLauncher");
    apz.hide("ficl01__CreditLimitsList__limListRow");
    var lRow = parseInt(pthis.id.split("_")[7]);
    var lrefno = $("#ficl01__FetchCreditLimitService__o__CreditLimitList__limitId_" + lRow).text();
    //var lrefno = apz.getObjValue(pthis);
    var params = {};
    params.appId = "ficl01";
    params.scr = "CreditLimitDetails";
    params.layout = "All";
    params.div = "ficl01__CreditLimitsList__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    apz.launchSubScreen(params);
};
apz.ficl01.CreditLimitsList.addCreditLimit = function() {
    debugger;
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.hide("ficl01__FCSummary__limitsHeaderRow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    //  apz.hide("ficl01__FCSummary__limHeader");
    apz.hide("ficl01__CreditLimitsList__limHeader");
    apz.hide("ficl01__CreditLimitsList__MoblimHeader");
    apz.hide("ficl01__CreditLimitsList__limchart");
    apz.show("ficl01__CreditLimitsList__subScreenLauncher");
    apz.hide("ficl01__CreditLimitsList__limListRow");
    var params = {};
    params.appId = "ficl01";
    params.scr = "AddCreditLimit";
    params.layout = "All";
    params.div = "ficl01__CreditLimitsList__subScreenLauncher";
    apz.launchSubScreen(params);
};
apz.ficl01.CreditLimitsList.fnSearch = function(event,SearchBy,SearchValue) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("ficl01__CreditLimitsList__"+SearchBy);
        var lInput = apz.getElmValue("ficl01__CreditLimitsList__"+SearchValue);
        var lSearchType;
        var flag = true;
        if (lType == "All") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "LimitId") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "LimitId";
            }
        } else if (lType == "All") {
            lSearchType = "All";
        }
        if (flag) {
            var req = {
                "CreditLimitList": {
                    "corporateId": apz.Login.sCorporateId,
                    "type": lSearchType,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_corp_credit_limit";
            var lServerParams = {
                "ifaceName": "FetchCreditLimitService",
                "buildReq": "N",
                "appId": "ficl01",
                "req": req,
                "paintResp": "Y",
                "async": "true",
                "callBack": apz.ficl01.CreditLimitsList.getCreditLimitListCB,
                "callBackObj": "",
            };
            apz.server.callServer(lServerParams);
        }
    }
}
apz.ficl01.CreditLimitsList.fnFormatNumber = function(pvalue) {
    return apz.formatNumber({
        "value": pvalue,
        decimalPoints: "2",
        decimalSep: ".",
        mask: "MILLION"
    })
}

apz.app.updateChartBeforeRender = function(gChartType, gChartData, gId, gChart) {
   
    gChartData.chart.usePlotGradientColor = 0;
}
