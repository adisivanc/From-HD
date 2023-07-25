apz.chqsts.chequestatusenquiry = {};
apz.app.onShown_ChequeStatusEnquiry = function(pParams) {
    debugger;
    apz.chqsts.chequestatusenquiry.sParams = pParams;
    apz.chqsts.chequestatusenquiry.fnInitialise(pParams);
};
apz.chqsts.chequestatusenquiry.fnInitialise = function(pParams) {
    debugger;
    apz.data.loadJsonData("AccountDetails", "chqsts");
    apz.data.scrdata.chqsts__DebitAccount_Res = {};
    apz.data.scrdata.chqsts__DebitAccount_Res.SavingsAccount = apz.data.scrdata.chqsts__AccountDetails_Res.SavingsAccount;
    apz.data.scrdata.chqsts__DebitAccount_Res.CurrentAccount = apz.data.scrdata.chqsts__AccountDetails_Res.CurrentAccount;
    if (pParams.Navigation) {
        apz.chqsts.chequestatusenquiry.fnSetNavigation(pParams);
    }
    if (apz.data.scrdata.chqsts__AccountDetails_Res.SavingsAccount.length === 0) {
        apz.hide("chqsts__ChequeStatusEnquiry__savAcc");
    }
    if (apz.data.scrdata.chqsts__AccountDetails_Res.SavingsAccount.length === 0) {
        apz.hide("chqsts__ChequeStatusEnquiry__debAcc");
    }
    for (var i = 0; i < apz.data.scrdata.chqsts__DebitAccount_Res.SavingsAccount.length; i++) {
        var strlen = apz.data.scrdata.chqsts__DebitAccount_Res.SavingsAccount[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.chqsts__DebitAccount_Res.SavingsAccount[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.chqsts__DebitAccount_Res.SavingsAccount[i].accountNo = result;
    }
    for (var i = 0; i < apz.data.scrdata.chqsts__DebitAccount_Res.CurrentAccount.length; i++) {
        var strlen = apz.data.scrdata.chqsts__DebitAccount_Res.CurrentAccount[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.chqsts__DebitAccount_Res.CurrentAccount[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.chqsts__DebitAccount_Res.CurrentAccount[i].accountNo = result;
    }
    apz.data.loadData("DebitAccount", "chqsts");
    apz.chqsts.chequestatusenquiry.fnGoToStage1();
};
apz.chqsts.chequestatusenquiry.fnGoToStage1 = function() {
    apz.chqsts.chequestatusenquiry.fnRenderStage1();
};
apz.chqsts.chequestatusenquiry.fnRenderStage1 = function() {
    apz.hide("chqsts__ChequeStatusEnquiry__displayStatus");
    apz.hide("chqsts__ChequeStatusEnquiry__chqNo");
    apz.hide("chqsts__ChequeStatusEnquiry__startChqNo");
    apz.hide("chqsts__ChequeStatusEnquiry__fromChqNo");
    apz.hide("chqsts__ChequeStatusEnquiry__endChqNo");
    apz.hide("chqsts__ChequeStatusEnquiry__toChqNo");
    //apz.hide("chqsts__ChequeStatusEnquiry__chqNoEntering");
};
apz.chqsts.chequestatusenquiry.fnChqType = function(pObj) {
    var lChqType = pObj;
    apz.chqsts.chequestatusenquiry.lChqType = pObj;
    if (lChqType === "Single Cheque") {
        apz.show("chqsts__ChequeStatusEnquiry__chqNo");
        apz.hide("chqsts__ChequeStatusEnquiry__startChqNo");
        apz.hide("chqsts__ChequeStatusEnquiry__fromChqNo");
        apz.hide("chqsts__ChequeStatusEnquiry__endChqNo");
        apz.hide("chqsts__ChequeStatusEnquiry__toChqNo");
        apz.hide("chqsts__ChequeStatusEnquiry__displayStatus");
        for (var j = 1; j < 7; j++) {
            apz.setElmValue("chqsts__ChequeStatusEnquiry__chqNo" + j, "");
        }
    } else {
        apz.hide("chqsts__ChequeStatusEnquiry__chqNo");
        apz.show("chqsts__ChequeStatusEnquiry__startChqNo");
        apz.show("chqsts__ChequeStatusEnquiry__fromChqNo");
        apz.show("chqsts__ChequeStatusEnquiry__endChqNo");
        apz.show("chqsts__ChequeStatusEnquiry__toChqNo");
        apz.hide("chqsts__ChequeStatusEnquiry__displayStatus");
        for (var i = 1; i < 7; i++) {
            
            apz.setElmValue("chqsts__ChequeStatusEnquiry__fromChqNo" + i, "");
            apz.setElmValue("chqsts__ChequeStatusEnquiry__toChqNo" + i, "");
        }
    }
};
apz.chqsts.chequestatusenquiry.fnSelectCheueType = function(pthis, pacctype) {
    debugger;
    var lrow = $(pthis).attr("id").split("_")[5];
    apz.toggleModal({
        "targetId": "chqsts__ChequeStatusEnquiry__chequeModal"
    });
    if (pacctype == "savings") {
        apz.chqsts.chequestatusenquiry.sAccNo = apz.getElmValue("chqsts__DebitAccount__o__SavingsAccount__accountNo_" + lrow);
        apz.chqsts.chequestatusenquiry.sAccType = "Savings Account";
    } else if (pacctype == "current") {
        apz.chqsts.chequestatusenquiry.sAccNo = apz.getElmValue("chqsts__DebitAccount__o__CurrentAccount__accountNo_" + lrow);
        apz.chqsts.chequestatusenquiry.sAccType = "Current Account";
    }
    apz.show("chqsts__ChequeStatusEnquiry__chqNoEntering");
    //apz.hide("chqsts__ChequeStatusEnquiry__displayAccDtls");
    apz.setElmValue("chqsts__ChequeStatusEnquiry__debitAccType", apz.chqsts.chequestatusenquiry.sAccType);
    apz.setElmValue("chqsts__ChequeStatusEnquiry__debitAccNum", apz.chqsts.chequestatusenquiry.sAccNo);
    apz.setElmValue("chqsts__ChequeStatusEnquiry__chequetypetxt", pthis.value);
    apz.chqsts.chequestatusenquiry.fnChqType(pthis.value);
}
apz.chqsts.chequestatusenquiry.fnBackchqNoEntering = function() {
    apz.hide("chqsts__ChequeStatusEnquiry__chqNoEntering");
    //apz.show("chqsts__ChequeStatusEnquiry__displayAccDtls");
    apz.setElmValue("chqsts__ChequeStatusEnquiry__debitAccType", '');
    apz.setElmValue("chqsts__ChequeStatusEnquiry__debitAccNum", '');
    apz.toggleModal({
        "targetId": "chqsts__ChequeStatusEnquiry__chequeModal"
    });
};
apz.chqsts.chequestatusenquiry.fnSwitchOver = function(pObj, pEvent) {
    if (pEvent.which === 8) {
        $("#" + pObj.id.slice(0, -1) + (Number(pObj.id.slice("-1")) - 1)).focus();
    } else {
        $("#" + pObj.id.slice(0, -1) + (Number(pObj.id.slice("-1")) + 1)).focus();
    }
};
apz.chqsts.chequestatusenquiry.fnStatusEnq = function() {
    debugger;
    var lSingleChequeValue = "";
    var lMultiChecqueValue = "";
    //var lChequeRadioBtnValue = apz.getElmValue("chqsts__ChequeStatusEnquiry__options");
    var lChequeRadioBtnValue = apz.chqsts.chequestatusenquiry.lChqType;
    if (lChequeRadioBtnValue === "Single Cheque") {
        for (var i = 1; i < 7; i++) {
            var lsingleInputValue = apz.getElmValue("chqsts__ChequeStatusEnquiry__chqNo" + i);
            if (!(apz.isNull(lsingleInputValue)) && !(isNaN(lsingleInputValue))) {
                lSingleChequeValue = lSingleChequeValue.concat(lsingleInputValue);
            } else {
                break;
            }
        }
        apz.chqsts.chequestatusenquiry.fnCallBeforeChqStsRslt(lSingleChequeValue, "singleCheque");
    } else {
        for (var j = 1; j < 7; j++) {
            var lStartChqValue = apz.getElmValue("chqsts__ChequeStatusEnquiry__fromChqNo" + j);
            var lLastChqValue = apz.getElmValue("chqsts__ChequeStatusEnquiry__toChqNo" + j);
            if (!(apz.isNull(lStartChqValue && lLastChqValue)) && !(isNaN(lStartChqValue)) && !(isNaN(lLastChqValue))) {
                lSingleChequeValue = lSingleChequeValue.concat(lStartChqValue);
                lMultiChecqueValue = lMultiChecqueValue.concat(lLastChqValue);
            } else {
                break;
            }
        }
        apz.chqsts.chequestatusenquiry.fnCallBeforeChqStsRslt(lSingleChequeValue, lMultiChecqueValue);
    }
};
apz.chqsts.chequestatusenquiry.fnCallBeforeChqStsRslt = function(respSingleChequeValue, respMultiChecqueValue) {
    debugger;
    if (respMultiChecqueValue === "singleCheque") {
        if (respSingleChequeValue.length != 6) {
            var lMsg = {
                "code": "VAL-001"
            };
            apz.dispMsg(lMsg);
        } else {
            apz.chqsts.chequestatusenquiry.sFromChqNo = respSingleChequeValue;
            apz.chqsts.chequestatusenquiry.fnChqStsRslt("singleCheque");
        }
    } else {
        if (respSingleChequeValue.length != 6 && respMultiChecqueValue.length != 6) {
            var lMsg = {
                "code": "VAL-001"
            };
            apz.dispMsg(lMsg);
        } else {
            apz.chqsts.chequestatusenquiry.sFromChqNo = respSingleChequeValue;
            apz.chqsts.chequestatusenquiry.sToChqNo = respMultiChecqueValue;
            apz.chqsts.chequestatusenquiry.fnChqStsRslt("multipleCheque");
        }
    }
};
apz.chqsts.chequestatusenquiry.fnChqStsRslt = function(pResp) {
    if (pResp === "singleCheque") {
        var lReq = {};
        lReq.chequeStatusEnq = {};
        lReq.chequeStatusEnq.startChequeNumber = apz.chqsts.chequestatusenquiry.sFromChqNo;
        //lReq.chequeStatusEnq.customerId = apz.chqsts.chequestatusenquiry.sParams.data.customerID;
        lReq.chequeStatusEnq.accountNo = apz.chqsts.chequestatusenquiry.sAccNo;
        lReq.chequeStatusEnq.cheqType = pResp;
    } else {
        var lReq = {};
        lReq.chequeStatusEnq = {};
        lReq.chequeStatusEnq.startChequeNumber = apz.chqsts.chequestatusenquiry.sFromChqNo;
        lReq.chequeStatusEnq.endChequeNumber = apz.chqsts.chequestatusenquiry.sToChqNo;
        // lReq.chequeStatusEnq.customerId = apz.chqsts.chequestatusenquiry.sParams.data.customerID;
        lReq.chequeStatusEnq.accountNo = apz.chqsts.chequestatusenquiry.sAccNo;
        lReq.chequeStatusEnq.cheqType = pResp;
    }
    var lPar = {
        "ifaceName": "ChequeStatusEnquiry",
        "req": lReq
    };
    apz.chqsts.chequestatusenquiry.fnBeforeCallServer(lPar);
};
apz.chqsts.chequestatusenquiry.fnBeforeCallServer = function(pParams) {
    debugger;
    // var lServerParams = {
    //     "ifaceName": pParams.ifaceName,
    //     "req": pParams.req,
    //     "paintResp": "N",
    //     "appId": "chqsts",
    //     "callBack": apz.chqsts.chequestatusenquiry.fnCallServerCallBack
    // };
    // apz.server.callServer(lServerParams);
    apz.data.loadJsonData(pParams.ifaceName, "chqsts");
    apz.chqsts.chequestatusenquiry.fnCallServerCallBack({
        "errors": false,
        "req": pParams.req
    });
};
apz.chqsts.chequestatusenquiry.fnCallServerCallBack = function(pParams) {
    debugger;
    if (!(pParams.errors)) {
        if (apz.data.scrdata.chqsts__ChequeStatusEnquiry_Res.chequeStatusEnq.status === "success") {
            
            var chequeArr = [];
            if (pParams.req.chequeStatusEnq.cheqType == "singleCheque") {
                //apz.hide("chqsts__ChequeStatusEnquiry__chqNoEntering");
            apz.show("chqsts__ChequeStatusEnquiry__displayStatus");
                var lobj = {};
                lobj.chequeNumber = pParams.req.chequeStatusEnq.startChequeNumber;
                lobj.chequeStatus = "Used";
                chequeArr.push(lobj);
            }
            if (pParams.req.chequeStatusEnq.cheqType == "multipleCheque") {
                apz.hide("chqsts__ChequeStatusEnquiry__chqNoEntering");
            apz.show("chqsts__ChequeStatusEnquiry__displayStatus");
                for (var i = pParams.req.chequeStatusEnq.startChequeNumber; i <= pParams.req.chequeStatusEnq.endChequeNumber; i++) {
                    var lobj = {};
                    lobj.chequeNumber = i;
                    
                    if(i % 2 == 0)
                    {
                        lobj.chequeStatus = "Cheque used";
                    }
                    else {
                        lobj.chequeStatus = "Unused";
                    }
                    chequeArr.push(lobj);
                }
            }
            apz.data.scrdata.chqsts__ChequeStatusEnquiry_Res.chequeStatusEnq.chequeStatusDetails = chequeArr;
            apz.data.loadData("ChequeStatusEnquiry", "chqsts");
        } else if (apz.data.scrdata.chqsts__ChequeStatusEnquiry_Res.chequeStatusEnq.status === "failure" && apz.data.scrdata.chqsts__ChequeStatusEnquiry_Res
            .chequeStatusEnq.respCode === "disp") {
            apz.hide("chqsts__ChequeStatusEnquiry__chqNoEntering");
            apz.show("chqsts__ChequeStatusEnquiry__displayStatus");
            apz.setElmValue("chqsts__ChequeStatusEnquiry__o__chequeStatusEnq__chequeNumber_0_txtcnt", apz.chqsts.chequestatusenquiry.sFromChqNo);
            apz.setElmValue("chqsts__ChequeStatusEnquiry__o__chequeStatusEnq__chequeStatus_0_txtcnt", apz.data.scrdata.chqsts__ChequeStatusEnquiry_Res
                .ExtMsg);
        }
    } else {
        apz.hide("chqsts__ChequeStatusEnquiry__chqNoEntering");
        apz.show("chqsts__ChequeStatusEnquiry__displayStatus");
        apz.setElmValue("chqsts__ChequeStatusEnquiry__o__chequeStatusEnq__chequeNumber_0_txtcnt", apz.chqsts.chequestatusenquiry.sFromChqNo);
        apz.setElmValue("chqsts__ChequeStatusEnquiry__o__chequeStatusEnq__chequeStatus_0_txtcnt", pParams.errors[0].errorMessage);
    }
};
apz.chqsts.chequestatusenquiry.fnDone = function() {
    var params = {};
    params.appId = "chqsts";
    params.scr = "ChequeStatusEnquiry";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
    //apz.launchSubScreen(params);
    apz.launchApp(params);
};
