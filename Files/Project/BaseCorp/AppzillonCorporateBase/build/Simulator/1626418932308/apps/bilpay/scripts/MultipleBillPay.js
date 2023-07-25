apz.bilpay.MultipleBillPay = {};
apz.bilpay.MultipleBillPay.sDeleteRecordData = {};
apz.app.onLoad_MultipleBillPay = function(puserObj) {
    debugger;
    apz.hide("NBBA01__LandingPage__AccountSummaryRow");
    apz.hide("NBBA01__LandingPage__CardDetailsRow");
    apz.hide("NBBA01__LandingPage__FinanceAccountsRow");
    apz.hide("bilpay__MultipleBillPay__deleteBillerConfModal");
    apz.hide("NBBA01__LandingPage__DepositAccountsRow");
    apz.show("NBBA01__LandingPage__BillPaymentRow");
    apz.bilpay.MultipleBillPay.sParams = puserObj;
    apz.data.loadJsonData("AccountDetails","bilpay");
    
    apz.bilpay.MultipleBillPay.sParams.data.accounts = apz.data.scrdata.bilpay__AccountDetails_Res.accounts;
    apz.hide("bilpay__MultipleBillPay__stage1nav");
};
apz.app.onShown_MultipleBillPay = function(puserObj) {
    apz.bilpay.MultipleBillPay.fn_showRecs();
    if (puserObj.Navigation) {
        apz.bilpay.MultipleBillPay.fnSetNavigation(puserObj)
    }
    //apz.bilpay.MultipleBillPay.fnGoToStage1();
};
apz.bilpay.MultipleBillPay.fnSetNavigation = function(params) {
    debugger;
    apz.bilpay.MultipleBillPay.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    if (!apz.isNull(params.headerText)) {
        lParams.headerText = params.headerText;
    } else {
        lParams.headerText = "MANAGE BILLERS";
    }
    lParams.backPressed = apz.bilpay.MultipleBillPay.fnBack;
    apz.bilpay.MultipleBillPay.Navigation(lParams);
};
apz.bilpay.MultipleBillPay.fn_showRecs = function() {
    debugger;
    // var lserver = {};
    // lserver.appId = "bilpay";
    // lserver.scrName = "MultipleBillPay";
    // lserver.ifaceName = "MultipleBillers";
    // lserver.buildReq = "N";
    // lserver.paintResp = "N";
    // lserver.req = {
    //     "action": "Query"
    // };
    // lserver.callBack = apz.bilpay.MultipleBillPay.fn_BillerListCallback;
    apz.startLoader();
    //apz.server.callServer(lserver);
    apz.data.loadJsonData("MultipleBillers","bilpay");
    apz.stopLoader();
    apz.data.loadJsonData("BillerDetails","bilpay");
    
};

apz.bilpay.MultipleBillPay.fn_removenumformat = function(amt) {
    var obj = {};
    obj.value = amt;
    obj.decimalSep = ".";
    var result = apz.unFormatNumber(obj);
    return parseFloat(result);
};

