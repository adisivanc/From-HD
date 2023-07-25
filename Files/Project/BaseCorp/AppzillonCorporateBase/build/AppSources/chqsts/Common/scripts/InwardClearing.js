apz.chqsts.inwardClearing = {};
apz.app.onShown_InwardClearing = function(Params) {
    debugger;
    apz.data.scrdata.chqsts__InwardClearing_Res = {};
    apz.data.scrdata.chqsts__InwardClearing_Res.tbDbtpChequedetails = Params.data.ChequeData;
    apz.data.loadData("InwardClearing", "chqsts");
};
apz.chqsts.inwardClearing.fnOpenImage = function() {
    debugger;
    apz.toggleModal({
        "targetId": "chqsts__InwardClearing__cheque_image"
    });
};
apz.chqsts.inwardClearing.fnCancel = function() {
    debugger;
    $("#chqsts__ClearingChequeSummary__LaunchScreen").addClass("sno");
    $("#chqsts__ClearingChequeSummary__AccNumRow").removeClass("sno");
    $("#chqsts__ClearingChequeSummary__ListRow").removeClass("sno");
};
