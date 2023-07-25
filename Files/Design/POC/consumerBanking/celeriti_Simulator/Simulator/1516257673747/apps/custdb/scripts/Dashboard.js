apz.custdb = {};
apz.custdb.dashboard = {};
apz.custdb.dashboard.sCache = {};
apz.custdb.dashboard.sAccounts = [];
apz.custdb.dashboard.sLoanAcc = [];
apz.custdb.dashboard.sCardAcc = [];
apz.custdb.dashboard.sDDAAcc = [];
apz.custdb.dashboard.sRSVAcc = [];
apz.custdb.dashboard.sCustInfo = {};
apz.custdb.dashboard.sCardNum = "";
apz.app.onLoad_Dashboard = function(params) {
    debugger;
    apz.custdb.dashboard.sCache = params;
    apz.custdb.dashboard.fnInitialize();
    if (params.widget) {
        apz.custdb.dashboard.sWidget = true;
    } else {
        apz.custdb.dashboard.sWidget = false;
    }
    $("#custdb__Dashboard__ps_pls_8 input[type='CHECKBOX']").hide()
};
apz.app.onShown_Dashboard = function(params) {
    debugger;
    var lReq = {
        "tbCelerityCustomize": {
            "userId": apz.csmrbk.userId,
            "screenName": "Dashboard"
        }
    }
    var lServerParams = {
        "ifaceName": "UserDetails_Query",
        "buildReq": "N",
        "req": lReq,
        "paintResp": "N",
        "callBack": apz.custdb.dashboard.fnQueryCallBack
    };
    apz.server.callServer(lServerParams);
};
apz.custdb.dashboard.fnQueryCallBack = function(params) {
    debugger;
    apz.custdb.dashboard.custWidgetArr = [];
    apz.custdb.dashboard.custWidgetArrBck = [];
    apz.custdb.dashboard.custMicroappArr = [];
    apz.custdb.dashboard.custMicroappArrBck = [];
    if (params.errors) {
        if (params.errors[0].errorMessage == "No Data Found.") {
            apz.custdb.dashboard.sCache.sAction = "NewUser";
        } else {
            var param = {
                'code': params.errors[0].errorCode
            };
            apz.dispMsg(param);
        }
    } else {
        var lResponse = params.res.custdb__UserDetails_Res.tbCelerityCustomize;
        for (i = 0; i < lResponse.length; i++) {
            if (lResponse[i].type == "widget") {
                apz.custdb.dashboard.custWidgetArr[lResponse[i].sequence - 1] = lResponse[i].widgetId;
            } else if (lResponse[i].type == "microapp") {
                apz.custdb.dashboard.custMicroappArr[lResponse[i].sequence - 1] = lResponse[i].widgetId;
            }
        }
        if (apz.custdb.dashboard.custWidgetArr.length === 0) {
            apz.custdb.dashboard.custWidgetArr = ['custdb__Dashboard__accountOverview', 'custdb__Dashboard__relationshipOverview',
                'custdb__Dashboard__cardTransactions'
            ];
            apz.custdb.dashboard.custWidgetArrBck = ['custdb__Dashboard__accountOverview', 'custdb__Dashboard__relationshipOverview',
                'custdb__Dashboard__cardTransactions'
            ];
        } else {
            apz.custdb.dashboard.custWidgetArrBck = $.extend(true, [], apz.custdb.dashboard.custWidgetArr);
            apz.custdb.dashboard.fnCustomizeCallBack();
            apz.custdb.dashboard.fnResetCustCheck();
        } if (apz.custdb.dashboard.custMicroappArr.length === 0) {
            apz.custdb.dashboard.custMicroappArr = ['custdb__Dashboard__FundTransfer', 'custdb__Dashboard__CustomerInfo',
                'custdb__Dashboard__talkBack','custdb__Dashboard__chatBot','custdb__Dashboard__chequeSer','custdb__Dashboard__demandDraft'
            ];
            apz.custdb.dashboard.custMicroappArrBck = ['custdb__Dashboard__FundTransfer', 'custdb__Dashboard__CustomerInfo',
                'custdb__Dashboard__talkBack','custdb__Dashboard__chatBot','custdb__Dashboard__chequeSer','custdb__Dashboard__demandDraft'
            ];
        } else {
            apz.custdb.dashboard.custMicroappArrBck = $.extend(true, [], apz.custdb.dashboard.custMicroappArr);
            apz.custdb.dashboard.fnCustomizeCallBack();
            apz.custdb.dashboard.fnResetCustCheck();
        }
    }
    if (apz.custdb.dashboard.sWidget) {
        apz.show("custdb__Dashboard__dashboard_widgets");
        $(".dashboardMain").addClass("sno");
    } else {
        apz.hide("custdb__Dashboard__dashboard_widgets");
        $(".dashboardMain").removeClass("sno");
    }
    setTimeout(function() {
        apz.custdb.dashboard.fnResetCustCheck();
    }, 0);
};
apz.custdb.dashboard.fnInitialize = function() {
    if (apz.data.scrdata.custdb__GetCustInfo_Res == undefined) {
        var lCustId = "2660";
        var lServerParams = {
            "ifaceName": "GetCustInfo",
            "buildReq": "N",
            "req": {},
            "paintResp": "N",
            "async": "",
            "callBack": apz.custdb.dashboard.fnDbCallback,
            "callBackObj": "",
        };
        lServerParams.req = {
            "reqDetails": {
                "action": "getCustProfile",
                "custId": lCustId,
                "token": apz.custdb.dashboard.sCache.tokenObj.customer
            }
        };
        apz.startSpinner("custdb__Dashboard__ps_pls_3");
        $("#page-body").css("opacity", "0.4");
        apz.server.callServer(lServerParams);
    } else {
        apz.custdb.dashboard.sAccounts = apz.data.scrdata.custdb__GetCustInfo_Res.custDetails.accountInformation;
        apz.custdb.dashboard.sCustInfo = apz.data.scrdata.custdb__GetCustInfo_Res.custDetails.customerInfo;
    }
    apz.custdb.dashboard.fnLoadDashboardData();
    $("#custdb__Dashboard__accList li").attr("onclick", "apz.custdb.dashboard.fnLaunchAccountDetails(this);");
};
apz.custdb.dashboard.fnDbCallback = function(params) {
    debugger;
    apz.stopSpinner("custdb__Dashboard__ps_pls_3");
    $("#page-body").css("opacity", "1");
    apz.custdb.dashboard.sAccounts = apz.data.scrdata.custdb__GetCustInfo_Res.custDetails.accountInformation;
    for (i = 0; i < apz.data.scrdata.custdb__GetCustInfo_Res.custDetails.accountInformation.length; i++) {
        apz.data.scrdata.custdb__GetCustInfo_Res.custDetails.accountInformation[i].currentBalanceAmt = Math.abs(apz.data.scrdata.custdb__GetCustInfo_Res
            .custDetails.accountInformation[i].currentBalanceAmt);
    }
    apz.custdb.dashboard.sCustInfo = apz.data.scrdata.custdb__GetCustInfo_Res.custDetails.customerInfo;
};
apz.custdb.dashboard.fnLoadDashboardData = function() {
    debugger;
    var lLoanBal = 0,
        lCardBal = 0,
        lDepositBal = 0;
    apz.custdb.dashboard.sLoanAcc = [];
    apz.custdb.dashboard.sCardAcc = [];
    apz.custdb.dashboard.sRSVAcc = [];
    apz.custdb.dashboard.sDDAAcc = [];
    $("#custdb__Dashboard__name_txtcnt").text(apz.custdb.dashboard.sCustInfo.customerNameLine1);
    $("#custdb__Dashboard__custId_txtcnt").text("Customer Id : " + apz.custdb.dashboard.sCustInfo.customerNbr);
    for (i = 0; i < apz.custdb.dashboard.sAccounts.length; i++) {
        var lAccType = apz.custdb.dashboard.sAccounts[i].accountType;
        if (lAccType == "CLS" || lAccType == "ILS" || lAccType == "MLS" || lAccType == "ICF") {
            apz.custdb.dashboard.sLoanAcc.push(apz.custdb.dashboard.sAccounts[i]);
            lLoanBal = parseFloat(lLoanBal + apz.custdb.dashboard.sAccounts[i].currentBalanceAmt);
        } else if (lAccType == "CRD" || lAccType == "PLS") {
            if (lAccType == "CRD") {
                apz.custdb.dashboard.sCardNum = apz.custdb.dashboard.sAccounts[i].accountNbr;
            }
            apz.custdb.dashboard.sCardAcc.push(apz.custdb.dashboard.sAccounts[i]);
            lCardBal = parseFloat(lCardBal + apz.custdb.dashboard.sAccounts[i].currentBalanceAmt);
        } else if (lAccType == "DDA") {
            apz.custdb.dashboard.sAccounts[i].accountNbr = apz.custdb.dashboard.sAccounts[i].accountNbr.slice(-5);
            apz.custdb.dashboard.sDDAAcc.push(apz.custdb.dashboard.sAccounts[i]);
            lDepositBal = parseFloat(lDepositBal + apz.custdb.dashboard.sAccounts[i].currentBalanceAmt);
        } else if (lAccType == "RSV") {
            apz.custdb.dashboard.sAccounts[i].accountNbr = apz.custdb.dashboard.sAccounts[i].accountNbr.slice(-5);
            apz.custdb.dashboard.sRSVAcc.push(apz.custdb.dashboard.sAccounts[i]);
            lDepositBal = parseFloat(lDepositBal + apz.custdb.dashboard.sAccounts[i].currentBalanceAmt);
        }
    }
    apz.data.scrdata.custdb__RelOverview_Res = {
        "Overview": [{
            "Label": "Loan",
            "Value": lLoanBal
        }, {
            "Label": "Cards",
            "Value": lCardBal
        }]
    };
    apz.data.scrdata.custdb__AccOverview_Res = {
        "Overview": [{
            "Label": "Loans",
            "Value": lLoanBal,
            "image": "icon-land001"
        }, {
            "Label": "Cards",
            "Value": lCardBal,
            "image": "icon-land002"
        }]
    };
    apz.data.loadData("RelOverview", "custdb");
    apz.data.loadData("AccOverview", "custdb");
    $(".raphael-group-8-axisbottom g:nth-child(4)").hide();
    $("#custdb__Dashboard__ps_pls_3_ul h4").css("color", "#5c9ebc");
    var lServerParams = {
        "ifaceName": "GetCardAccTransac",
        "buildReq": "N",
        "req": {},
        "paintResp": "N",
        "async": "",
        "callBack": apz.custdb.dashboard.fncardCallback,
        "callBackObj": "",
    };
    lServerParams.req = {
        "reqDetails": {
            "action": "getCardTransactions",
            "cardNumber": apz.custdb.dashboard.sCardNum.split("*").join(""),
            "token": apz.csmrbk.landingpage.sCardToken
        }
    }
    apz.startLoader();
    apz.server.callServer(lServerParams);
};
apz.custdb.dashboard.fncardCallback = function(params) {
    debugger;
    apz.data.scrdata.custdb__GetCardAccTransac_Res.getCardTransacDet = params.res.custdb__GetCardAccTransac_Res.getCardTransacDet.transactionInfo;
    for (i = 0; i < apz.data.scrdata.custdb__GetCardAccTransac_Res.getCardTransacDet.length; i++) {
        var lDate = apz.data.scrdata.custdb__GetCardAccTransac_Res.getCardTransacDet[i].transactionDt;
        lDate = lDate.split("-");
        apz.data.scrdata.custdb__GetCardAccTransac_Res.getCardTransacDet[i].transactionDt = lDate[1] + "/" + lDate[2] + "/" + lDate[0];
        var lAmt = apz.data.scrdata.custdb__GetCardAccTransac_Res.getCardTransacDet[i].transactionAmt.toString();
        apz.data.scrdata.custdb__GetCardAccTransac_Res.getCardTransacDet[i].transactionAmt = "$ "+lAmt;
    }
    apz.data.loadData("GetCardAccTransac", "custdb");
};
apz.custdb.dashboard.fnLaunchAccountDetails = function(pthis) {
    debugger;
    if ($(pthis).find(".label").text() == "Loans") {
        var lAppId = "loandt";
        var lScr = "LoanSummary";
        var lAccounts = [];
        lAccounts = apz.custdb.dashboard.sLoanAcc;
    } else {
        var lAppId = "carddt";
        var lScr = "CardSummary";
        var lAccounts = [];
        lAccounts = apz.custdb.dashboard.sCardAcc;
    }
    var lParams = {
        "appId": lAppId,
        "scr": lScr,
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "parentAppId": "csmrbk",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "accounts": lAccounts,
            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchApp(lParams);
};
apz.app.updateChartBeforeRender = function(pchartType, pchartData, pid, pchart) {
    pchartData.chart.showYAxisValues = 0;
    pchart.width = "200px";
};
apz.custdb.dashboard.fnCustomizeReset = function() {
    debugger;
    apz.custdb.dashboard.custWidgetArr = $.extend(true, [], apz.custdb.dashboard.custWidgetArrBck);
    apz.custdb.dashboard.custMicroappArr = $.extend(true, [], apz.custdb.dashboard.custMicroappArrBck);
    apz.custdb.dashboard.fnResetCustCheck();
};
apz.custdb.dashboard.fnCustomizeApply = function() {
    debugger;
    if (apz.custdb.dashboard.sCache.sAction == "NewUser") {
        apz.custdb.dashboard.fnInsertUserDetails()
    } else {
        apz.custdb.dashboard.fnUpdateUserDetails();
    }
};
apz.custdb.dashboard.fnInsertUserDetails = function() {
    debugger;
    var lObjArr = [];
    for (i = 0; i < apz.custdb.dashboard.custWidgetArr.length; i++) {
        var lObj = {
            "sequence": i + 1,
            "widgetId": apz.custdb.dashboard.custWidgetArr[i],
            "screenName": "Dashboard",
            "type": "widget",
            "userId": apz.csmrbk.userId
        };
        lObjArr.push(lObj);
    };
    for (i = 0; i < apz.custdb.dashboard.custMicroappArr.length; i++) {
        var lObj = {
            "sequence": i + 1,
            "widgetId": apz.custdb.dashboard.custMicroappArr[i],
            "screenName": "Dashboard",
            "type": "microapp",
            "userId": apz.csmrbk.userId
        };
        lObjArr.push(lObj);
    };
    var lReq = {
        "tbCelerityCustomize": lObjArr
    };
    var lServerParams = {
        "ifaceName": "UserDetails_New",
        "buildReq": "N",
        "req": lReq,
        "paintResp": "N",
        "callBack": apz.custdb.dashboard.fnCustomizeCallBack
    };
    debugger;
    apz.server.callServer(lServerParams);
};
apz.custdb.dashboard.fnCustomizeCallBack = function(params) {
    debugger;
    var lWidgetParent = $("#custdb__Dashboard__Dashboard_mainCol");
    lWidgetParent.children().addClass('sno');
    for (i = 0; i < apz.custdb.dashboard.custWidgetArr.length; i++) {
        var lWidgetChild = $('#' + apz.custdb.dashboard.custWidgetArr[i]);
        if (lWidgetParent.find(lWidgetChild)) {
            lWidgetChild.removeClass('sno');
            lWidgetParent.append(lWidgetChild);
        }
    }
    var lMicroappParent = $("#custdb__Dashboard__ct_frm_2_row");
    lMicroappParent.children().addClass('sno');
    for (i = 0; i < apz.custdb.dashboard.custMicroappArr.length; i++) {
        var lMicroappChild = $('#' + apz.custdb.dashboard.custMicroappArr[i] + '_li');
        if (lMicroappParent.find(lMicroappChild)) {
            lMicroappChild.removeClass('sno');
            lMicroappParent.append(lMicroappChild);
        }
    }
    apz.hide("custdb__Dashboard__dashboard_widgets");
    $(".dashboardMain").removeClass("sno");
};
apz.custdb.dashboard.fnUpdateUserDetails = function() {
    debugger;
    var lReq = {
        "tbCelerityCustomize": {
            "userId": apz.csmrbk.userId,
            "screenName": "Dashboard"
        }
    };
    var lServerParams = {
        "ifaceName": "UserDetails_Delete",
        "buildReq": "N",
        "req": lReq,
        "paintResp": "N",
        "callBack": apz.custdb.dashboard.fnDeleteCallBack
    };
    debugger;
    apz.server.callServer(lServerParams);
}
apz.custdb.dashboard.fnDeleteCallBack = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        apz.apz.dispMsg(param);
    } else {
        apz.custdb.dashboard.fnInsertUserDetails();
    }
};
apz.custdb.dashboard.fnCustomizeCheck = function(pThis) {
    debugger;
    if (apz.getElmValue(pThis.id) == "y") {
       // $(pThis).addClass("selected");
        if (pThis.id == "custdb__Dashboard__accOvr_check") {
            apz.custdb.dashboard.custWidgetArr.push("custdb__Dashboard__accountOverview");
        } else if (pThis.id == "custdb__Dashboard__relOvr_check") {
            apz.custdb.dashboard.custWidgetArr.push("custdb__Dashboard__relationshipOverview");
        } else if (pThis.id == "custdb__Dashboard__card_check") {
            apz.custdb.dashboard.custWidgetArr.push("custdb__Dashboard__cardTransactions");
        } else if (pThis.id == "custdb__Dashboard__ft_check") {
            apz.custdb.dashboard.custMicroappArr.push("custdb__Dashboard__FundTransfer");
        } else if (pThis.id == "custdb__Dashboard__info_check") {
            apz.custdb.dashboard.custMicroappArr.push("custdb__Dashboard__CustomerInfo");
        } else if (pThis.id == "custdb__Dashboard__talk_check") {
            apz.custdb.dashboard.custMicroappArr.push("custdb__Dashboard__talkBack");
        }else if (pThis.id == "custdb__Dashboard__chat_check") {
            apz.custdb.dashboard.custMicroappArr.push("custdb__Dashboard__chatBot");
        } else if (pThis.id == "custdb__Dashboard__cheq_check") {
            apz.custdb.dashboard.custMicroappArr.push("custdb__Dashboard__chequeSer");
        } else if (pThis.id == "custdb__Dashboard__dd_check") {
            apz.custdb.dashboard.custMicroappArr.push("custdb__Dashboard__demandDraft");
        }
        apz.custdb.dashboard.fnResetCustSeq();
    } else {
        //$(pThis).removeClass("selected");
        if (pThis.id == "custdb__Dashboard__accOvr_check") {
            var index = $.inArray('custdb__Dashboard__accountOverview', apz.custdb.dashboard.custWidgetArr);
            if (index != -1) {
                apz.custdb.dashboard.custWidgetArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__relOvr_check") {
            var index = $.inArray('custdb__Dashboard__relationshipOverview', apz.custdb.dashboard.custWidgetArr);
            if (index != -1) {
                apz.custdb.dashboard.custWidgetArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__card_check") {
            var index = $.inArray('custdb__Dashboard__cardTransactions', apz.custdb.dashboard.custWidgetArr);
            if (index != -1) {
                apz.custdb.dashboard.custWidgetArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__ft_check") {
            var index = $.inArray('custdb__Dashboard__FundTransfer', apz.custdb.dashboard.custMicroappArr);
            if (index != -1) {
                apz.custdb.dashboard.custMicroappArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__info_check") {
            var index = $.inArray('custdb__Dashboard__CustomerInfo', apz.custdb.dashboard.custMicroappArr);
            if (index != -1) {
                apz.custdb.dashboard.custMicroappArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__talk_check") {
            var index = $.inArray('custdb__Dashboard__talkBack', apz.custdb.dashboard.custMicroappArr);
            if (index != -1) {
                apz.custdb.dashboard.custMicroappArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__chat_check") {
            var index = $.inArray('custdb__Dashboard__chatBot', apz.custdb.dashboard.custMicroappArr);
            if (index != -1) {
                apz.custdb.dashboard.custMicroappArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__cheq_check") {
            var index = $.inArray('custdb__Dashboard__chequeSer', apz.custdb.dashboard.custMicroappArr);
            if (index != -1) {
                apz.custdb.dashboard.custMicroappArr.splice(index, 1);
            }
        } else if (pThis.id == "custdb__Dashboard__dd_check") {
            var index = $.inArray('custdb__Dashboard__demandDraft', apz.custdb.dashboard.custMicroappArr);
            if (index != -1) {
                apz.custdb.dashboard.custMicroappArr.splice(index, 1);
            }
        }
        apz.custdb.dashboard.fnResetCustSeq();
    }
};
apz.custdb.dashboard.fnCustomizeBtnClick = function(pThis) {
    debugger;
    $(pThis).toggleClass("selected");
    $($(pThis).siblings()[0]).find("input").trigger("click");
};
apz.custdb.dashboard.fnResetCustSeq = function() {
    debugger;
    $("#custdb__Dashboard__dashboard_widgets .ett-badg").addClass('sno');
   
    $("#custdb__Dashboard__dashboard_widgets .ett-badg").text('');
    for (i = 0; i < apz.custdb.dashboard.custWidgetArr.length; i++) {
        if (apz.custdb.dashboard.custWidgetArr[i] == "custdb__Dashboard__accountOverview") {
            apz.setElmValue("custdb__Dashboard__accOvr_seq", i + 1);
            $("#custdb__Dashboard__accOvr_seq").removeClass("sno");
        } else if (apz.custdb.dashboard.custWidgetArr[i] == "custdb__Dashboard__relationshipOverview") {
            apz.setElmValue("custdb__Dashboard__relOvr_seq", i + 1);
            $("#custdb__Dashboard__relOvr_seq").removeClass("sno");
        } else if (apz.custdb.dashboard.custWidgetArr[i] == "custdb__Dashboard__cardTransactions") {
            apz.setElmValue("custdb__Dashboard__card_seq", i + 1);
            $("#custdb__Dashboard__card_seq").removeClass("sno");
        }
    }
    for (i = 0; i < apz.custdb.dashboard.custMicroappArr.length; i++) {
        if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__FundTransfer") {
            apz.setElmValue("custdb__Dashboard__ft_seq", i + 1);
            $("#custdb__Dashboard__ft_seq").removeClass("sno");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__CustomerInfo") {
            apz.setElmValue("custdb__Dashboard__info_seq", i + 1);
            $("#custdb__Dashboard__info_seq").removeClass("sno");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__talkBack") {
            apz.setElmValue("custdb__Dashboard__talk_seq", i + 1);
            $("#custdb__Dashboard__talk_seq").removeClass("sno");
        }else  if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__chatBot") {
            apz.setElmValue("custdb__Dashboard__chat_seq", i + 1);
            $("#custdb__Dashboard__chat_seq").removeClass("sno");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__chequeSer") {
            apz.setElmValue("custdb__Dashboard__cheq_seq", i + 1);
            $("#custdb__Dashboard__cheq_seq").removeClass("sno");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__demandDraft") {
            apz.setElmValue("custdb__Dashboard__dd_seq", i + 1);
            $("#custdb__Dashboard__dd_seq").removeClass("sno");
        }
    }
};
apz.custdb.dashboard.fnResetCustCheck = function() {
    debugger;
     $("#custdb__Dashboard__dashboard_widgets button").removeClass('selected');
    for (i = 0; i < apz.custdb.dashboard.custWidgetArr.length; i++) {
        if (apz.custdb.dashboard.custWidgetArr[i] == "custdb__Dashboard__accountOverview") {
            document.getElementById("custdb__Dashboard__accOvr_check").checked = true;
            $("#custdb__Dashboard__accOvr_icon").addClass("selected");
        } else if (apz.custdb.dashboard.custWidgetArr[i] == "custdb__Dashboard__relationshipOverview") {
            document.getElementById("custdb__Dashboard__relOvr_check").checked = true;
             $("#custdb__Dashboard__relOvr_icon").addClass("selected");
        } else if (apz.custdb.dashboard.custWidgetArr[i] == "custdb__Dashboard__cardTransactions") {
            document.getElementById("custdb__Dashboard__card_check").checked = true;
             $("#custdb__Dashboard__card_icon").addClass("selected");
        }
    }
    for (i = 0; i < apz.custdb.dashboard.custMicroappArr.length; i++) {
        if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__FundTransfer") {
            document.getElementById("custdb__Dashboard__ft_check").checked = true;
             $("#custdb__Dashboard__ft_icon").addClass("selected");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__CustomerInfo") {
            document.getElementById("custdb__Dashboard__info_check").checked = true;
             $("#custdb__Dashboard__info_icon").addClass("selected");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__talkBack") {
            document.getElementById("custdb__Dashboard__talk_check").checked = true;
             $("#custdb__Dashboard__talk_icon").addClass("selected");
        }else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__chatBot") {
            document.getElementById("custdb__Dashboard__chat_check").checked = true;
             $("#custdb__Dashboard__chat_icon").addClass("selected");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__chequeSer") {
            document.getElementById("custdb__Dashboard__cheq_check").checked = true;
             $("#custdb__Dashboard__cheq_icon").addClass("selected");
        } else if (apz.custdb.dashboard.custMicroappArr[i] == "custdb__Dashboard__demandDraft") {
            document.getElementById("custdb__Dashboard__dd_check").checked = true;
             $("#custdb__Dashboard__dd_icon").addClass("selected");
        }
    }
    apz.custdb.dashboard.fnResetCustSeq();
};
apz.custdb.dashboard.fnLaunchFundTransfer = function() {
    debugger;
    var lLaunchParams = {
        "appId": "funtra",
        "scr": "TransferDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "accounts": apz.custdb.dashboard.sDepositAcc,
            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchApp(lLaunchParams);
}
apz.custdb.dashboard.fnLaunchCustInfo = function() {
    debugger;
    var lLaunchParams = {
        "appId": "custpr",
        "scr": "Profile",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "accounts": "",
            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchApp(lLaunchParams);
}
apz.custdb.dashboard.fnLaunchTalkAcc = function() {
    debugger;
    var json = {};
    json.id = "NATIVE";
    json.callBack = apz.custdb.dashboard.fnTalkCallback;
    apz.ns.nativeServiceExt(json);
}
apz.custdb.dashboard.fnTalkCallback = function(params) {};
