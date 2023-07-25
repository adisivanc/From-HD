apz.lecr01.ExportLCSummary = {};
apz.app.onLoad_ExportLCSummary = function(params) {
    if (apz.Login) {
        apz.lecr01.ExportLCSummary.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.lecr01.ExportLCSummary.sCorporateId = "000FTAC4321";
    }
    apz.lecr01.ExportLCSummary.showExportLCSummary();
};
apz.lecr01.ExportLCSummary.showExportLCSummary = function() {
   var req = {
            "letterSummary": {
                "corporateId": apz.lecr01.ExportLCSummary.sCorporateId,
                "type": "All"
            }
        };
    req.action = "Query";
    req.table = "tb_dbmi_corp_letter_credit";
   var lParams = {
            "ifaceName": "FetchLetterofCreditsService",
            "paintResp": "Y",
            "appId": "lecr01",
            "buildReq": "N",
            "lReq": req
        };
    apz.lecr01.ExportLCSummary.fnBeforCallServer(lParams);
};
apz.lecr01.billCollections.showBillSummaryCB = function(params) {
    debugger;
};