apz.bilpay.MultipleBillPay.fn_closeDeleteToggle = function() {
    apz.hide("bilpay__MultipleBillPay__deleteBillerConfModal");
    apz.show("bilpay__MultipleBillPay__multiplebillpaystage1");
};
apz.bilpay.MultipleBillPay.fn_deleteSingleRecord = function(pthis) {
    debugger;
    var rowNo = $(pthis).attr('rowno');
    apz.bilpay.MultipleBillPay.sDeleteRecordData.consumerno = apz.getElmValue('bilpay__MultipleBillers__o__Billers__ConsumerNumber_' + rowNo);
    apz.bilpay.MultipleBillPay.sDeleteRecordData.serviceprovider = apz.getElmValue('bilpay__MultipleBillers__o__Billers__ServiceName_' + rowNo);
    apz.bilpay.MultipleBillPay.sDeleteRecordData.desc = apz.getElmValue('bilpay__MultipleBillers__o__Billers__Description_' + rowNo);
    apz.bilpay.MultipleBillPay.sDeleteRecordData.siReq = apz.getElmValue('bilpay__MultipleBillers__o__Billers__SiReq_' + rowNo);
    apz.bilpay.MultipleBillPay.sDeleteRecordData.trancLimit = apz.getElmValue('bilpay__MultipleBillers__o__Billers__TrancLimit_' + rowNo);
    apz.bilpay.MultipleBillPay.sDeleteRecordData.account = apz.getElmValue('bilpay__MultipleBillers__o__Billers__Account_' + rowNo);
    apz.bilpay.MultipleBillPay.sDeleteRecordData.retryCount = apz.getElmValue('bilpay__MultipleBillers__o__Billers__RetryCount_' + rowNo);
    apz.bilpay.MultipleBillPay.sDeleteRecordData.prefPayDay = apz.getElmValue('bilpay__MultipleBillers__o__Billers__PreferredPayDay_' + rowNo);
    apz.bilpay.MultipleBillPay.paymentType = 'Single';
    apz.show("bilpay__MultipleBillPay__deleteBillerConfModal");
    apz.hide("bilpay__MultipleBillPay__multiplebillpaystage1");
    apz.hide('bilpay__MultipleBillPay__multipleDeleteRow');
    apz.show('bilpay__MultipleBillPay__singleDeleteRow');
    if (apz.bilpay.MultipleBillPay.sDeleteRecordData.siReq == "NO") {
        $(".siReqCol").addClass("sno");
    } else {
        $(".siReqCol").removeClass("sno");
    }
    apz.setElmValue('bilpay__MultipleBillPay__singleDeleteNickName', apz.bilpay.MultipleBillPay.sDeleteRecordData.desc);
    apz.setElmValue('bilpay__MultipleBillPay__singleDeleteConsumerNo', apz.bilpay.MultipleBillPay.sDeleteRecordData.consumerno);
    apz.setElmValue('bilpay__MultipleBillPay__singleDeleteServiceProvider', apz.bilpay.MultipleBillPay.sDeleteRecordData.serviceprovider);
    apz.setElmValue('bilpay__MultipleBillPay__singleDeleteSiReq', apz.bilpay.MultipleBillPay.sDeleteRecordData.siReq);
    apz.setElmValue('bilpay__MultipleBillPay__singleDeleteTrancLimit', apz.bilpay.MultipleBillPay.sDeleteRecordData.trancLimit);
    apz.setElmValue('bilpay__MultipleBillPay__singleDeleteAccount', apz.bilpay.MultipleBillPay.sDeleteRecordData.account);
    apz.setElmValue('bilpay__MultipleBillPay__singleDeleteRetryCount', apz.bilpay.MultipleBillPay.sDeleteRecordData.retryCount);
    apz.setElmValue('bilpay__MultipleBillPay__singleDeletePrefPayDay', apz.bilpay.MultipleBillPay.sDeleteRecordData.prefPayDay);
};
apz.bilpay.MultipleBillPay.fn_confirmDelete = function() {
    var lreq = {};
    lreq.action = 'DELETE';
    var lObj = {
        "value": apz.bilpay.MultipleBillPay.sDeleteRecordData.trancLimit,
        "decimalSep": '.',
        "displayAsLiteral": 'N'
    };
    if (apz.bilpay.MultipleBillPay.paymentType == 'Single') {
        lreq.billerDtls = {};
        lreq.billerDtls.customerId = apz.bilpay.MultipleBillPay.sParams.data.customerID;
        lreq.billerDtls.consumerNumber = apz.bilpay.MultipleBillPay.sDeleteRecordData.consumerno;
        lreq.billerDtls.serviceProvider = apz.bilpay.MultipleBillPay.sDeleteRecordData.serviceprovider;
        lreq.billerDtls.nickName = apz.bilpay.MultipleBillPay.sDeleteRecordData.desc;
        lreq.billerDtls.siReq = apz.bilpay.MultipleBillPay.sDeleteRecordData.siReq;
        if (lreq.billerDtls.siReq == "YES") {
            lreq.billerDtls.account = apz.bilpay.MultipleBillPay.sDeleteRecordData.account;
            lreq.billerDtls.txnLimit = apz.unFormatNumber(lObj);
            lreq.billerDtls.retryCount = apz.bilpay.MultipleBillPay.sDeleteRecordData.retryCount;
            lreq.billerDtls.PreferredPayDay = apz.bilpay.MultipleBillPay.sDeleteRecordData.prefPayDay;
        }
        lreq.billerDtls.authenticationType = "OTP";
        var lParam = {};
        lParam.appId = 'bilpay';
        lParam.ifaceName = 'DeleteBiller';
        lParam.req = lreq;
        lParam.async = true;
        lParam.callBack = apz.bilpay.MultipleBillPay.fn_deleteCallBack;
        apz.startLoader();
        //apz.server.callServer(lParam);
        apz.data.loadJsonData("DeleteBiller","bilpay");
         apz.stopLoader();
    debugger;
    apz.hide("bilpay__MultipleBillPay__deleteBillerConfModal")
    
        var refno = apz.data.scrdata.bilpay__DeleteBiller_Res.billerDtls.data.OTPRefNo;
        apz.bilpay.MultipleBillPay.fn_deleteOtpCall(refno);
   
        
    } else {
        for (var i = 0; i < apz.bilpay.MultipleBillPay.sIndex; i++) {}
    }
};
apz.bilpay.MultipleBillPay.fn_deleteCallBack = function(resp) {
    apz.stopLoader();
    debugger;
    apz.hide("bilpay__MultipleBillPay__deleteBillerConfModal")
    if (resp.resFull.appzillonHeader.status) {
        var refno = resp.res.bilpay__DeleteBiller_Res.billerDtls.data.OTPRefNo;
        apz.bilpay.MultipleBillPay.fn_deleteOtpCall(refno);
    }
};
apz.bilpay.MultipleBillPay.fn_deleteOtpCall = function(refNo) {
    apz.hide("bilpay__MultipleBillPay__multiplebillpaystage1");
    var lparams = {
        "appId": "otpeng",
        "scr": "ProcessOTP",
        "div": "bilpay__MultipleBillPay__otpshowcol",
        "userObj": {
            "action": "SetRefNo",
            "data": {
                "OTPRefNo": refNo
            },
            "control": {
                "appId": "otpeng",
                "callBack": apz.bilpay.MultipleBillPay.fn_singleDeleteOTPCB,
                "destroyDiv": "bilpay__MultipleBillPay__otpshowcol"
            }
        }
    };
    apz.launchApp(lparams);
};
apz.bilpay.MultipleBillPay.fn_singleDeleteOTPCB = function(resp) {
    $("#bilpay__MultipleBillPay__otpshowcol").remove();
    apz.show("bilpay__MultipleBillPay__singleDeleteSuccRow");
    var lParams = {};
    lParams.showHome = 'Y';
    lParams.showImage = 'N';
    lParams.directHome = apz.bilpay.MultipleBillPay.fndirectHome;
    // lParams.headerText = apz.lits['bilpay'][apz.language]['LIT_Success'];
    // apz.bilpay.MultipleBillPay.fnsetNavi(lParams);
    apz.hide("NBBA01__LandingPage__backButton");
    $("body").removeClass("ter");
    $("body").addClass("pri");
    var date = new Date();
    apz.setElmValue("bilpay__MultipleBillPay__deleteTransDate", date.format('d M Y h:mA'));
    if (apz.bilpay.MultipleBillPay.paymentType == 'Single') {
        apz.hide("bilpay__MultipleBillPay__multipleDeleteSuccRow");
        apz.show("bilpay__MultipleBillPay__singleDeleteSuccRow");
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeleteNickName", apz.bilpay.MultipleBillPay.sDeleteRecordData.desc);
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeleteConsumerNo", apz.bilpay.MultipleBillPay.sDeleteRecordData.consumerno);
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeleteServiceProvider", apz.bilpay.MultipleBillPay.sDeleteRecordData.serviceprovider);
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeleteSiReq", apz.bilpay.MultipleBillPay.sDeleteRecordData.siReq);
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeleteTrancLimit", apz.bilpay.MultipleBillPay.sDeleteRecordData.trancLimit);
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeleteAccount", apz.bilpay.MultipleBillPay.sDeleteRecordData.account);
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeleteRetryCount", apz.bilpay.MultipleBillPay.sDeleteRecordData.retryCount);
        apz.setElmValue("bilpay__MultipleBillPay__singleSucDeletePrefPayDay", apz.bilpay.MultipleBillPay.sDeleteRecordData.prefPayDay);
    } else {
        apz.show("bilpay__MultipleBillPay__multipleDeleteSuccRow");
        apz.hide("bilpay__MultipleBillPay__singleDeleteSuccRow");
    }
};
apz.bilpay.MultipleBillPay.fn_OTPCall = function(presp) {
    if (presp.resFull.appzillonHeader.status) {
        var refNo = presp.res.bilpay__DeleteBiller_Res.RefNo;
        apz.bilpay.MultipleBillPay.fn_callOTP(refNo);
    } else {}
};
apz.bilpay.MultipleBillPay.fn_OTPCall = function(refNo) {
    var lparams = {
        "appId": "otpeng",
        "scr": "ProcessOTP",
        "div": "bilpay__MultipleBillPay__otpshowcol",
        "userObj": {
            "action": "SetRefNo",
            "data": {
                "OTPRefNo": refNo
            },
            "control": {
                "appId": "otpeng",
                "callBack": apz.bilpay.MultipleBillPay.fn_OTP,
                "destroyDiv": "bilpay__MultipleBillPay__otpshowcol"
            }
        }
    };
    apz.launchApp(lparams);
};
apz.bilpay.MultipleBillPay.fn_addRecord = function() {
    //apz.hide("bilpay__MultipleBillPay__multiplebillpaystage1");
    var lparams = {};
    lparams.div = "bilpay__MultipleBillPay__multiplebillpaystage1";
    lparams.scr = "AddBiller";
    lparams.userObj = {};
    lparams.userObj.customerContext = apz.bilpay.MultipleBillPay.sParams;
    lparams.userObj.callback = apz.bilpay.MultipleBillPay.fn_reLaunchApp;
    apz.launchSubScreen(lparams);
    //apz.show("bilpay__MultipleBillPay__multiplebillpaystage11");
};
apz.bilpay.MultipleBillPay.fn_paySingleBill = function(pthis) {
    //apz.hide("bilpay__MultipleBillPay__multiplebillpaystage1");
    debugger;
    apz.bilpay.MultipleBillPay.paymentType = "Single";
    var rowNo = $(pthis).attr('rowno');
    var lAmount = apz.bilpay.MultipleBillPay.fn_removenumformat("0.00");
    var lparams = {};
    lparams.div = "bilpay__MultipleBillPay__customeraccountsel";
    lparams.scr = "BillPay";
    lparams.appId = "bllpay";
    lparams.userObj = {};
    lparams.userObj.accountStatus = {};
    lparams.userObj.accountStatus.Description = apz.getElmValue("bilpay__MultipleBillers__o__Billers__Description_" + rowNo);
    lparams.userObj.accountStatus.ConsumerNumber = apz.getElmValue("bilpay__MultipleBillers__o__Billers__ConsumerNumber_" + rowNo);
    lparams.userObj.accountStatus.ServiceName = apz.getElmValue("bilpay__MultipleBillers__o__Billers__ServiceName_" + rowNo);
    lparams.userObj.accountStatus.amount = apz.getElmValue("bilpay__MultipleBillers__o__Billers__Amount_" + rowNo).split(".")[0];
    lparams.userObj.accountStatus.currency = apz.getElmValue("bilpay__MultipleBillPay__amountccy_" + rowNo);
    lparams.userObj.accountStatus.dueDate = apz.getElmValue("bilpay__MultipleBillPay__duedate_" + rowNo);
    lAmount += apz.bilpay.MultipleBillPay.fn_removenumformat(apz.getElmValue("bilpay__MultipleBillers__o__Billers__Amount_" + rowNo));
    lparams.userObj.totalAmt = lAmount;
    lparams.userObj.data = apz.bilpay.MultipleBillPay.sParams.data;
    lparams.userObj.callback = apz.bilpay.MultipleBillPay.fn_accountSel;
    apz.launchApp(lparams);
    $("#bilpay__MultipleBillPay__multiplebillpaystage1").empty();
    apz.show("bilpay__MultipleBillPay__multiplebillpaystage2");
};
apz.bilpay.MultipleBillPay.fn_addToTotal = function(pthis) {
    var payableAmt = 0;
    var lselect = apz.getElmValue(pthis.id);
    var lrec = pthis.id && pthis.id.split("_");
    if (apz.getElmValue("bilpay__MultipleBillPay__totalamount") == " ") {
        var totalAmt = apz.bilpay.MultipleBillPay.fn_removenumformat("0.00");
    } else {
        var totalAmt = apz.bilpay.MultipleBillPay.fn_removenumformat(apz.getElmValue("bilpay__MultipleBillPay__totalamount"));
    }
    var lamt = apz.getElmValue("bilpay__MultipleBillers__o__Billers__Amount_" + lrec[5]);
    lamt = apz.unFormatNumber({
        "value": lamt,
        "decimalSep": ".",
        "displayAsLiteral": "N"
    });
    lamt = apz.getFloat(lamt);
    lamt = apz.isNull(lamt) ? 0 : lamt;
    if (lselect == 'y') {
        payableAmt = totalAmt + lamt;
        apz.setElmValue("bilpay__MultipleBillPay__totalamount", payableAmt);
        $("#bilpay__MultipleBillPay__stage1nav").removeClass("sno");
    } else {
        payableAmt = totalAmt - lamt;
        payableAmt == 0 ? $("#bilpay__MultipleBillPay__stage1nav").addClass("sno") : $("#bilpay__MultipleBillPay__stage1nav").removeClass("sno");;
    }
    apz.setElmValue("bilpay__MultipleBillPay__totalamount", payableAmt);
};
apz.bilpay.MultipleBillPay.fn_checkForOnlyOnePayment = function() {
    var lbillerCount = apz.data.scrdata.bilpay__MultipleBillers_Res.billerList.length;
    var lcount = 0;
    for (var i = 0; i < lbillerCount; i++) {
        if (apz.getElmValue("bilpay__MultipleBillPay__selectedrec_" + i) == 'y') {
            lcount++;
        }
    }
    return lcount;
};
apz.bilpay.MultipleBillPay.fn_multipleBillPay = function() {
    var lmsg = {
        "message": "Currently multiple bill payment is disabled",
        "type": "I"
    };
    apz.dispMsg(lmsg);
};
apz.bilpay.MultipleBillPay.fnBack = function() {
    var params = apz.bilpay.MultipleBillPay.sParams;
    appId = "dashbd";
    Div = "NBBA01__LandingPage__DashBoardLaunchRow";
    ScrName = "DashBoard";
    $("#NBBA01__LandingPage__BillPaymentRow").empty();
    apz.NBBA01.LandingPage.fnLaunchMicroApp(appId, ScrName, Div, params);
};
apz.bilpay.MultipleBillPay.fndirectHome = function() {
    apz.NBBA01.LandingPage.fnLaunchDashBd(apz.bilpay.MultipleBillPay.sParams, "#NBBA01__LandingPage__BillPaymentRow");
};
apz.bilpay.MultipleBillPay.fn_reLaunchApp = function() {};
