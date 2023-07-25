apz.crlmch.LimitChange = {};
apz.app.onLoad_LimitChange = function(params) {
    apz.data.scrdata["crlmch__Limits_Req"] = {}
    apz.data.scrdata["crlmch__Limits_Req"]["Limits"] = {
        "CardNo": "5000-XXXX-XXXX-0656",
        "CurrentLimit": "100000"
    }
    if (params.cardNo && params.currentLimit) {
        apz.data.scrdata["crlmch__Limits_Req"]["Limits"] = {
            "CardNo": params.cardNo,
            "CurrentLimit": params.currentLimit
        }
    }
    apz.data.loadData("Limits", "crlmch");
};
apz.crlmch.LimitChange.fnOnClickProceed = function() {
    $("#crlmch__LimitChange__limitChangeProceed").removeClass("sno");
    $("#crlmch__LimitChange__limitChangeDiv").addClass("sno");
    apz.data.buildData("Limits", "crlmch");
    var amt = "";
    apz.data.scrdata["crlmch__LimitDetails_Req"] = {}
    apz.data.scrdata["crlmch__LimitDetails_Req"]["LimitDetails"] = {};
    apz.data.scrdata["crlmch__LimitDetails_Req"]["LimitDetails"]["CardNo"] = apz.data.scrdata["crlmch__Limits_Req"]["Limits"]["CardNo"];
    apz.data.scrdata["crlmch__LimitDetails_Req"]["LimitDetails"]["Amount"] = apz.data.scrdata["crlmch__Limits_Req"]["Limits"]["NewLimit"]
    apz.data.loadData("LimitDetails", "crlmch");
};
apz.crlmch.LimitChange.fnOnClickOk = function() {
    apz.toggleModal({
        "targetId": "crlmch__LimitChange__transactionSuccess"
    });
    var params = {};
    params.appId = "card01";
    params.scr = "Cards";
    //params.layout = "All";
    params.description = "Cards";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
     if (apz.deviceGroup == "Mobile") {
         params.layout = "Mobile";
    }
    else {
         params.layout = "All";
    }
    apz.launchApp(params);
};
apz.crlmch.LimitChange.fnOnClickContinue = function() {
    apz.data.buildData("LimitDetails", "crlmch");
    apz.toggleModal({
        "targetId": "crlmch__LimitChange__transactionSuccess"
    });
    apz.setElmValue("crlmch__LimitChange__trnsId_txtcnt", Math.random().toString().slice(2, 11));
    var getTodate = new Date();
    apz.setElmValue("crlmch__LimitChange__txnDate_txtcnt", (getTodate.getMonth() + 1) + "/" + getTodate.getDate() + "/" + getTodate.getFullYear());
    apz.setElmValue("crlmch__LimitChange__el_txt_23_txtcnt", apz.data.scrdata["crlmch__LimitDetails_Req"]["LimitDetails"]["Amount"]);
};
apz.crlmch.LimitChange.fnOnCancel = function() {
    $("#crlmch__LimitChange__limitChangeDiv").removeClass("sno");
    $("#crlmch__LimitChange__limitChangeProceed").addClass("sno");
};
