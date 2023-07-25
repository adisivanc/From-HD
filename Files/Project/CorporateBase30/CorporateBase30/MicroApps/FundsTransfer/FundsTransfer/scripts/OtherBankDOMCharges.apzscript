apz.acft01.otherBankDOMCharges = {};
apz.app.onLoad_OtherBankDOMCharges = function() {
    apz.data.loadJsonData("OtherBankDOMCharges");
}
apz.acft01.otherBankDOMCharges.selectedCharge = function(pObj) {
    var lRowNo = $(pObj).attr("rowno");
    var lType = apz.data.scrdata.acft01__OtherBankDOMChargeType_Res.ChargeType[lRowNo].type;
    if (lType == "ACH") {
        apz.launchSubScreen({
            appId: "acft01",
            scr: "ACHDetails",
            div: "acft01__OtherBankDOM__charge_launcher",
            layout: "All"
        });
    }
}