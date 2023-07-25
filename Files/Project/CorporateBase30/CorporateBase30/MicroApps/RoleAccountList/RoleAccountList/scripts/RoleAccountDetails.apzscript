apz.roleAc = {};
apz.roleAc.roleAccountDetails = {};
apz.roleAc.roleAccountDetails.sAction = "";
apz.app.onLoad_RoleAccountDetails = function(userObj) {
    apz.roleAc.roleAccountDetails.sCorporateID = userObj.data.corpID;
    apz.roleAc.roleAccountDetails.sRoleID = userObj.data.roleID;
    apz.roleAc.roleAccountDetails.sParentCB = userObj.control.callBack;
    apz.roleAc.roleAccountDetails.sParentDiv = userObj.control.destroyDiv;
    apz.roleAc.roleAccountDetails.fnRender(userObj);
};
apz.roleAc.roleAccountDetails.fnRender = function(params) {
    apz.roleAc.roleAccountDetails.fnRenderData(params);
};
apz.roleAc.roleAccountDetails.fnRenderData = function(params) {
    debugger;
    var lSearchType, lInput;
    if (params.data.type === undefined) {
        lSearchType = "All";
        lInput = "";
    } else {
        lSearchType = params.data.type;
        lInput = params.data.value;
    }
    var req = {
        "accountDetails": {
            "type": lSearchType,
            "corporateId": apz.roleAc.roleAccountDetails.sCorporateID,
            "roleId": apz.roleAc.roleAccountDetails.sRoleID,
            "value": lInput
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_role_account";
    var lParams = {
        "ifaceName": "RoleAccount",
        "paintResp": "N",
        "appId": "roleAc",
        "buildReq": "N",
        "lReq": req
    };
    apz.startLoader();
    apz.roleAc.roleAccountDetails.sAction = "launch";
    apz.roleAc.roleAccountDetails.fnBeforCallServer(lParams);
};
apz.roleAc.roleAccountDetails.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.roleAc.roleAccountDetails.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.roleAc.roleAccountDetails.callServerCB = function(params) {
    if (apz.roleAc.roleAccountDetails.sAction == "launch") {
        apz.roleAc.roleAccountDetails.fnRenderAccountCB(params);
    }
};
apz.roleAc.roleAccountDetails.fnRenderAccountCB = function(params) {
    debugger;
    apz.stopLoader();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.roleAc__RoleAccount_Res.accountStatus == false) {
            var msg = {};
            msg.message = "No Records found";
            apz.dispMsg(msg);
        }
        var sResult = {};
        sResult.status = true;
        sResult.data = params.res.roleAc__RoleAccount_Res.tbDbmiCorpRoleAccount;
        $("#" + apz.roleAc.roleAccountDetails.sParentDiv).html("");
        apz.roleAc.roleAccountDetails.sParentCB(sResult);
    } else {
        sResult.status = false;
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
        $("#" + apz.roleAc.roleAccountDetails.sParentDiv).html("");
        apz.roleAc.roleAccountDetails.sParentCB(sResult);
    }
};
