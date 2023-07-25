apz.aclo01.LoanPayment = {};
apz.app.onLoad_LoanPayment = function(params) {
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
        "callBack": apz.aclo01.LoanPayment.getLoanDetailsCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.aclo01.LoanPayment.getLoanDetailsCB = function(pResp) {
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
    var payAmount = apz.getElmValue("aclo01__LoanDetails__o__tbDbmiCorpLoanDetails__nextPaymentAmount");
    apz.setElmValue("aclo01__LoanPayment__el_inp_6",payAmount)
    apz.aclo01.LoanPayment.fnGetAccountNo();
};
apz.aclo01.LoanPayment.fnCancel = function() {
    debugger;
    $("#aclo01__LoansSummary__LoansSummaryHeader").removeClass('sno');
    $("#aclo01__LoansSummary__LoanSummarySearchrow").removeClass('sno');
    $("#aclo01__LoansSummary__LoansSummaryList").removeClass('sno');
    $("#aclo01__LoansSummary__LoanDetailsLaunchRow").addClass('sno');
}
apz.aclo01.LoanPayment.fnSubmit = function() {
    debugger;
    apz.dispMsg({
        "message": "Loan Payment is Successfull",
        "type":"S",
        "callBack": apz.aclo01.LoanPayment.fnCancel
    })
    
}
apz.aclo01.LoanPayment.fnGetAccountNo = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "roleAc";
    llaunch.scr = "RoleAccountDetails";
    llaunch.layout = "All";
    llaunch.userObj = {};
    llaunch.userObj.action = "FetchRoleAccount";
    llaunch.div = "aclo01__LoanPayment__AccountLaunch";
    llaunch.userObj.control = {};
    llaunch.userObj.control.destroyDiv = "aclo01__LoanPayment__AccountLaunch";
    llaunch.userObj.control.callBack = apz.aclo01.LoanPayment.fnGetAccountNoCB;
    llaunch.userObj.data = {
        "corpID": apz.aclo01.loansSummary.sCorporateID,
        "roleID": apz.aclo01.loansSummary.sRoleID
    };
    apz.launchApp(llaunch);
}
apz.aclo01.LoanPayment.fnGetAccountNoCB = function(params) {
    debugger;
    apz.resetCurrAppId("aclo01");
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var larrLength = params.data.length;
    for (var i = 0; i < larrLength; i++) {
        var strlen = params.data[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = params.data[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        var lfrmacc = {
            "val": params.data[i].accountNo,
            "desc": result
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("aclo01__LoanPayment__settleAcctNo"), lfrmarr);
};
