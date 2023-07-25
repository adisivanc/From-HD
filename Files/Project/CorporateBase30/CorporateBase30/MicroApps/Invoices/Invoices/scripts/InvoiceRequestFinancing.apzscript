apz.app.onLoad_InvoiceRequestFinancing = function(){
    debugger;
    apz.data.loadData("QbookInvoiceReqstFinancing", "Invoic")
    $("#Invoic__InvoiceRequestFinancing__totalamount_txtcnt").text(apz.formatNumber({
                value: "$"+apz.Invoic.InvoiceList.sum,
                decimalSep: ".",
                mask: "MILLION",
                decimalPoints: 2
            }))
}
