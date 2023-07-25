apz.acbs01 = {};
apz.acbs01.beneficiaryList = {};
apz.acbs01.beneficiaryList.sAction = "";
apz.app.onLoad_BeneficiaryList = function(userObj) {
    apz.acbs01.beneficiaryList.sCorporateID = userObj.data.corporateId;
    apz.acbs01.beneficiaryList.sBeneficiaryType = userObj.data.beneficaryType;
    apz.acbs01.beneficiaryList.sParentCB = userObj.control.callBack;
    apz.acbs01.beneficiaryList.sParentDiv = userObj.control.destroyDiv;
    apz.acbs01.beneficiaryList.sBenAction = userObj.data.action;
    if (apz.acbs01.beneficiaryList.sBenAction == "onchange") {
        apz.acbs01.beneficiaryList.sType = userObj.data.type;
        apz.acbs01.beneficiaryList.sValue = userObj.data.value;
    }
    var params = {
        "action": "benList"
    };
    apz.acbs01.beneficiaryList.fnRender(params);
};
apz.acbs01.beneficiaryList.fnRender = function(params) {
    debugger;
    apz.acbs01.beneficiaryList.fnRenderData(params);
};
apz.acbs01.beneficiaryList.fnRenderData = function(params) {
    debugger;
    if (params.action == "benList") {
        apz.acbs01.beneficiaryList.sAction = "benList";
        var req = {};
        if (apz.acbs01.beneficiaryList.sBenAction == "onload") {
            req.beneficiary = {
                "corporateId": apz.acbs01.beneficiaryList.sCorporateID,
                "beneficaryType": apz.acbs01.beneficiaryList.sBeneficiaryType,
                "flag": "onload",
                "type": "All"
            };
        } else if (apz.acbs01.beneficiaryList.sBenAction == "onchange") {
            req.beneficiary = {
                "corporateId": apz.acbs01.beneficiaryList.sCorporateID,
                "beneficaryType": apz.acbs01.beneficiaryList.sBeneficiaryType,
                "flag": "onchange",
                "type": apz.acbs01.beneficiaryList.sType,
                "value": apz.acbs01.beneficiaryList.sValue
            };
        }
        req.action = "Query";
        req.table = "tb_dbmi_corp_role_beneficary";
        var lParams = {
            "ifaceName": "FetchBeneficiaryList",
            "paintResp": "N",
            "appId": "acbs01",
            "buildReq": "N",
            "lReq": req
        };
        apz.acbs01.beneficiaryList.fnBeforCallServer(lParams);
    }
};
apz.acbs01.beneficiaryList.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acbs01.beneficiaryList.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acbs01.beneficiaryList.callServerCB = function(params) {
    debugger;
    if (apz.acbs01.beneficiaryList.sAction == "benList") {
        apz.acbs01.beneficiaryList.fnRenderBeneficiaryListCB(params);
    }
};
apz.acbs01.beneficiaryList.fnRenderBeneficiaryListCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acbs01__FetchBeneficiaryList_Res.Status) {
            var sResult = {};
            sResult.status = true;
            sResult.data = params.res.acbs01__FetchBeneficiaryList_Res.beneficiaryList;
            $("#" + apz.acbs01.beneficiaryList.sParentDiv).html("");
            apz.acbs01.beneficiaryList.sParentCB(sResult);
        } else {
            sResult.status = false;
            $("#" + apz.acbs01.beneficiaryList.sParentDiv).html("");
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
            apz.acbs01.beneficiaryList.sParentCB(sResult);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};