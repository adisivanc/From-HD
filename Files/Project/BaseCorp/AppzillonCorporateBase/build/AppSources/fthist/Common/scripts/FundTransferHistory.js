apz.fthist.FundTransferHistory = {};
apz.fthist.FundTransferHistory.workflowdata=[];
apz.app.onLoad_FundTransferHistory = function() {
    debugger;
    $(".date input").attr("disabled", true);
    $("#fthist__FundTransferHistory__DetailsTableul_ttl,#fthist__FundTransferHistory__advice_bableul_ttl").addClass("sno");
   apz.fthist.FundTransferHistory.showTxns();
};
apz.fthist.FundTransferHistory.showTxns = function() {
    // var lServerParams = {
    //     "ifaceName": "GetScheduledPayments_Query",
    //     "buildReq": "N",
    //     "req": "",
    //     "paintResp": "N",
    //     "async": "true",
    //     "callBack": apz.fthist.FundTransferHistory.fnGetScheduledPaymentsCB,
    // };
    
     var lServerParams = {
        "ifaceName": "GetTransferHistory_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.fthist.FundTransferHistory.fnGetTransferHistoryCB,
    };
    apz.server.callServer(lServerParams);
};

apz.fthist.FundTransferHistory.fnGetTransferHistoryCB = function(params){
    debugger;
    apz.fthist.FundTransferHistory.workflowdata=[];
    var ldata = params.res.fthist__GetTransferHistory_Res.tbDbtpFundsTransfer;
    for (var i = 0; i < ldata.length; i++) {
        var lobj = {};
        lobj.ref = ldata[i].txnId;
        lobj.initiated_by = ldata[i].initiatedBy;
        lobj.txn_date = ldata[i].txnDate;
        if (ldata[i].transferType == "FTOA") {
            lobj.txn_type = "Own Account Transfer";
        } else if (ldata[i].transferType == "FTDOM" || ldata[i].transferType == "FTDM") {
            lobj.txn_type = "Domestic Transfer";
        } else if (ldata[i].transferType == "FTWB") {
            lobj.txn_type = "Within Bank Transfer";
        } else if (ldata[i].transferType == "FTINT") {
            lobj.txn_type = "International Transfer";
        }
        
        
        
        lobj.acc_no = apz.fthist.FundTransferHistory.fnGetMaskedAcct(ldata[i].fromAccount);
        //lobj.acc_no = ldata[i].fromAccount;
        if (ldata[i].beneficaryName != undefined) {
            lobj.beneficiary = ldata[i].beneficaryName + "-" + apz.fthist.FundTransferHistory.fnGetMaskedAcct(ldata[i].toAccount);
        } else {
            lobj.beneficiary = apz.fthist.FundTransferHistory.fnGetMaskedAcct(ldata[i].toAccount);
        }
        
        lobj.amount = ldata[i].amount;
        lobj.drcr = "Dr";
        apz.fthist.FundTransferHistory.workflowdata.push(lobj);
    }
    
    apz.data.scrdata.fthist__FundTransferHistory_Res = {};
     apz.data.scrdata.fthist__FundTransferHistory_Res = apz.fthist.FundTransferHistory.workflowdata;
    apz.data.loadData("FundTransferHistory", "fthist");
}

apz.fthist.FundTransferHistory.fnGetMaskedAcct = function(Account) {
    var strlen = Account;
    strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
    var laccNo = Account;
    return apz.getMaskedValue(strlen, laccNo);
}

