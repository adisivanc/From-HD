apz.acnp01.NotionalPooling = {};
apz.acnp01.NotionalPooling.sCorporateId = "";
apz.app.onLoad_NotionalPooling = function() {
    if(apz.Login){
        apz.acnp01.NotionalPooling.sCorporateId = apz.Login.sCorporateId;
        apz.acnp01.NotionalPooling.sRoleId = apz.Login.sRoleId;
        apz.acnp01.NotionalPooling.sUserId = apz.Login.sUserId;
    }else{
        apz.acnp01.NotionalPooling.sCorporateId = "000FTAC4321";
        apz.acnp01.NotionalPooling.sRoleId = "Admin"
    }
    
    //apz.data.loadJsonData("NotionalPoolSummary","acnp01");
    var lServerParams = {
        "ifaceName": "NotionalPoolSummary",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acnp01.NotionalPooling.NotionalPoolSummaryCB,
        "callBackObj": "",
    };
   var req = {};
    req.action = "Query";
    req.table = "tb_dbmi_corp_notional_pool";
    req.tbDbmiCorpNotionalPool = {};
    req.tbDbmiCorpNotionalPool.corporateId = apz.acnp01.NotionalPooling.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    
};
apz.acnp01.NotionalPooling.NotionalPoolSummaryCB = function(pResp) {
    debugger;
    //apz.data.acnp01__NotionalPoolSummary_Res = {};
    //apz.data.acnp01__NotionalPoolSummary_Res.tbDbmiCorpNotionalPool= pResp.res.acnp01__NotionalPoolSummary_Res.tbDbmiCorpNotionalPool;
    //apz.data.loadData("NotionalPoolSummary",'acnp01');
};
apz.acnp01.NotionalPooling.viewDetails = function(pObj) {
    debugger;
    var lRow = $(pObj).attr('rowno');
    var lData = apz.data.scrdata.acnp01__NotionalPoolSummary_Res.tbDbmiCorpNotionalPool[lRow];
    var params = {};
    params.appId = "acnp01";
    params.layout = "All";
    params.div = "acnp01__NotionalPooling__NotionalPoolLauncher";
    params.scr = "NotionalPoolDetails";
    params.userObj = {
        "PoolData": lData
    };
    $("#acnp01__NotionalPooling__NotionalPoolLauncherRow").removeClass('sno');
    $("#acnp01__NotionalPooling__NotionalPoolSummaryRow").addClass('sno');
    $("#acnp01__CMLanding__grayheaderrow").addClass('sno');
    apz.launchSubScreen(params);
};

apz.acnp01.NotionalPooling.editPool = function(pObj){
    debugger;
    var lRow = $(pObj).parent().parent().parent().parent().attr('rowno');
    var lData = apz.data.scrdata.acnp01__NotionalPoolSummary_Res.tbDbmiCorpNotionalPool[lRow];
    var params = {};
    params.appId = "acnp01";
    params.layout = "All";
    params.div = "acnp01__NotionalPooling__NotionalPoolLauncher";
    params.scr = "NotionalPoolMaintenance";
    params.userObj = {
        "PoolData": lData,
        "action":"MODIFY"
    };
    $("#acnp01__NotionalPooling__NotionalPoolLauncherRow").removeClass('sno');
    $("#acnp01__NotionalPooling__NotionalPoolSummaryRow").addClass('sno');
    $("#acnp01__NotionalPooling__mainHeader").addClass('sno');
    $("#acnp01__NotionalPooling__newmainheader").addClass('sno');
    apz.launchSubScreen(params);
    event.stopPropagation();
};

apz.acnp01.NotionalPooling.createPool = function(pObj){
    debugger;
    var params = {};
    params.appId = "acnp01";
    if (apz.deviceGroup == "Mobile") {
         params.layout = "Mobile";
    }
    
    else{
         params.layout = "All";
    }
   
    params.div = "acnp01__NotionalPooling__NotionalPoolLauncher";
    params.scr = "NotionalPoolMaintenance";
    params.userObj = {
        "action":"ADD"
    };
    $("#acnp01__NotionalPooling__NotionalPoolLauncherRow").removeClass('sno');
    $("#acnp01__NotionalPooling__NotionalPoolSummaryRow").addClass('sno');
    $("#acnp01__NotionalPooling__mainHeader").addClass('sno');
    $("#acnp01__NotionalPooling__newmainheader").addClass('sno');
    apz.launchSubScreen(params);
};
