apz.acdp01.depositDetails = {};
apz.acdp01.depositDetails.sAction = "";
apz.app.onLoad_DepositDetails = function(userObj) {
    debugger;
    $("#acdp01__DepositDetails__depDetails").hide();
    apz.acdp01.depositDetails.lScrData = userObj.data.depositData;
    var params = {
        "action": "Deposit Details"
    };
    apz.acdp01.depositDetails.fnRender(params);
};
apz.acdp01.depositDetails.fnRender = function(params) {
    apz.acdp01.depositDetails.fnRenderData(params);
};
apz.acdp01.depositDetails.fnRenderData = function(params) {
    if (params.action == "Deposit Details") {
        apz.acdp01.depositDetails.sAction = "Deposit Details";
        apz.data.scrdata.acdp01__DepositDetails_Res = {};
        apz.data.scrdata.acdp01__DepositDetails_Res.depositSummary = {};
        apz.data.scrdata.acdp01__DepositDetails_Res.depositSummary = apz.acdp01.depositDetails.lScrData;
        apz.data.loadData("DepositDetails", "acdp01");
        
        var strlen = apz.getElmValue("acdp01__DepositDetails__o__depositSummary__principalCreditAcno");
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.getElmValue("acdp01__DepositDetails__o__depositSummary__principalCreditAcno");
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.setElmValue("acdp01__DepositDetails__o__depositSummary__principalCreditAcno", result);
    }
};
apz.acdp01.depositDetails.fnCancel = function() {
    var params = {};
    params.appId = "acdp01";
    params.scr = "DepositSummary";
    params.div = "acdp01__DepositLauncher__DepositLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
