apz.acsi01.modifySI = {};
apz.app.onLoad_ModifySI = function(params) {
    debugger;
    apz.acsi01.modifySI.sCorporateId =apz.Login.sCorporateId;
    apz.acsi01.modifySI.fetchbeneficiaryDetails();
    apz.data.scrdata.acsi01__SIClosure_Req = {};
    apz.data.scrdata.acsi01__SIClosure_Req.tbDbmiCorpStandingInstructions = params.SIData;
    apz.data.loadData("SIClosure", "acsi01");
};
apz.acsi01.modifySI.fetchbeneficiaryDetails = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "acbs01";
    llaunch.scr = "BeneficiaryList";
    llaunch.div = "acsi01__ModifySI__launchMicroServiceHere";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "acsi01__ModifySI__launchMicroServiceHere";
    llaunch.userObj.control.callBack = apz.acsi01.modifySI.fetchbeneficiaryDetailsCB;
    llaunch.userObj.data = {
        "corporateId": apz.acsi01.modifySI.sCorporateId,
        //"beneficaryType": "Same"
    };
    apz.launchApp(llaunch);
};
apz.acsi01.modifySI.fetchbeneficiaryDetailsCB = function(params) {
    debugger;
    apz.resetCurrAppId("acsi01");
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        var lfrmacc = {
            "val": params.data[i].accountNo,
            "desc": params.data[i].accountNumber
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("acsi01__SIClosure__i__tbDbmiCorpStandingInstructions__toAccount"), lfrmarr);
};
apz.acsi01.modifySI.cancel = function() {
    debugger;
    var params = {};
    params.appId = "acsi01";
    params.scr = "StandingInstructions";
    params.layout = "All";
    apz.launchScreen(params);
};
apz.acsi01.modifySI.confirm = function() {
    debugger;
};
