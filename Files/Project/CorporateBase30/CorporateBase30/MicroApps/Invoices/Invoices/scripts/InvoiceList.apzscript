apz.Invoic.InvoiceList = {};
apz.Invoic.InvoiceList.sum = 0;
var monArr = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
apz.app.onLoad_InvoiceList = function() {
    debugger;
    if (firstLoad == "Y") {
        apz.data.loadJsonData("InvoiceListResp")
        apz.data.loadJsonData("InvoiceDetailsResp")
        apz.data.loadJsonData("InvoiceReqstFinResp")
        firstLoad = "N";
        ResUpdated = apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse;
    } else {
        apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse = ResUpdated;
        apz.data.loadData("QbookInvoiceDetails", "Invoic");
    }
    //$("#Invoic__InvoiceList__AvailableInvoiceListTable_tbody tr td:nth-child(1)").find("input").attr("disabled", true)
    //$("#Invoic__InvoiceList__AvailableInvoiceListTable_0_th").find("input").attr("disabled", true);
    // apz.data.loadJsonData("CashFlowChart","Invoic");
    // apz.Invoic.InvoiceList.fnPaintInitialCashFlow();
    // apz.Invoic.InvoiceList.fnLoadUpdateCashFlow();
    try {
        apz.Invoic.InvoiceList.fnPaintInitialCashFlow();
    } catch (e) {}
}
apz.Invoic.InvoiceList.fnSyncQuickBook = function() {
    apz.Invoic.InvoiceList.fnLaunchScreenInDialog();
}
apz.Invoic.InvoiceList.fnToggleModal = function() {
    var lDialog = {};
    lDialog.targetId = "Invoic__InvoiceList__pu_dlg_1";
    lDialog.callBack = apz.Invoic.InvoiceList.dialogCallBack;
    apz.toggleModal(lDialog);
}
apz.Invoic.InvoiceList.fnLaunchScreenInDialog = function() {
    var param = {};
    param.appId = apz.currAppId
    param.scr = "InvoiceSelection";
    param.layout = "All"
    param.div = "Invoic__InvoiceList__gr_row_4";
    apz.launchSubScreen(param);
}
apz.data.rowClicked = function(p) {
    debugger;
    if (p.parentElement.id.match("AvailableInvoiceListTable") != null) {
        var InvoiveNo = p.firstChild.nextSibling.textContent;
        apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].BillAddr.Line1 = ""
        for (var i = 0; i < apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice.length; i++) {
            var listClickedItemResp = apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice[i];
            if (InvoiveNo == apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice[i].Id) {
                var IssueDate = apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice[i].MetaData.CreateTime
                IssueDate = IssueDate.split("T")[0];
                apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0] = apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse
                    .Invoice[i]
                if (listClickedItemResp.BillAddr.Line4) {
                    apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].BillAddr.Line1 = listClickedItemResp.BillAddr.Id + ", " +
                        listClickedItemResp.BillAddr.Line1 + ", " + listClickedItemResp.BillAddr.Line2 + ", " + listClickedItemResp.BillAddr.Line3 +
                        ", " + listClickedItemResp.BillAddr.Line4;
                } else {
                    apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].BillAddr.Line1 = listClickedItemResp.BillAddr.Id + ", " +
                        listClickedItemResp.BillAddr.Line1 + ", " + listClickedItemResp.BillAddr.Line2 + ", " + listClickedItemResp.BillAddr.Line3
                }
                apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].PaymentType = "Pay On Delivery";
                apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].BIC = "CITIUS33";
                apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].BankName = "CitiBankUS";
                apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].CountryCode = "USA";
                apz.data.scrdata.Invoic__QbookInvoiceDetails_Res.QueryResponse.Invoice[0].MetaData.CreateTime = IssueDate;
            }
        }
        var param = {};
        param.appId = apz.currAppId
        param.scr = "InvoiceDetails";
        param.layout = "All"
        param.div = "Invoic__InvoiceLauncher__gr_row_2";
        apz.launchSubScreen(param);
    }
}
apz.Invoic.InvoiceList.dialogCallBack = function(param) {
    if (param.innerText == "Submit") apz.Invoic.InvoiceSelection.onClickOk();
    //$("#Invoic__InvoiceList__financing").removeClass("sno");
}
apz.Invoic.InvoiceList.fnFinancing = function() {
    debugger;
    apz.Invoic.InvoiceList.rowSelectorClicked();
    /* $("#Invoic__InvoiceList__AvailableInvoiceListTable_tbody tr td:nth-child(1)").find("input").attr("disabled", false)
    $("#Invoic__InvoiceList__AvailableInvoiceListTable_tbody tr td:nth-child(1)").find("input").on("click", apz.Invoic.InvoiceList.rowSelectorClicked)
    $("#Invoic__InvoiceList__AvailableInvoiceListTable_0_th").find("input").attr("disabled", false);*/
};
apz.Invoic.InvoiceList.rowSelectorClicked = function(event) {
    debugger;
    apz.Invoic.InvoiceList.sum = 0;
    apz.data.scrdata.Invoic__QbookInvoiceReqstFinancing_Res.QueryResponse.Invoice = [{}];
    for (var i = 0; i < apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice.length; i++) {
        var elem = $("#Invoic__InvoiceList__AvailableInvoiceListTable_selcb_" + i)[0].checked;
        if (elem) {
            apz.data.scrdata.Invoic__QbookInvoiceReqstFinancing_Res.QueryResponse.Invoice.push(apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse
                .Invoice[i]);
            apz.Invoic.InvoiceList.sum += apz.data.scrdata.Invoic__QbookInvoiceList_Res.QueryResponse.Invoice[i].TotalAmt;
        }
    }
    
    if(apz.Invoic.InvoiceList.sum != 0){
    var param = {};
    param.appId = apz.currAppId
    param.scr = "InvoiceRequestFinancing";
    param.layout = "All"
    param.div = "Invoic__InvoiceLauncher__gr_row_2";
    apz.launchSubScreen(param);
    }
    else{
        apz.dispMsg({"message":"Please select invoice","type":"E"});
    }
}
apz.Invoic.InvoiceList.fnSubmit = function() {
    debugger;
    apz.dispMsg({
        "message": "Request for financing submitted successfully",
        "type": "S",
        "callBack": apz.Invoic.InvoiceLauncher.launchInvoiceListScr
    });
}
apz.Invoic.InvoiceList.fnPaintInitialCashFlow = function() {
    // debugger;
    var account = apz.getElmValue("Invoic__InvoiceList__account");
    var data = gCashBalance; //needs to be uncommented while integrating
    //var data = apz.data.scrdata.Invoic__Dashboard_Req //needs to be commented while integrating
    apz.data.scrdata.Invoic__CashFlowChart_Res = {};
    apz.data.scrdata.Invoic__CashFlowChart_Res.data = [];
    $.each(gCashBalance.balanceMovement, function(i, v) {
        v.rawdt = apz.Invoic.InvoiceList.getDate(v.date);
        v.balance = parseInt(v.balance);
        if (v.account == account) apz.data.scrdata.Invoic__CashFlowChart_Res.data.push(v);
    })
    apz.data.scrdata.Invoic__CashFlowChart_Res.data = JSLINQ(apz.data.scrdata.Invoic__CashFlowChart_Res.data).OrderBy(function(item) {
        return item.rawdt
    }).items;
    /*var result = data.balanceMovement.filter(function(item) {
        if (item.account == account) return item;
    });
    apz.data.scrdata.Invoic__CashFlowChart_Res.data = result;*/
    apz.data.loadData("CashFlowChart", "Invoic");
}
apz.Invoic.InvoiceList.fnUpdateCashFlow = function(objInv) {
    let selAccNum = apz.getElmValue("Invoic__InvoiceList__account");
    let lastDt = '';
    $.each(objInv, function(i, v) {
        v.date = apz.Invoic.InvoiceList.getFormatDate(v.DueDate);
        v.rawdt = apz.Invoic.InvoiceList.getDate(v.date);
        if (lastDt == v.rawdt) v.samedt = true;
        lastDt = v.rawdt;
        v.newInv = true;
        v.account = selAccNum;
        v.balance = parseInt(v.TotalAmt);
        gCashBalance.balanceMovement.push(v);
        let temp = apz.copyJSONObject(v);
        temp.account = "4785936513712";
        temp.staticbal = true;
        gCashBalance.balanceMovement.push(temp);
        temp = apz.copyJSONObject(v);
        temp.account = "5785936513734";
        temp.staticbal = true;
        gCashBalance.balanceMovement.push(temp);
        temp = apz.copyJSONObject(v);
        temp.account = "7356329872139";
        temp.staticbal = true;
        gCashBalance.balanceMovement.push(temp);
    })
    gCashBalance.balanceMovement = JSLINQ(gCashBalance.balanceMovement).OrderBy(function(item) {
        return item.rawdt
    }).items;
    let amount = 0;
    let ledgerBalance = 0;
    $.each(gCashBalance.balanceMovement, function(i, v) {
        if (v.account == selAccNum) {
            if (v.newInv && apz.isNull(v.processed)) {
                amount = amount + v.balance;
                if (!v.samedt) v.balance = ledgerBalance + v.balance;
                delete v.newInv;
            } else {
                v.balance = v.balance + amount;
            }
            ledgerBalance = v.balance;
        }
    })
    apz.Invoic.InvoiceList.updateBalanceForNonSelAcc(selAccNum);
    apz.data.scrdata.Invoic__CashFlowChart_Res.data = JSLINQ(gCashBalance.balanceMovement).Where(function(item) {
        return item.account == selAccNum;
    }).items;
    apz.data.loadData("CashFlowChart", "Invoic");
    //  $('#bill01__BillDetails__gr_col_25 .sno').removeClass("sno");
}
apz.Invoic.InvoiceList.updateBalanceForNonSelAcc = function(selAccNum) {
    gCashBalance.balanceMovement = JSLINQ(gCashBalance.balanceMovement).OrderBy(function(item) {
        return item.account
    }).items;
    let lastAmt = 0;
    let lastAcc = '';
    let lastRawDt = '';
    $.each(gCashBalance.balanceMovement, function(i, v) {
        v.processed = true;
        if (v.account != selAccNum) {
            if (v.account == lastAcc && v.staticbal) {
                if (v.rawdt == lastRawDt) v.balance = 0;
                else v.balance = lastAmt;
                delete v.staticbal;
            }
            lastAmt = v.balance;
            lastAcc = v.account;
            lastRawDt = v.rawdt;
        }
    })
    gCashBalance.balanceMovement = JSLINQ(gCashBalance.balanceMovement).OrderBy(function(item) {
        return item.rawdt
    }).items;
}
apz.Invoic.InvoiceList.getDate = function(date) {
    let dtArr = date.split('-');
    return new Date(dtArr[0] + '-' + monArr[parseInt(dtArr[1])] + '-' + dtArr[2]).getTime();
}
apz.Invoic.InvoiceList.getFormatDate = function(date) {
    let dtArr = date.split('-');
    return dtArr[2] + '-' + dtArr[1] + '-' + dtArr[0];
}
