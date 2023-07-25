apz.lonact.LoanCreation = {};
apz.lonact.continueFlag = "";
apz.app.onLoad_LoanCreation = function(userObj) {
    debugger;
    //Initializing loan object
    apz.lonact.loanDetails = {};
    apz.lonact.loanDetails.components = [];
    apz.lonact.componentListArray = [];
    apz.lonact.componentDDValues = [{
        'val': "",
        'desc': "Select"
    }, {
        'val': "PRINCIPAL",
        'desc': "PRINCIPAL"
    }, {
        'val': "MAIN_INT",
        'desc': "MAIN_INT"
    }, {
        'val': "PROC_CHARGE",
        'desc': "PROC_CHARGE"
    }];
    apz.setElmValue("lonact__LoanCreation__ApplicationNumber", Date.now());
    $("#lonact__LoanCreation__el_progressstep_1_ext li").on("click", function() {
        apz.lonact.LoanCreation.fnProgressClick(this);
    });
    $("#lonact__LoanCreation__el_progressstep_1_ext li").removeClass("current");
    $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(1)").addClass("current");
    var today = new Date();
    var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    apz.setElmValue("lonact__LoanCreation__inpDate", dateTime);
    var llaunch = {};
    llaunch.appId = "lonact";
    llaunch.scr = "Main";
    llaunch.div = "lonact__LoanCreation__launchdiv";
    llaunch.layout = "All";
    apz.launchSubScreen(llaunch);
};
apz.lonact.LoanCreation.fnContinueNext = function(screen) {
    debugger;
    if ($("#lonact__LoanCreation__el_btn_3").text() == "Submit") {
        apz.lonact.LoanCreation.saveApplicationService();
    } else {
        $("#lonact__LoanCreation__el_progressstep_1_ext li").removeClass("current");
        if (apz.lonact.continueFlag == "") {
            apz.lonact.LoanCreation.createRequest("Main");
            $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(2)").addClass("current");
            $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(1)").addClass("completed");
            $("#lonact__LoanCreation__el_btn_3").text("Continue");
            var params = {};
            params.appId = "lonact";
            params.scr = "Preferences";
            params.div = "lonact__LoanCreation__launchdiv";
            apz.launchSubScreen(params);
        } else if (apz.lonact.continueFlag == "Preferences") {
            apz.lonact.LoanCreation.createRequest("Preferences");
            $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(3)").addClass("current");
            $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(2)").addClass("completed");
            $("#lonact__LoanCreation__el_btn_3").text("Submit");
            var params = {};
            params.appId = "lonact";
            params.scr = "Components";
            params.div = "lonact__LoanCreation__launchdiv";
            params.layout = "All";
            apz.launchSubScreen(params);
        }
    }
};
apz.lonact.formatDate = function(pDate) {
    var args = {
        "val": pDate,
        "fromFormat": 'dd/MM/yyyy',
        "toFormat": 'yyyy-MM-dd'
    };
    return apz.formatDate(args);
};
//Loan Application DB Save
apz.lonact.LoanCreation.saveApplicationService = function() {
    var request = {};
    var params = {};
    request.tbDbmiLoanMaster = apz.lonact.loanDetails;
    request.tbDbmiLoanMaster.valueDate = apz.lonact.formatDate(apz.lonact.loanDetails.valueDate);
    request.tbDbmiLoanMaster.maturityDate = apz.lonact.formatDate(apz.lonact.loanDetails.maturityDate);
    request.tbDbmiLoanMaster.statementStartDate = apz.lonact.formatDate(apz.lonact.loanDetails.statementStartDate);
    request.tbDbmiLoanMaster.amount = Number(apz.lonact.loanDetails.amount.replace(/[^0-9\.]+/g, ""));
    request.tbDbmiLoanComponents = [];
    request.tbDbmiLoanScheduleDefinitions = [];
    if (apz.lonact.loanDetails.components.length > 0) {
        for (var i = 0; i < apz.lonact.loanDetails.components.length; i++) {
            apz.lonact.loanDetails.components[i].applicationNumber = apz.lonact.loanDetails.applicationNumber;
            request.tbDbmiLoanComponents.push(apz.lonact.loanDetails.components[i]);
            if (apz.lonact.loanDetails.components[i].scheduleDefinitions) {
                for (var j = 0; j < apz.lonact.loanDetails.components[i].scheduleDefinitions.length; j++) {
                    apz.lonact.loanDetails.components[i].scheduleDefinitions[j].applicationNumber = apz.lonact.loanDetails.applicationNumber;
                    apz.lonact.loanDetails.components[i].scheduleDefinitions[j].componentName = apz.lonact.loanDetails.components[i].componentName;
                    request.tbDbmiLoanScheduleDefinitions.push(apz.lonact.loanDetails.components[i].scheduleDefinitions[j]);
                }
            }
        }
    }
    params.callBackObj = this;
    params.buildReq = "N";
    params.paintResp = "N";
    params.req = request;
    params.ifaceName = "CreateLoanDBService_New";
    params.async = true;
    params.callBack = apz.lonact.LoanCreation.saveApplicationCB;
    apz.server.callServer(params);
};
apz.lonact.LoanCreation.saveApplicationCB = function(pResp) {
    debugger;
    var params = {};
    params.message = "Request has been submitted successfully";
    params.type = "S";
    params.callBack = apz.lonact.LoanCreation.fnCancel;
    apz.dispMsg(params);
};
apz.lonact.LoanCreation.fnProgressClick = function(pthis) {
    var previousStep = $("#lonact__LoanCreation__el_progressstep_1_ext .current")[0].textContent;
    apz.lonact.LoanCreation.createRequest(previousStep);
    $("#lonact__LoanCreation__el_progressstep_1_ext li").removeClass("current");
    if (pthis.textContent == "Preferences") {
        $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(2)").addClass("current");
        $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(1)").addClass("completed");
        $("#lonact__LoanCreation__el_btn_3").text("Continue");
        var llaunch = {};
        llaunch.appId = "lonact";
        llaunch.scr = "Preferences";
        llaunch.div = "lonact__LoanCreation__launchdiv";
        //llaunch.layout = "All";
    }
    if (pthis.textContent == "Main") {
        $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(1)").addClass("current");
        $("#lonact__LoanCreation__el_btn_3").text("Continue");
        var llaunch = {};
        llaunch.appId = "lonact";
        llaunch.scr = "Main";
        llaunch.div = "lonact__LoanCreation__launchdiv";
        llaunch.layout = "All";
    }
    if (pthis.textContent == "Components") {
        $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(3)").addClass("current");
        $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(1)").addClass("completed");
        $("#lonact__LoanCreation__el_progressstep_1_ext li:nth-child(2)").addClass("completed");
        $("#lonact__LoanCreation__el_btn_3").text("Submit");
        var llaunch = {};
        llaunch.appId = "lonact";
        llaunch.scr = "Components";
        llaunch.div = "lonact__LoanCreation__launchdiv";
        llaunch.layout = "All";
    }
    apz.launchSubScreen(llaunch);
};
apz.lonact.LoanCreation.fnClickCustomerId = function(pthis) {
    debugger;
    var custId = apz.getElmValue(pthis.id);
    if (custId != "Please Select") {
        apz.setElmValue("lonact__Main__inpCustName", "ACME Corp");
    }
};
apz.lonact.LoanCreation.fnCancel = function() {
    debugger;
    var llaunch = {};
    llaunch.appId = "lonact";
    llaunch.scr = "Summary";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    apz.launchApp(llaunch);
}
apz.lonact.LoanCreation.createRequest = function(lParam) {
    debugger;
    apz.lonact.loanDetails.product = apz.getElmValue("lonact__LoanCreation__Product");
    apz.lonact.loanDetails.branch = apz.getElmValue("lonact__LoanCreation__Branch");
    apz.lonact.loanDetails.applicationNumber = apz.getElmValue("lonact__LoanCreation__ApplicationNumber");
    apz.lonact.loanDetails.customerId = apz.getElmValue("lonact__LoanCreation__inpCustId");
    apz.lonact.loanDetails.accountNumber = apz.getElmValue("lonact__LoanCreation__AccountNumber")
    if (lParam === "Main") {
        let lMainReq = {};
        apz.lonact.loanDetails.customerName = apz.getElmValue("lonact__Main__inpCustName");
        apz.lonact.loanDetails.currency = apz.getElmValue("lonact__Main__Currency");
        apz.lonact.loanDetails.amount = apz.getElmValue("lonact__Main__Amount");
        apz.lonact.loanDetails.valueDate = apz.getElmValue("lonact__Main__ValueDate");
        apz.lonact.loanDetails.maturityDate = apz.getElmValue("lonact__Main__MaturityDate");
        apz.lonact.loanDetails.effectiveDateArr = apz.lonact.Main.EffectiveDateArr;
    } else if (lParam === "Preferences") {
        apz.lonact.loanDetails.liquidateBack = apz.getElmValue("lonact__Preferences__LiquidateCbox");
        apz.lonact.loanDetails.amendPastPaidSchedules = apz.getElmValue("lonact__Preferences__AmendCbox");
        apz.lonact.loanDetails.liquidationMode = apz.getElmValue("lonact__Preferences__LiquidationMode");
        apz.lonact.loanDetails.partialLiquidation = apz.getElmValue("lonact__Preferences__PartialLiquidation");
        apz.lonact.loanDetails.statusChangeMode = apz.getElmValue("lonact__Preferences__StatusChangeMode");
        apz.lonact.loanDetails.loanStatementRequired = apz.getElmValue("lonact__Preferences__LoanStatementReq");
        if (apz.lonact.loanDetails.loanStatementRequired === "Y") {
            apz.lonact.loanDetails.statementStartDate = apz.getElmValue("lonact__Preferences__StatementStDate");
            apz.lonact.loanDetails.reminderFrequency = apz.getElmValue("lonact__Preferences__RemFrequency");
            apz.lonact.loanDetails.frequencyUnit = apz.getElmValue("lonact__Preferences__FrequencyUnit");
        }
    } else if (lParam === "Components") {}
};
apz.lonact.LoanCreation.fnClickCustId = function() {
    debugger;
    var params = {
        "targetId": "lonact__LoanCreation__CustModal"
    }
    apz.toggleModal(params);
    apz.data.loadJsonData("CustomerDetails", "lonact");
}
apz.lonact.LoanCreation.fnSelectCustId = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var lcustId = apz.getElmValue("lonact__CustomerDetails__o__LIstItem__CustomerID_" + lrow);
    var lcustName = apz.getElmValue("lonact__CustomerDetails__o__LIstItem__CustomerName_" + lrow);
    apz.setElmValue("lonact__LoanCreation__inpCustId", lcustId);
    apz.setElmValue("lonact__Main__inpCustName", lcustName);
    var params = {
        "targetId": "lonact__LoanCreation__CustModal"
    }
    apz.toggleModal(params);
}
apz.lonact.LoanCreation.fnClickProduct = function() {
    debugger;
    var params = {
        "targetId": "lonact__LoanCreation__ProdModal"
    }
    apz.toggleModal(params);
    apz.data.loadJsonData("ProductList", "lonact");
}
apz.lonact.LoanCreation.fnSelectProduct = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var lproduct = apz.getElmValue("lonact__ProductList__o__LIstItem__ProductName_" + lrow);
    apz.setElmValue("lonact__LoanCreation__Product", lproduct);
    var params = {
        "targetId": "lonact__LoanCreation__ProdModal"
    }
    apz.toggleModal(params);
}
