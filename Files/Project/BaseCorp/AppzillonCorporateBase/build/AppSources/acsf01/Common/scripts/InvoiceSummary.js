apz.acsf01.InvoiceSummary = {};
apz.app.onLoad_InvoiceSummary = function() {
    if (apz.Login) {
        apz.acsf01.InvoiceSummary.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acsf01.InvoiceSummary.sCorporateId = "000FTAC4321";
    }
    apz.acsf01.InvoiceSummary.getInvoiceSummary();
};
apz.acsf01.InvoiceSummary.getInvoiceSummary = function() {
    debugger;
    var req = {};
    req.tbDbmiCorpInvoiceDetails = {
        "corpId": apz.acsf01.InvoiceSummary.sCorporateId,
        "type": "All"
    };
    // req.action = "Query";
    // req.table = "tb_dbmi_corp_invoice_details";
     req.importFunction = "InvoiceSummary";
    var lReq = {
        "ifaceName": "InvoiceSummary",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.InvoiceSummary.getInvoiceSummaryCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsf01.InvoiceSummary.getInvoiceSummaryCB = function(pResp) {
    debugger;
};
apz.acsf01.InvoiceSummary.search = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acsf01__InvoiceSummary__SearchBy");
        var lInput = apz.getElmValue("acsf01__InvoiceSummary__Search");
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_MSGCHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "InvoiceNumber") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "invoiceNumber";
            }
        } else if (lType == "Name") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "name";
            }
        }
        if (flag) {
            var req = {};
            req.tbDbmiCorpInvoiceDetails = {
                "corpId": apz.acsf01.InvoiceSummary.sCorporateId,
                "type": lSearchType,
                "value": lInput
            };
            // req.action = "Query";
            // req.table = "tb_dbmi_corp_invoice_details";
             req.importFunction = "InvoiceSummary";
            var lReq = {
                "ifaceName": "InvoiceSummary",
                "paintResp": "Y",
                "buildReq": "N",
                "req": req,
                "appId": "acsf01",
                "async": false,
                "callBack": apz.acsf01.InvoiceSummary.getInvoiceSummaryCB,
                "callBackObj": ""
            };
            apz.server.callServer(lReq);
        }
    }
};
apz.acsf01.InvoiceSummary.fnOnSelectInvoice = function(lObj, event) {
    debugger;
    //  var lRow = parseInt(lObj.id.split("_")[6]);
    var lRow = $(lObj).attr("rowno");
    var lScrData;
    var lRef = apz.getElmValue("acsf01__InvoiceSummary__o__tbDbmiCorpInvoiceDetails__invoiceNumber_" + lRow);
    for (var i = 0; i < apz.data.scrdata.acsf01__InvoiceSummary_Res.tbDbmiCorpInvoiceDetails.length; i++) {
        if (apz.data.scrdata.acsf01__InvoiceSummary_Res.tbDbmiCorpInvoiceDetails[i].invoiceNumber == lRef) {
            lScrData = apz.data.scrdata.acsf01__InvoiceSummary_Res.tbDbmiCorpInvoiceDetails[i];
            break;
        }
    }
    var params = {};
    params.appId = "acsf01";
    params.scr = "InvoiceDetails";
    params.userObj = {
        "data": {
            "InvoiceData": lScrData
        }
    };
    params.div = "acsf01__InvoiceSummary__launchScreen";
    params.layout = "All";
    $("#acsf01__InvoiceSummary__InvoiceSummary").addClass('sno');
    $("#acsf01__InvoiceSummary__launchScreenRow").removeClass('sno');
    apz.launchSubScreen(params);
};
