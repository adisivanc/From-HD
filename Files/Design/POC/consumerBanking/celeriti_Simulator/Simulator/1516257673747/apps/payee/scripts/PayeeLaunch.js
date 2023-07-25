apz.payee.payeelaunch = {};
apz.payee.payeelaunch.sValue = "";
apz.payee.payeelaunch.sCache = {};
apz.app.onLoad_PayeeLaunch = function(params) {
    apz.payee.payeelaunch.sCache = params;
    apz.payee.payeelaunch.fnIntialise();
    $("#payee__PayeeLaunch__detList li").attr("onclick", "apz.payee.payeelaunch.fnReadDetails(this)");
};
apz.payee.payeelaunch.fnIntialise = function() {
    var lParam = {
        "action": "Query",
        "ifaceName": "BenifData_Query"
    };
    apz.payee.payeelaunch.fnBeforeCallServer(lParam);
};
apz.payee.payeelaunch.fnBeforeCallServer = function(params) {
    var lServerParams = {
        "ifaceName": params.ifaceName,
        "buildReq": "N",
        "req": {},
        "paintResp": "Y",
        "async": "",
        "callBack": apz.payee.payeelaunch.callServerCallBack,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.payee.payeelaunch.callServerCallBack = function() {
    debugger;
    apz.stopLoader();
};
apz.payee.payeelaunch.fnReadDetails = function(pthis) {
    apz.startLoader();
    var lRowNo = $("#" + pthis.id).attr("rowno");
    var lObj = {
        "scr": "PayeeNew",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "action": "Read",
            "accNum": apz.data.scrdata.payee__BenifData_Req.benTable[lRowNo].accNo,
            "routNum": apz.data.scrdata.payee__BenifData_Req.benTable[lRowNo].routingNo,
            "accType": apz.data.scrdata.payee__BenifData_Req.benTable[lRowNo].accType,
            "name": apz.data.scrdata.payee__BenifData_Req.benTable[lRowNo].name
        }
    };
    apz.launchSubScreen(lObj);
};
apz.payee.payeelaunch.fnAddDetails = function(pthis) {
    var lObj = {
        "scr": "PayeeNew",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "action": "New"
        }
    };
    apz.launchSubScreen(lObj);
};
