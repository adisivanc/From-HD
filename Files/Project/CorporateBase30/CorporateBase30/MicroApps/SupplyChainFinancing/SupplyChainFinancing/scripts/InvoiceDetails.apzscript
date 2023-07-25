apz.acsf01.invoiceDetails = {};
apz.app.onLoad_InvoiceDetails = function(params) {
    debugger;
    if (apz.Login) {
        apz.acsf01.invoiceDetails.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acsf01.invoiceDetails.sCorporateId = "000FTAC4321";
    }
    $("#acsf01__InvoiceSummary__InvoiceRow").hide();
    apz.acsf01.invoiceDetails.lScrData = params.data.InvoiceData;
    apz.data.scrdata.acsf01__InvoiceDetails_Res = {};
    apz.data.scrdata.acsf01__InvoiceDetails_Res.tbDbmiCorpInvoiceDetails = {};
    apz.data.scrdata.acsf01__InvoiceDetails_Res.tbDbmiCorpInvoiceDetails = apz.acsf01.invoiceDetails.lScrData;
    apz.data.loadData("InvoiceDetails", "acsf01");
};
apz.acsf01.invoiceDetails.fnCancel = function() {
    debugger;
    $("#acsf01__InvoiceSummary__launchScreenRow").addClass("sno");
    $("#acsf01__InvoiceSummary__InvoiceRow").show();
    $("#acsf01__InvoiceSummary__InvoiceSummary").removeClass("sno");
};