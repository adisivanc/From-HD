apz.accm01.NotionalPoolMaintenance = {};
apz.accm01.sCorporateId = "";
apz.app.onLoad_NotionalPoolMaintenance = function(params) {
    debugger;
    if (params.action == "MODIFY") {
        $("#accm01__NotionalPoolMaintenance__AccountsListRow").removeClass('sno');
        $("#accm01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__poolId").attr('disabled',true);
        apz.data.scrdata.accm01__NotionalPoolInsert_Req = {};
        apz.data.scrdata.accm01__NotionalPoolInsert_Req.tbDbmiCorpNotionalPool = params.PoolData;
        apz.data.loadData("NotionalPoolInsert", 'accm01');
        apz.data.loadJsonData("NotionalPoolAccInsert","accm01");
        //apz.accm01.NotionalPoolMaintenance.getPoolAccDetails(params);
    } else if (params.action == "ADD") {
        $("#accm01__NotionalPoolMaintenance__AccountsListRow").addClass('sno');
        apz.data.scrdata.accm01__NotionalPoolInsert_Req = {};
        apz.data.scrdata.accm01__NotionalPoolAccInsert_Req = {};
    }
};
apz.accm01.NotionalPoolMaintenance.getPoolAccDetails = function(pPoolObj) {
    var lServerParams = {
        "ifaceName": "NotionalPoolAccInsert",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.accm01.NotionalPoolMaintenance.poolAccDetailsCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.accm01.NotionalPoolMaintenance.poolAccDetailsCB = function(pResp) {
    debugger;
    apz.data.scrdata.accm01__NotionalPoolAccInsert_Req = {};
    apz.data.scrdata.accm01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc = pResp.res.accm01__NotionalPoolAccInsert_Res.tbDbmiCorpNotionalPoolAcc;
    apz.data.loadData("NotionalPoolAccInsert", 'accm01');
};

apz.accm01.NotionalPoolMaintenance.addAccount = function() {
    debugger;
    if (!apz.data.scrdata.accm01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc) {
        apz.data.scrdata.accm01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc = [];
    }
    var lAccObj = {};
    lAccObj.poolId = $("#accm01__NotionalPoolMaintenance__i__tbDbmiCorpNotionalPool__poolId").val();
    lAccObj.corporateId = apz.accm01.sCorporateId;
    lAccObj.accountNo = $("#accm01__NotionalPoolMaintenance__AccountNo").val();
    lAccObj.accountType = $("#accm01__NotionalPoolMaintenance__AccountType").val();
    lAccObj.amount = 100000;
    apz.data.scrdata.accm01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc.push(lAccObj);
    apz.data.loadData("NotionalPoolAccInsert", 'accm01');
    $("#accm01__NotionalPoolMaintenance__AccountsListRow").removeClass('sno');
    var lAccArr = apz.data.scrdata.accm01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc;
    var lAccArrLength = lAccArr.length;
    var lTotalAmount;
    for (var i = 0; i < lAccArrLength; i++) {
        if (lTotalAmount) {
            lTotalAmount = lTotalAmount + lAccArr[i].amount;
        } else {
            lTotalAmount = lAccArr[i].amount;
        }
    };
    $("#accm01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__balance_txtcnt").text(lTotalAmount);
};
apz.accm01.NotionalPoolMaintenance.Save = function() {
    var msg = {
        "code": 'accm_task',
    };
    apz.dispMsg(msg);
};
apz.accm01.NotionalPoolMaintenance.Cancel = function() {
    $("#accm01__CMLanding__CMLandingRow").removeClass('sno');
    $("#accm01__CMLanding__grayheaderrow").removeClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").addClass('sno');
};
