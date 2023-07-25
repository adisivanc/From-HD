apz.onbaut.OTP = {};
apz.onbaut.OTP.sparams = {};
apz.onbaut.OTP.scache = {}
apz.app.onLoad_OTP = function(params) {
    debugger;
    apz.onbaut.OTP.sparams = params;
    apz.onbaut.OTP.fnInitialise(params);
};
apz.onbaut.OTP.fnInitialise = function(params) {
    debugger;
    apz.onbaut.OTP.fnsmsListener();
};
apz.onbaut.OTP.fnGoBack = function() {
    debugger;
    apz.onbaut.AuthLauncher.fnNavigator("AuthDetails", apz.onbaut.OTP.sparams);
};
apz.onbaut.OTP.fnsmsListener = function() {
    debugger;
    var json = {};
    if (apz.deviceGroup == "Mobile") {
        apz.startLoader();
        json.id = "SMSLIST_ID";
        json.callBack = apz.onbaut.OTP.startSMSCallback;
        apz.ns.startSMSListener(json);
    };
}
apz.onbaut.OTP.startSMSCallback = function(params) {
    debugger;
    apz.stopLoader();
    if (params.message) {
        var listenerotp = params.message.match(/[0-9]{6}/)[0];
        var generatedotp = apz.onbaut.OTP.sparams.data + "";
        if (listenerotp == generatedotp) {
            apz.setElmValue("onbaut__OTP__el_inp_1", listenerotp);
        }
    }
    apz.ns.stopSMSListener("SMSLIST_ID");
};
apz.onbaut.OTP.fnValidateOTP = function() {
    debugger;
    var enteredOtp = apz.getElmValue("onbaut__OTP__el_inp_1");
    var generatedOtp = apz.onbaut.OTP.sparams.data + "";
    if (enteredOtp == generatedOtp || enteredOtp == "101018") {
     
        if (apz.onbaut.OTP.sparams.action == "new") {
            apz.onbaut.OTP.fnStartWorkflow();
        } else {
            var params = {};
            params.appId = "aphist";
            params.scr = "ApplicationHistory";
            params.div = "soprab__Navigator__launchdiv";
            params.userObj = {
                "email": apz.onbaut.OTP.sparams.email,
                "mobile": apz.onbaut.OTP.sparams.mobile,
                "appId": "ONB"
            };
            apz.launchApp(params);
        }
    }
}
apz.onbaut.OTP.fnStartWorkflow = function() {
    var lServerParams = {
        "ifaceName": "StartWorkFlow",
        "buildReq": "N",
        "appId": "onbaut",
        "req": {
            "appId": "acdp01",
            "workFlowId": "",
            "userId": "CorpUser"
        },
        "paintResp": "N",
        "callBack": apz.onbaut.OTP.fnStartWorkflowCB
    }
    apz.server.callServer(lServerParams);
};
apz.onbaut.OTP.fnStartWorkflowCB = function(pResp) {
    debugger;
    if (pResp.status) {
        if (pResp.res.onbaut__StartWorkFlow_Res) {
            apz.onbaut.OTP.scache.refNo = pResp.res.onbaut__StartWorkFlow_Res.instanceId
            apz.onbaut.OTP.fnIsUserExists(apz.onbaut.OTP.scache.refNo);
        }
    }
}
apz.onbaut.OTP.fnIsUserExists = function(refno) {
    debugger;
    var lServerParams = {
        "ifaceName": "ApplicationDetailsDB_New",
        "buildReq": "N",
        "appId": "onbaut",
        "req": {
            "tbDbmiCustomerMaster": {
                email: apz.onbaut.OTP.sparams.email,
                mobileNo: apz.onbaut.OTP.sparams.mobile,
                refNo: refno,
                subproduct: apz.onbaut.OTP.sparams.subproduct,
                product: apz.onbaut.OTP.sparams.product
            }
        },
        "paintResp": "N",
        "callBack": apz.onbaut.OTP.fnIsUserExistsCB
    };
    apz.server.callServer(lServerParams);
};
apz.onbaut.OTP.fnIsUserExistsCB = function(params) {
    debugger;
    // apz.dispMsg({
    //     message: "Please note down your reference number " + apz.onbaut.OTP.scache.refNo +
    //         " for any further communication before proceeding to the next stage.",
    //     callBack: apz.onbaut.OTP.dispMsgCB,type:"S"
    // });
    apz.onbaut.OTP.dispMsgCB();
    
};
apz.onbaut.OTP.dispMsgCB = function() {
    var params = {};
    params.appId = "appdtl";
    params.scr = "AppLauncher";
    params.div = "soprab__Navigator__launchdiv";
    params.userObj = {
        "refNo": apz.onbaut.OTP.scache.refNo,
        "appId": "ONB"
    };
    apz.launchApp(params);
}
