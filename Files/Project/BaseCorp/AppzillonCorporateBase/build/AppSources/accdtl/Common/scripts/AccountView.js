apz.accdtl.accountView = {};
apz.accdtl.accountView.sAction = "";
apz.app.onLoad_AccountView = function(userObj) {
    apz.accdtl.accountView.sAccNo = userObj.data.accountNo;
    var params = {
        "action": "account"
    };
    apz.accdtl.accountView.fnRender(params);
};
apz.app.onShown_AccountView = function() {
    $(".adr-ctr").addClass("sno");
};
apz.accdtl.accountView.fnRender = function(params) {
    apz.accdtl.accountView.getPersonaDashboard();
    apz.accdtl.accountView.fnRenderData(params);
    apz.accdtl.accountView.fnRenderActionButtons(params);
};
apz.accdtl.accountView.fnRenderActionButtons = function(params) {
    if (params.action == "account") {
        $("#accdtl__AccountSummary__account_header").addClass("sno");
        $("#accdtl__AccountSummary__new_account_header").addClass("sno");
    }
};
apz.accdtl.accountView.fnRenderData = function(params) {
    debugger;
    if (params.action == "account") {
        apz.accdtl.accountView.sAction = "account";
        var llaunch = {};
        llaunch.appId = "acclt";
        llaunch.scr = "AccountDetails";
        llaunch.div = "accdtl__AccountView__AccountViewHolder";
        llaunch.layout = "All";
        llaunch.userObj = {};
        llaunch.userObj.action = "";
        llaunch.userObj.control = {};
        llaunch.userObj.control.destroyDiv = "accdtl__AccountView__AccountViewHolder";
        llaunch.userObj.control.callBack = apz.accdtl.accountView.fnRoleAccountDetailsCB;
        llaunch.userObj.data = {
            "accountNo": apz.accdtl.accountView.sAccNo
        };
        apz.launchApp(llaunch);
    }
};
apz.accdtl.accountView.fnRoleAccountDetailsCB = function(params) {
    debugger;
    if (params.status) {
        apz.resetCurrAppId("accdtl");
        apz.data.scrdata.accdtl__FetchAccountDetails_Res = {};
        apz.data.scrdata.accdtl__FetchAccountDetails_Res.accountDetails = {};
        apz.data.scrdata.accdtl__FetchAccountDetails_Res.accountDetails = params.data;
        apz.data.loadData("FetchAccountDetails", "accdtl");
        
        var strlen = apz.getElmValue("accdtl__FetchAccountDetails__o__accountDetails__accountNo");
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.getElmValue("accdtl__FetchAccountDetails__o__accountDetails__accountNo");
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.setElmValue("accdtl__FetchAccountDetails__o__accountDetails__accountNo", result);
        apz.accdtl.accountView.fnFetchTransactionSummary(params.data.accountNo);
    }
};
apz.accdtl.accountView.fnFetchTransactionSummary = function(lAccNo) {
    var req = {};
    req.transactionDetails = {
        "accountno": lAccNo,
        "queryType": "Summary"
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_account_transactions";
    var lReq = {
        "ifaceName": "TransactionDetails",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "accdtl",
        "async": false,
        "callBack": apz.accdtl.accountView.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.accdtl.accountView.callServerCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.accdtl__TransactionDetails_Res.Status) {
            apz.accdtl.accountView.fnRenderIndicator();
        } else {
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.accdtl.accountView.fnRenderIndicator = function() {
    debugger;
    for (var i = 0; i < apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary.length; i++) {
        if (!apz.isNull(apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[i].indicator)) {
            apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[i].indicator = apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[
                i].indicator + ".png";
        }
        if (!apz.isNull(apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[i].txnDate)) {
            apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[i].txnDate = apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[
                i].txnDate.split(" ")[0];
        }
        if (!apz.isNull(apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[i].valDate)) {
            apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[i].valDate = apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary[
                i].valDate.split(" ")[0];
        }
    }
    apz.data.loadData("TransactionDetails", "accdtl");
};
apz.accdtl.accountView.fnCancel = function() {
    $("#accdtl__AccountSummary__AccountDetailsMaster").removeClass("sno");
    $("#accdtl__AccountSummary__account_header").removeClass("sno");
     $("#accdtl__AccountSummary__new_account_header").removeClass("sno");
    $("#accdtl__AccountSummary__AccountLaunch").html("");
};
apz.accdtl.accountView.exportPDF = function() {
    var columns = [{
        title: "Ref No.",
        dataKey: "RefNo"
    }, {
        title: "Transaction Date",
        dataKey: "txnDate"
    }, {
        title: "Value Date",
        dataKey: "valDate"
    }, {
        title: "Description",
        dataKey: "desc"
    }, {
        title: "Transaction Amount",
        dataKey: "amount"
    }, {
        title: "Currency",
        dataKey: "txnCurrency"
    }, {
        title: "Running Balance",
        dataKey: "balance"
    }];
    // var lrow = $(".acc-active").attr("rowno");
    var rows = apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary;
    var doc = new jsPDF('landscape');
    //doc.text(apz.getElmValue("AccTransactionName"), 20, 20);
    doc.text("Account Number", 20, 30);
    doc.text(apz.getElmValue("accdtl__FetchAccountDetails__o__accountDetails__accountNo"), 70, 30);
    doc.text("Available Balance", 20, 40);
    doc.text(apz.getElmValue("accdtl__FetchAccountDetails__o__accountDetails__availableBalance"), 70, 40);
    doc.autoTable(columns, rows, {
        startY: 60
    });
    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    if(isMobile){
        
        var e = Base64.encode(doc.output());
         //var e = btoa(doc.output());
         var json = {};
        json.id = "BASE64TOFILE";
        json.callBack = apz.accdtl.accountView.exportPDFcallBack;
        json.base64 = e;
        json.fileName = "AccountTransaction.pdf";
        json.filePath = "docs";
        apz.ns.base64ToFile(json);
    }
    
    else{
    doc.save('Account Transactions.pdf');
    }
};

apz.accdtl.accountView.exportPDFcallBack = function(json)
{
     if (json.status) {
        var json = {
            "filePath": json.filePath
        };
        json.id = "OPENFILE_ID";
        json.callBack = apz.accdtl.accountView.openFileCallback;
        apz.ns.openFile(json);
    } else {
        alert(json.errorCode);
    }
}

apz.accdtl.accountView.openFileCallback = function(params) {
    debugger;
};
apz.accdtl.accountView.exportExcel = function() {
    //var xls = new XlsExport(apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary, "Account Transactions");
    // xls.exportToXLS('export.xls');
    var CsvString = "";
    CsvString += "Ref No.,Transaction Date,Value Date,Description,Transaction Amount,Currency,Running Balance" + "\r\n";
    var lrows = apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary;
    lrows.forEach(function(RowItem, RowIndex) {
        var row = RowItem.refNo + "," + RowItem.txnDate + "," + RowItem.valDate + "," + RowItem.desc + "," + RowItem.amount + "," + RowItem.txnCurrency +
            "," + RowItem.balance;
        CsvString += row + "\r\n";
    });
    // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(CsvString));
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(CsvString));
    excel_file.setAttribute('download', 'Account Transactions.xls');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
}
apz.accdtl.accountView.exportCSV = function() {
    debugger;
    var lrows = apz.data.scrdata.accdtl__TransactionDetails_Res.accountTransactionSummary;
    // var csvContent = "data:text/csv;charset=utf-8,";
    var csvContent = "";
    csvContent += "Ref No.,Transaction Date,Value Date,Description,Transaction Amount,Currency,Running Balance" + "\r\n";
    lrows.forEach(function(rowArray) {
        debugger;
        var row = rowArray.refNo + "," + rowArray.txnDate + "," + rowArray.valDate + "," + rowArray.desc + "," + rowArray.amount + "," + rowArray
            .txnCurrency + "," + rowArray.balance;
        csvContent += row + "\r\n";
    });
    var encodedUri = encodeURI(csvContent);
    //window.open(encodedUri);
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent));
    excel_file.setAttribute('download', 'Account Transactions.csv');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
}
apz.accdtl.accountView.getPersonaDashboard = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "GetPersonaDashboard",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.accdtl.accountView.getPersonaDashboardCB
    };
    var req = {};
    req.userId = apz.Login.sUserId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.accdtl.accountView.getPersonaDashboardCB = function(pResp) {
    debugger;
    try {
        if (!pResp.errors) {
            var lDesign = pResp.res.accdtl__GetPersonaDashboard_Res[0].design;
            if (lDesign == "D1") {
                $(".D1").addClass("sno");
            }
        }
    } catch (e) {
        apz.dashboard.getCorpDashboard(pResp.callBackObj.dashboardId);
    }
};
apz.accdtl.accountView.fnOpenModal = function() {
    var params = {
        "targetId": "accdtl__AccountView__acctModal",
    }
    apz.toggleModal(params);
}
