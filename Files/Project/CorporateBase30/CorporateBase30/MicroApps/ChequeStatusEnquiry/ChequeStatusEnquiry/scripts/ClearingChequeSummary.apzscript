apz.chqsts.clearingChequeSummary = {};

apz.app.onLoad_ClearingChequeSummary = function() {
   // apz.setElmValue("csmrbk__LandingPage__ScreenNmeLandingTxt", "INWARD CLEARING")
}
apz.app.onShown_ClearingChequeSummary = function(pParams) {
    debugger;
   apz.data.loadJsonData("AccountDetails","chqsts");
   apz.chqsts.clearingChequeSummary.sparams = apz.data.scrdata.chqsts__AccountDetails_Res;
    apz.chqsts.clearingChequeSummary.fnInitialise(apz.chqsts.clearingChequeSummary.sparams);
};

apz.chqsts.clearingChequeSummary.fnInitialise = function(pParams) {
    debugger;
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var larrLength = pParams.SavingsAccount.length;
    
    
    
      for (var i = 0; i < larrLength; i++) {
        var strlen = pParams.SavingsAccount[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = pParams.SavingsAccount[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        var lfrmacc = {
            "val": pParams.SavingsAccount[i].accountNo,
            "desc": result
        };
        lfrmarr.push(lfrmacc);
    }
    
    
    
    
    // for (var i = 0; i < larrLength; i++) {
    //     var lfrmacc = {
    //         "val": pParams.SavingsAccount[i].accountNo,
    //         "desc": pParams.SavingsAccount[i].accountNo
    //     };
    //     lfrmarr.push(lfrmacc);
    // }
    
    
    
    
    apz.populateDropdown(document.getElementById("chqsts__ClearingChequeSummary__accNum"), lfrmarr);
    apz.setElmValue("chqsts__ClearingChequeSummary__accNum",lfrmarr[1].val);
};
apz.chqsts.clearingChequeSummary.fnGetDetails1 = function() {
    debugger;
    var lReq = {
        "ifaceName": "ClearingCheques",
        "paintResp": "N",
        "buildReq": "N",
        "req": "",
        "appId": "chqsts",
        "async": false,
        "callBack": apz.chqsts.clearingChequeSummary.fnGetDetailsCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.chqsts.clearingChequeSummary.fnGetDetails = function() {
    debugger;
    $("#chqsts__ClearingChequeSummary__ListRow").removeClass("sno");
    var lAccountNo = apz.getElmValue("chqsts__ClearingChequeSummary__accNum");
    
    apz.data.loadJsonData("ClearingCheques","chqsts");
   var lRecords = apz.data.scrdata.chqsts__ClearingCheques_Res.tbDbtpChequedetails;
    
   // var lRecords = pResp.res.chqsts__ClearingCheques_Res.tbDbtpChequedetails;
    var lRecordsLength = lRecords.length;
    var lFinalRecord = [];
    for (var i = 0; i < lRecordsLength; i++) {
        if (lRecords[i].accountNumber == lAccountNo) {
            lFinalRecord.push(lRecords[i]);
        }
    }
        apz.data.scrdata.chqsts__ClearingCheques_Res.tbDbtpChequedetails = lFinalRecord;
        //$("#chqsts__ClearingCheques__o__tbDbtpChequedetails__chequeStatus_0").addClass("suc");
        $("#chqsts__ClearingCheques__o__tbDbtpChequedetails__chequeStatus_1").addClass("war");
        apz.data.loadData("ClearingCheques", "chqsts");
    
};
apz.chqsts.clearingChequeSummary.fnViewDetails = function(lObj, event) {
    debugger;
    var RowNo = $(lObj).attr('rowno');
    var lScrData = apz.data.scrdata.chqsts__ClearingCheques_Res.tbDbtpChequedetails[RowNo];
    var params = {};
    params.appId = "chqsts";
    params.scr = "InwardClearing";
    params.layout = "All";
    params.userObj = {
        "data": {
            "ChequeData": lScrData
        }
    };
    params.div = "chqsts__ClearingChequeSummary__LaunchScreen";
    $("#chqsts__ClearingChequeSummary__LaunchScreen").removeClass("sno");
    $("#chqsts__ClearingChequeSummary__AccNumRow").addClass("sno");
    $("#chqsts__ClearingChequeSummary__ListRow").addClass("sno");
    apz.launchSubScreen(params);
};
