apz.aclo01.loanDetails = {};
apz.app.onLoad_LoanDetails = function(params) {
    debugger;
    var req = {};
    req.tbDbmiCorpLoanDetails = {
        "corporateId": apz.aclo01.loansSummary.sCorporateID,
        "loanAccountNo": params.LoanAccountNo
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_loan_details";
    var lReq = {
        "ifaceName": "LoanDetails",
        "paintResp": "N",
        "buildReq": "N",
        "req": req,
        "appId": "aclo01",
        "async": false,
        "callBack": apz.aclo01.loanDetails.getLoanDetailsCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.aclo01.loanDetails.getLoanDetailsCB = function(pResp) {
    debugger;
    apz.data.scrdata.aclo01__LoanDetails_Res = {};
    apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails = [];
    apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails = pResp.res.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails;
    
    var strlen1 = pResp.res.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.accountNo;
    strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
    var laccNo1 = pResp.res.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.accountNo;
    var result1 = apz.getMaskedValue(strlen1, laccNo1);
    apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.maskAccNo = result1;
    apz.data.loadData("LoanDetails", "aclo01");
    apz.aclo01.loanDetails.calcPaymentDetails();
};
apz.aclo01.loanDetails.fnCancel = function() {
    $("#aclo01__LoansSummary__LoansSummaryHeader").removeClass('sno');
     $("#aclo01__LoansSummary__LoanSummarySearchrow").removeClass('sno');
    $("#aclo01__LoansSummary__LoansSummaryList").removeClass('sno');
    $("#aclo01__LoansSummary__LoanDetailsLaunchRow").addClass('sno');
};
apz.aclo01.loanDetails.calcPaymentDetails = function() {
    debugger;
    var lArmotScheduleJSON = [];
    var lEmi = apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.installmentAmount;
    var lMonthlyROI = apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.interestRate / (12 * 100);
    var lPrincipal = apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.loanAmount;
    var lStartDate = new Date(apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.accountOpeningDate);
    var lEndDate = new Date(apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.maturityDate);
    var lMonthlyTenure = (lEndDate.getFullYear() - lStartDate.getFullYear()) * 12;
    apz.aclo01.loanDetails.calcAmortizationSchedule(lEmi, lPrincipal, lMonthlyROI, lMonthlyTenure, 1, lArmotScheduleJSON);
    apz.data.scrdata.aclo01__LoanSimulation_Req = {};
    apz.data.scrdata.aclo01__LoanSimulation_Req.EMI = lArmotScheduleJSON;
    apz.data.scrdata.aclo01__LoanSimulation_Req.EMI.reverse();
    apz.data.loadData("LoanSimulation");
}
apz.aclo01.loanDetails.calcAmortizationSchedule = function(pEmi, pPrincipal, pROI, pTenure, pCurrPeriod, pArmotScheduleJSON) {
    debugger;
    if (pCurrPeriod <= pTenure) {
        var lMonthInterest = Math.round((pPrincipal * pROI * 100) / 100);
        var lMonthPrincipal = Math.round(((pEmi - lMonthInterest) * 100) / 100);
        var lBalance = Math.round(((pPrincipal - lMonthPrincipal) * 100) / 100);
        var lCurrAmort = {};
        lCurrAmort.Interest = lMonthInterest;
        lCurrAmort.Principal = lMonthPrincipal;
        lCurrAmort.Balance = lBalance;
        lCurrAmort.Period = pCurrPeriod;
        pArmotScheduleJSON.push(lCurrAmort);
        pCurrPeriod = pCurrPeriod + 1;
        apz.aclo01.loanDetails.calcAmortizationSchedule(pEmi, lBalance, pROI, pTenure, pCurrPeriod, pArmotScheduleJSON);
        apz.aclo01.loanDetails.calcPaymentSchedule(pArmotScheduleJSON);
    }
};
apz.aclo01.loanDetails.calcPaymentSchedule = function(pArmotScheduleJSON) {
    debugger;
    var lStartDate = new Date(apz.data.scrdata.aclo01__LoanDetails_Res.tbDbmiCorpLoanDetails.accountOpeningDate);
    var lToday = new Date();
    var lPayDate = lToday;
    if (lToday.getDate() < lStartDate.getDate()) {
        lPayDate = lToday.getFullYear() + "-" + (lToday.getMonth() - 1) + "-" + lToday.getDate();
    }
    var lDateDiff = lToday - lStartDate;
    var lMonthsBetween = Math.round(lDateDiff / (1000 * 60 * 60 * 24 * 30));
    var lAmortArrayLen = pArmotScheduleJSON.length;
    pArmotScheduleJSON.splice(lMonthsBetween, lAmortArrayLen - lMonthsBetween);
    for (var month = 0; month < lMonthsBetween; month++) {
        try {
            pArmotScheduleJSON[month].date = (new Date(lStartDate)).addMonths(month).format("m/d/Y");
        } catch (e) {}
    }
};
apz.aclo01.loanDetails.sendMail = function() {
    apz.dispMsg({
        "type": "I",
        "message": "The loan statement has been mailed to your registered e-mail address"
    });
};
