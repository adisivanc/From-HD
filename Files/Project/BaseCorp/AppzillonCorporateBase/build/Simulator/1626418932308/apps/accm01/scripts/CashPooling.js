apz.accm01.CashPooling = {};
apz.accm01.CashPooling.sCorporateId = "";
apz.app.onLoad_CashPooling = function() {
    apz.accm01.CashPooling.sCorporateId = "000FTAC4321";
    apz.data.loadJsonData("CashPoolSummary","accm01");
    /*var lServerParams = {
        "ifaceName": "CashPoolSummary_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.accm01.CashPooling.CashPoolSummaryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpCashPool = {};
    req.tbDbmiCorpCashPool.corporateId = apz.accm01.CashPooling.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    */
};
apz.accm01.CashPooling.CashPoolSummaryCB = function(pResp) {
    debugger;
};
apz.accm01.CashPooling.viewDetails = function(pObj) {
    debugger;
    var lRow = $(pObj).attr('rowno');
    var lData = apz.data.scrdata.accm01__CashPoolSummary_Res.tbDbmiCorpCashPool[lRow];
    var params = {};
    params.appId = "accm01";
    params.layout = "All";
    params.div = "accm01__CMLanding__CMInnerScreensLaunch";
    params.scr = "CashPoolingDetails";
    params.userObj = {
        "PoolData": lData
    };
    $("#accm01__CMLanding__CMLandingRow").addClass('sno');
    $("#accm01__CMLanding__grayheaderrow").addClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").removeClass('sno');
    apz.launchSubScreen(params);
};

apz.accm01.CashPooling.sweepPool = function(pObj){
    debugger;
    var lRow = $(pObj).parent().parent().parent().parent().attr('rowno');
    var lData = apz.data.scrdata.accm01__CashPoolSummary_Req.tbDbmiCorpCashPool[lRow];
    var params = {};
    params.appId = "accm01";
    params.layout = "All";
    params.div = "accm01__CMLanding__CMInnerScreensLaunch";
    params.scr = "CashPoolMaintenance";
    params.userObj = {
        "PoolData": lData,
        "action":"MODIFY"
    };
    $("#accm01__CMLanding__CMLandingRow").addClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").removeClass('sno');
    $("#accm01__CMLanding__grayheaderrow").addClass('sno');
    apz.launchSubScreen(params);
};

