apz.card01.accountDetails = {};
apz.card01.accountDetails.sAction = "";
apz.app.onLoad_CardAccountDetails = function(userObj) {
    debugger;
    apz.card01.accountDetails.sAccountNo = userObj.data.accountNo;
    apz.card01.accountDetails.sCorporateID = userObj.data.corporateID;
    apz.card01.accountDetails.sCategoryID = userObj.data.category;
    var params = {
        "action": "Account Details"
    };
    apz.card01.accountDetails.fnRender(params);
};
apz.app.onShown_CardAccountDetails = function(userObj) {
    debugger;
    apz.card01.cards.fnAdjustHeight();
};
apz.card01.accountDetails.fnRender = function(params) {
    apz.card01.accountDetails.fnRenderData(params);
    apz.card01.accountDetails.fnRenderActionButtons(params);
};
apz.card01.accountDetails.fnRenderActionButtons = function(params) {
    debugger;
    if (params.action == "Account Details") {
        $("#card01__AccountDetails__AccountCardList").css("cursor", "pointer");
        $("#card01__Cards__BreadcrumbBtn2").parent().removeClass("sno");
        $("#card01__Cards__BreadcrumbBtn3").parent().addClass("sno");
        $(".active").removeClass("active");
        $("#card01__Cards__BreadcrumbBtn2").parent().addClass("active");
        $("#card01__Cards__BreadcrumbBtn2").text(apz.card01.accountDetails.sAccountName);
        $("#card01__AccountDetails__AccountDouhnutChart").css("margin", "1px 0");
        $("#card01__AccountDetails__AccountDouhnutChart_chart").css("padding", "1px 0");
    }
};
apz.card01.accountDetails.fnRenderData = function(params) {
    debugger;
    if (params.action == "Account Details") {
        apz.card01.accountDetails.sAction = "Account Details";
        var req = {
            "cardSummary": {
                "masterAccountNo": apz.card01.accountDetails.sAccountNo
            },
            "accountDetails": {
                "accountNo": apz.card01.accountDetails.sAccountNo,
                "category": apz.card01.accountDetails.sCategoryID,
                "corporateID": apz.card01.accountDetails.sCorporateID
            }
        };
        req.action = "Query";
        req.table = "tb_dbmi_card_details";
        var lParams = {
            "ifaceName": "FetchAccountDetails",
            "paintResp": "N",
            "appId": "card01",
            "buildReq": "N",
            "lReq": req
        };
        apz.card01.accountDetails.fnBeforCallServer(lParams);
    }
};
apz.card01.accountDetails.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.card01.accountDetails.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.card01.accountDetails.callServerCB = function(params) {
    debugger;
    if (apz.card01.accountDetails.sAction == "Account Details") {
        apz.card01.accountDetails.fnAccountDetailsCB(params);
    }
};
apz.card01.accountDetails.fnAccountDetailsCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        apz.card01.accountDetails.sAccountName = params.res.card01__FetchAccountDetails_Res.accountDetails.cardAccountName;
        if (params.res.card01__FetchAccountDetails_Res.AccountStatus) {
            apz.card01.accountDetails.fnRenderDoughnutChart(params);
            if (params.res.card01__FetchAccountDetails_Res.cardSummary.length > 3) {
                $("#card01__AccountDetails__AccountCardList_pagination_ul").removeClass("sno");
            } else {
                $("#card01__AccountDetails__AccountCardList_pagination_ul").addClass("sno");
            }
            apz.data.scrdata.card01__FetchAccountDetails_Res = {};
            apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary = [];
            apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary = params.res.card01__FetchAccountDetails_Res.cardSummary;
            apz.data.scrdata.card01__FetchAccountDetails_Res.accountDetails = params.res.card01__FetchAccountDetails_Res.accountDetails;
            var strlen1 = params.res.card01__FetchAccountDetails_Res.accountDetails.cardAccountNo;
            strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(
                /[0-9]/g, '9');
            var laccNo1 = params.res.card01__FetchAccountDetails_Res.accountDetails.cardAccountNo;
            var result1 = apz.getMaskedValue(strlen1, laccNo1);
            apz.data.scrdata.card01__FetchAccountDetails_Res.accountDetails.maskAccNo = result1;
            for (var i = 0; i < params.res.card01__FetchAccountDetails_Res.cardSummary.length; i++) {
                var strlen = params.res.card01__FetchAccountDetails_Res.cardSummary[i].cardAccountNo;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = params.res.card01__FetchAccountDetails_Res.cardSummary[i].cardAccountNo;
                var result = apz.getMaskedValue(strlen, laccNo);
                apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[i].maskAccNo = result;
            }
            apz.data.loadData("FetchAccountDetails", "card01");
             //setTimeout(function() {
                
            
            for (var i = 0; i < apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary.length; i++) {
                if (apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[i].cardStatus == "Inactive") {
                    $("#card01__CardAccountDetails__el_hpl_1_" + i).attr("disabled", true);
                    $("#card01__CardAccountDetails__el_hpl_2_" + i).attr("disabled", true);
                    $("#card01__CardAccountDetails__el_hpl_4_" + i).attr("disabled", true);
                    $("#card01__CardAccountDetails__el_hpl_3_" + i).attr("disabled", true);
                    $("#card01__CardAccountDetails__el_hpl_1_" + i).css("pointer-events", "none");
                    $("#card01__CardAccountDetails__el_hpl_2_" + i).css("pointer-events", "none");
                    $("#card01__CardAccountDetails__el_hpl_4_" + i).css("pointer-events", "none");
                    $("#card01__CardAccountDetails__el_hpl_3_" + i).css("pointer-events", "none");
                      // card01__CardAccountDetails__AccountCardList_row_0
                    $("#card01__CardAccountDetails__AccountCardList_row_" + i).addClass("inactive");
                } else {
                    $("#card01__CardAccountDetails__AccountCardList_row_" + i).addClass("activeSt");
                }
            }
           //  }, 2000);
            
        } else {
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
            $("#card01__AccountDetails__AccountCardList_pagination_ul").addClass("sno");
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
        $("#card01__AccountDetails__AccountCardList_pagination_ul").addClass("sno");
    }
};
apz.card01.accountDetails.fnRenderDoughnutChart = function(params) {
    apz.data.scrdata.card01__DoughnutCharts_Res = {};
    apz.data.scrdata.card01__DoughnutCharts_Res.cardSummary = [];
    apz.data.scrdata.card01__DoughnutCharts_Res.cardSummary = params.res.card01__FetchAccountDetails_Res.cardSummary;
    apz.data.loadData("DoughnutCharts", "card01");
};
apz.card01.accountDetails.fnCardSelected = function(pObj, event) {
    debugger;
    apz.card01.accountDetails.sAction = "Card Details";
    var lRow = parseInt(pObj.id.split("_")[7]);
    var lAccountNo = $("#card01__FetchAccountDetails__o__cardSummary__cardAccountNo_" + lRow).text();
    var params = {};
    params.appId = "card01";
    params.scr = "TransactionDetails";
    params.userObj = {
        "data": {
            "accountNo": lAccountNo
        }
    };
    params.div = "card01__Cards__CardLauncher";
    if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    } else {
        params.layout = "All";
    }
    apz.launchSubScreen(params);
};
apz.card01.accountDetails.fnNewCardRequest = function() {
    var params = {};
    params.appId = "card01";
    params.scr = "NewCardRequest";
    params.userObj = {
        "data": {
            "masterAccount": apz.data.scrdata.card01__FetchAccountDetails_Res.accountDetails.cardAccountNo,
            "accountName": apz.data.scrdata.card01__FetchAccountDetails_Res.accountDetails.cardAccountName,
            "category": apz.data.scrdata.card01__FetchAccountDetails_Res.accountDetails.categoryId
        }
    };
    params.div = "card01__Cards__CardLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.card01.accountDetails.fnPay = function() {
    var params = {};
    params.appId = "crdt01";
    params.scr = "Payment";
    params.layout = "All";
    params.description = "Card Payment";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
};
apz.card01.accountDetails.fnLaunchLimitChangeApp = function(pObj) {
    var rowNo = $(pObj).attr("rowno");
    var params = {};
    params.appId = "crlmch";
    params.scr = "LimitChange";
    params.layout = "All";
    params.description = "Request Limit Change";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = {
        cardNo: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].cardAccountNo,
        currentLimit: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].creditLimit
    }
    apz.launchApp(params);
};
apz.card01.accountDetails.fnMore = function(pthis, event) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    $("#card01__CardAccountDetails__AccountCardList_row_" + lrow + " #card01__CardAccountDetails__morerow_row").removeClass("sno");
    $("#card01__CardAccountDetails__AccountCardList_row_" + lrow + " #card01__CardAccountDetails__detailsrow_row").addClass("sno");
}
apz.card01.accountDetails.fnClose = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    $("#card01__CardAccountDetails__AccountCardList_row_" + lrow + " #card01__CardAccountDetails__morerow_row").addClass("sno");
    $("#card01__CardAccountDetails__AccountCardList_row_" + lrow + " #card01__CardAccountDetails__detailsrow_row").removeClass("sno");
}
apz.card01.accountDetails.fnSetpin = function(pObj, ev) {
    debugger;
    var rowNo = $(pObj).attr("rowno");
    var params = {};
    params.appId = "crlmch";
    params.scr = "CardOperations";
    params.layout = "All";
    params.description = "Request Limit Change";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = {
        cardNo: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].cardAccountNo,
        currentLimit: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].creditLimit,
        cardHolderName: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].cardHolderName,
        availableCreditLimit: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].availableCreditLimit
    }
    apz.launchApp(params);
}
apz.card01.accountDetails.fnBlock = function(pObj) {
    debugger;
    var rowNo = $(pObj).attr("rowno");
    var params = {};
    params.appId = "crlmch";
    params.scr = "BlockCards";
    params.layout = "All";
    params.description = "Request Limit Change";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = {
        cardNo: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].cardAccountNo,
        currentLimit: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].creditLimit,
        cardHolderName: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].cardHolderName,
        availableCreditLimit: apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary[rowNo].availableCreditLimit
    }
    apz.launchApp(params);
}
