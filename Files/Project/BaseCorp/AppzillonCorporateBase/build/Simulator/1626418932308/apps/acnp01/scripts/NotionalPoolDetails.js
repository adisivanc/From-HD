apz.acnp01.NotionalPoolDetails = {};
apz.app.onLoad_NotionalPoolDetails = function(params) {
    debugger;
    apz.acnp01.NotionalPoolDetails.getPoolAccDetails(params.PoolData);
};
apz.acnp01.NotionalPoolDetails.getPoolAccDetails = function(pPoolObj) {
    var lServerParams = {
        "ifaceName": "NotionalPoolAccs",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acnp01.NotionalPoolDetails.poolAccDetailsCB,
        "callBackObj": {
            "poolMasterData": pPoolObj
        },
    };
    var req = {};
    req.action = "Query";
    req.table = "tb_dbmi_corp_notional_pool_acc";
    req.tbDbmiCorpNotionalPoolAcc = {};
    req.tbDbmiCorpNotionalPoolAcc.corporateId = apz.acnp01.NotionalPooling.sCorporateId;
    req.tbDbmiCorpNotionalPoolAcc.poolId = pPoolObj.poolId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acnp01.NotionalPoolDetails.poolAccDetailsCB = function(pResp) {
    debugger;
    if(pResp.status){
    apz.data.scrdata.acnp01__NotionalPoolAccs_Res.tbDbmiCorpNotionalPool = pResp.callBackObj.poolMasterData;
    apz.data.loadData("NotionalPoolAccs", 'acnp01');
    }
};
apz.acnp01.NotionalPoolDetails.Cancel = function() {
    $("#acnp01__NotionalPooling__NotionalPoolLauncherRow").addClass('sno');
    $("#acnp01__NotionalPooling__NotionalPoolSummaryRow").removeClass('sno');
    $("#acnp01__NotionalPooling__mainHeader").removeClass('sno');
    $("#acnp01__NotionalPooling__newmainheader").removeClass('sno');
};
