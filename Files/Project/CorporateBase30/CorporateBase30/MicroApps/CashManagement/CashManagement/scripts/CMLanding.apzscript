apz.accm01.CMLanding = {};
apz.accm01.CMLanding.sCorporateId = "";
apz.app.onLoad_CMLanding = function(params) {
    debugger;
    $("#accm01__CMLanding__CashManagement_Menu li").click(function() {
        apz.accm01.CMLanding.listClick(this);
    });
    $("#accm01__CMLanding__CashManagement_Menu_row").trigger('click');
};
apz.accm01.CMLanding.listClick = function(pObj) {
    debugger;
    $(pObj).parent().find('.selected').removeClass('selected');
    $(pObj).addClass('selected');
    var lClickedText = pObj.textContent;
    $("#accm01__CMLanding__Header_Title").text(lClickedText);
    var params = {};
    params.appId = "accm01";
    params.layout = "All";
    params.div = "accm01__CMLanding__LaunchCMSummaryHere";
    if (lClickedText == "Notional Pooling") {
        params.scr = "NotionalPooling";
    } else if (lClickedText == "Cash Pooling") {
        params.scr = "CashPooling";
    } else {
        return;
    }
    apz.launchSubScreen(params);
};
apz.accm01.CMLanding.addNew = function() {
    var lActiveOption = $("#accm01__CMLanding__CashManagement_Menu").find('.selected').text();
    var params = {};
    params.appId = "accm01";
    params.layout = "All";
    params.div = "accm01__CMLanding__CMInnerScreensLaunch";
    params.userObj = {
        "action": "ADD"
    };
    if (lActiveOption == "Notional Pooling") {
        params.scr = "NotionalPoolMaintenance";
    } else if (lActiveOption == "Cash Pooling") {
        params.scr = "CashPoolMaintenance";
    } else {
        return;
    }
    $("#accm01__CMLanding__CMLandingRow").addClass('sno');
    $("#accm01__CMLanding__CMInnerScreensLaunch").removeClass('sno');
    $("#accm01__CMLanding__grayheaderrow").addClass('sno');
    apz.launchSubScreen(params);
};
