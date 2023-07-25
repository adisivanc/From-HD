apz.bilpay.OneTimeBillPay = {};
apz.app.onLoad_OneTimeBillPay = function(params) {
    debugger;
    apz.hide("bilpay__OneTimeBillPay__header");
    apz.hide("NBBA01__LandingPage__AccountSummaryRow");
    apz.hide("NBBA01__LandingPage__CardDetailsRow");
    apz.hide("NBBA01__LandingPage__FinanceAccountsRow");
    apz.hide("NBBA01__LandingPage__DepositAccountsRow");
    apz.show("NBBA01__LandingPage__BillPaymentRow");
    apz.hide("bilpay__OneTimeBillPay__confirmationmodal");
    apz.hide("bilpay__OneTimeBillPay__customerpinrow");
    apz.bilpay.OneTimeBillPay.sParams = params;
    apz.data.loadJsonData("AccountDetails","bilpay");
    apz.bilpay.OneTimeBillPay.sParams.data.accounts = apz.data.scrdata.bilpay__AccountDetails_Res.accounts;
    if (params.Navigation) {
        // apz.bilpay.OneTimeBillPay.fnsetNavi = params.Navigation.setNavigation;
        // var lParams = {};
        // if (!apz.isNull(params.headerText)) {
        //     lParams.headerText = params.headerText;
        // } else {
        //     lParams.headerText = "ONE TIME BILL PAY";
        // }
        // lParams.backPressed = apz.bilpay.OneTimeBillPay.fnBack;
        // //apz.bilpay.OneTimeBillPay.fnsetNavi(lParams);
        apz.bilpay.OneTimeBillPay.fnSetNavigation(params);
    }
    // $("body").removeClass("pri");
    //    $("body").addClass("ter");
    apz.bilpay.OneTimeBillPay.sParams = params.data;
    apz.bilpay.OneTimeBillPay.fnInitialise();
    if (params.data.type == "transaction") {
        apz.setElmValue("bilpay__OneTimeBillPay__serviceamount", params.data.amount);
    }
};

