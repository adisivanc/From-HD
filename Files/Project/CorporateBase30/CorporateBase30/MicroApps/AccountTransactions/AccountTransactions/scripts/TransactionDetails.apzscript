//apz.acta01 = {};
apz.acta01.transactionDetails = {};
apz.acta01.transactionDetails.sAction = "";
apz.app.onLoad_TransactionDetails = function(userObj) {
    debugger;
    apz.acta01.transactionDetails.sCorporateID = apz.Login.sCorporateId;
    apz.acta01.transactionDetails.sRoleID = apz.Login.sRoleId;
    apz.acta01.transactionDetails.sAccNo = userObj.data.accountNo;
    var params = {
        "action": "account"
    };
    apz.acta01.transactionDetails.fnRender(params);
};
apz.acta01.transactionDetails.fnRender = function(params) {
    apz.acta01.transactionDetails.fnRenderData(params);
    apz.acta01.transactionDetails.fnRenderActionButtons(params);
};
apz.acta01.transactionDetails.fnRenderActionButtons = function(params) {
    if (params.action == "account") {
        $("#acta01__TransactionDetails__TransactionDetailsList").css("cursor", "pointer");
        $("#acta01__TransactionDetails__DetailsTable_pagination_ul").addClass("sno");
        $("#acta01__TransactionLauncher__Transaction_header").addClass("sno");
    }
};
apz.acta01.transactionDetails.fnRenderData = function(params) {
    debugger;
    if (params.action == "account") {
        apz.acta01.transactionDetails.sAction = "account";
        var llaunch = {};
        llaunch.appId = "acclt";
        llaunch.scr = "AccountDetails";
        llaunch.div = "acta01__TransactionDetails__TransactionDetailsLaunch";
        llaunch.layout = "All";
        llaunch.userObj = {};
        llaunch.userObj.action = "";
        llaunch.userObj.control = {};
        llaunch.userObj.control.destroyDiv = "acta01__TransactionDetails__TransactionDetailsLaunch";
        llaunch.userObj.control.callBack = apz.acta01.transactionDetails.fnRoleAccountDetailsCB;
        llaunch.userObj.data = {
            "accountNo": apz.acta01.transactionDetails.sAccNo
        };
        apz.launchApp(llaunch);
    }
};
apz.acta01.transactionDetails.fnRoleAccountDetailsCB = function(params) {
    debugger;
    if (params.status) {
        apz.resetCurrAppId("acta01");
        apz.data.scrdata.acta01__FetchAccountDetails_Res = {};
        apz.data.scrdata.acta01__FetchAccountDetails_Res.accountDetails = {};
        apz.data.scrdata.acta01__FetchAccountDetails_Res.accountDetails = params.data;
        
        
        apz.data.loadData("FetchAccountDetails", "acta01");
        
        var strlen = apz.getElmValue("acta01__FetchAccountDetails__o__accountDetails__accountNo");
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.getElmValue("acta01__FetchAccountDetails__o__accountDetails__accountNo");
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.setElmValue("acta01__FetchAccountDetails__o__accountDetails__accountNo", result);
    }
    apz.data.clearMRMV("acta01__TransactionDetails__DetailsTable");
    apz.acta01.transactionDetails.fnResetFilter();
};
apz.acta01.transactionDetails.fnResetFilter = function() {
    $("#acta01__TransactionDetails__countDays").attr("disabled", false);
    $(".date input").attr("disabled", true);
    apz.setElmValue("acta01__TransactionDetails__countDays", "7");
    apz.setElmValue("acta01__TransactionDetails__fromDate", "");
    apz.setElmValue("acta01__TransactionDetails__toDate", "");
    apz.acta01.transactionDetails.fnSearch();
};
apz.acta01.transactionDetails.fnRefreshFilter = function() {
    apz.data.clearMRMV("acta01__TransactionDetails__DetailsTable");
    apz.acta01.transactionDetails.fnResetFilter();
};
apz.acta01.transactionDetails.fnSearch = function() {
    debugger;
    apz.acta01.transactionDetails.sAction = "details";
    var lStartDate, lEndDate, lStatus = true;
    var lType = apz.getElmValue("acta01__TransactionDetails__countDays");
    if (lType !== 'Between') {
        var lPeriod = parseInt(apz.getElmValue("acta01__TransactionDetails__countDays"));
        var start = new Date();
        start.setDate(start.getDate() - lPeriod);
        var sDate = start.getDate();
        var sMonth = (start.getMonth() + 1);
        var sYear = start.getFullYear();
        lStartDate = sYear + "-" + sMonth + "-" + sDate;
        var end = new Date();
        var eDate = end.getDate();
        var eMonth = (end.getMonth() + 1);
        var eYear = end.getFullYear();
        lEndDate = eYear + "-" + eMonth + "-" + eDate;
    } else {
        var fromDate = apz.getElmValue("acta01__TransactionDetails__fromDate");
        var endDate = apz.getElmValue("acta01__TransactionDetails__toDate");
        if (apz.isNull(fromDate) || apz.isNull(endDate)) {
            lStatus = false;
            var lRes = {};
            lRes.message = "Please select the date fields"
            apz.dispMsg(lRes);
        }
        if (lStatus) {
            lStartDate = apz.acta01.transactionDetails.fnFormatDate(fromDate);
            lEndDate = apz.acta01.transactionDetails.fnFormatDate(endDate);
            if (lEndDate < lStartDate) {
                lStatus = false;
                var lRes = {};
                lRes.message = "From date can't be greater than end date"
                apz.dispMsg(lRes);
            }
        }
    }
    if (lStatus) {
        var req = {};
        req.transactionDetails = {
            "accountno": apz.acta01.transactionDetails.sAccNo,
            "queryType": "Details",
            "startDate": lStartDate,
            "endDate": lEndDate,
        };
        req.action = "Query";
        req.table = "tb_dbmi_corp_account_transactions";
        var lParams = {
            "ifaceName": "TransactionDetails",
            "paintResp": "Y",
            "appId": "acta01",
            "buildReq": "N",
            "lReq": req
        };
        apz.acta01.transactionDetails.fnBeforCallServer(lParams);
    }
};
apz.acta01.transactionDetails.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acta01.transactionDetails.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acta01.transactionDetails.callServerCB = function(params) {
    debugger;
    if (apz.acta01.transactionDetails.sAction == "details") {
        apz.acta01.transactionDetails.fnFetchTransactionDetailsCB(params);
    }
};
apz.acta01.transactionDetails.fnFetchTransactionDetailsCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acta01__TransactionDetails_Res.Status) {
            apz.acta01.transactionDetails.fnRenderIndicator();
            if (params.res.acta01__TransactionDetails_Res.accountTransactionDetails.length > 5) {
                $("#acta01__TransactionDetails__DetailsTable_pagination_ul").removeClass("sno");
            } else {
                $("#acta01__TransactionDetails__DetailsTable_pagination_ul").addClass("sno");
            }
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
apz.acta01.transactionDetails.fnRenderIndicator = function() {
    debugger;
    for (var i = 0; i < apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails.length; i++) {
        if (!apz.isNull(apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[i].indicator)) {
            apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[i].indicator = apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[
                i].indicator + ".png";
        }
        if (!apz.isNull(apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[i].txnDate)) {
            apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[i].txnDate = apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[
                i].txnDate.split(" ")[0];
        }
        if (!apz.isNull(apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[i].valDate)) {
            apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[i].valDate = apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails[
                i].valDate.split(" ")[0];
        }
    }
    apz.data.loadData("TransactionDetails", "acta01");
    apz.acta01.transactionDetails.advancedSearch();
};
apz.acta01.transactionDetails.advancedSearch = function(){
    var txnType = apz.getElmValue("acta01__TransactionDetails__txn_type");
    if(txnType!=""){
        apz.searchRecords("acta01__TransactionDetails__DetailsTable",txnType);
    }
    
};
apz.acta01.transactionDetails.fnFormatDate = function(lVal) {
    var params = {};
    params.fromFormat = "dd-MMM-yyyy";
    params.toFormat = "yyyy-MM-dd";
    params.val = lVal;
    var value = apz.formatDate(params);
    return value;
};
apz.acta01.transactionDetails.fnCancel = function() {
    debugger;
    //$("#acta01__TransactionLauncher__Transaction_master").removeClass("sno");
    //$("#acta01__TransactionLauncher__Transaction_header").removeClass("sno");
    //$("#acta01__TransactionLauncher__Transaction_launch").html("");
    $("#accdtl__AccountSummary__AccountDetailsMaster").removeClass("sno");
    $("#accdtl__AccountSummary__account_header").removeClass("sno");
    $("#accdtl__AccountSummary__AccountLaunch").html("");
};
apz.acta01.transactionDetails.fnPeriodType = function() {
    debugger;
    var lType = apz.getElmValue("acta01__TransactionDetails__countDays");
    if (lType == 'Between') {
        // $("#acta01__TransactionDetails__countDays").attr("disabled", true);
        $(".date input").attr("disabled", false);
    } else {
        // $("#acta01__TransactionDetails__countDays").attr("disabled", false);
        $(".date input").attr("disabled", true);
        $("#acta01__TransactionDetails__fromDate").val("");
        $("#acta01__TransactionDetails__toDate").val("");
    }
};
apz.acta01.transactionDetails.exportPDF = function() {
    var columns = [{
        title: "Ref No.",
        dataKey: "txnRefNo"
    }, {
        title: "Transaction Date",
        dataKey: "txnDate"
    }, {
        title: "Value Date",
        dataKey: "valDate"
    }, {
        title: "Description",
        dataKey: "description"
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
    var rows = apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails;
    var doc = new jsPDF('landscape');
    doc.text("Account Number", 20, 30);
    doc.text(apz.getElmValue("acta01__FetchAccountDetails__o__accountDetails__accountNo"), 70, 30);
    doc.text("Available Balance", 20, 40);
    doc.text(apz.getElmValue("acta01__FetchAccountDetails__o__accountDetails__availableBalance"), 70, 40);
    doc.autoTable(columns, rows, {
        startY: 60
    });
    doc.save('Transaction Summary.pdf');
};
apz.acta01.transactionDetails.exportCSV = function() {
    var CsvString = "";
    CsvString += "Ref No.,Transaction Date,Value Date,Description,Transaction Amount,Currency,Running Balance" + "\r\n";
    var lrows = apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails;
    lrows.forEach(function(RowItem, RowIndex) {
        var row = RowItem.txnRefNo + "," + RowItem.txnDate + "," + RowItem.valDate + "," + RowItem.description + "," + RowItem.amount + "," +
            RowItem.txnCurrency + "," + RowItem.balance;
        CsvString += row + "\r\n";
    });
    // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(CsvString));
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(CsvString));
    excel_file.setAttribute('download', 'Transaction Summary.csv');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
};
apz.acta01.transactionDetails.exportExcel = function() {
    debugger;
    /*var lrows = apz.data.scrdata.acta01__TransactionDetails_Res.accountTransactionDetails;
    // var csvContent = "data:text/csv;charset=utf-8,";
    var csvContent = "";
    csvContent += "Ref No.,Transaction Date,Value Date,Description,Transaction Amount,Currency,Running Balance" + "\r\n";
    lrows.forEach(function(rowArray) {
        debugger;
        var row = rowArray.txnRefNo + "," + rowArray.txnDate + "," + rowArray.valDate + "," + rowArray.description + "," + rowArray.amount + "," +
            rowArray.txnCurrency + "," + rowArray.balance;
        csvContent += row + "\r\n";
    });
    var encodedUri = encodeURI(csvContent);
    //window.open(encodedUri);
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(csvContent));
    excel_file.setAttribute('download', 'Transaction Summary.xls');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);*/
    var table = document.getElementById("acta01__TransactionDetails__DetailsTable_table");
    var html = table.outerHTML;
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
};
apz.acta01.transactionDetails.sendMail = function() {
    apz.dispMsg({
        "type": "I",
        "message": "The account statement has been mailed to your registered e-mail address"
    });
};
