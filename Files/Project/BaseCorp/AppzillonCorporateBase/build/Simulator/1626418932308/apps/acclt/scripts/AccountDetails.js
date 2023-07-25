apz.acclt = {};
apz.acclt.accountDetails = {};
apz.acclt.accountDetails.sAction = "";
apz.app.onLoad_AccountDetails = function(userObj) {
   // setTimeout(function() {
        apz.acclt.accountDetails.sAccount = userObj.data.accountNo;
        apz.acclt.accountDetails.sParentCB = userObj.control.callBack;
        apz.acclt.accountDetails.sParentDiv = userObj.control.destroyDiv;
        var params = {
            "action": "account"
        };
        apz.acclt.accountDetails.fnRender(params);
    //}, 2000);
    
};
apz.acclt.accountDetails.fnRender = function(params) {
    
    apz.acclt.accountDetails.fnRenderData(params);
};
apz.acclt.accountDetails.fnRenderData = function(params) {
   
    if (params.action == "account") {
        apz.acclt.accountDetails.sAction = "account";
        var req = {};
        req.accountDetails = {
            "accountno": apz.acclt.accountDetails.sAccount
        };
        req.action = "Query";
        req.table = "tb_dbmi_account_details";
        var lParams = {
            "ifaceName": "FetchAccountDetails",
            "paintResp": "N",
            "appId": "acclt",
            "buildReq": "N",
            "lReq": req
        };
        apz.acclt.accountDetails.fnBeforCallServer(lParams);
    }
};
apz.acclt.accountDetails.fnBeforCallServer = function(params) {
   
      
       var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acclt.accountDetails.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
       
   
    
};
apz.acclt.accountDetails.callServerCB = function(params) {
   
    if (apz.acclt.accountDetails.sAction == "account") {
        apz.acclt.accountDetails.fnRenderAccountDetailsCB(params);
    }
};
apz.acclt.accountDetails.fnRenderAccountDetailsCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acclt__FetchAccountDetails_Res.Status) {
            var sResult = {};
            sResult.status = true;
            sResult.data = params.res.acclt__FetchAccountDetails_Res.accountDetails;
            $("#" + apz.acclt.accountDetails.sParentDiv).html("");
            apz.acclt.accountDetails.sParentCB(sResult);
        } else {
            sResult.status = false;
            $("#" + apz.acclt.accountDetails.sParentDiv).html("");
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
            apz.acclt.accountDetails.sParentCB(sResult);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
