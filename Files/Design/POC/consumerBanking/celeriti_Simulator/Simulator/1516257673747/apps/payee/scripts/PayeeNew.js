apz.payee.payeenew = {};
apz.payee.payeenew.sCache = {};
apz.app.onLoad_PayeeNew = function(params) {
    apz.payee.payeenew.sCache = params;
    if (apz.payee.payeenew.sCache.action == "Read") {
        apz.setElmValue("payee__PayeeNew__name", apz.payee.payeenew.sCache.name);
        apz.setElmValue("payee__PayeeNew__heading", "Benificiary Details");
        apz.setElmValue("payee__PayeeNew__routNo", apz.payee.payeenew.sCache.routNum);
        apz.setElmValue("payee__PayeeNew__accNum", apz.payee.payeenew.sCache.accNum);
        apz.setElmValue("payee__PayeeNew__bankName", apz.payee.payeenew.sCache.accType);
        $("#payee__PayeeNew__accForm input").attr("readonly", "readonly");
    }else{
        apz.setElmValue("payee__PayeeNew__heading", "New Benificiary");
    }
    apz.payee.payeenew.fnInitialise();
};
apz.payee.payeenew.fnInitialise = function() {};
apz.payee.payeenew.fnSaveAccounts = function() {
    apz.startLoader();
    if (apz.payee.payeenew.sCache.action == "Read") {
        var lParam = {
            "action": "",
            "ifaceName": ""
        };
    } else {
        var lParam = {
            "action": "Save Accounts",
            "ifaceName": "BenifData_New"
        };
        apz.payee.payeenew.fnBeforeCallServer(lParam);
    }
};
apz.payee.payeenew.fnBeforeCallServer = function(params) {
    var lRequest = {};
    if (params.action == "Save Accounts") {
        lRequest = {
            "benTable": {
                "accNo": apz.getElmValue("payee__PayeeNew__accNum"),
                "routingNo": apz.getElmValue("payee__PayeeNew__routNo"),
                "accType": apz.getElmValue("payee__PayeeNew__bankName"),
                "name": apz.getElmValue("payee__PayeeNew__name")
            }
        };
    }
    var lServerParams = {
        "ifaceName": params.ifaceName,
        "buildReq": "N",
        "req": lRequest,
        "paintResp": "Y",
        "async": "",
        "callBack": apz.payee.payeenew.callServerCallBack,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.payee.payeenew.callServerCallBack = function(params) {
    debugger;
};
apz.payee.payeenew.fnBack = function() {
    debugger;
    var lObj = {
        "scr": "PayeeLaunch",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {}
    };
    apz.launchSubScreen(lObj);
};
