apz.lecr01.billCollections = {};
apz.app.onLoad_BillCollections = function() {
    debugger;
    if (apz.Login) {
        apz.lecr01.billCollections.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.lecr01.billCollections.sCorporateId = "000FTAC4321";
    }
    apz.lecr01.billCollections.showBillSummary();
};
apz.app.onShown_BillCollections = function() {
    debugger;
};
apz.lecr01.billCollections.showBillSummary = function() {
    var req = {
        "ExportBillsSummary": {
            "corporateId": apz.lecr01.billCollections.sCorporateId,
            "type": "All"
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_bill_collection";
    var lParams = {
        "ifaceName": "BillCollection",
        "paintResp": "Y",
        "appId": "lecr01",
        "buildReq": "N",
        "req": req,
        "async": false,
        "callBack": apz.lecr01.billCollections.showBillSummaryCB,
    };
    apz.server.callServer(lParams);
};
apz.lecr01.billCollections.showBillSummaryCB = function(params) {
    debugger;
};
apz.lecr01.billCollections.fnBillDetails = function(pObj) {
    debugger;
    apz.hide("lecr01__LCSummary__lcRow");
    apz.hide("lecr01__LCSummary__BCRow");
    apz.hide("lecr01__LCSummary__MobBCRow");
    var lRefNo = $(pObj).closest('li').find('.refNo').text();
    $(".details").removeClass('sno');
    $(".summary").addClass('sno');
    /*var params = {};
    params.appId = "lecr01";
    params.scr = "BillDetails";
    params.layout = "All";
    params.div = "lecr01__BillCollections__LaunchDetails";
    params.userObj = {
        'refNo': lRefNo
    };
    apz.launchInDiv(params);*/
    var params = {};
    params.appId = "lecr01";
    params.scr = "BillDetails";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    params.userObj = {
        "refNo": lRefNo
    };
     if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    apz.launchSubScreen(params);
};
apz.lecr01.billCollections.fnBillDetailsCB = function(pResp) {
    debugger;
};