apz.fthist.FundTransferHistory.fnGetScheduledPaymentsCB =function(params){
    debugger;
     var ldata = params.res.fthist__GetScheduledPayments_Res.tbDbmiWorkflowDetail;
    var ldata1 = apz.fthist.FundTransferHistory.removeDuplicateRecords(ldata, 'instanceId');
    for (var i = 0; i < ldata1.length; i++) {
        var scrdata = JSON.parse(ldata1[i].screenData);
        for (var j in scrdata) {
            var nodedata = scrdata[j];
            for (var k in nodedata) {
                var objdata = nodedata[k];
               
                    var lobj = {};
                    lobj.ref = ldata1[i].instanceId;
                    lobj.initiated_by = ldata1[i].actorId;
                    lobj.txn_date = ldata1[i].startTs;
                    if (ldata1[i].workflowId == "FTOA") {
                        lobj.txn_type = "Own Account Transfer";
                    } else if (ldata1[i].workflowId == "FTDOM") {
                        lobj.txn_type = "Domestic Transfer";
                    } else if (ldata1[i].workflowId == "FTWB") {
                        lobj.txn_type = "Within Bank Transfer";
                    } else if (ldata1[i].workflowId == "FTINT") {
                        lobj.txn_type = "International Transfer";
                    }
                    if (objdata.fromaccount) {
                        lobj.acc_no = objdata.fromaccount;
                    } else {
                        lobj.acc_no = objdata.fromAccount;
                    }
                    if (objdata.toaccount) {
                        if (objdata.beneficiaryName != undefined) {
                            lobj.beneficiary = objdata.beneficiaryName + "-" + objdata.toaccount;
                        } else {
                            lobj.beneficiary = objdata.toaccount;
                        }
                    } else {
                        if (objdata.beneficiaryName != undefined) {
                            lobj.beneficiary = objdata.beneficiaryName + "-" + objdata.toAccount;
                        } else {
                            lobj.beneficiary = objdata.toAccount;
                        }
                    }
                    lobj.amount = objdata.amount;
                     lobj.drcr = "Dr";
                      //lobj.currency = "Dr";
                       //lobj.status = "Dr";
                    apz.fthist.FundTransferHistory.workflowdata.push(lobj);
                
            }
        }
    }
    
    
    
     apz.data.scrdata.fthist__FundTransferHistory_Res = {};
     apz.data.scrdata.fthist__FundTransferHistory_Res = apz.fthist.FundTransferHistory.workflowdata;
    apz.data.loadData("FundTransferHistory", "fthist");
}


apz.fthist.FundTransferHistory.removeDuplicateRecords = function(arr, comp) {
    debugger;
    // store the comparison  values in array
    const unique = arr.map(e => e[comp])
    // store the indexes of the unique objects
    .map((e, i, final) => final.indexOf(e) === i && i)
    // eliminate the false indexes & return unique objects
    .filter((e) => arr[e]).map(e => arr[e]);
    return unique;
}




apz.fthist.FundTransferHistory.fnResetFilter = function() {
    $("#fthist__FundTransferHistorys__countDays").attr("disabled", false);
    $(".date input").attr("disabled", true);
    apz.setElmValue("fthist__FundTransferHistory__countDays", "7");
    apz.setElmValue("fthist__FundTransferHistory__fromDate", "");
    apz.setElmValue("fthist__FundTransferHistory__toDate", "");
    apz.fthist.FundTransferHistory.showTxns();
};
apz.fthist.FundTransferHistory.fnPeriodType = function() {
    debugger;
    var lType = apz.getElmValue("fthist__FundTransferHistory__countDays");
    if (lType == 'Between') {
        // $("#fthist__FundTransferHistory__countDays").attr("disabled", true);
        $(".date input").attr("disabled", false);
    } else {
        // $("#fthist__FundTransferHistory__countDays").attr("disabled", false);
        $(".date input").attr("disabled", true);
        $("#fthist__FundTransferHistory__fromDate").val("");
        $("#fthist__FundTransferHistory__toDate").val("");
    }
};
apz.fthist.FundTransferHistory.showAdvice = function() {
    apz.toggleModal({
        targetId: "fthist__FundTransferHistory__advice_modal"
    });
    setTimeout(function(){apz.data.loadJsonData("Advice", "fthist")},300);
};
apz.fthist.FundTransferHistory.showAdviceDoc = function(pObj) {
    var rowNo = $(pObj).attr("rowno");
    var myBase64string = apz.data.scrdata.fthist__ImportLCDetails_Res.Advice[rowNo].advicedoc;
    var objbuilder = '';
    objbuilder += ('<object width="100%" height="100%" data="data:application/pdf;base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="application/pdf" class="internal">');
    objbuilder += ('<embed src="data:application/pdf;base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="application/pdf"  />');
    objbuilder += ('</object>');
    var win = window.open("#", "_blank");
    var title = "Advice document";
    win.document.write('<html><title>' + title + '</title><body style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px;">');
    win.document.write(objbuilder);
    win.document.write('</body></html>');
    var layer = jQuery(win.document);
};


