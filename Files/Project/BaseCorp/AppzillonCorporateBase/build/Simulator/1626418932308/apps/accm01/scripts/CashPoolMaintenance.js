apz.accm01.CashPoolMaintenance = {};
apz.accm01.CashPoolMaintenance.sCorporateId = "";
apz.app.onLoad_CashPoolMaintenance = function(params) {
    debugger;
    if (params.action == "MODIFY") {
        $("#accm01__CashPoolMaintenance__AccountsListRow").removeClass('sno');
        $("#accm01__CashPoolInsert__i__tbDbmiCorpCashPool__poolId").attr('disabled',true);
        apz.data.scrdata.accm01__CashPoolInsert_Res = {};
        apz.data.scrdata.accm01__CashPoolInsert_Res.tbDbmiCorpCashPool = params.PoolData;
        apz.data.loadData("CashPoolInsert", 'accm01');
        apz.data.loadJsonData("CashPoolAccInsert","accm01");
        //apz.accm01.CashPoolMaintenance.getPoolAccDetails(params);
    } else if (params.action == "ADD") {
        $("#accm01__CashPoolMaintenance__AccountsListRow").addClass('sno');
        apz.data.scrdata.accm01__CashPoolInsert_Res = {};
        apz.data.scrdata.accm01__CashPoolAccInsert_Res = {};
    }
};
apz.accm01.CashPoolMaintenance.getPoolAccDetails = function(pPoolObj) {
    var lServerParams = {
        "ifaceName": "CashPoolAccInsert",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.accm01.CashPoolMaintenance.poolAccDetailsCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.accm01.CashPoolMaintenance.poolAccDetailsCB = function(pResp) {
    debugger;
    apz.data.scrdata.accm01__CashPoolAccInsert_Res = {};
    apz.data.scrdata.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc = pResp.res.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc;
    apz.data.loadData("CashPoolAccInsert", 'accm01');
};

apz.accm01.CashPoolMaintenance.addAccount = function() {
    debugger;
    if (!apz.data.scrdata.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc) {
        apz.data.scrdata.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc = [];
    }
    var lAccObj = {};
    lAccObj.poolId = $("#accm01__CashPoolMaintenance__i__tbDbmiCorpCashPool__poolId").val();
    lAccObj.corporateId = apz.accm01.CashPoolMaintenance.sCorporateId;
    lAccObj.accountNo = $("#accm01__CashPoolMaintenance__AccountNo").val();
    lAccObj.accountType = $("#accm01__CashPoolMaintenance__AccountType").val();
    lAccObj.amount = 100000;
    lAccObj.currency = "INR";
    apz.data.scrdata.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc.push(lAccObj);
    apz.data.loadData("CashPoolAccInsert", 'accm01');
    $("#accm01__CashPoolMaintenance__AccountsListRow").removeClass('sno');
    var lAccArr = apz.data.scrdata.accm01__CashPoolAccInsert_Res.tbDbmiCorpCashPoolAcc;
    var lAccArrLength = lAccArr.length;
    var lTotalAmount;
    for (var i = 0; i < lAccArrLength; i++) {
        if (lTotalAmount) {
            lTotalAmount = lTotalAmount + lAccArr[i].amount;
        } else {
            lTotalAmount = lAccArr[i].amount;
        }
    };
    $("#accm01__CashPoolInsert__o__tbDbmiCorpCashPool__balance_txtcnt").text(lTotalAmount);
};
apz.accm01.CashPoolMaintenance.Save = function() {
    var msg = {
        "code": 'accm_task',
    };
    apz.dispMsg(msg);
};
apz.accm01.CashPoolMaintenance.Cancel = function() {
    $("#accm01__CMLanding__CMLandingRow").removeClass('sno');
    $("#accm01__CMLanding__grayheaderrow").removeClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").addClass('sno');
};
