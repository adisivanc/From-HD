apz.bill01.BillSelection = {};
apz.app.onLoad_BillSelection = function() {
    debugger;
    $(".pgn-ctr").addClass("sno");
    var lServerParams = {
        "ifaceName": "BillingDetails",
        "buildReq": "N",
        "appId": apz.appId,
        "req": {
            "QueryParm": {
                "CompnayName": apz.app.CompanyName,
                "Query": "select * from Bill",
                "OuthToken": apz.app.Token
            }
        },
        "paintResp": "N",
        "callBack": apz.bill01.BillSelection.getBillingDetailsCB
    };
    apz.server.callServer(lServerParams);
}
apz.bill01.BillSelection.getBillingDetailsCB = function(param) {
    if (param.errors != undefined) {
        apz.data.loadJsonData("BillingDetails", "bill01");
    } else {
        apz.data.scrdata.bill01__BillingDetails_Res = {};
        if (apz.isNull(param.res)) apz.data.loadJsonData("BillingDetails", "bill01");
        else {
            apz.data.scrdata.bill01__BillingDetails_Res = param.res.bill01__BillingDetails_Res;
            apz.data.loadData("BillingDetails", "bill01");
        }
    }
    apz.stopLoader();
}
apz.bill01.BillSelection.onClickOk = function() {
    var selectedQuickBookBills = [];
    for (var i = 0; i < apz.data.scrdata.bill01__BillingDetails_Res.QueryResponse.Bill.length; i++) {
        var elem = $("#bill01__BillSelection__ct_tbl_1_selcb_" + i)[0].checked;
        if (elem) {
            var billdetails = {};
            billdetails["DueDate"] = apz.data.scrdata.bill01__BillingDetails_Res.QueryResponse.Bill[i].DueDate;
            billdetails["Currency"] = apz.data.scrdata.bill01__BillingDetails_Res.QueryResponse.Bill[i].CurrencyRef.value;
            billdetails["TotalAmt"] = apz.data.scrdata.bill01__BillingDetails_Res.QueryResponse.Bill[i].TotalAmt;
            billdetails["VendorName"] = apz.data.scrdata.bill01__BillingDetails_Res.QueryResponse.Bill[i].VendorRef.name;
            billdetails["VendorId"] = apz.data.scrdata.bill01__BillingDetails_Res.QueryResponse.Bill[i].VendorRef.value;
            billdetails["BillId"] = apz.data.scrdata.bill01__BillingDetails_Res.QueryResponse.Bill[i].Id;
            selectedQuickBookBills.push(billdetails);
        }
    }
    for (var j = 0; j < selectedQuickBookBills.length; j++) {
        apz.data.scrdata.bill01__BillList_Res.list.push(selectedQuickBookBills[j]);
    }
    apz.data.loadData("BillList", "bill01");
    apz.bill01.BillingDetails.updateCashFlowChart(selectedQuickBookBills);
}