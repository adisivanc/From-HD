apz.favftr = {};
apz.favftr.ftFavouriteManipulate = {};
apz.favftr.ftFavouriteManipulate.sAction = "";
apz.app.onLoad_FTFavouriteManipulate = function(userObj) {
    debugger;
    apz.favftr.ftFavouriteManipulate.sCorporateID = userObj.data.corpID;
    apz.favftr.ftFavouriteManipulate.sUserID = userObj.data.userID;
    apz.favftr.ftFavouriteManipulate.sFtType = userObj.data.ftType;
    apz.favftr.ftFavouriteManipulate.sFromAccount = userObj.data.fromAccount;
    apz.favftr.ftFavouriteManipulate.sToAccount = userObj.data.toAccount;
    apz.favftr.ftFavouriteManipulate.sAmount = parseFloat(apz.favftr.ftFavouriteManipulate.unformatNumber(userObj.data.amount));
    apz.favftr.ftFavouriteManipulate.sName = userObj.data.name;
    apz.favftr.ftFavouriteManipulate.sParentCB = userObj.control.callBack;
    apz.favftr.ftFavouriteManipulate.sParentDiv = userObj.control.destroyDiv;
    apz.favftr.ftFavouriteManipulate.fnRender(userObj);
};
apz.favftr.ftFavouriteManipulate.unformatNumber = function(value) {
    var params = {};
    params.value = value;
    params.decimalSep = apz.decimalSep;
    params.mask = apz.numberMask;
    params.displayAsLiteral = "N";
    debugger;
    params.decimalPoints = apz.getDecimalPoints();
    debugger;
    value = apz.unFormatNumber(params);
    return value;
}
apz.favftr.ftFavouriteManipulate.fnRender = function(params) {
    apz.favftr.ftFavouriteManipulate.fnRenderData(params);
};
apz.favftr.ftFavouriteManipulate.fnRenderData = function(params) {
    debugger;
    var req = {
        "tbDbmiCorpFavFt": [{
            "userId": apz.favftr.ftFavouriteManipulate.sUserID,
            "corporateId": apz.favftr.ftFavouriteManipulate.sCorporateID,
            "ftType": apz.favftr.ftFavouriteManipulate.sFtType,
            "fromAccount": apz.favftr.ftFavouriteManipulate.sFromAccount,
            "name": apz.favftr.ftFavouriteManipulate.sName,
            "toAccount": apz.favftr.ftFavouriteManipulate.sToAccount,
            "amount": apz.favftr.ftFavouriteManipulate.sAmount
        }]
    };
    var lParams = {
        "ifaceName": "FTFavourite_New",
        "paintResp": "N",
        "appId": "favftr",
        "buildReq": "N",
        "lReq": req
    };
    apz.startLoader();
    apz.favftr.ftFavouriteManipulate.sAction = "launch";
    apz.favftr.ftFavouriteManipulate.fnBeforCallServer(lParams);
};
apz.favftr.ftFavouriteManipulate.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.favftr.ftFavouriteManipulate.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.favftr.ftFavouriteManipulate.callServerCB = function(params) {
    apz.favftr.ftFavouriteManipulate.fnRenderFavouriteCB(params);
};
apz.favftr.ftFavouriteManipulate.fnRenderFavouriteCB = function(params) {
    debugger;
    apz.stopLoader();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        var sResult = {};
        sResult.status = true;
        var lmsg = {
            "message": "Template saved to your favourites.",
            "type": "S"
        };
        apz.dispMsg(lmsg);
        $("#" + apz.favftr.ftFavouriteManipulate.sParentDiv).html("");
        apz.favftr.ftFavouriteManipulate.sParentCB(sResult);
    } else {
        var sResult = {};
        sResult.status = false;
        var lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
        $("#" + apz.favftr.ftFavouriteManipulate.sParentDiv).html("");
        apz.favftr.ftFavouriteManipulate.sParentCB(sResult);
    }
};