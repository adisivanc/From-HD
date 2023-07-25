apz.accm01.NotionalPooling = {};
apz.accm01.NotionalPooling.sCorporateId = "";
apz.app.onLoad_NotionalPooling = function() {
    apz.accm01.NotionalPooling.sCorporateId = "000FTAC4321";
    //apz.data.loadJsonData("NotionalPoolSummary","accm01");
    var lServerParams = {
        "ifaceName": "NotionalPoolSummary",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.accm01.NotionalPooling.NotionalPoolSummaryCB,
        "callBackObj": "",
    };
   var req = {};
    req.action = "Query";
    req.table = "tb_dbmi_corp_notional_pool";
    req.tbDbmiCorpNotionalPool = {};
    req.tbDbmiCorpNotionalPool.corporateId = apz.accm01.NotionalPooling.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    
};
apz.accm01.NotionalPooling.NotionalPoolSummaryCB = function(pResp) {
    debugger;
   //apz.data.accm01__NotionalPoolSummary_Res = {};
    //apz.data.accm01__NotionalPoolSummary_Res.tbDbmiCorpNotionalPool= pResp.res.accm01__NotionalPoolSummary_Res.tbDbmiCorpNotionalPool;
    //apz.data.loadData("NotionalPoolSummary",'accm01');
};
apz.accm01.NotionalPooling.viewDetails = function(pObj) {
    debugger;
    var lRow = $(pObj).attr('rowno');
    var lData = apz.data.scrdata.accm01__NotionalPoolSummary_Res.tbDbmiCorpNotionalPool[lRow];
    var params = {};
    params.appId = "accm01";
    params.layout = "All";
    params.div = "accm01__CMLanding__CMInnerScreensLaunch";
    params.scr = "NotionalPoolDetails";
    params.userObj = {
        "PoolData": lData
    };
    $("#accm01__CMLanding__CMLandingRow").addClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").removeClass('sno');
    $("#accm01__CMLanding__grayheaderrow").addClass('sno');
    apz.launchSubScreen(params);
};

apz.accm01.NotionalPooling.editPool = function(pObj){
    debugger;
    var lRow = $(pObj).parent().parent().parent().parent().attr('rowno');
    var lData = apz.data.scrdata.accm01__NotionalPoolSummary_Req.tbDbmiCorpNotionalPool[lRow];
    var params = {};
    params.appId = "accm01";
    params.layout = "All";
    params.div = "accm01__CMLanding__CMInnerScreensLaunch";
    params.scr = "NotionalPoolMaintenance";
    params.userObj = {
        "PoolData": lData,
        "action":"MODIFY"
    };
    $("#accm01__CMLanding__CMLandingRow").addClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").removeClass('sno');
    $("#accm01__CMLanding__grayheaderrow").addClass('sno');
    apz.launchSubScreen(params);
};

