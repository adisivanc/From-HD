apz.benf01.otherBankDOM = {};
apz.app.onLoad_OtherBankDOM = function() {
    debugger;
    apz.benf01.otherBankDOM.sCorporateId = apz.Login.sCorporateId;
    apz.benf01.otherBankDOM.fetchDetails();
};
apz.benf01.otherBankDOM.fetchDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "benf01__OtherBankDOM__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "benf01__OtherBankDOM__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.benf01.otherBankDOM.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.benf01.otherBankDOM.sCorporateId,
        "beneficaryType": "Other",
        "action": "onload"
    };
    apz.launchApp(llaunch);
};
apz.benf01.otherBankDOM.fetchbeneficiaryDetailsCB = function(pResp) {
    debugger;
    apz.resetCurrAppId("benf01");
    apz.data.scrdata.benf01__OtherBankDOM_Req = {};
    apz.data.scrdata.benf01__OtherBankDOM_Req.tbDbmiCorpRoleBeneficary = pResp.data;
    
    
    for (var i = 0; i < apz.data.scrdata.benf01__OtherBankDOM_Req.tbDbmiCorpRoleBeneficary.length; i++) {
                var strlen = pResp.data[i].accountNumber;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = pResp.data[i].accountNumber;
                var result = apz.getMaskedValue(strlen, laccNo);
                apz.data.scrdata.benf01__OtherBankDOM_Req.tbDbmiCorpRoleBeneficary[i].maskAccNo = result;
            }
    
    
    
    
    
    apz.data.loadData("OtherBankDOM", "benf01");
};
apz.benf01.otherBankDOM.otherBankSearch = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("benf01__Beneficiary__OBSearchBy");
        var lInput = apz.getElmValue("benf01__Beneficiary__OBsearch");
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
            llaunch.div = "benf01__OtherBankDOM__launchMicroServiceHere";
            llaunch.layout = "All";
            llaunch.userObj = {};
            llaunch.userObj.action = "";
            llaunch.userObj.control = {};
            llaunch.userObj.control.destroyDiv = "benf01__OtherBankDOM__launchMicroServiceHere";
            llaunch.userObj.control.callBack = apz.benf01.otherBankDOM.fetchbeneficiaryDetailsOBCB;
            llaunch.userObj.data = {
                "corporateId": apz.benf01.otherBankDOM.sCorporateId,
                "beneficaryType": "Other",
                "action": "onchange",
                "value": lInput,
                "type": lSearchType
            };
            apz.launchApp(llaunch);
        }
    }
};
apz.benf01.otherBankDOM.fetchbeneficiaryDetailsOBCB = function(pResp) {
    apz.resetCurrAppId("benf01");
    apz.data.scrdata.benf01__OtherBankDOM_Req = {};
    apz.data.scrdata.benf01__OtherBankDOM_Req.tbDbmiCorpRoleBeneficary = pResp.data;
    apz.data.loadData("OtherBankDOM", "benf01");
};
apz.benf01.otherBankDOM.addBeneficary = function() {
    //  apz.hide("benf01__Beneficiary__beneficaryRow");
    var params = {};
    params.appId = "benf01";
    params.scr = "NewOtherBank";
    params.layout = "All";
    params.div = "benf01__Beneficiary__benLaunchRow";
    // $("#benf01__OtherBankDOM__OBAdd").addClass('sno');
    // $("#benf01__OtherBankDOM__summaryRow").addClass('sno');
    // apz.hide("benf01__OtherBankDOM__OtherBankRow");
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__OBHead");
    apz.hide("benf01__Beneficiary__rowdom_intbtn");
    apz.launchSubScreen(params);
};
apz.benf01.otherBankDOM.editBeneficary = function(pthis) {
    // apz.hide("benf01__Beneficiary__beneficaryRow");
    var lrow = $(pthis).attr("rowno");
    var params = {};
    params.appId = "benf01";
    params.scr = "ModifyOtherBank";
    params.layout = "All";
    params.div = "benf01__Beneficiary__benLaunchRow";
    params.userObj = {
        "accountNumber": apz.getElmValue("benf01__OtherBankDOM__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lrow)
    };
    // $("#benf01__OtherBankDOM__OBAdd").addClass('sno');
    // $("#benf01__OtherBankDOM__summaryRow").addClass('sno');
    // apz.hide("benf01__OtherBankDOM__OtherBankRow");
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__benHead");
    apz.hide("benf01__Beneficiary__rowdom_intbtn");
    apz.launchSubScreen(params);
};
apz.benf01.otherBankDOM.viewBeneficary = function(pthis) {
    debugger;
    var lRow = $(pthis).attr("rowno");
    var lScrData;
    var lRef = $("#benf01__OtherBankDOM__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lRow).text();
    for (var i = 0; i < apz.data.scrdata.benf01__OtherBankDOM_Req.tbDbmiCorpRoleBeneficary.length; i++) {
        if (apz.data.scrdata.benf01__OtherBankDOM_Req.tbDbmiCorpRoleBeneficary[i].accountNumber == lRef) {
            lScrData = apz.data.scrdata.benf01__OtherBankDOM_Req.tbDbmiCorpRoleBeneficary[i];
            break;
        }
    }
    var params = {};
    params.appId = "benf01";
    params.scr = "OtherBankBeneficaryDetails";
    params.userObj = {
        "data": {
            "OBData": lScrData
        }
    };
    params.div = "benf01__Beneficiary__benLaunchRow";
    params.layout = "All";
    apz.hide("benf01__Beneficiary__benfRow");
    apz.hide("benf01__Beneficiary__rowdom_intbtn");
    apz.launchSubScreen(params);
    // var params = {};
    // params.appId = "benf01";
    // params.scr = "OtherBankBeneficaryDetails";
    // params.layout = "All";
    // params.div = "benf01__Beneficiary__benLaunchRow";
    // params.userObj = {
    //     "accountNumber": apz.getElmValue("benf01__OtherBankDOM__i__tbDbmiCorpRoleBeneficary__accountNumber_" + lrow)
    // };
    // // $("#benf01__OtherBankDOM__OBAdd").addClass('sno');
    // // $("#benf01__OtherBankDOM__summaryRow").addClass('sno');
    // apz.hide("benf01__Beneficiary__benfRow");
    // apz.launchSubScreen(params);
};

