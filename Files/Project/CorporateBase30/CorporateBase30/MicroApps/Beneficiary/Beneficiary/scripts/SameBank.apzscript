apz.benf01.sameBank = {};
apz.benf01.sameBank.sAction = "";
apz.app.onLoad_SameBank = function() {
    debugger;
    apz.benf01.sameBank.sCorporateId = apz.Login.sCorporateId;
    apz.benf01.sameBank.fetchDetails();
};
apz.benf01.sameBank.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "benf01__SameBank__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "benf01__SameBank__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.benf01.sameBank.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.benf01.sameBank.sCorporateId,
        "beneficaryType": "Same",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.benf01.sameBank.fetchbeneficiaryDetailsCB = function(pResp) {
    apz.resetCurrAppId("benf01");
    apz.data.scrdata.benf01__SameBank_Req = {};
    apz.data.scrdata.benf01__SameBank_Req.tbDbmiCorpRoleBeneficary = pResp.data;
    apz.data.loadData("SameBank", "benf01");
};
apz.benf01.sameBank.sameBankSearch = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("benf01__Beneficiary__SBSearchBy");
        var lInput = apz.getElmValue("benf01__Beneficiary__SBSearch");
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
        }
        if (flag) {
            var llaunch = {};
            llaunch.appId = "acbs01";
            llaunch.scr = "BeneficiaryList";
            llaunch.div = "benf01__SameBank__launchMicroServiceHere";
            llaunch.layout = "All";
            llaunch.userObj = {};
            llaunch.userObj.action = "";
            llaunch.userObj.control = {};
            llaunch.userObj.control.destroyDiv = "benf01__SameBank__launchMicroServiceHere";
            llaunch.userObj.control.callBack = apz.benf01.sameBank.fetchbeneficiaryDetailsSCB;
            llaunch.userObj.data = {
                "corporateId": apz.benf01.sameBank.sCorporateId,
                "beneficaryType": "Same",
                "action": "onchange",
                "value": lInput,
                "type": lSearchType
            };
            apz.launchApp(llaunch);
        }
    }
};
apz.benf01.sameBank.fetchbeneficiaryDetailsSCB = function(pResp) {
    debugger;
    apz.resetCurrAppId("benf01");
    apz.data.scrdata.benf01__SameBank_Req = {};
    apz.data.scrdata.benf01__SameBank_Req.tbDbmiCorpRoleBeneficary = pResp.data;
    apz.data.loadData("SameBank", "benf01");
};
apz.benf01.sameBank.addBeneficary = function() {
    var params = {};
    params.appId = "benf01";
    params.scr = "NewSameBank";
    params.layout = "All";
    params.div = "benf01__Beneficiary__benLaunchRow";
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__benHead");
    apz.launchSubScreen(params);
};
apz.benf01.sameBank.editBeneficary = function(pthis) {
    var lrow = $(pthis).attr("rowno");
    var params = {};
    params.appId = "benf01";
    params.scr = "ModifySameBank";
    params.layout = "All";
    params.div = "benf01__Beneficiary__benLaunchRow";
    params.userObj = {
        "accountNumber": apz.getElmValue("benf01__SameBank__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lrow)
    };
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__benHead");
    apz.launchSubScreen(params);
};
apz.benf01.sameBank.viewBeneficary = function(pthis) {
    var lRow = $(pthis).attr("rowno");
    var lScrData;
    var lRef = $("#benf01__SameBank__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lRow).text();
    for (var i = 0; i < apz.data.scrdata.benf01__SameBank_Req.tbDbmiCorpRoleBeneficary.length; i++) {
        if (apz.data.scrdata.benf01__SameBank_Req.tbDbmiCorpRoleBeneficary[i].accountNumber == lRef) {
            lScrData = apz.data.scrdata.benf01__SameBank_Req.tbDbmiCorpRoleBeneficary[i];
            break;
        }
    }
    var params = {};
    params.appId = "benf01";
    params.scr = "SameBankBeneficaryDetails";
    params.userObj = {
        "data": {
            "SBData": lScrData
        }
    };
    params.div = "benf01__Beneficiary__benLaunchRow";
    params.layout = "All";
    apz.hide("benf01__Beneficiary__benfRow");
    apz.launchSubScreen(params);
    // var lrow = $(pthis).attr("rowno");
    // var params = {};
    // params.appId = "benf01";
    // params.scr = "SameBankBeneficaryDetails";
    // params.layout = "All";
    // params.div = "benf01__Beneficiary__benLaunchRow";
    // params.userObj = {
    //     "accountNumber": apz.getElmValue("benf01__SameBank__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lrow)
    // };
    // apz.hide("benf01__Beneficiary__benfRow");
    // apz.launchSubScreen(params);
};