apz.lonact.ViewLoanDetails = {};
apz.app.onLoad_ViewLoanDetails = function(params) {
    debugger;
    let lApplicatioNum = params.ApplicationNumber;
    var request = {};
    var params = {};
    request.tbDbmiLoanMaster = {};
    request.tbDbmiLoanComponents = {};
    request.tbDbmiLoanScheduleDefinitions = {};
    request.tbDbmiLoanMaster.applicationNumber = lApplicatioNum;
    request.tbDbmiLoanComponents.applicationNumber = lApplicatioNum;
    request.tbDbmiLoanScheduleDefinitions.applicationNumber = lApplicatioNum;
    var lReq = {
        "ifaceName": "GetLoanDetails_Query",
        "paintResp": "Y",
        "buildReq": "N",
        "req": request,
        "appId": "lonact",
        "callBack": apz.lonact.ViewLoanDetails.fnGetLoanDetailsCB,
    };
    apz.server.callServer(lReq);
};
apz.lonact.ViewLoanDetails.fnGetLoanDetailsCB = function(params) {
    debugger;
};
apz.app.onShown_ViewLoanDetails = function() {
    let lAmount = $("#lonact__GetLoanDetails__i__tbDbmiLoanMaster__amount").text();
    $("#lonact__GetLoanDetails__i__tbDbmiLoanMaster__amount").text(apz.data.scrdata.lonact__GetLoanDetails_Req.tbDbmiLoanMaster.currency + " " +
        lAmount);
    if (apz.data.scrdata.lonact__GetLoanDetails_Req.tbDbmiLoanMaster.loanStatementRequired === "Y") {
        $("#lonact__ViewLoanDetails__ct_frm_10").removeClass('sno');
    }
    apz.data.scrdata.lonact__GetEffectiveDatevalues_Res = {};
    apz.data.scrdata.lonact__GetEffectiveDatevalues_Res.tbDbmiLoanEffectiveDateValues = [{
        "id": "1",
        "applicationNumber": "2915931892506",
        "effectiveDate": "01/01/2021",
        "udeId": "MAIN_INT",
        "udeValue": "4.5%",
        "rateCode": "",
        "codeUsage": "",
        "resolvedValue": "4.5%"
    }, {
        "id": "2",
        "applicationNumber": "2915931892506",
        "effectiveDate": "01/01/2021",
        "udeId": "CHARGE",
        "udeValue": "120",
        "rateCode": "",
        "codeUsage": "",
        "resolvedValue": "120"
    }]
    
    apz.data.loadData("GetEffectiveDatevalues","lonact");
};
apz.lonact.ViewLoanDetails.back = function() {
    var llaunch = {};
    llaunch.appId = "lonact";
    llaunch.scr = "Summary";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    apz.launchApp(llaunch);
};
apz.lonact.ViewLoanDetails.viewSD = function(pObj) {
    debugger;
    let lRow = $(pObj).attr("rowno");
    $("#lonact__ViewLoanDetails__ct_lst_4 #lonact__ViewLoanDetails__ScheduleDefinitions_Table").remove();
    let lComponent = $("#lonact__GetLoanDetails__i__tbDbmiLoanComponents__componentName_" + lRow + "_txtcnt").text();
    let lSDData = apz.data.scrdata.lonact__GetLoanDetails_Req.tbDbmiLoanScheduleDefinitions;
    var lFilteredSD = [];
    if (lSDData.length > 0) {
        lFilteredSD = lSDData.filter(lObj => lObj.componentName === lComponent);
    }
    apz.data.scrdata.lonact__GetScheduleDefinitions_Req = {};
    apz.data.scrdata.lonact__GetScheduleDefinitions_Req.tbDbmiLoanScheduleDefinitions = lFilteredSD;
    apz.data.loadData("GetScheduleDefinitions", "lonact");
    $("#lonact__ViewLoanDetails__ct_lst_4_row_" + lRow + " .sdcol").html($("#lonact__ViewLoanDetails__SD_MAIN_PS").html());
    $("#lonact__ViewLoanDetails__ct_lst_4 #lonact__ViewLoanDetails__ScheduleDefinitions_Table").removeClass("sno");
    $("#lonact__ViewLoanDetails__ScheduleDefinitions_Table_table").removeClass("sno");
};
// apz.lonact.ViewLoanDetails.fnClickServiceAccct = function() {
//     debugger;
//     var params = {
//         "targetId": "lonact__LoanCreation__ProdModal"
//     }
//     apz.toggleModal(params);
//     apz.data.loadJsonData("ProductList", "lonact");
// }
// apz.lonact.LoanCreation.fnSelectProduct = function(pthis) {
//     debugger;
//     var lrow = $(pthis).attr("rowno");
//     var lproduct = apz.getElmValue("lonact__ProductList__o__LIstItem__ProductName_" + lrow);
//     apz.setElmValue("lonact__LoanCreation__Product", lproduct);
//     var params = {
//         "targetId": "lonact__LoanCreation__ProdModal"
//     }
//     apz.toggleModal(params);
// }
