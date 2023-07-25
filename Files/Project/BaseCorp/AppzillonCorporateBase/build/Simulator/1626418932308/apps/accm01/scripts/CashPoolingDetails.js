apz.accm01.CashPoolingDetails = {};
apz.app.onLoad_CashPoolingDetails = function(params) {
    debugger;
    apz.data.scrdata.accm01__CashPoolInsert_Res = {};
    apz.data.scrdata.accm01__CashPoolInsert_Res.tbDbmiCorpCashPool = params.PoolData;
    apz.data.loadData("CashPoolInsert", 'accm01');
    //apz.accm01.CashPoolingDetails.getPoolAccDetails(params);
    apz.data.loadJsonData("CashPoolAccInsert","accm01");
};
apz.accm01.CashPoolingDetails.getPoolAccDetails = function(pPoolObj) {
    var lServerParams = {
        "ifaceName": "CashPoolAccInsert",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.accm01.CashPoolingDetails.poolAccDetailsCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.accm01.CashPoolingDetails.poolAccDetailsCB = function(pResp) {
    debugger;
    apz.data.scrdata.accm01__CashPoolAccInsert_Res = {};
    apz.data.scrdata.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc = pResp.res.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc;
    apz.data.loadData("CashPoolAccInsert", 'accm01');
};

apz.accm01.CashPoolingDetails.Cancel = function(){
    $("#accm01__CMLanding__CMLandingRow").removeClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").addClass('sno');
    $("#accm01__CMLanding__grayheaderrow").removeClass('sno');
};
