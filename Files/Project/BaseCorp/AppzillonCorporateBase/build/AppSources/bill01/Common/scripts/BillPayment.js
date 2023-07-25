apz.bill01.BillPayment = {};
apz.bill01.rowNo = "";
apz.bill01.IsACH = false;
apz.app.onLoad_BillPayment = function(param) {
    debugger;
    apz.bill01.rowNo = parseInt(param.RowId);
}
apz.app.onShown_BillPayment = function() {
    $(".swiftField").addClass("sno");
    apz.data.loadJsonData("ACHList", "bill01");
    $("#bill01__Header__el_txt_1").text("Payments");
    //From Accounts.
    /* var availableTags = ["10020323100", "10012023124", "15920323100", "10012023920"];
    $("#bill01__PaymentDetails__o__payment__FromAccount").autocomplete({
        source: availableTags
    });*/
    var pamentData = apz.data.scrdata.bill01__BillList_Res.list[apz.bill01.rowNo];
    apz.data.scrdata.bill01__PaymentDetails_Res = {};
    apz.data.scrdata.bill01__PaymentDetails_Res.payment = {};
    apz.data.scrdata.bill01__PaymentDetails_Res.payment = {
        "FromAccount": "",
        "Beneficiary": pamentData.VendorName,
        "VendorName": pamentData.VendorName,
        "VendorID": pamentData.VendorId,
        "BillID": pamentData.BillId,
        "Currency": pamentData.Currency,
        "TotalAmount": pamentData.TotalAmt,
        "DueDate": pamentData.DueDate,
        "RoutingNumber": "111111111",
        "AccountNo": pamentData.AccountNo,
    }
    apz.data.scrdata.bill01__SuccessData_Res = {};
    var test = new Date();
    var lFormatDt = apz.formatDate({
            val: test.getDate() + "/" + (test.getMonth() + 1) + "/" + test.getFullYear(),
            fromFormat: "dd/m/yyyy",
            toFormat: "mm/dd/yyyy"
        });
    apz.data.scrdata.bill01__SuccessData_Res.Summary = {
        "TransactionId": "Txn_" + Math.floor(Math.random() * 900000),
        "TransactionDate": lFormatDt,
        "Currency": pamentData.Currency,
        "TotalAmount": pamentData.TotalAmt
    };
    apz.data.loadData("SuccessData", "bill01");
    apz.bill01.IsACH = (pamentData.Currency == "USD");
    if (apz.bill01.IsACH) {
        $("#bill01__BillPayment__gr_col_31").addClass("sno");
        //$("#bill01__BillPayment__el_txt_4_txtcnt").text("ACH");
        $("#bill01__BillPayment__el_txt_4_txtcnt").text("Swift");
        $("#bill01__PaymentDetails__o__payment__RoutingNumber_ul").removeClass("sno");
    } else {
        $("#bill01__BillPayment__gr_col_31").removeClass("sno");
        $("#bill01__BillPayment__el_txt_4_txtcnt").text("Swift");
        $("#bill01__PaymentDetails__o__payment__RoutingNumber_ul").addClass("sno");
    }
    apz.data.loadData("PaymentDetails", "bill01");
}
apz.bill01.BillPayment.onClickCancel = function() {
    apz.bill01.BillPayment.launchMainScreen(false);
}
apz.bill01.BillPayment.launchMainScreen = function(isSuccess) {
    var param = {};
    param.scr = "BillDetails";
    param.div = "bill01__Header__gr_row_2";
    param.layout = "All";
    param.userObj = {
        "success": isSuccess,
        "RowId": apz.bill01.rowNo
    };
    apz.launchSubScreen(param);
}
apz.bill01.BillPayment.onClickContinue = function() {
    var lModal = {};
    lModal.targetId = "bill01__BillPayment__successModal";
    lModal.usrObj
    apz.toggleModal(lModal);
}
apz.bill01.BillPayment.transferTypeDetails = function(param) {
    var selectedTransferType = $(param).find('input:checked')[0].id;
    if (selectedTransferType == "bill01__BillPayment__el_tgl_1_00") {
        $(".achField").removeClass("sno");
        $(".swiftField").addClass("sno");
        apz.data.loadJsonData("ACHList", "bill01");
    }
    if (selectedTransferType == "bill01__BillPayment__el_tgl_1_11") {
        $(".swiftField").removeClass("sno");
        $(".achField").addClass("sno");
        apz.data.loadJsonData("SwiftList", "bill01");
    }
}
