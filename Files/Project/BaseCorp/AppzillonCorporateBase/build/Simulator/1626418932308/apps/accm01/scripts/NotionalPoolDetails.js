apz.accm01.NotionalPoolDetails = {};
apz.app.onLoad_NotionalPoolDetails = function(params) {
    debugger;
    apz.accm01.NotionalPoolDetails.getPoolAccDetails(params.PoolData);
};
apz.accm01.NotionalPoolDetails.getPoolAccDetails = function(pPoolObj) {
    var lServerParams = {
        "ifaceName": "NotionalPoolAccs",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.accm01.NotionalPoolDetails.poolAccDetailsCB,
        "callBackObj": {
            "poolMasterData": pPoolObj
        },
    };
    var req = {};
    req.action = "Query";
    req.table = "tb_dbmi_corp_notional_pool_acc";
    req.tbDbmiCorpNotionalPoolAcc = {};
    req.tbDbmiCorpNotionalPoolAcc.corporateId = apz.accm01.NotionalPooling.sCorporateId;
    req.tbDbmiCorpNotionalPoolAcc.poolId = pPoolObj.poolId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.accm01.NotionalPoolDetails.poolAccDetailsCB = function(pResp) {
    debugger;
    if(pResp.status){
    apz.data.scrdata.accm01__NotionalPoolAccs_Res.tbDbmiCorpNotionalPool = pResp.callBackObj.poolMasterData;
    apz.data.loadData("NotionalPoolAccs", 'accm01');
    }
};
apz.accm01.NotionalPoolDetails.Cancel = function() {
    $("#accm01__CMLanding__CMLandingRow").removeClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").addClass('sno');
    $("#accm01__CMLanding__grayheaderrow").removeClass('sno');
};
