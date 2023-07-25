apz.rolovr.Summary = {};
apz.app.onLoad_Summary = function(params) {
    debugger;
    //apz.data.loadJsonData("SummaryData", "rolovr");
    apz.rolovr.Summary.fnGetSummaryData();
}
apz.rolovr.Summary.fnGetSummaryData = function() {
    debugger;
   var lReq = {
        "ifaceName": "GetLoanSummary_Query",
        "paintResp": "Y",
        "buildReq": "N",
        "req": {},
        "appId": "rolovr",
        "callBack": apz.rolovr.Summary.fnGetSummaryDataCB,
    };
    apz.server.callServer(lReq);
}
apz.rolovr.Summary.fnGetSummaryDataCB = function(params) {
    debugger;
}
apz.rolovr.Summary.fnSelectAcct = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var llaunch = {};
    llaunch.appId = "rolovr";
    llaunch.scr = "RollOver";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    llaunch.userObj = {
        "AccountNo": apz.getElmValue("rolovr__GetLoanSummary__i__tbDbmiLoanMaster__accountNumber_" + lrow),
        "Product":apz.data.scrdata.rolovr__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].product,
        "Branch":apz.data.scrdata.rolovr__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].branch,
        "CustomerId":apz.data.scrdata.rolovr__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].customerId,
        "CustomerName":apz.data.scrdata.rolovr__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].customerName
        
    }
    apz.launchSubScreen(llaunch);
}
apz.rolovr.Summary.fnNew = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "lonact";
    llaunch.scr = "LoanCreation";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    apz.launchApp(llaunch);
}
apz.rolovr.Summary.fnSearch = function() {
    debugger;
    var pval = apz.getElmValue("rolovr__Summary__el_inp_1");
    apz.searchRecords("rolovr__Summary__ct_lst_3", pval);
}
