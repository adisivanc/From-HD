apz.duitnw.TransferInput = {};
apz.duitnw.TransferInput.changeTransferType = function() {
    var transferType = apz.getElmValue("duitnw__TransferInput__rec_type");
    if (transferType == "Favourites") {
        $("#duitnw__TransferInput__nickname_ul").removeClass("sno");
        apz.setElmValue("duitnw__TransferInput__nickname", "");
        apz.setElmValue("duitnw__Transfer__i__duitnw__Transfer_Req__type", "Mobile Number");
        apz.setElmValue("duitnw__Transfer__i__duitnw__Transfer_Req__number", "");
        $("#duitnw__Transfer__i__duitnw__Transfer_Req__type").attr("disabled", "disabled");
        $("#duitnw__Transfer__i__duitnw__Transfer_Req__number").attr("disabled", "disabled");
    } else {
        $("#duitnw__TransferInput__nickname_ul").addClass("sno");
        apz.setElmValue("duitnw__TransferInput__nickname", "");
        apz.setElmValue("duitnw__Transfer__i__duitnw__Transfer_Req__type", "Mobile Number");
        apz.setElmValue("duitnw__Transfer__i__duitnw__Transfer_Req__number", "");
        $("#duitnw__Transfer__i__duitnw__Transfer_Req__type").removeAttr("disabled");
        $("#duitnw__Transfer__i__duitnw__Transfer_Req__number").removeAttr("disabled");
    }
};
apz.duitnw.TransferInput.poplulateFavData = function() {
    var nickName = apz.getElmValue("duitnw__TransferInput__nickname");
    if (nickName == "Md Said") {
        apz.setElmValue("duitnw__Transfer__i__duitnw__Transfer_Req__type", "Mobile Number");
        apz.setElmValue("duitnw__Transfer__i__duitnw__Transfer_Req__number", "9452618182");
    }
}
apz.duitnw.TransferInput.next = function() {
    apz.data.buildData("Transfer", "duitnw");
    apz.launchSubScreen({
        div: "duitnw__TransferLauncher__launcher",
        scr: "TransferVerify",
        layout: "All"
    });
};