apz.duitnw.IDInputStage = {};
apz.app.onLoad_IDInputStage = function() {
    $("#duitnw__IDInputStage__ct_tbl_1 .pgn-ctr").addClass("sno");
    apz.data.loadJsonData("IDType", "duitnw");
};
apz.duitnw.IDInputStage.next = function() {
    apz.data.buildData("AddID", "duitnw");
    var rowno = $("input[type='radio']:checked").attr("rowno")
    var currRow = apz.data.scrdata.duitnw__IDType_Res[rowno];
    apz.data.scrdata.duitnw__AddID_Req.type = currRow.type;
    apz.data.scrdata.duitnw__AddID_Req.number = currRow.number;
    apz.launchSubScreen({
        div: "duitnw__IDLauncher__launcher",
        scr: "IDVerifyStage",
        layout: "All"
    });
};
apz.duitnw.IDInputStage.back = function() {
    apz.launchSubScreen({
        div: "duitnw__IDLauncher__launcher",
        scr: "IDSummary",
        layout: "All"
    });
};