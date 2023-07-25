apz.lonact.Summary = {};
apz.app.onLoad_Summary = function(params) {
    debugger;
    //apz.data.loadJsonData("SummaryData","lonact");
    apz.lonact.Summary.fnGetSummaryData();
};
apz.lonact.Summary.fnGetSummaryData = function() {
    debugger;
    var lReq = {
        "ifaceName": "GetLoanSummary_Query",
        "paintResp": "Y",
        "buildReq": "N",
        "req": {},
        "appId": "lonact",
        "callBack": apz.lonact.Summary.fnGetSummaryDataCB,
    };
    apz.server.callServer(lReq);
};
apz.lonact.Summary.fnGetSummaryDataCB = function(params) {
    debugger;
};
apz.lonact.Summary.fnSelectCUstomerId = function(pthis) {
    debugger;
    //$("#lonact__Summary__listrow").removeClass("sno");
    //apz.data.loadJsonData("SummaryData","lonact");
};
apz.lonact.Summary.fnNew = function() {
    debugger;
    // $("lonact__Summary__loanSubScreenLauncher").removeClass("sno");
    // $("#lonact__Summary__headerRow").addClass("sno");
    // $("#lonact__Summary__SummaryListRow").addClass("sno");
    var llaunch = {};
    llaunch.appId = "lonact";
    llaunch.scr = "LoanCreation";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    apz.launchApp(llaunch);
};
apz.lonact.Summary.fnRollOver = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var llaunch = {};
    llaunch.appId = "rolovr";
    llaunch.scr = "RollOver";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    llaunch.userObj = {
        "AccountNo": apz.getElmValue("lonact__GetLoanSummary__i__tbDbmiLoanMaster__accountNumber_" + lrow),
        "Product":apz.data.scrdata.lonact__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].product,
        "Branch":apz.data.scrdata.lonact__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].branch,
        "CustomerId":apz.data.scrdata.lonact__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].customerId,
        "CustomerName":apz.data.scrdata.lonact__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].customerName
    };
    apz.launchApp(llaunch);
};
apz.lonact.Summary.fnSearch = function() {
    debugger;
    var pval = apz.getElmValue("lonact__Summary__el_inp_1");
    apz.searchRecords("lonact__Summary__ct_lst_3", pval);
};

apz.lonact.Summary.fnView = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var llaunch = {};
    llaunch.appId = "lonact";
    llaunch.scr = "ViewLoanDetails";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    llaunch.userObj = {
        "ApplicationNumber": apz.data.scrdata.lonact__GetLoanSummary_Req.tbDbmiLoanMaster[lrow].applicationNumber
    };
    apz.launchSubScreen(llaunch);
}