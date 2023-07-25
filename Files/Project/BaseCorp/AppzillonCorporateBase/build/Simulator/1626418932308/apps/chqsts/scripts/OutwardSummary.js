apz.chqsts.outwardSummary = {};
 apz.app.onLoad_outwardSummary = function() {
    
}
apz.app.onShown_OutwardSummary = function(pParams) {
    debugger;
   
    $("#chqsts__ClearingCheques__o__tbDbtpChequedetails__chequeStatus_1").addClass("war");
   apz.data.loadJsonData("AccountDetails","chqsts");
   apz.chqsts.outwardSummary.sparams = apz.data.scrdata.chqsts__AccountDetails_Res;
    apz.chqsts.outwardSummary.fnInitialise(apz.chqsts.outwardSummary.sparams);
};

apz.chqsts.outwardSummary.fnInitialise = function(pParams) {
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
    apz.populateDropdown(document.getElementById("chqsts__OutwardSummary__OutwardAccNum"), lfrmarr);
    apz.setElmValue("chqsts__OutwardSummary__OutwardAccNum",lfrmarr[1].val);
    
};
apz.chqsts.outwardSummary.fnGetDetails1 = function() {
    debugger;
    var lReq = {
        "ifaceName": "OutwardSummary",
        "paintResp": "N",
        "buildReq": "N",
        "req": "",
        "appId": "chqsts",
        "async": false,
        "callBack": apz.chqsts.outwardSummary.fnGetDetailsCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.chqsts.outwardSummary.fnGetDetails = function(pResp) {
    debugger;
    $("#chqsts__OutwardSummary__Outward_ListRow").removeClass("sno");
    var lAccountNo = apz.getElmValue("chqsts__OutwardSummary__OutwardAccNum");
    
    //var lRecords = pResp.res.chqsts__OutwardSummary_Res.tbDbtpChequedetails;
    
     apz.data.loadJsonData("OutwardSummary","chqsts");
  // var lRecords = apz.data.scrdata.chqsts__ClearingCheques_Res.tbDbtpChequedetails;
    var lRecords = apz.data.scrdata.chqsts__OutwardSummary_Res.tbDbtpChequedetails;
    
    var lRecordsLength = lRecords.length;
    var lFinalRecord = [];
    for (var i = 0; i < lRecordsLength; i++) {
        if (lRecords[i].accountNumber == lAccountNo) {
            lFinalRecord.push(lRecords[i]);
        }
    }
        apz.data.scrdata.chqsts__OutwardSummary_Res.tbDbtpChequedetails = lFinalRecord;
        //$("#chqsts__OutwardSummary__o__tbDbtpChequedetails__chequeStatus_0").addClass("suc");
        $("#chqsts__OutwardSummary__o__tbDbtpChequedetails__chequeStatus_1").addClass("war");
        apz.data.loadData("OutwardSummary", "chqsts");
    
};
apz.chqsts.outwardSummary.fnViewDetails = function(lObj, event) {
    debugger;
    var RowNo = $(lObj).attr('rowno');
    var lScrData = apz.data.scrdata.chqsts__OutwardSummary_Res.tbDbtpChequedetails[RowNo];
    var params = {};
    params.appId = "chqsts";
    params.scr = "OutwardClearing";
    params.layout = "All";
    params.userObj = {
        "data": {
            "ChequeData": lScrData
        }
    };
    params.div = "chqsts__OutwardSummary__LaunchOutwardScreen";
    $("#chqsts__OutwardSummary__LaunchOutwardScreen").removeClass("sno");
    $("#chqsts__OutwardSummary__AccNum_Row").addClass("sno");
    $("#chqsts__OutwardSummary__Outward_ListRow").addClass("sno");
    apz.launchSubScreen(params);
};
