apz.deptop.DepositTopup = {};
apz.app.onLoad_DepositTopup = function(params) {
    apz.data.scrdata["deptop__Topup_Req"] = {}
    apz.data.scrdata["deptop__Topup_Req"]["Topup"] = {
        "depositAmount": "40,000.00",
        "interestPayableMode": "CASH",
        "fromAccount": "47585936513712",
        "roi": "2",
        "corporateId": "000FTAC4321",
        "maturityInstructions": "None",
        "refNum": "150100159221",
        "maturityDate": "2017-02-12",
        "ownAccountCurrency": "USD",
        "principalCreditAcno": "16774534256789",
        "depositCurrency": "USD",
        "startDate": "2017-01-12",
        "interestPayable": "1",
        "status": "Active",
        "interestAmount": "23",
        "finalAmount": "40,023.00",
        "accBranch": "Central Park",
        "accountEntity": "ENTITY001",
        "lienAmount": "12,312.00",
        "accountName": "Savings"
    };
    if (params.refNum) {
        apz.data.scrdata["deptop__Topup_Req"]["Topup"] = {
            "depositAmount": params.depositAmount,
            "fromAccount": params.fromAccount,
            "roi": params.roi,
            "refNum": params.refNum,
            "maturityDate": params.maturityDate,
            "depositCurrency": params.depositCurrency,
            "finalAmount": params.finalAmount,
        }
        
        var strlen = params.refNum;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var result = apz.getMaskedValue(strlen, params.refNum);
        apz.data.scrdata["deptop__Topup_Req"]["Topup"]["refNum"] = result;
        
    }
    apz.data.loadData("Topup", "deptop");
};
apz.deptop.DepositTopup.fnOnClickProceed = function() {
    $("#deptop__DepositTopup__DepositTopupProceed").removeClass("sno");
    $("#deptop__DepositTopup__DepositTopupDiv").addClass("sno");
    apz.data.buildData("Topup", "deptop");
    apz.data.scrdata["deptop__TopupDetails_Req"] = {}
    apz.data.scrdata["deptop__TopupDetails_Req"]["TopupDetails"] = apz.data.scrdata["deptop__Topup_Req"]["Topup"];
    apz.data.loadData("TopupDetails", "deptop");
    
     var strlen = apz.getElmValue("deptop__TopupDetails__i__TopupDetails__fromAccount");
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.getElmValue("deptop__TopupDetails__i__TopupDetails__fromAccount");
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.setElmValue("deptop__TopupDetails__i__TopupDetails__fromAccount", result);
};
apz.deptop.DepositTopup.fnOnClickOk = function() {
    apz.toggleModal({
        "targetId": "deptop__DepositTopup__transactionSuccess"
    });
    var params = {};
    params.appId = "acdp01";
    params.scr = "DepositLauncher";
    params.layout = "All";
    params.description = "Term Deposits";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
};

apz.deptop.DepositTopup.fnOnClickCancel = function(){
    var params = {};
    params.appId = "acdp01";
    params.scr = "DepositLauncher";
    params.layout = "All";
    params.description = "Term Deposits";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}
apz.deptop.DepositTopup.fnOnClickContinue = function() {
    apz.data.buildData("TopupDetails", "deptop");
    apz.toggleModal({
        "targetId": "deptop__DepositTopup__transactionSuccess"
    });
    apz.setElmValue("deptop__DepositTopup__trnsId_txtcnt", Math.random().toString().slice(2, 11));
    var getTodate = new Date();
    apz.setElmValue("deptop__DepositTopup__txnDate_txtcnt", (getTodate.getMonth() + 1) + "/" + getTodate.getDate() + "/" + getTodate.getFullYear());
    apz.setElmValue("deptop__DepositTopup__dep_acc", apz.data.scrdata["deptop__TopupDetails_Req"]["TopupDetails"]["refNum"]);
    apz.setElmValue("deptop__DepositTopup__topup_amt", apz.data.scrdata["deptop__TopupDetails_Req"]["TopupDetails"]["topupAmount"]);
};
apz.deptop.DepositTopup.fnOnCancel = function() {
    $("#deptop__DepositTopup__DepositTopupDiv").removeClass("sno");
    $("#deptop__DepositTopup__DepositTopupProceed").addClass("sno");
};
apz.deptop.DepositTopup.calculateRevisedMaturityValue = function() {
    var lTopupAmt = parseFloat(apz.getElmValue("deptop__Topup__i__Topup__topupAmount").replace(",", ""));
    if (!apz.isNull(lTopupAmt) && !lTopupAmt.isNaN) {
        var lRoi = apz.getElmValue("deptop__Topup__i__Topup__roi");
        if (!apz.isNull(lRoi)) {
            var lFinalAmt = parseFloat(apz.getElmValue("deptop__Topup__i__Topup__finalAmount").replace(",", ""));
            lFinalAmt = lFinalAmt + lTopupAmt + (lTopupAmt * lRoi / 100);
            if (!isNaN(lFinalAmt)) {
                apz.setElmValue("deptop__Topup__i__Topup__revisedAmount", lFinalAmt);
                apz.formatNumberControl(document.getElementById("deptop__Topup__i__Topup__revisedAmount"));
            }
        }
    }
}
