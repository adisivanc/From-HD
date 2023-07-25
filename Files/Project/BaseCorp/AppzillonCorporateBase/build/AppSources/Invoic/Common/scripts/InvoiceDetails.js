apz.Invoic.InvoiceDetails = {}
apz.app.onLoad_InvoiceDetails = function() {
   debugger
   apz.data.loadData("QbookInvoiceDetails", "Invoic"); //apz.data.loadJsonData("InvoiceDetailsResp")
}
apz.Invoic.InvoiceDetails.Back = function() {
    var param = {};
    param.appId = apz.currAppId
    param.scr = "InvoiceList";
    param.layout = "All"
    param.div = "Invoic__InvoiceLauncher__gr_row_2";
    apz.launchSubScreen(param);
}
