apz.recrep.ReportSummaryDetails = {};
apz.app.onLoad_ReportSummaryDetails = function(params){
    apz.recrep.ReportSummaryDetails.sCache = params;
    apz.recrep.ReportSummaryDetails.fnRenderData();
}

apz.recrep.ReportSummaryDetails.fnRenderData = function(){
    debugger;
    apz.data.loadJsonData("ReportsDetails","recrep");
};
apz.recrep.ReportSummaryDetails.fnDownloadExcel= function(){
    debugger;
      var CsvString = "";
    CsvString += "Sequence Number,Unique ID,Status,Remarks" + "\r\n";
    var lrows = apz.data.scrdata.recrep__ReconciliationReportDetails_Res.ReportSummaryDetails;
    lrows.forEach(function(RowItem, RowIndex) {
        var row = RowItem.sequenceNumber + "," + RowItem.uniqueId + "," + RowItem.status + "," + RowItem.remarks;
        CsvString += row + "\r\n";
    });
    // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(CsvString));
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(CsvString));
    excel_file.setAttribute('download', 'Reconciliation Report Details.xls');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
};

apz.recrep.ReportSummaryDetails.fnDownloadCSV = function(){
    debugger;
   var lrows = apz.data.scrdata.recrep__ReconciliationReportDetails_Res.ReportSummaryDetails;
    // var csvContent = "data:text/csv;charset=utf-8,";
    var csvContent = "";
    csvContent += "Sequence Number,Unique ID,Status,Remarks" + "\r\n";
    lrows.forEach(function(RowItem) {
        debugger;
        var row =RowItem.sequenceNumber + "," + RowItem.uniqueId + "," + RowItem.status + "," + RowItem.remarks;
        csvContent += row + "\r\n";
    });
    var encodedUri = encodeURI(csvContent);
    //window.open(encodedUri);
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent));
    excel_file.setAttribute('download', 'Reconciliation Report Details.csv');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file); 
}

apz.recrep.ReportSummaryDetails.fnReportSummary=function(){
   apz.recrep.ReportSummaryDetails.sCache.callback();
};

apz.recrep.ReportSummary.exportPDF = function() {
    debugger;
    var columns = [{
        title: "Sequence Number",
        dataKey: "sequenceNumber"
    }, {
        title: "Unique ID",
        dataKey: "uniqueId"
    }, {
        title: "Status",
        dataKey: "status"
    }, {
        title: "Remarks",
        dataKey: "remarks"
    }];
    var rows = apz.data.scrdata.recrep__ReconciliationReportDetails_Res.ReportSummaryDetails;
    var doc = new jsPDF('landscape');
    doc.text("Reconciliation Reports", 20, 30);
    // doc.text(apz.getElmValue("acta01_/_FetchAccountDetails__o__accountDetails__accountNo"), 70, 30);
    // doc.text("Available Balance", 20, 40);
    // doc.text(apz.getElmValue("acta01__FetchAccountDetails__o__accountDetails__availableBalance"), 70, 40);
    doc.autoTable(columns, rows, {
        startY: 40
    });
    doc.save('Report Details Summary.pdf');
};