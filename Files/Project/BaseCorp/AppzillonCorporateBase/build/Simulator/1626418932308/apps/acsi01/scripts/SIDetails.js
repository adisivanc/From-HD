apz.acsi01.SIDetails = {};
apz.acsi01.SIDetails.sAction = "";
apz.app.onLoad_SIDetails = function(userObj) {
    debugger;
    $("#acsi01__StandingInstructions__SIRow").hide();
    apz.acsi01.SIDetails.lScrData = userObj.data.SIData;
    var params = {
        "action": "SI Details"
    };
    apz.acsi01.SIDetails.fnRender(params);
};
apz.acsi01.SIDetails.fnRender = function(params) {
    debugger;
    apz.acsi01.SIDetails.fnRenderData(params);
};
apz.acsi01.SIDetails.fnRenderData = function(params) {
    debugger;
    if (params.action == "SI Details") {
        apz.acsi01.SIDetails.sAction = "SI Details";
        apz.data.scrdata.acsi01__SIDetails_Res = {};
        apz.data.scrdata.acsi01__SIDetails_Res.SISummary = {};
        apz.data.scrdata.acsi01__SIDetails_Res.SISummary = apz.acsi01.SIDetails.lScrData;
        apz.data.loadData("SIDetails", "acsi01");
    }
};
apz.acsi01.SIDetails.fnCancel = function() {
    apz.show("acsi01__StandingInstructions__SIRow");
    $("#acsi01__StandingInstructions__SIAdd").removeClass('sno');
    $("#acsi01__StandingInstructions__SummaryRow").removeClass('sno');
    $("#acsi01__StandingInstructions__launchScreenRow").addClass('sno');
    $("#acsi01__StandingInstructions__SIRow").show();
};
