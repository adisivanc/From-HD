apz.favftr = {};
apz.favftr.ftFavourite = {};
apz.favftr.ftFavourite.sAction = "";
apz.app.onLoad_FTFavourite = function(userObj) {
    debugger;
    apz.favftr.ftFavourite.sCorporateID = userObj.data.corpID;
    apz.favftr.ftFavourite.sUserID = userObj.data.userID;
    apz.favftr.ftFavourite.sFtType = userObj.data.ftType;
    apz.favftr.ftFavourite.sParentCB = userObj.control.callBack;
    apz.favftr.ftFavourite.sParentDiv = userObj.control.destroyDiv;
    apz.favftr.ftFavourite.fnRender(userObj);
};
apz.favftr.ftFavourite.fnRender = function(params) {
    apz.favftr.ftFavourite.fnRenderData(params);
};
apz.favftr.ftFavourite.fnRenderData = function(params) {
    debugger;
    var req = {
        "tbDbmiCorpFavFt": [{
            "userId": apz.favftr.ftFavourite.sUserID,
            "corporateId": apz.favftr.ftFavourite.sCorporateID,
            "ftType": apz.favftr.ftFavourite.sFtType
        }]
    };
    var lParams = {
        "ifaceName": "FTFavourite_Query",
        "paintResp": "Y",
        "appId": "favftr",
        "buildReq": "N",
        "lReq": req
    };
    //apz.startLoader();
    apz.favftr.ftFavourite.sAction = "launch";
    apz.favftr.ftFavourite.fnBeforCallServer(lParams);
};
apz.favftr.ftFavourite.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.favftr.ftFavourite.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.favftr.ftFavourite.callServerCB = function(params) {
    apz.favftr.ftFavourite.fnRenderFavouriteCB(params);
};
apz.favftr.ftFavourite.fnRenderFavouriteCB = function(params) {
    debugger;
    apz.stopLoader();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        
    } else {
         var sResult = {};
        sResult.status = false;
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
        $("#" + apz.favftr.ftFavourite.sParentDiv).html("");
        apz.favftr.ftFavourite.sParentCB(sResult);
    }
};
apz.favftr.ftFavourite.getFavFtClickedRow = function(pObj) {
    var lRowNo = $(pObj).attr("rowno");
    var sResult = {};
    sResult.status = true;
    sResult.data = apz.data.scrdata.favftr__FTFavourite_Req.tbDbmiCorpFavFt[lRowNo];
    apz.favftr.ftFavourite.sParentCB(sResult);
};
apz.favftr.ftFavourite.formatNumber = function(value) {
    var params = {};
    params.value = value;
    params.decimalSep = apz.decimalSep;
    params.mask = apz.numberMask;
    params.displayAsLiteral = "N";
    debugger;
    params.decimalPoints = apz.getDecimalPoints();
    debugger;
    value = apz.formatNumber(params);
    return value;
}