apz.fthist.FundTransferHistory.exportPDF = function() {
    var columns = [{
        title: "Ref No.",
        dataKey: "ref"
    }, {
        title: "Transaction Date",
        dataKey: "txn_date"
    }, {
        title: "Transaction Type",
        dataKey: "txn_type"
    }, {
        title: "Account No.",
        dataKey: "acc_no"
    }, {
        title: "Beneficiary",
        dataKey: "beneficiary"
    }, {
        title: "Dr/Cr",
        dataKey: "drcr"
    }, {
        title: "TransactionAmount",
        dataKey: "amount"
    }, {
        title: "Initiated by",
        dataKey: "initiated_by"
    }];
    // var lrow = $(".acc-active").attr("rowno");
    var rows = apz.data.scrdata.fthist__FundTransferHistory_Res;
    var doc = new jsPDF('landscape');
   
   
    doc.autoTable(columns, rows, {
        startY: 60
    });
    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    if(isMobile){
        
        var e = Base64.encode(doc.output());
         //var e = btoa(doc.output());
         var json = {};
        json.id = "BASE64TOFILE";
        json.callBack = apz.fthist.FundTransferHistory.exportPDFcallBack;
        json.base64 = e;
        json.fileName = "FundsTransferHistory.pdf";
        json.filePath = "docs";
        apz.ns.base64ToFile(json);
    }
    
    else{
    doc.save('Funds Transfer History.pdf');
    }
};

apz.fthist.FundTransferHistory.exportPDFcallBack = function(json) {
    if (json.status) {
        var json = {
            "filePath": json.filePath
        };
        json.id = "OPENFILE_ID";
        json.callBack = apz.fthist.FundTransferHistory.openFileCallback;
        apz.ns.openFile(json);
    } else {
        alert(json.errorCode);
    }
}

apz.fthist.FundTransferHistory.openFileCallback = function(params) {
    debugger;
};


apz.fthist.FundTransferHistory.exportExcel = function() {
    
    var CsvString = "";
    CsvString += "Ref No.,Transaction Date,Transaction Type,Account No.,Beneficiary,Dr/Cr,TransactionAmount,Initiated by" + "\r\n";
    var lrows = apz.data.scrdata.fthist__FundTransferHistory_Res;
    lrows.forEach(function(RowItem, RowIndex) {
        var row = RowItem.ref + "," + RowItem.txn_date + "," + RowItem.txn_type + "," + RowItem.acc_no + "," + RowItem.beneficiary + "," + RowItem.drcr +"," + RowItem.amount +","+ RowItem.initiated_by;
        CsvString += row + "\r\n";
    });
    
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(CsvString));
    excel_file.setAttribute('download', 'FundsTransferHistory.xls');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
}
apz.fthist.FundTransferHistory.exportCSV = function() {
    debugger;
    var lrows = apz.data.scrdata.fthist__FundTransferHistory_Res;
    
    var csvContent = "";
    csvContent += "Ref No.,Transaction Date,Transaction Type,Account No.,Beneficiary,Dr/Cr,TransactionAmount,Initiated by" + "\r\n";
    lrows.forEach(function(rowArray) {
        debugger;
        var row = rowArray.ref + "," + rowArray.txn_date + "," + rowArray.txn_type + "," + rowArray.acc_no + "," + rowArray.beneficiary + "," + rowArray.drcr + "," + rowArray.amount+","+rowArray.initiated_by;
        csvContent += row + "\r\n";
    });
    var encodedUri = encodeURI(csvContent);
    //window.open(encodedUri);
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent));
    excel_file.setAttribute('download', 'FundsTransferHistory.csv');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
}
