apz.Invoic = {};
apz.Invoic.InvoiceLauncher = {};
apz.app.Token = "Bearer ";
apz.app.CompanyName = "123146326718494";
var firstLoad = "Y";
var ResUpdated = {}
apz.app.singleResponseData = {};
apz.app.onLoad_InvoiceLauncher = function(){
     $("body").removeClass("dbcls");
    //apz.Invoic.InvoiceLauncher.fnDBTokenservice();
    //apz.data.loadJsonData("Dashboard")
    apz.Invoic.InvoiceLauncher.launchInvoiceListScr();
    debugger;
    
}

apz.Invoic.InvoiceLauncher.fnDBTokenservice = function(){
    var lServerParams = {
        "ifaceName": "GetCustomToken_Query",
        "buildReq": "N",
        "appId": apz.currAppId,
        "req": {},
        "paintResp": "N",
        "callBack": apz.Invoic.InvoiceLauncher.getCustomToken
    };
    apz.server.callServer(lServerParams);
}

//var billOrInvoice = "";
apz.Invoic.InvoiceLauncher.getCustomToken = function(param) {
    apz.app.Token += param.res.Invoic__GetCustomToken_Res.tbcustomtoken.token;
}

apz.Invoic.InvoiceLauncher.launchInvoiceListScr = function(){
    var param={};
    param.appId = apz.currAppId
    param.scr = "InvoiceList";
    param.layout = "All"
    param.div = "Invoic__InvoiceLauncher__gr_row_2";
    apz.launchSubScreen(param);
}
