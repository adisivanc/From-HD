apz.lonact.Preferences = {};
apz.app.onLoad_Preferences = function(userObj) {
    debugger;
    apz.lonact.continueFlag = "Preferences";
    if (apz.lonact.loanDetails.liquidateBack) {
        apz.setElmValue("lonact__Preferences__LiquidateCbox", apz.lonact.loanDetails.liquidateBack);
        apz.setElmValue("lonact__Preferences__AmendCbox", apz.lonact.loanDetails.amendPastPaidSchedules);
        apz.setElmValue("lonact__Preferences__LiquidationMode", apz.lonact.loanDetails.liquidationMode);
        apz.setElmValue("lonact__Preferences__PartialLiquidation", apz.lonact.loanDetails.partialLiquidation);
        apz.setElmValue("lonact__Preferences__StatusChangeMode",apz.lonact.loanDetails.statusChangeMode);
        apz.setElmValue("lonact__Preferences__LoanStatementReq",apz.lonact.loanDetails.loanStatementRequired);
        if (apz.lonact.loanDetails.loanStatementRequired === "Y") {
             apz.lonact.Preferences.fnHideShowForm();
             apz.setElmValue("lonact__Preferences__StatementStDate",apz.lonact.loanDetails.statementStartDate);
             apz.setElmValue("lonact__Preferences__RemFrequency",apz.lonact.loanDetails.reminderFrequency);
             apz.setElmValue("lonact__Preferences__FrequencyUnit",apz.lonact.loanDetails.frequencyUnit);
        }
    }
};
apz.lonact.Preferences.fnHideShowForm = function() {
    debugger;
    var status = $("#lonact__Preferences__ct_frm_3").hasClass("sno");
    if (status == true) {
        $("#lonact__Preferences__ct_frm_3").removeClass("sno");
    } else {
        $("#lonact__Preferences__ct_frm_3").addClass("sno");
    }
};
