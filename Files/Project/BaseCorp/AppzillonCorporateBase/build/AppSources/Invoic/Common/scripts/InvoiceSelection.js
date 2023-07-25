apz.Invoic.InvoiceSelection = {}
apz.app.onLoad_InvoiceSelection = function() {
    apz.Invoic.InvoiceSelection.fnQbookService();
    //apz.data.loadJsonData("BackUpOrignal")
};
apz.Invoic.InvoiceSelection.fnQbookService = function() {
    var lServerParams = {
        "ifaceName": "QbookInvoiceServc",
        "buildReq": "N",
        "appId": apz.currAppId,
        "req": {
            "QueryParm": {
                "CompnayName": apz.app.CompanyName,
                "Query": "select * from Invoice",
                "OuthToken": apz.app.Token
            }
        },
        "paintResp": "N",
        "callBack": apz.Invoic.InvoiceSelection.getQbookInvoiceServcCB
    }
    apz.server.callServer(lServerParams);
}
apz.Invoic.InvoiceSelection.getQbookInvoiceServcCB = function(param) {
    debugger;
    if (param.errors != undefined) {
        apz.data.loadJsonData("BackUpOrignal")
    } else {
        apz.data.scrdata.Invoic__QbookInvoiceServc_Res = {};
        if (apz.isNull(param.res)) {
            apz.data.loadJsonData("BackUpOrignal")
        } else {
            apz.data.scrdata.Invoic__QbookInvoiceServc_Res = param.res.Invoic__QbookInvoiceServc_Res;
            apz.data.loadData("QbookInvoiceServc", "Invoic");
        }
    }
    apz.stopLoader()
    apz.Invoic.InvoiceList.fnToggleModal();
}
apz.Invoic.InvoiceSelection.onClickOk = function() {
    var selectedQuickBookInv = [];
    /* for (var i = 0; i < apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice.length; i++) {
        var elem = $("#Invoic__InvoiceSelection__ct_tbl_1_selcb_" + i)[0].checked;
		if (elem) {
            for(var j=0; j<apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice.length; j++){
				if(apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice[i].Id == apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice[j].Id ){
					itemInListFlag = "T";
					 break;
				}
            }
            if(itemInListFlag == "F"){
                apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice.push(apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice[i]);
            }
        }
    }
    ResUpdated = apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse;*/
    for (var i = 0; i < apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice.length; i++) {
        var elem = $("#Invoic__InvoiceSelection__ct_tbl_1_selcb_" + i)[0].checked;
        if (elem) {
            apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice.push(apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice[
                i]);
            var InvDetails = {};
            InvDetails["DueDate"] = apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice[i].DueDate;
            InvDetails["Currency"] = apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice[i].CurrencyRef.value;
            InvDetails["TotalAmt"] = apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice[i].TotalAmt;
            InvDetails["InvId"] = apz.data.scrdata.Invoic__QbookInvoiceServc_Res.QueryResponse.Invoice[i].Id;
            selectedQuickBookInv.push(InvDetails);
        }
    }
    //apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice.concat(selectedQuickBookInv);
    apz.data.loadData("QbookInvoiceList", "Invoic");
    apz.Invoic.InvoiceList.fnUpdateCashFlow(selectedQuickBookInv);
}