apz.bllpay.billpay = {};
apz.bllpay.billpay.sParams = {};
apz.bllpay.billpay.sAction = {};
apz.bllpay.billpay.pthis = {};

apz.app.onLoad_BillPay = function(params) {
    debugger;
   apz.hide("bllpay__BillPay__ServiceRow");
    if (params.Navigation) {
        apz.bllpay.billpay.fnSetNavigation(params);
    }
    apz.bllpay.billpay.fnInitialise(params);
    var param = {
        "ifaceName": "UtilityList_Query",
        "paintResp": "N",
        "req": {},
        "callBack": apz.bllpay.billpay.fnCall
    };
    apz.bllpay.billpay.fBeforeCallServer(param);
};
apz.app.onShown_BillPay = function()
{
    $("#bllpay__BillPay__i__tbDbtpBillPay__mobileNumber").attr("type","tel");


}
apz.bllpay.billpay.fnCall = function(pResp) {
    debugger;
}
apz.app.onShown_BillPay = function() {
    debugger;
     $("#bllpay__UtilityList__i__tbDbtmUtilityDet__utilityImg_0").trigger("click",this);
    $(".crt-form.ver .ecn > .syl > span").text("Rs.");
};
apz.bllpay.billpay.fnSetNavigation = function(params) {
    debugger;
    apz.bllpay.billpay.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    lParams.headerText = "BILL PAYMENTS";
    apz.bllpay.billpay.Navigation(lParams);
};
apz.bllpay.billpay.fnInitialise = function(params) {
    debugger;
    apz.bllpay.billpay.sParams = params;
    //$("#bllpay__UtilityList__i__tbDbtmUtilityDet__utilityImg_0").click();
  //  $("#bllpay__UtilityList__i__tbDbtmUtilityDet__utilityImg_0").trigger("click");
    //trigger.onClick("bllpay__UtilityList__i__tbDbtmUtilityDet__utilityImg_0");
  // apz.bllpay.billpay.fnGetOperation($("#bllpay__UtilityList__i__tbDbtmUtilityDet__utilityImg_0"));
   // var tes = $("#bllpay__BillPay__utilityList li").first()
    apz.bllpay.billpay.fnGoToStage1();
};
apz.bllpay.billpay.fnGoToStage1 = function() {
    debugger;
    apz.bllpay.billpay.fnSetValueStage1();
    apz.bllpay.billpay.fnPopulateDropdown();
    apz.bllpay.billpay.fnRenderStage1();
};
apz.bllpay.billpay.fnSetValueStage1 = function() {
    debugger;
    if (apz.bllpay.billpay.sParams.accountStatus) {
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__paymentType", apz.bllpay.billpay.sParams.accountStatus.Description);
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__operatorName", apz.bllpay.billpay.sParams.accountStatus.ServiceName);
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__mobileNumber", apz.bllpay.billpay.sParams.accountStatus.ConsumerNumber);
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__amount", apz.bllpay.billpay.sParams.accountStatus.amount);
        // apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__nickname", apz.bllpay.billpay.sParams.accountStatus.nickName);
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__customerid", apz.bllpay.billpay.sParams.data.customerID);
    } else {
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__paymentType", "Mobile Recharge");
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__operatorName", apz.bllpay.billpay.sParams.data.operatorName);
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__customerid", apz.bllpay.billpay.sParams.data.customerID);
    }
    $("#bllpay__BillPay__BillTypeNav").css("overflow-x", "scroll");
    $("#bllpay__BillPay__OperatorNameNav").css("overflow-x", "scroll");
};
apz.bllpay.billpay.fnPopulateDropdown = function() {
    debugger;
    var lAccounts = apz.bllpay.billpay.sParams.data.accounts;
    var lObj = [];
    var lOption;
    lOption = {
        "val": "",
        "desc": "Please Select"
    };
    lObj.push(lOption);
    for (i = 0; i < lAccounts.length; i++) {
        lOption = {
            "val": lAccounts[i].accountNo,
            "desc": lAccounts[i].accountType + " - " + lAccounts[i].accountNo
        };
        lObj.push(lOption);
    }
    apz.populateDropdown(document.getElementById("bllpay__BillPay__i__tbDbtpBillPay__accountNo"), lObj);
};
apz.bllpay.billpay.fnRenderStage1 = function() {
    debugger;
    apz.show("bllpay__BillPay__MainRow");
    if (apz.bllpay.billpay.sAction == "Mobile") {
        apz.hide("bllpay__BillPay__i__tbDbtpBillPay__subscriberid_ul");
        apz.hide("bllpay__BillPay__CreditCardNo");
        apz.show("bllpay__BillPay__i__tbDbtpBillPay__mobileNumber_ul");
        apz.show("bllpay__BillPay__i__tbDbtpBillPay__nickname_ul");
        apz.show("bllpay__BillPay__i__tbDbtpBillPay__operatorName_ul");
        apz.hide("bllpay__BillPay__CreditCardNo_ul");
        apz.hide("bllpay__BillPay__bank_ul");
        //   apz.hide("bllpay__BillPay__creditCardPayment_ul");
    } else if (apz.bllpay.billpay.sAction == "DTH") {
        apz.show("bllpay__BillPay__i__tbDbtpBillPay__subscriberid_ul");
        apz.show("bllpay__BillPay__i__tbDbtpBillPay__operatorName_ul");
        apz.hide("bllpay__BillPay__CreditCardNo");
        apz.hide("bllpay__BillPay__i__tbDbtpBillPay__mobileNumber_ul");
        apz.hide("bllpay__BillPay__i__tbDbtpBillPay__nickname_ul");
        apz.hide("bllpay__BillPay__CreditCardNo_ul");
        apz.hide("bllpay__BillPay__bank_ul");
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__paymentType", "DTH");
        //   apz.hide("bllpay__BillPay__creditCardPayment_ul");
    } else if (apz.bllpay.billpay.sAction == "Credit Card") {
        apz.hide("bllpay__BillPay__i__tbDbtpBillPay__subscriberid_ul");
        apz.hide("bllpay__BillPay__i__tbDbtpBillPay__operatorName_ul");
        //  apz.hide("bllpay__BillPay__i__tbDbtpBillPay__paymentType_ul");
        apz.hide("bllpay__BillPay__i__tbDbtpBillPay__mobileNumber_ul");
        apz.hide("bllpay__BillPay__i__tbDbtpBillPay__nickname_ul");
        apz.show("bllpay__BillPay__CreditCardNo_ul");
        apz.show("bllpay__BillPay__CreditCardNo");
        apz.show("bllpay__BillPay__bank_ul");
        apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__paymentType", "CreditCard Payment");
        apz.setElmValue("bllpay__BillPay__bank");
        //  apz.show("bllpay__BillPay__creditCardPayment_ul");
    }
    apz.bllpay.billpay.fnRenderStages(1);
};
apz.bllpay.billpay.fnServiceProvider = function(pthis) {
    debugger;
    lindex = $("#" + pthis.id).attr("rowno");
    apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__operatorName", apz.getElmValue(
        "bllpay__ServiceProvider__i__tbDbtmUtilityProviderDet__utilityProviderName_" + lindex));
    apz.setElmValue("bllpay__BillPay__bank", apz.getElmValue("bllpay__ServiceProvider__i__tbDbtmUtilityProviderDet__utilityProviderName_" + lindex));
};
apz.bllpay.billpay.fnGetOperation = function(pthis) {
    debugger;
    apz.show("bllpay__BillPay__ServiceRow");
    Lindex = $("#" + pthis.id).attr("rowno");
    apz.bllpay.billpay.pthis.id=Lindex;
    var params = {
        "ifaceName": "ServiceProvider_Query",
        "paintResp": "N",
        "req": {
            "tbDbtmUtilityProviderDet": {
                "utilityId": apz.getElmValue("bllpay__UtilityList__i__tbDbtmUtilityDet__utilityId_" + Lindex)
            }
        },
        "callback": apz.bllpay.billpay.fnqueryCB
    };
    apz.bllpay.billpay.fnImage(params);
    Pindex = $("#" + pthis.id).attr("rowno");
    var test = apz.getElmValue("bllpay__UtilityList__i__tbDbtmUtilityDet__utilityName_" + Pindex)
    if (test == "Prepaid") {
        apz.bllpay.billpay.sAction = "Mobile";
    } else if (test == "Postpaid") {
        apz.bllpay.billpay.sAction = "Mobile";
    } else if (test == "Credit Card") {
        apz.bllpay.billpay.sAction = "Credit Card";
    } else if (test == "DTH") {
        apz.bllpay.billpay.sAction = "DTH";
    } else {
        apz.bllpay.billpay.sAction = "";
    }
    apz.bllpay.billpay.fnRenderStage1(1);
};
apz.bllpay.billpay.fnRenderStages = function(pStage) {
    debugger;
    for (i = 0; i < 4; i++) {
        if (i == pStage) {
            apz.show("bllpay__BillPay__Stage" + i);
        } else {
            apz.hide("bllpay__BillPay__Stage" + i);
        }
    }
};
apz.bllpay.billpay.fnGetOperator = function(pOperatorName) {
    debugger;
    apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__operatorName", pOperatorName);
    apz.setElmValue("bllpay__BillPay__bank", pOperatorName);
};
apz.bllpay.billpay.fnSelectOperator = function() {
    debugger;
    var lObj = {
        "targetId": "bllpay__BillPay__OperatorModal"
    };
    apz.toggleModal(lObj);
};
apz.bllpay.billpay.fnGetOperatorFromModal = function(pOperatorName) {
    debugger;
    apz.bllpay.billpay.fnSelectOperator();
    apz.setElmValue("bllpay__BillPay__i__tbDbtpBillPay__operatorName", pOperatorName);
};
apz.bllpay.billpay.fnContinueStage1 = function() {
    debugger;
    var lValid = apz.bllpay.billpay.fnValidateStage1();
    if (lValid) {
        apz.bllpay.billpay.fnGoToStage2();
    }
};
apz.bllpay.billpay.fnGoToStage2 = function() {
    debugger;
    apz.data.buildData("BillPay", "bllpay");
    apz.bllpay.billpay.fnSetValueStage2();
    apz.bllpay.billpay.fnRenderStage2();
};
apz.bllpay.billpay.fnSetValueStage2 = function() {
    debugger;
    apz.setElmValue("bllpay__BillPay__Stage2AccNo", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__accountNo"));
    apz.setElmValue("bllpay__BillPay__Stage2MobileNo", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__mobileNumber"));
    apz.setElmValue("bllpay__BillPay__Stage2SubscriberID", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__subscriberid"));
    apz.setElmValue("bllpay__BillPay__Stage2Amount", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__amount"));
    apz.setElmValue("bllpay__BillPay__Stage2OperatorName", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__operatorName"));
    apz.setElmValue("bllpay__BillPay__Stage2Card", apz.getElmValue("bllpay__BillPay__CreditCardNo"));
    apz.setElmValue("bllpay__BillPay__Stage2Bank", apz.getElmValue("bllpay__BillPay__bank"));
};
apz.bllpay.billpay.fnRenderStage2 = function() {
    debugger;
    if (apz.bllpay.billpay.sAction == "Mobile") {
        apz.hide("bllpay__BillPay__Stage2SubscriberID_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage2MobileNo_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage2NickName_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage2OperatorName_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2Bank_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2Card_ctrl_grp_div");
    } else if (apz.bllpay.billpay.sAction == "DTH") {
        apz.show("bllpay__BillPay__Stage2SubscriberID_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage2OperatorName_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2MobileNo_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2NickName_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2Bank_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2Card_ctrl_grp_div");
    } else if (apz.bllpay.billpay.sAction == "Credit Card") {
        apz.hide("bllpay__BillPay__Stage2SubscriberID_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2MobileNo_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2NickName_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage2Bank_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage2OperatorName_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage2Card_ctrl_grp_div");
    }
    apz.bllpay.billpay.fnRenderStages(2);
};
apz.bllpay.billpay.fnValidateStage1 = function() {
    debugger;
    var lValid = apz.val.validateContainer("bllpay__BillPay__Stage1EntryForm");
    if (lValid) {
        return true;
    } else {
        var lMsg = {
            "code": "ERR_MAN"
        };
        apz.dispMsg(lMsg);
        return false;
    }
};
apz.bllpay.billpay.fnBackStage2 = function() {
    debugger;
    apz.bllpay.billpay.fnImage(params);
    apz.bllpay.billpay.fnRenderStage1();
};
apz.bllpay.billpay.fnCallServerCallBack = function(param) {};
apz.bllpay.billpay.fnConfirmStage2 = function() {
    debugger;
    apz.hide("bllpay__BillPay__MainRow");
    apz.bllpay.billpay.fnInsertData();
};
apz.bllpay.billpay.fnInsertData = function() {
    debugger;
    var lReq = {
        "action": "Confirm",
        "BillPayDtls": apz.data.scrdata.bllpay__BillPay_Req.tbDbtpBillPay
    };
    var lServerParams = {
        "ifaceName": "BillPay",
        "req": lReq,
        "callBack": apz.bllpay.billpay.fnInsertCallBack
    };
    apz.bllpay.billpay.fnBeforeCallServer(lServerParams);
};
apz.bllpay.billpay.fnBeforeCallServer = function(params) {
    debugger;
    var lServerParams = {
        "ifaceName": params.ifaceName,
        "buildReq": "N",
        "req": params.req,
        "paintResp": "N",
        "callBack": params.callBack
    };
    apz.server.callServer(lServerParams);
};
apz.bllpay.billpay.fnInsertCallBack = function(params) {
    debugger;
    if (!params.errors) {
        apz.bllpay.billpay.fnRenderStages('');
        apz.bllpay.billpay.sParams.OtpRes = params.res.bllpay__BillPay_Res.BillPayDtls;
        var lLaunchParams = {
            "appId": "otpeng",
            "scr": "ProcessOTP",
            "div": "bllpay__BillPay__Launcher",
            "userObj": {
                "action": "SetRefNo",
                "data": {
                    "OTPRefNo": params.res.bllpay__BillPay_Res.BillPayDtls.data.OTPRefNo
                },
                "control": {
                    "appId": "otpeng",
                    "callBack": apz.bllpay.billpay.fnGotoStage3,
                    "destroyDiv": "bllpay__BillPay__Launcher"
                }
            }
        };
        apz.launchApp(lLaunchParams);
    } else {}
};
apz.bllpay.billpay.fnGotoStage3 = function() {
    debugger;
    apz.currAppId = "bllpay";
    apz.bllpay.billpay.fnSetValueStage3();
    apz.bllpay.billpay.fnRenderStage3();
};
apz.bllpay.billpay.fnSetValueStage3 = function() {
    debugger;
    apz.setElmValue("bllpay__BillPay__Stage3MobileNo", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__mobileNumber"));
    apz.setElmValue("bllpay__BillPay__Stage3SubscriberID", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__subscriberid"));
    apz.setElmValue("bllpay__BillPay__Stage3Amount", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__amount"));
    apz.setElmValue("bllpay__BillPay__Stage3AccNo", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__accountNo"));
    apz.setElmValue("bllpay__BillPay__Stage3OperatorName", apz.getElmValue("bllpay__BillPay__i__tbDbtpBillPay__operatorName"));
    apz.setElmValue("bllpay__BillPay__Stage3Card", apz.getElmValue("bllpay__BillPay__CreditCardNo"));
    apz.setElmValue("bllpay__BillPay__Stage3Bank", apz.getElmValue("bllpay__BillPay__bank"));
    var lRefNo = "Your Reference no is " + apz.bllpay.billpay.sParams.OtpRes.txnRefNo;
    apz.setElmValue("bllpay__BillPay__Stgae3RefNo", lRefNo);
};
apz.bllpay.billpay.fnRenderStage3 = function() {
    debugger;
    if (apz.bllpay.billpay.sAction == "Mobile") {
        apz.hide("bllpay__BillPay__Stage3SubscriberID_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage3DTHRechargeSucc");
        apz.show("bllpay__BillPay__Stage3OperatorName_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage3MobileNo_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage3NickNameRow");
        apz.show("bllpay__BillPay__Stage3MobRechargeSucc");
        apz.hide("bllpay__BillPay__Stage3CreditCardSucces");
        apz.hide("bllpay__BillPay__Stage3Bank_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage3Card_ctrl_grp_div");
    } else if (apz.bllpay.billpay.sAction == "DTH") {
        apz.show("bllpay__BillPay__Stage3SubscriberID_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage3MobRechargeSucc");
        apz.hide("bllpay__BillPay__Stage3MobileNo_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage3NickNameRow");
        apz.show("bllpay__BillPay__Stage3DTHRechargeSucc");
        apz.hide("bllpay__BillPay__Stage3MobRechargeSucc");
        apz.hide("bllpay__BillPay__Stage3Bank_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage3Card_ctrl_grp_div");
    } else if (apz.bllpay.billpay.sAction == "Credit Card") {
        apz.hide("bllpay__BillPay__Stage3SubscriberID_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage3MobileNo_ctrl_grp_div");
        apz.hide("bllpay__BillPay__Stage3NickName_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage3Bank_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage3Card_ctrl_grp_div");
        apz.show("bllpay__BillPay__Stage3CreditCardSucces");
        apz.hide("bllpay__BillPay__Stage3MobRechargeSucc");
        apz.hide("bllpay__BillPay__Stage3OperatorName_ctrl_grp_div");
    }
    apz.bllpay.billpay.fnRenderStages(3);
};
apz.bllpay.billpay.fnValidatePhone = function(pobj) {
    debugger;
    var lError = apz.val.validateInputAct(document.getElementById("bllpay__BillPay__i__tbDbtpBillPay__mobileNumber"), false);
    if (lError == "APZ-CNT-128") {
        var lErrorParams = {
            "code": 'ERR_PHONE'
        };
        apz.dispMsg(lErrorParams);
    }
};
apz.app.postGetHeader = function(header) {
    header.sessionId = 'gjdgasghgasfgafgas';
    return header;
};
apz.bllpay.billpay.fnBack = function() {
    $("#bllpay__BillPay__Stage1EntryForm input").val("");
    apz.bllpay.billpay.fnGoToStage1();
    apz.bllpay.billpay.fnPopulateDropdown();
    //  apz.bllpay.billpay.fnContinueStage1();
}
apz.bllpay.billpay.fBeforeCallServer = function(param) {
    debugger;
    var lServerParams = {
        "ifaceName": param.ifaceName,
        "buildReq": "N",
        "req": param.req,
        "paintResp": param.paintResp,
        "async": true,
        "callBack": apz.bllpay.billpay.fnCallServerCallBack,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}
apz.bllpay.billpay.fnCallServerCallBack = function(param) {
    debugger;
    if (apz.deviceOs == "WEB") {
        apz.scrMetaData.containersMap["bllpay__BillPay__utilityList"].pagesize = 6;
    } else {
        apz.scrMetaData.containersMap["bllpay__BillPay__utilityList"].pagesize = 4;
    }
    
    if(apz.mockServer && apz.bllpay.billpay.pthis.id  && param.ifaceName=="ServiceProvider_Query"){
        apz.data.scrdata.bllpay__ServiceProvider_Req.tbDbtmUtilityProviderDet=apz.data.scrdata.bllpay__ServiceProvider_Req.tbDbtmUtilityProviderDet.filter(obj=>{
            if(typeof(obj.utilityId)=='string')
               return obj.utilityId==apz.bllpay.billpay.pthis.id;
            else($.isArray(obj.utilityId))
                return obj.utilityId.includes(apz.bllpay.billpay.pthis.id);
        })
    }
    
    
    //we are checking the current resolution of the screen. like (pc or mobile)
	if(window.innerWidth>=700){
		param.ifaceName=="UtilityList_Query" && apz.data.loadData("UtilityList", "bllpay");
		param.ifaceName=="ServiceProvider_Query" && apz.data.loadData("ServiceProvider", "bllpay");	
		return;
	}
	if(apz.data.scrdata.bllpay__UtilityList_Req && param.ifaceName=="UtilityList_Query"){
	    //we are taking deep cloning of this (`apz.data.scrdata.bllpay__UtilityList_Req.tbDbtmUtilityDet`) variable
		$.extend(true,apz.bllpay.billpay.ScacheOfUtilityList.tbDbtmUtilityDet,apz.data.scrdata.bllpay__UtilityList_Req.tbDbtmUtilityDet);		
		apz.bllpay.billpay.paginationFunction();
	}else if(apz.data.scrdata.bllpay__ServiceProvider_Req && param.ifaceName=="ServiceProvider_Query"){
        apz.bllpay.billpay.ScacheOfProviderList={
        	tbDbtmUtilityDet:[],
    	    start           :0,
            end             :4,
        	limit           :4
        };

	    //we are taking deep cloning of this (`apz.data.scrdata.bllpay__UtilityList_Req.tbDbtmUtilityDet`) variable
	    $.extend(true,apz.bllpay.billpay.ScacheOfProviderList.tbDbtmUtilityDet,apz.data.scrdata.bllpay__ServiceProvider_Req.tbDbtmUtilityProviderDet);		
		apz.bllpay.billpay.paginationFunctionForProviderList();
	}
	
};
apz.bllpay.billpay.fnImage = function(param) {
    debugger;
    var lServerParams = {
        "ifaceName": param.ifaceName,
        "buildReq": "N",
        "req": param.req,
        "paintResp": param.paintResp,
        "async": true,
        "callBack": apz.bllpay.billpay.fnCallServerCallBack,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}







/////////////////////////////////////////Latest Chaneges ProvoderList///////////////////////////////////////////////////////////////////


apz.bllpay.billpay.detectswipeForProvoderList=(el,func)=> {
      swipe_det ={
    	    sX:0,
    		sY:0,
    		eX:0,
    		eY:0
      }
      var min_x = 20;  //min x swipe for horizontal swipe
      var max_x = 40;  //max x difference for vertical swipe
      var min_y = 40;  //min y swipe for vertical swipe
      var max_y = 50;  //max y difference for horizontal swipe
      var direc = "";
      ele = document.getElementById(el);
      
      ele.addEventListener('touchstart',function(e){
        var t = e.touches[0];
        swipe_det.sX = t.screenX; 
        swipe_det.sY = t.screenY;
      },false);  // we are enabling capturing way instead of buffling event by applying false on the third arg
      
      ele.addEventListener('touchmove',function(e){
        e.preventDefault();
        var t = e.touches[0];
        swipe_det.eX = t.screenX; 
        swipe_det.eY = t.screenY;    
      },false);  // we are enabling capturing way instead of buffling event by applying false on the third arg
      
      ele.addEventListener('touchend',function(e){
        //horizontal detection
        if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y)))) {
          if(swipe_det.eX > swipe_det.sX) direc = "r";
          else direc = "l";
        }
        //vertical detection
        if ((((swipe_det.eY - min_y > swipe_det.sYswipe) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x)))) {
          if(swipe_det.eY > swipe_det.sY) direc = "d";
          else direc = "u";
        }
    
        if (direc != "") {
          if(typeof func == 'function') func(el,direc);
        }
        direc = "";
      },false);   // we are enabling capturing way instead of buffling event by applying false on the third arg
    }

//Arrow function with arg
apz.bllpay.billpay.myfunctionForProviderList=(el,d)=> {
        if(d=="l"){
        	apz.bllpay.billpay.ScacheOfProviderList.start+=apz.bllpay.billpay.ScacheOfProviderList.limit;
        	apz.bllpay.billpay.ScacheOfProviderList.end+=apz.bllpay.billpay.ScacheOfProviderList.limit;
        	apz.bllpay.billpay.paginationFunctionForProviderList();
        }else if(d=="r"){
        	apz.bllpay.billpay.ScacheOfProviderList.start-=apz.bllpay.billpay.ScacheOfProviderList.limit;
        	apz.bllpay.billpay.ScacheOfProviderList.end-=apz.bllpay.billpay.ScacheOfProviderList.limit;
        	apz.bllpay.billpay.paginationFunctionForProviderList();	
        }
}

apz.bllpay.billpay.detectswipeForProvoderList('bllpay__BillPay__ServiceRow',apz.bllpay.billpay.myfunctionForProviderList);


//Arrow function without arg
apz.bllpay.billpay.paginationFunctionForProviderList=()=>{
	if(apz.bllpay.billpay.ScacheOfProviderList.start>=0 && apz.bllpay.billpay.ScacheOfProviderList.start<apz.bllpay.billpay.ScacheOfProviderList.tbDbtmUtilityDet.length){
	}else{
		apz.bllpay.billpay.ScacheOfProviderList.start=0;
		apz.bllpay.billpay.ScacheOfProviderList.end=apz.bllpay.billpay.ScacheOfProviderList.limit;
	}
	apz.data.scrdata.bllpay__ServiceProvider_Req.tbDbtmUtilityProviderDet=apz.bllpay.billpay.ScacheOfProviderList.tbDbtmUtilityDet.slice(apz.bllpay.billpay.ScacheOfProviderList.start,apz.bllpay.billpay.ScacheOfProviderList.end);
	apz.data.loadData("ServiceProvider","bllpay");
	
}


























/////////////////////////////////////////Latest Chaneges UtilityList///////////////////////////////////////////////////////////////////
apz.bllpay.billpay.ScacheOfUtilityList={
	tbDbtmUtilityDet:[],
	start           :0,
    end             :4,
	limit           :4
};

apz.bllpay.billpay.detectswipe=(el,func)=> {
      swipe_det ={
    	    sX:0,
    		sY:0,
    		eX:0,
    		eY:0
      }
      var min_x = 20;  //min x swipe for horizontal swipe
      var max_x = 40;  //max x difference for vertical swipe
      var min_y = 40;  //min y swipe for vertical swipe
      var max_y = 50;  //max y difference for horizontal swipe
      var direc = "";
      ele = document.getElementById(el);
      
      ele.addEventListener('touchstart',function(e){
        var t = e.touches[0];
        swipe_det.sX = t.screenX; 
        swipe_det.sY = t.screenY;
      },false);  // we are enabling capturing way instead of buffling event by applying false on the third arg
      
      ele.addEventListener('touchmove',function(e){
        e.preventDefault();
        var t = e.touches[0];
        swipe_det.eX = t.screenX; 
        swipe_det.eY = t.screenY;    
      },false);  // we are enabling capturing way instead of buffling event by applying false on the third arg
      
      ele.addEventListener('touchend',function(e){
        //horizontal detection
        if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y)))) {
          if(swipe_det.eX > swipe_det.sX) direc = "r";
          else direc = "l";
        }
        //vertical detection
        if ((((swipe_det.eY - min_y > swipe_det.sYswipe) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x)))) {
          if(swipe_det.eY > swipe_det.sY) direc = "d";
          else direc = "u";
        }
    
        if (direc != "") {
          if(typeof func == 'function') func(el,direc);
        }
        direc = "";
      },false);   // we are enabling capturing way instead of buffling event by applying false on the third arg
    }

//Arrow function with arg
apz.bllpay.billpay.myfunction=(el,d)=> {
        if(d=="l"){
        	apz.bllpay.billpay.ScacheOfUtilityList.start+=apz.bllpay.billpay.ScacheOfUtilityList.limit;
        	apz.bllpay.billpay.ScacheOfUtilityList.end+=apz.bllpay.billpay.ScacheOfUtilityList.limit;
        	apz.bllpay.billpay.paginationFunction();
        }else if(d=="r"){
        	apz.bllpay.billpay.ScacheOfUtilityList.start-=apz.bllpay.billpay.ScacheOfUtilityList.limit;
        	apz.bllpay.billpay.ScacheOfUtilityList.end-=apz.bllpay.billpay.ScacheOfUtilityList.limit;
        	apz.bllpay.billpay.paginationFunction();	
        }
}

apz.bllpay.billpay.detectswipe('bllpay__BillPay__utilityList',apz.bllpay.billpay.myfunction);


//Arrow function without arg
apz.bllpay.billpay.paginationFunction=()=>{
	if(apz.bllpay.billpay.ScacheOfUtilityList.start>=0 && apz.bllpay.billpay.ScacheOfUtilityList.start<apz.bllpay.billpay.ScacheOfUtilityList.tbDbtmUtilityDet.length){
	}else{
		apz.bllpay.billpay.ScacheOfUtilityList.start=0;
		apz.bllpay.billpay.ScacheOfUtilityList.end=apz.bllpay.billpay.ScacheOfUtilityList.limit;
	}
	apz.data.scrdata.bllpay__UtilityList_Req.tbDbtmUtilityDet=apz.bllpay.billpay.ScacheOfUtilityList.tbDbtmUtilityDet.slice(apz.bllpay.billpay.ScacheOfUtilityList.start,apz.bllpay.billpay.ScacheOfUtilityList.end);
	apz.data.loadData("UtilityList","bllpay");
	
}
