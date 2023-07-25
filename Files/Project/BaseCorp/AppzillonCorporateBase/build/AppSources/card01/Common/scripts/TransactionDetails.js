apz.card01.transactionDetails = {};
apz.card01.transactionDetails.sAction = "";
apz.app.onLoad_TransactionDetails = function(userObj) {
    debugger;
    apz.card01.transactionDetails.sAccountNo = userObj.data.accountNo;
    var params = {
        "action": "Transaction Details"
    };
    apz.card01.transactionDetails.fnRender(params);
};
apz.card01.transactionDetails.fnRender = function(params) {
    apz.card01.transactionDetails.fnRenderActionButtons(params);
};
apz.card01.transactionDetails.fnRenderActionButtons = function(params) {
    if (params.action == "Transaction Details") {
        apz.setElmValue("card01__TransactionDetails__StatementType", "Current");
        $("#card01__TransactionDetails__TxnTable_col_0_sort").addClass("sno");
        $("#card01__Cards__BreadcrumbBtn3").parent().removeClass("sno");
        $(".active").removeClass("active");
        $("#card01__Cards__BreadcrumbBtn3").parent().addClass("active");
        $("#card01__Cards__BreadcrumbBtn3").text("Card Statement");
        apz.card01.cards.fnAdjustHeight();
    }
};
apz.card01.transactionDetails.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.card01.transactionDetails.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.card01.transactionDetails.callServerCB = function(params) {
    debugger;
    if (apz.card01.transactionDetails.sAction == "Transaction Details") {
        apz.card01.transactionDetails.fnTransactionDetailsCB(params);
    }
};
apz.card01.transactionDetails.fnTransactionDetailsCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.card01__FetchTxnDetails_Res.TxnStatus) {
            apz.card01.transactionDetails.fnRenderLineChartCB(params);
            apz.card01.transactionDetails.fnRenderStackedChartCB(params);
            if (params.res.card01__FetchTxnDetails_Res.txtDetails.length > 5) {
                $("#card01__TransactionDetails__TxnTable_pagination_ul").removeClass("sno");
            } else {
                $("#card01__TransactionDetails__TxnTable_pagination_ul").addClass("sno");
            }
            
            apz.data.scrdata.card01__FetchAccountDetails_Res = {};
            //apz.data.scrdata.card01__FetchAccountDetails_Res.cardSummary = [];
            apz.data.scrdata.card01__FetchTxnDetails_Res.txtDetails = params.res.card01__FetchTxnDetails_Res.txtDetails;
            
            apz.data.scrdata.card01__FetchTxnDetails_Res.cardDetails = params.res.card01__FetchTxnDetails_Res.cardDetails;
            
            var strlen1 = params.res.card01__FetchTxnDetails_Res.cardDetails.cardAccountNo;
                strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(
                    /[0-9]/g, '9');
                var laccNo1 = params.res.card01__FetchTxnDetails_Res.cardDetails.cardAccountNo;
                var result1 = apz.getMaskedValue(strlen1, laccNo1);
                apz.data.scrdata.card01__FetchTxnDetails_Res.cardDetails.maskAccNo = result1;
                
                var strlen = params.res.card01__FetchTxnDetails_Res.cardDetails.masterAccountNo;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = params.res.card01__FetchTxnDetails_Res.cardDetails.masterAccountNo;
                var result = apz.getMaskedValue(strlen, laccNo);
                apz.data.scrdata.card01__FetchTxnDetails_Res.cardDetails.maskMasterAccNo = result;
               apz.data.loadData("FetchTxnDetails", "card01");
            
        } else {
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
            $("#card01__TransactionDetails__TxnTable_pagination_ul").addClass("sno");
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
        $("#card01__TransactionDetails__TxnTable_pagination_ul").addClass("sno");
    }
};
apz.card01.transactionDetails.fnOnChangeType = function() {
    debugger;
    apz.card01.transactionDetails.sAction = "Transaction Details";
    var lType = apz.getElmValue("card01__TransactionDetails__StatementType");
    var req = {
        "cardDetails": {
            "accountNo": apz.card01.transactionDetails.sAccountNo
        },
        "txtDetails": {
            "accountNo": apz.card01.transactionDetails.sAccountNo,
            "statementType": lType
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_card_txn_details";
    var lParams = {
        "ifaceName": "FetchTxnDetails",
        "paintResp": "N",
        "appId": "card01",
        "buildReq": "N",
        "lReq": req
    };
    apz.card01.transactionDetails.fnBeforCallServer(lParams);
};
apz.card01.transactionDetails.fnRenderLineChartCB = function(params) {
    apz.data.scrdata.card01__LineChart_Res = {};
    apz.data.scrdata.card01__LineChart_Res.txtDetails = [];
    apz.data.scrdata.card01__LineChart_Res.txtDetails = params.res.card01__FetchTxnDetails_Res.txtDetails;
    apz.data.loadData("LineChart", "card01");
};
apz.card01.transactionDetails.fnRenderStackedChartCB = function(params) {
    debugger;
    apz.data.scrdata.card01__StackedColumn2D_Res = {};
    apz.data.scrdata.card01__StackedColumn2D_Res.data = [];
    for (var i = 0; i < 4; i++) {
        apz.data.scrdata.card01__StackedColumn2D_Res.data[i] = {};
        if (i < 2) {
            apz.data.scrdata.card01__StackedColumn2D_Res.data[i].label = "Credit Limit";
            if (i === 0) {
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].value = params.res.card01__FetchTxnDetails_Res.cardDetails.availableCreditLimit;
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].type = "Available";
            } else {
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].value = parseInt(params.res.card01__FetchTxnDetails_Res.cardDetails.creditLimit) -
                    parseInt(params.res.card01__FetchTxnDetails_Res.cardDetails.availableCreditLimit);
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].type = "Not Available";
            }
        } else {
            apz.data.scrdata.card01__StackedColumn2D_Res.data[i].label = "Cash Limit";
            if (i == 2) {
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].value = params.res.card01__FetchTxnDetails_Res.cardDetails.availableCashLimit;
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].type = "Available";
            } else {
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].value = parseInt(params.res.card01__FetchTxnDetails_Res.cardDetails.cashLimit) -
                    parseInt(params.res.card01__FetchTxnDetails_Res.cardDetails.availableCashLimit);
                apz.data.scrdata.card01__StackedColumn2D_Res.data[i].type = "Not Available";
            }
        }
    }
    debugger;
    apz.data.loadData("StackedColumn2D", "card01");
};
apz.card01.transactionDetails.exportPDF = function() {
    var columns = [{
        title: "Ref No.",
        dataKey: "txnRef"
    }, {
        title: "Transaction Date",
        dataKey: "txnDate"
    }, {
        title: "Description",
        dataKey: "desc"
    }, {
        title: "Transaction Amount",
        dataKey: "amount"
    }];
    var rows = apz.data.scrdata.card01__FetchTxnDetails_Res.txtDetails;
    var doc = new jsPDF('landscape');
    doc.text("Card Number", 20, 30);
    doc.text(apz.data.scrdata.card01__FetchTxnDetails_Res.cardDetails.cardAccountNo, 70, 30);
    doc.text("Card Holder Name", 20, 40);
    doc.text(apz.data.scrdata.card01__FetchTxnDetails_Res.cardDetails.cardHolderName, 70, 40);
    doc.text("Statement Date", 20, 50);
    doc.text((new Date()).toLocaleDateString(), 70, 50);
    doc.autoTable(columns, rows, {
        startY: 60
    });
    doc.save('Card Transaction Summary.pdf');
};
apz.card01.transactionDetails.exportExcel = function() {
    var CsvString = "";
    CsvString += "Ref No.,Transaction Date,Description,Transaction Amount" + "\r\n";
    var lrows = apz.data.scrdata.card01__FetchTxnDetails_Res.txtDetails;
    lrows.forEach(function(RowItem, RowIndex) {
        var row = RowItem.txnRef + "," + RowItem.txnDate + "," + RowItem.desc + "," + RowItem.amount;
        CsvString += row + "\r\n";
    });
    // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(CsvString));
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(CsvString));
    excel_file.setAttribute('download', 'Card Transaction Summary.xls');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
}
apz.card01.transactionDetails.exportCSV = function() {
    debugger;
    var lrows = apz.data.scrdata.card01__FetchTxnDetails_Res.txtDetails;
    // var csvContent = "data:text/csv;charset=utf-8,";
    var csvContent = "";
    csvContent += "Ref No.,Transaction Date,Description,Transaction Amount" + "\r\n";
    lrows.forEach(function(rowArray) {
        debugger;
        var row = rowArray.txnRef + "," + rowArray.txnDate + "," + rowArray.desc + "," + rowArray.amount;
        csvContent += row + "\r\n";
    });
    var encodedUri = encodeURI(csvContent);
    //window.open(encodedUri);
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent));
    excel_file.setAttribute('download', 'Card Transaction Summary.csv');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
}

