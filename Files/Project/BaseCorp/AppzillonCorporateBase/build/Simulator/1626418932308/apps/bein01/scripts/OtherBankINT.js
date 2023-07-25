apz.bein01.OtherBankINT = {};
apz.app.onLoad_OtherBankINT = function() {
    debugger;
    apz.bein01.OtherBankINT.sCorporateId = apz.Login.sCorporateId;
    apz.bein01.OtherBankINT.fetchDetails();
};
apz.bein01.OtherBankINT.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "bein01__OtherBankINT__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "bein01__OtherBankINT__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.bein01.OtherBankINT.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.bein01.OtherBankINT.sCorporateId,
        "beneficaryType": "International",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.bein01.OtherBankINT.fetchbeneficiaryDetailsCB = function(pResp) {
    debugger;
    apz.resetCurrAppId("benf01");
    apz.data.scrdata.bein01__OtherBankINT_Req = {};
    apz.data.scrdata.bein01__OtherBankINT_Req.tbDbmiCorpRoleBeneficary = pResp.data;
    
      
    for (var i = 0; i < apz.data.scrdata.bein01__OtherBankINT_Req.tbDbmiCorpRoleBeneficary.length; i++) {
                var strlen = pResp.data[i].accountNumber;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = pResp.data[i].accountNumber;
                var result = apz.getMaskedValue(strlen, laccNo);
                apz.data.scrdata.bein01__OtherBankINT_Req.tbDbmiCorpRoleBeneficary[i].maskAccNo = result;
            }
    
    apz.data.loadData("OtherBankINT", "bein01");
};
apz.bein01.OtherBankINT.OBINTSearch = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("benf01__Beneficiary__INTSearchBy");
        var lInput = apz.getElmValue("benf01__Beneficiary__INTSearch");
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "NickName") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "NickName";
            }
        } else if (lType == "BeneficaryName") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "BeneficaryName";
            }
        } else if (lType == "AccountNumber") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "AccountNumber";
            }
        } else if (lType == "BankName") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "BankName";
            }
        }
        if (flag) {
            var llaunch = {};
            llaunch.appId = "acbs01";
            llaunch.scr = "BeneficiaryList";
            llaunch.div = "bein01__OtherBankINT__launchMicroServiceHere";
            llaunch.layout = "All";
            llaunch.userObj = {};
            llaunch.userObj.action = "";
            llaunch.userObj.control = {};
            llaunch.userObj.control.destroyDiv = "bein01__OtherBankINT__launchMicroServiceHere";
            llaunch.userObj.control.callBack = apz.bein01.OtherBankINT.fetchbeneficiaryDetailsINTCB;
            llaunch.userObj.data = {
                "corporateId": apz.bein01.OtherBankINT.sCorporateId,
                "beneficaryType": "International",
                "action": "onchange",
                "value": lInput,
                "type": lSearchType
            };
            apz.launchApp(llaunch);
        }
    }
};
apz.bein01.OtherBankINT.fetchbeneficiaryDetailsINTCB = function(pResp) {
    debugger;
    apz.resetCurrAppId("benf01");
    apz.data.scrdata.bein01__OtherBankINT_Req = {};
    apz.data.scrdata.bein01__OtherBankINT_Req.tbDbmiCorpRoleBeneficary = pResp.data;
    apz.data.loadData("OtherBankINT", "bein01");
};
apz.bein01.OtherBankINT.addBeneficary = function() {
    var params = {};
    params.appId = "bein01";
    params.scr = "NewOtherBankINT";
    params.layout = "All";
    params.div = "benf01__Beneficiary__benLaunchRow";
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__INTHead");
    apz.hide("benf01__Beneficiary__rowdom_intbtn");
    apz.launchSubScreen(params);
};
apz.bein01.OtherBankINT.editBeneficary = function(pthis) {
    //apz.hide("bein01__OtherBankINT__otherIntRow");
    // apz.show("bein01__OtherBankINT__benInterRow");
    var lrow = $(pthis).attr("rowno");
    var params = {};
    params.appId = "bein01";
    params.scr = "ModifyOtherBankINT";
    params.layout = "All";
    params.div = "benf01__Beneficiary__benLaunchRow";
    params.userObj = {
        "accountNumber": apz.getElmValue("bein01__OtherBankINT__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lrow)
    };
    // $("#bein01__OtherBankINT__OBINTAdd").addClass('sno');
    // $("#bein01__OtherBankINT__summaryRow").addClass('sno');
    // apz.hide("bein01__OtherBankINT__OBINTRow");
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__rowdom_intbtn");
    apz.hide("benf01__Beneficiary__INTHead");
    apz.launchSubScreen(params);
};
apz.bein01.OtherBankINT.viewBeneficary = function(pthis) {
    var lRow = $(pthis).attr("rowno");
    var lScrData;
    var lRef = $("#bein01__OtherBankINT__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lRow).text();
    for (var i = 0; i < apz.data.scrdata.bein01__OtherBankINT_Req.tbDbmiCorpRoleBeneficary.length; i++) {
        if (apz.data.scrdata.bein01__OtherBankINT_Req.tbDbmiCorpRoleBeneficary[i].accountNumber == lRef) {
            lScrData = apz.data.scrdata.bein01__OtherBankINT_Req.tbDbmiCorpRoleBeneficary[i];
            break;
        }
    }
    var params = {};
    params.appId = "bein01";
    params.scr = "OtherBankINTBeneficaryDetails";
    params.userObj = {
        "data": {
            "INTData": lScrData
        }
    };
    params.div = "benf01__Beneficiary__benLaunchRow";
    params.layout = "All";
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__rowdom_intbtn");
    $("#bein01__OtherBankINT__summaryRow").addClass('sno');
    apz.launchSubScreen(params);
    // // apz.hide("bein01__OtherBankINT__otherIntRow");
    // // apz.show("bein01__OtherBankINT__benInterRow");
    // var lrow = $(pthis).attr("rowno");
    // var params = {};
    // params.appId = "bein01";
    // params.scr = "OtherBankINTBeneficaryDetails";
    // params.layout = "All";
    // params.div = "benf01__Beneficiary__benLaunchRow";
    // params.userObj = {
    //     "accountNumber": apz.getElmValue("bein01__OtherBankINT__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lrow)
    // };
    // // $("#bein01__OtherBankINT__OBINTAdd").addClass('sno');
    // apz.hide("benf01__Beneficiary__benfRow");
    // // $("#bein01__OtherBankINT__summaryRow").addClass('sno');
    // apz.launchSubScreen(params);
};
