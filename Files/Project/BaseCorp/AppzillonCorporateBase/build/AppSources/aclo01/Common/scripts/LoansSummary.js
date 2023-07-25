apz.aclo01.loansSummary = {};
apz.aclo01.loansSummary.sCorporateID = "";
apz.aclo01.loansSummary.sRoleID = "";
apz.app.onLoad_LoansSummary = function(params) {
    if (apz.Login) {
        apz.aclo01.loansSummary.sCorporateID = apz.Login.sCorporateId;
        apz.aclo01.loansSummary.sRoleID = apz.Login.sRoleId;
    } else {
        apz.aclo01.loansSummary.sCorporateID = "000FTAC4321";
    }
    apz.aclo01.loansSummary.getLoanSummary();
};
apz.aclo01.loansSummary.getLoanSummary = function() {
    debugger;
    var req = {};
    req.tbDbmiCorpLoanMaster = {
        "corporateId": apz.aclo01.loansSummary.sCorporateID
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_loan_master";
    var lReq = {
        "ifaceName": "LoanSummary",
        "paintResp": "N",
        "buildReq": "N",
        "req": req,
        "appId": "aclo01",
        "async": false,
        "callBack": apz.aclo01.loansSummary.getLoanSummaryCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.aclo01.loansSummary.getLoanSummaryCB = function(pResp) {
    debugger;
    apz.data.scrdata.aclo01__LoanSummary_Res = {};
    apz.data.scrdata.aclo01__LoanSummary_Res.tbDbmiCorpLoanMaster = [];
    apz.data.scrdata.aclo01__LoanSummary_Res.tbDbmiCorpLoanMaster = pResp.res.aclo01__LoanSummary_Res.tbDbmiCorpLoanMaster;
    for (var i = 0; i < apz.data.scrdata.aclo01__LoanSummary_Res.tbDbmiCorpLoanMaster.length; i++) {
        var strlen = apz.data.scrdata.aclo01__LoanSummary_Res.tbDbmiCorpLoanMaster[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.aclo01__LoanSummary_Res.tbDbmiCorpLoanMaster[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.aclo01__LoanSummary_Res.tbDbmiCorpLoanMaster[i].maskAccNo = result;
    }
    apz.data.loadData("LoanSummary", "aclo01");
};
apz.aclo01.loansSummary.loanDetails = function(pObj) {
    debugger;
    //var lAccountNo = $(pObj).closest('li').find('.accountNo').text();
    var lrowno = $(pObj).attr("rowno");
    var lAccountNo = apz.getElmValue("aclo01__LoanSummary__o__tbDbmiCorpLoanMaster__accountNo_" + lrowno)
    
    $("#aclo01__LoansSummary__LoansSummaryHeader").addClass('sno');
    $("#aclo01__LoansSummary__LoanSummarySearchrow").addClass('sno');
    $("#aclo01__LoansSummary__LoansSummaryList").addClass('sno');
    $("#aclo01__LoansSummary__LoanDetailsLaunchRow").removeClass('sno');
    var params = {};
    params.appId = "aclo01";
    params.scr = "LoanDetails";
    params.div = "aclo01__LoansSummary__LoanDetailsLaunch";
    params.layout = "All";
    params.userObj = {
        "LoanAccountNo": lAccountNo
    };
    apz.launchSubScreen(params);
};

apz.aclo01.loansSummary.fnlLoanPay = function(pObj){
    debugger;
    var lrowno = $(pObj).attr("rowno");
    var lAccountNo = apz.getElmValue("aclo01__LoanSummary__o__tbDbmiCorpLoanMaster__accountNo_" + lrowno)
    
    $("#aclo01__LoansSummary__LoansSummaryHeader").addClass('sno');
    $("#aclo01__LoansSummary__LoanSummarySearchrow").addClass('sno');
    $("#aclo01__LoansSummary__LoansSummaryList").addClass('sno');
    $("#aclo01__LoansSummary__LoanDetailsLaunchRow").removeClass('sno');
    var params = {};
    params.appId = "aclo01";
    params.scr = "LoanPayment";
    params.div = "aclo01__LoansSummary__LoanDetailsLaunch";
    params.layout = "All";
    params.userObj = {
        "LoanAccountNo": lAccountNo
    };
    apz.launchSubScreen(params);
}
apz.aclo01.loansSummary.loanSimulator1 = function() {
    debugger;
    apz.hide("aclo01__LoansSummary__LoansSummaryList");
    apz.hide("aclo01__LoansSummary__LoansSummaryHeader");
    apz.hide("aclo01__LoansSummary__LoanSummarySearchrow");
    $("#aclo01__LoansSummary__LoanDetailsLaunchRow").removeClass('sno');
    var lparam = {
        "appId": "aclo01",
        "scr": "LoanSimulator",
        "div": "aclo01__LoansSummary__LoanDetailsLaunch",
        "layout": "All",
        "userObj": {
            "callBack": apz.aclo01.loansSummary.getLoanSimulator
        }
    };
    apz.launchSubScreen(lparam);
};
apz.aclo01.loansSummary.getLoanSimulator = function() {
    apz.show("aclo01__LoansSummary__LoansSummaryList");
    apz.show("aclo01__LoansSummary__LoansSummaryHeader");
    apz.show("aclo01__LoansSummary__LoanSummarySearchrow");
    
    apz.hide("aclo01__LoansSummary__LoanDetailsLaunchRow");
}
apz.aclo01.loansSummary.loanSimulator = function() {
    debugger;
    apz.hide("aclo01__LoansSummary__LoansSummaryList");
    apz.hide("aclo01__LoansSummary__LoansSummaryHeader");
     apz.hide("aclo01__LoansSummary__LoanSummarySearchrow");
    $("#aclo01__LoansSummary__LoanDetailsLaunchRow").removeClass('sno');
    var lparam = {
        "appId": "aclo01",
        "scr": "ApplyLoan",
        "div": "aclo01__LoansSummary__LoanDetailsLaunch",
        "layout": "All",
        "userObj": {
            "callBack": apz.aclo01.loansSummary.getLoanSimulator
        }
    };
    
    if (apz.deviceGroup == "Mobile") {
         lparam.scr = "ApplyLoanMobile";
    }
    else {
         lparam.scr = "ApplyLoan";
    }
    apz.launchSubScreen(lparam);
};
apz.aclo01.loansSummary.getLoanSimulator = function() {
    apz.show("aclo01__LoansSummary__LoansSummaryList");
    apz.show("aclo01__LoansSummary__LoansSummaryHeader");
     apz.show("aclo01__LoansSummary__LoanSummarySearchrow");
    apz.hide("aclo01__LoansSummary__LoanDetailsLaunchRow");
}