apz.bilpay.OneTimeBillPay.fnSetNavigation = function(params){
     debugger;
    apz.bilpay.OneTimeBillPay.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    lParams.headerText = "ONE TIME BILL PAY";
    apz.bilpay.OneTimeBillPay.Navigation(lParams);
}
apz.bilpay.OneTimeBillPay.fnInitialise = function() {
    debugger;
    var lAccs = apz.bilpay.OneTimeBillPay.sParams.accounts;
    var lArr = [{
        "val": "",
        "desc": "Select Account"
    }];
    for (var i = 0; i < lAccs.length; i++) {
        var lObj = {
            "val": lAccs[i].accountNo,
            "desc": lAccs[i].accountType + '-' + lAccs[i].accountNo
        };
        lArr.push(lObj);
    }
    apz.populateDropdown(document.getElementById("bilpay__OneTimeBillPay__fromAcc"), lArr);
    if (apz.bilpay.OneTimeBillPay.sParams.type == "transaction") {
        apz.setElmValue("bilpay__OneTimeBillPay__fromAcc", apz.bilpay.OneTimeBillPay.sParams.fromAcc);
    }
};
apz.app.onShown_OneTimeBillPay = function(param) {
    apz.bilpay.OneTimeBillPay.fn_getServiceList();
    if (apz.bilpay.OneTimeBillPay.sParams.message != undefined) {
        $("#bilpay__OneTimeBillPay__serviceprovider").val("DU");
        $("#bilpay__OneTimeBillPay__serviceprovider_div li").removeClass("is-selected").removeClass("hilt");
        $("#bilpay__OneTimeBillPay__serviceprovider_div li[value='DU']").addClass("is-selected");
        var lMsgArray = apz.bilpay.OneTimeBillPay.sParams.message.split(" ");
        var lAmount = parseFloat(lMsgArray[lMsgArray.indexOf("amount") + 2]);
        var lDateFormat = apz.dateFormat;
        var ldate = new Date();
        ldate = ldate.toString(lDateFormat);
        var lSubId = lMsgArray[lMsgArray.indexOf("mobile") + 2];
        $("#bilpay__OneTimeBillPay__serviceaccount").val(lSubId);
        $("#bilpay__OneTimeBillPay__serviceamount").val(lAmount);
        $("#bilpay__OneTimeBillPay__paymentdate").val(ldate);
    }
};
apz.bilpay.OneTimeBillPay.fn_getServiceList = function() {
    // var lserver = {};
    // lserver.appId = "bilpay";
    // lserver.scrName = "ServiceName";
    // lserver.ifaceName = "ServiceName_Query";
    // lserver.buildReq = "Y";
    // lserver.paintResp = "N";
    // lserver.id = "New";
    // lserver.req = "";
    // lserver.async = true;
    // lserver.callBack = apz.bilpay.OneTimeBillPay.fn_ServiceListCallback;
    apz.startLoader();
    //apz.server.callServer(lserver);
     apz.data.loadJsonData("ServiceName","bilpay");
     apz.stopLoader();
       var lserviceList = apz.bilpay.OneTimeBillPay.sortObj(apz.data.scrdata.bilpay__ServiceName_Req.tbRbBillpServicename);
            apz.bilpay.OneTimeBillPay.serviceList = lserviceList;
            var lArr = [{
                "val": "",
                "desc": "Service Provider"
            }];
            for (var i = 0; i < lserviceList.length; i++) {
                lArr.push({
                    "val": lserviceList[i].serviceName,
                    "desc": lserviceList[i].serviceName
                })
            }
            apz.populateDropdown(document.getElementById("bilpay__OneTimeBillPay__serviceprovider"), lArr)
    
};
apz.bilpay.OneTimeBillPay.fn_ServiceListCallback = function(presp) {
    apz.stopLoader();
    if (presp.status) {
        if (presp.res && presp.res.bilpay__ServiceName_Req) {
            var lserviceList = apz.bilpay.OneTimeBillPay.sortObj(presp.res.bilpay__ServiceName_Req.tbRbBillpServicename);
            apz.bilpay.OneTimeBillPay.serviceList = lserviceList;
            var lArr = [{
                "val": "",
                "desc": "Service Provider"
            }];
            for (var i = 0; i < lserviceList.length; i++) {
                lArr.push({
                    "val": lserviceList[i].serviceName,
                    "desc": lserviceList[i].serviceName
                })
            }
            apz.populateDropdown(document.getElementById("bilpay__OneTimeBillPay__serviceprovider"), lArr)
            /*apz.data.scrdata.bilpay__ServiceName_Req.tbRbBillpServicename = lserviceList;
            apz.data.loadData("ServiceName", "bilpay");
            var lcount = lserviceList.length;
            var loption = [];
            loption[0] = {};
            loption[0].desc = apz.lits.bilpay.LIT_SERVICEPROVIDER;
            loption[0].val = apz.lits.bilpay.LIT_SERVICEPROVIDER;
            for (var i = 0; i < lcount; i++) {
                loption[i + 1] = {};
                loption[i + 1].desc = lserviceList[i].serviceName;
                loption[i + 1].val = lserviceList[i].serviceName;*/
            // }
            //apz.populateDropdown(document.getElementById("bilpay__OneTimeBillPay__serviceprovider"), loption);
        } else {
            ///// check for error
        }
    } else {
        //// Handle error
    }
};
apz.bilpay.OneTimeBillPay.fn_changeServiceProvider = function() {
    var lserviceList = apz.bilpay.OneTimeBillPay.serviceList;
    apz.hide("bilpay__OneTimeBillPay__customerpinrow");
    for (var i = 0; i < lserviceList.length; i++) {
        if (lserviceList[i].serviceName == apz.getElmValue("bilpay__OneTimeBillPay__serviceprovider")) {
            if (lserviceList[i].requestTag.indexOf("ConsumerPIN") != -1) {
                apz.show("bilpay__OneTimeBillPay__customerpinrow");
                apz.setElmValue("bilpay__OneTimeBillPay__customerpin", "");
            }
            break;
        }
    }
};
apz.bilpay.OneTimeBillPay.fn_verifyCustNo = function() {
    //// get bill details and open continue button
    var lmsg = {
        "message": "Verify is disabled now. Coming soon...",
        "type": "I"
    };
    apz.dispMsg(lmsg);
};
apz.bilpay.OneTimeBillPay.fn_changeCcy = function(pthis) {
    /// do a calculation if required
    var lmsg = {
        "message": "Currency change is disabled now. Coming soon...",
        "type": "I"
    };
    apz.dispMsg(lmsg);
};
apz.bilpay.OneTimeBillPay.fn_openCcyUpdate = function(pthis) {
    ///// check to open ccy changes if not a dropdown
    var lParam = {
        "targetId": "bilpay__OneTimeBillPay__ccychangecol"
    };
    apz.toggleModal(lParam);
};
apz.bilpay.OneTimeBillPay.fn_updateCCY = function(pthis) {
    var lmsg = {
        "message": "Currency change is disabled now. Will proceed with AED. Coming soon...",
        "type": "I"
    };
    apz.dispMsg(lmsg);
    apz.setElmValue("bilpay__OneTimeBillPay__billccy", apz.getElmValue(pthis.id));
    var lParam = {
        "targetId": "bilpay__OneTimeBillPay__ccychangecol"
    };
    apz.toggleModal(lParam);
    //// check if some calculation is required
};
apz.bilpay.OneTimeBillPay.fnChangedate = function(pthis) {
    apz.setElmValue("bilpay__OneTimeBillPay__paymentdate", pthis.value);
};
apz.bilpay.OneTimeBillPay.fn_cancel = function() {
    apz.show("bilpay__OneTimeBillPay__onetimebilpaystage1");
    apz.hide("bilpay__OneTimeBillPay__confirmationmodal");
};
apz.bilpay.OneTimeBillPay.fnReset = function() {
    $("#bilpay__OneTimeBillPay__onetimebilpaystage1 input").val('');
    apz.setElmValue("bilpay__OneTimeBillPay__fromAcc", "");
    apz.setElmValue("bilpay__OneTimeBillPay__serviceprovider", "");
};
apz.bilpay.OneTimeBillPay.fn_continueStage1 = function() {
    var serviceProvider = apz.getElmValue("bilpay__OneTimeBillPay__serviceprovider");
    var consumerAccount = apz.getElmValue("bilpay__OneTimeBillPay__serviceaccount");
    var customerPin = apz.getElmValue("bilpay__OneTimeBillPay__customerpin");
    // var currencyCode = apz.getElmValue("bilpay__OneTimeBillPay__billccy");
    var accoutType = $("#bilpay__OneTimeBillPay__fromAcc").val().split("-")[0];
    var accountno = apz.getElmValue("bilpay__OneTimeBillPay__fromAcc")
    var amount = apz.unFormatNumber({
        'decimalSep': apz.decimalSep,
        'value': apz.getElmValue("bilpay__OneTimeBillPay__serviceamount"),
        'displayAsLiteral': 'N'
    });
    var date = apz.getElmValue("bilpay__OneTimeBillPay__paymentdate");
    var params = {};
    params.serviceProvider = serviceProvider;
    params.consumerAccount = consumerAccount;
    params.customerPin = customerPin;
    // params.currencyCode = currencyCode;
    params.amount = amount;
    params.date = date;
    var valid = apz.bilpay.OneTimeBillPay.validateFields(params);
    if (valid) {
        //apz.setElmValue("NBBA01__LandingPage__headerText", apz.lits['bilpay'][apz.language]['LIT_CHOOSEACC']);
        apz.bilpay.OneTimeBillPay.serviceProvider = serviceProvider;
        apz.bilpay.OneTimeBillPay.consumerAccount = consumerAccount;
        apz.bilpay.OneTimeBillPay.customerPin = customerPin;
        apz.bilpay.OneTimeBillPay.amount = amount;
        apz.bilpay.OneTimeBillPay.date = date;
        apz.bilpay.OneTimeBillPay.accoutType = accoutType;
        apz.bilpay.OneTimeBillPay.accountno = accountno;
        // apz.bilpay.OneTimeBillPay.currencyCode = currencyCode;
        apz.hide("bilpay__OneTimeBillPay__onetimebilpaystage1");
        /* var lparams = {};
        lparams.div = "bilpay__OneTimeBillPay__customeraccountsel";
        lparams.scr = "AccountSelection";
        lparams.userObj = {};
        lparams.userObj.data = apz.bilpay.OneTimeBillPay.sParams;
        lparams.userObj.callback = apz.bilpay.OneTimeBillPay.fn_accountSel;
        apz.launchSubScreen(lparams);
        apz.show("bilpay__OneTimeBillPay__onetimebillpaystage2");*/
        apz.bilpay.OneTimeBillPay.fn_accountSel(apz.bilpay.OneTimeBillPay);
    } else {}
};
apz.bilpay.OneTimeBillPay.fn_accountSel = function(presp) {
    debugger;
    /////// account no and details will populate from here
    // apz.setElmValue("bilpay__OneTimeBillPay__confAcc_type", "From " + presp.accoutType);
    apz.setElmValue("bilpay__OneTimeBillPay__accType", presp.accPrdName);
    apz.bilpay.OneTimeBillPay.paymentBy = presp.accoutType;
    apz.setElmValue("bilpay__OneTimeBillPay__acc", presp.accountnomasked);
    apz.setElmValue("bilpay__OneTimeBillPay__accType", apz.bilpay.OneTimeBillPay.accoutType);
    // apz.bilpay.OneTimeBillPay.FromCurrencyCode = presp.FromCurrencyCode;
    apz.setElmValue("bilpay__OneTimeBillPay__acc", apz.bilpay.OneTimeBillPay.accountno);
    apz.setElmValue("bilpay__OneTimeBillPay__conf_servProvider", apz.bilpay.OneTimeBillPay.serviceProvider);
    apz.setElmValue("bilpay__OneTimeBillPay__confirm_consAcc", apz.bilpay.OneTimeBillPay.consumerAccount);
    apz.setElmValue("bilpay__OneTimeBillPay__confAmt", apz.bilpay.OneTimeBillPay.amount);
    apz.setElmValue("bilpay__OneTimeBillPay__confPaymentDt", apz.bilpay.OneTimeBillPay.date);
    apz.bilpay.OneTimeBillPay.fromAccount = presp.accountno.replace(/ /g, "");
    apz.hide("bilpay__OneTimeBillPay__onetimebilpaystage1");
    apz.show("bilpay__OneTimeBillPay__confirmationmodal");
};
apz.bilpay.OneTimeBillPay.fn_confirm = function() {
    debugger;
    //// build the request and call service for OTP
    /*apz.bilpay.OneTimeBillPay.fn_hideStage2();
    apz.bilpay.OneTimeBillPay.fn_openOTP();*/
    /* var lreq = {};
    lreq.oneTimeBill = {};
    lreq.oneTimeBill.fromAccount = apz.bilpay.OneTimeBillPay.fromAccount;
    lreq.oneTimeBill.serviceProvider = apz.bilpay.OneTimeBillPay.serviceProvider;
    //lreq.oneTimeBill.consumerNumber = apz.bilpay.OneTimeBillPay.consumerNumber;
    lreq.oneTimeBill.consumerAccount = apz.bilpay.OneTimeBillPay.consumerAccount;
    lreq.oneTimeBill.paymentDate = apz.bilpay.OneTimeBillPay.paymentDate;
    lreq.oneTimeBill.customerPin = apz.bilpay.OneTimeBillPay.customerPin;
   // lreq.oneTimeBill.FromCurrencyCode = apz.bilpay.OneTimeBillPay.FromCurrencyCode;
    lreq.oneTimeBill.paymentBy = apz.bilpay.OneTimeBillPay.paymentBy;
    lreq.oneTimeBill.PaymentAmount = apz.bilpay.OneTimeBillPay.amount;*/
    apz.hide("bilpay__OneTimeBillPay__confirmationmodal");
    if (!apz.isNull(apz.bilpay.OneTimeBillPay.consumerAccount)) {
        var lSubscriberId = apz.bilpay.OneTimeBillPay.consumerAccount;
    } else {
        var lSubscriberId = apz.bilpay.OneTimeBillPay.customerPin;
    }
    var lparam = {
        "appId": "bilpay",
        "ifaceName": "OneTimeBillPayCustom",
        "buildReq": "N",
        "paintResp": "N",
        "req": {
            "action": "Confirm",
            "BillPayDtls": {
                "customerid": apz.bilpay.OneTimeBillPay.sParams.customerId,
                "accountNo": apz.bilpay.OneTimeBillPay.fromAccount,
                "billType": "ONE TIME",
                "paymentType": apz.bilpay.OneTimeBillPay.paymentBy,
                "operatorName": apz.bilpay.OneTimeBillPay.serviceProvider,
                "mobileNumber": "",
                "amount": parseFloat(apz.bilpay.OneTimeBillPay.amount),
                "nickname": "",
                "subscriberid": lSubscriberId,
                "authenticationType": "OTP"
            }
        },
        "callBack": apz.bilpay.OneTimeBillPay.fn_confirmCB
    };
    //apz.server.callServer(lparam);
    apz.data.loadJsonData("OneTimeBillPayCustom","bilpay");
     var lLaunchParams = {
            "appId": "otpeng",
            "scr": "ProcessOTP",
            "div": "bilpay__OneTimeBillPay__otplaunchercol",
            "userObj": {
                "action": "SetRefNo",
                "data": {
                    "OTPRefNo": apz.data.scrdata.bilpay__OneTimeBillPayCustom_Res.BillPayDtls.data.OTPRefNo
                },
                "control": {
                    "appId": "otpeng",
                    "callBack": apz.bilpay.OneTimeBillPay.fn_OTPCallback,
                    "destroyDiv": "bilpay__OneTimeBillPay__otplaunchercol"
                }
            }
        };
        apz.launchApp(lLaunchParams);
    
};
apz.bilpay.OneTimeBillPay.fn_confirmCB = function(params) {
    debugger;
    if (params.errors) {
        var lmsg = {
            "message": params.errors[0].errorMessage
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003") {
            apz.dispMsg(lmsg);
        }
    } else {
        // apz.bllpay.billpay.sParams.OtpRes = params.res.bilpay__OneTimeBillPayCustom_Res.BillPayDtls;
        var lLaunchParams = {
            "appId": "otpeng",
            "scr": "ProcessOTP",
            "div": "bilpay__OneTimeBillPay__otplaunchercol",
            "userObj": {
                "action": "SetRefNo",
                "data": {
                    "OTPRefNo": params.res.bilpay__OneTimeBillPayCustom_Res.BillPayDtls.data.OTPRefNo
                },
                "control": {
                    "appId": "otpeng",
                    "callBack": apz.bilpay.OneTimeBillPay.fn_OTPCallback,
                    "destroyDiv": "bilpay__OneTimeBillPay__otplaunchercol"
                }
            }
        };
        apz.launchApp(lLaunchParams);
    }
};
apz.bilpay.OneTimeBillPay.fn_hideStage2 = function() {
    apz.show("bilpay__OneTimeBillPay__onetimebilpaystage1");
    apz.hide("bilpay__OneTimeBillPay__confirmationmodal");
};
apz.bilpay.OneTimeBillPay.fn_openOTP = function(refNo) {
    apz.hide("bilpay__OneTimeBillPay__header");
    apz.hide("bilpay__OneTimeBillPay__onetimebillpaystage2");
    apz.hide("bilpay__OneTimeBillPay__confirmationmodal");
    var lparams = {};
    lparams.userObj = {};
    lparams.userObj.refNo = refNo;
    lparams.userObj.callback = apz.bilpay.OneTimeBillPay.fn_OTPCallback;
    lparams.scr = "ProcessOTP";
    lparams.appId = "otpeng";
    lparams.div = "bilpay__OneTimeBillPay__otplaunchercol";
    apz.launchApp(lparams);
};
apz.bilpay.OneTimeBillPay.fn_OTPCallback = function(presp) {
    debugger;
    if (apz.isNull(presp)) {
        apz.show("header");
        apz.bilpay.OneTimeBillPay.fndirectHome();
    } else {
        $("#NBBA01__LandingPage__backButton").addClass("ssp");
        var serviceProvider = apz.bilpay.OneTimeBillPay.serviceProvider;
        apz.setElmValue("bilpay__OneTimeBillPay__billpaysuccess", serviceProvider + " Bill Payment Successful");
        apz.setElmValue("bilpay__OneTimeBillPay__consumernoconf", apz.bilpay.OneTimeBillPay.consumerAccount);
        apz.setElmValue("bilpay__OneTimeBillPay__billerdetailconf", serviceProvider);
        apz.setElmValue("bilpay__OneTimeBillPay__ackfromAcc", apz.bilpay.OneTimeBillPay.fromAccount);
        apz.setElmValue("bilpay__OneTimeBillPay__billamountconf", apz.bilpay.OneTimeBillPay.amount);
        var ldate = apz.bilpay.OneTimeBillPay.date;
        /* ldate = apz.formatDate({
            "val": ldate,
            "fromFormat": "yyyyMMddHHmmss",
            "toFormat": "dd MMM yyyy   hh:mm tt"
        });*/
        apz.setElmValue("bilpay__OneTimeBillPay__ackdatetimeoftxn", ldate);
        apz.show("header");
        apz.show("bilpay__OneTimeBillPay__onetimebillpaystage3");
    }
    /*else {
        $("#NBBA01__LandingPage__backButton").addClass("ssp");
        apz.setElmValue("bilpay__OneTimeBillPay__billpaysuccess", serviceProvider + " Bill Payment Failure");
        apz.setElmValue("bilpay__OneTimeBillPay__consumernoconf", apz.bilpay.OneTimeBillPay.consumerAccount);
        apz.setElmValue("bilpay__OneTimeBillPay__billerdetailconf", apz.bilpay.OneTimeBillPay.serviceProvider);
        apz.setElmValue("bilpay__OneTimeBillPay__ackfromAcc",apz.bilpay.OneTimeBillPay.fromAccount);
        apz.setElmValue("bilpay__OneTimeBillPay__billamountconf", apz.bilpay.OneTimeBillPay.amount);
        var ldate = apz.bilpay.OneTimeBillPay.date;
        // ldate = apz.formatDate({
        //     "val": ldate,
        //     "fromFormat": "yyyyMMddHHmmss",
        //     "toFormat": "dd MMM yyyy   hh:mm tt"
        // });
        apz.setElmValue("bilpay__OneTimeBillPay__ackdatetimeoftxn", ldate);
        apz.show("header");
        
        apz.show("bilpay__OneTimeBillPay__onetimebillpaystage3");
    }*/
};
apz.bilpay.OneTimeBillPay.validateFields = function(param) {
    var lStatus = true;
    if (apz.isNull(param.serviceProvider)) {
        lStatus = false;
        var lMsg = {
            "code": "ERR_Service_provider"
        };
        apz.dispMsg(lMsg);
        return lStatus;
    } else if (apz.isNull(param.consumerAccount)) {
        lStatus = false;
        var lMsg = {
            "code": "ERR_consumer_Account"
        };
        apz.dispMsg(lMsg);
        return lStatus;
        //} else if (param.customerPin.length !== 4) {
        //    lStatus = true;
        //    var lMsg = {
        //        "code": "ERR_customer_Pin"
        //    };
        //    apz.dispMsg(lMsg);
        //    return lStatus;
    }
    /* else if (apz.isNull(param.currencyCode)) {
        lStatus = false;
        var lMsg = {
            "code": "ERR_currency_Code"
        };
        apz.dispMsg(lMsg);
        return lStatus;
    } */
    else if (apz.isNull(param.amount)) {
        lStatus = false;
        var lMsg = {
            "code": "ERR_amount"
        };
        apz.dispMsg(lMsg);
        return lStatus;
    } else {
        lStatus = true;
    }
    return lStatus;
}
apz.app.getTimeStamp = function() {
    var dateObj = new Date();
    date = dateObj.format('d M Y');
    var hours = dateObj.getHours();
    var minutes = dateObj.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var time = hours + ':' + minutes + ' ' + ampm;
    return date + " " + time;
}
apz.bilpay.OneTimeBillPay.fndirectHome = function() {
    $("#NBBA01__LandingPage__backButton").removeClass("ssp");
    apz.NBBA01.LandingPage.fnLaunchDashBd(apz.bilpay.OneTimeBillPay.sParams, "#NBBA01__LandingPage__BillPaymentRow");
};
apz.bilpay.OneTimeBillPay.fnBack = function() {
    apz.bilpay.OneTimeBillPay.fndirectHome();
};
/**
 * @purpouse - Function for sorting the service provider names in alphabetical order
 *
 * @Params -  Json array to be sorted in alphabetical order
 * @Return - Sorted array
 **/
apz.bilpay.OneTimeBillPay.sortObj = function(result) {
    debugger;
    var length = result.length;
    for (var i = 0; i < length; i++) {
        for (var j = 0; j < (length - i - 1); j++) {
            if (result[j].serviceName > result[j + 1].serviceName) {
                var tmp = result[j];
                result[j] = result[j + 1];
                result[j + 1] = tmp;
            }
        }
    }
    return result;
};
