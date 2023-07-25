apz.recrep.ReportSummary = {};
apz.app.onLoad_ReportSummary = function(params){
    apz.recrep.ReportSummary.sCache = params;
    apz.recrep.ReportSummary.fnRenderData();
   
}
apz.app.onShow_ReportSummary = function(params){
     $("#recrep__ReportSummary__Launcher").hide();
}
apz.recrep.ReportSummary.fnRenderData = function(){
    debugger;
    apz.data.loadJsonData("Reports","recrep");
};
apz.recrep.ReportSummary.fnDownloadExcel= function(){
    debugger;
      var CsvString = "";
    CsvString += "File Name,Category,UploadedBy,Date,Status" + "\r\n";
    var lrows = apz.data.scrdata.recrep__ReconciliationReports_Res.ReportsSummary;
    lrows.forEach(function(RowItem, RowIndex) {
        var row = RowItem.FileName + "," + RowItem.Category + "," + RowItem.UploadedBy + "," + RowItem.Date + "," + RowItem.Status;
        CsvString += row + "\r\n";
    });
    // window.open('data:application/vnd.ms-excel,' + encodeURIComponent(CsvString));
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(CsvString));
    excel_file.setAttribute('download', 'Reconciliation Report Summary.xls');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file);
};

apz.recrep.ReportSummary.fnDownloadCSV = function(){
    debugger;
   var lrows = apz.data.scrdata.recrep__ReconciliationReports_Res.ReportsSummary;
    // var csvContent = "data:text/csv;charset=utf-8,";
    var csvContent = "";
    csvContent += "File Name,Category,UploadedBy,Date,Status" + "\r\n";
    lrows.forEach(function(RowItem) {
        debugger;
        var row = RowItem.FileName + "," + RowItem.Category + "," + RowItem.UploadedBy + "," + RowItem.Date + "," + RowItem.Status;
        csvContent += row + "\r\n";
    });
    var encodedUri = encodeURI(csvContent);
    //window.open(encodedUri);
    var excel_file = document.createElement('a');
    excel_file.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent));
    excel_file.setAttribute('download', 'Reconciliation Report Summary.csv');
    document.body.appendChild(excel_file);
    excel_file.click();
    document.body.removeChild(excel_file); 
}

$("#td_recrep__ReconciliationReports__o__ReportsSummary__FileName_0").click(function(){
    debugger;
     var  params = {};
    params.appId = "recrep";
    params.scr = "ReportSummaryDetails";
    params.div = "recrep__ReportSummary__Launcher";
    params.userObj = {
        callback :apz.recrep.ReportSummary.fnCallBack
    };
    $("#recrep__ReportSummary__ReportTable").hide();
    $("#recrep__ReportSummary__Launcher").show();
    apz.launchSubScreen(params);
});
apz.recrep.ReportSummary.fnCallBack = function(){
    debugger;
    $("#recrep__ReportSummary__ReportTable").show();
    $("#recrep__ReportSummary__Launcher").hide();
    apz.recrep.ReportSummary.fnRenderData();
}

apz.recrep.ReportSummary.exportPDF = function() {
    debugger;
    var columns = [{
        title: "File Name.",
        dataKey: "FileName"
    }, {
        title: "Category",
        dataKey: "Category"
    }, {
        title: "UploadedBy",
        dataKey: "UploadedBy"
    }, {
        title: "Date",
        dataKey: "Date"
    }, {
        title: "Transaction Amount",
        dataKey: "amount"
    }, {
        title: "Status",
        dataKey: "Status"
    }];
    var rows = apz.data.scrdata.recrep__ReconciliationReports_Res.ReportsSummary;
    var doc = new jsPDF('landscape');
    doc.text("Reconciliation Reports", 20, 30);
    // doc.text(apz.getElmValue("acta01_/_FetchAccountDetails__o__accountDetails__accountNo"), 70, 30);
    // doc.text("Available Balance", 20, 40);
    // doc.text(apz.getElmValue("acta01__FetchAccountDetails__o__accountDetails__availableBalance"), 70, 40);
    doc.autoTable(columns, rows, {
        startY: 60
    });
    doc.save('Report Summary.pdf');
};
apz.recrep.ReportSummary.fnSelectedRow = function(ths){
    debugger;
  
};
