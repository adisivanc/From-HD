apz.acsf01.importDetails = {};
apz.app.onLoad_ImportDetails = function(params) {
    debugger;
    apz.acsf01.importDetails.showImportDetails(params.ImportDetails);
};
apz.acsf01.importDetails.showImportDetails = function(pImportDetails) {
    debugger;
    apz.data.scrdata.acsf01__ImportDetailsDummy_Res = {};
    apz.data.scrdata.acsf01__ImportDetailsDummy_Res.TbDbmiCorpUploadMaster = pImportDetails;
    apz.data.loadData("ImportDetailsDummy", 'acsf01');
    apz.data.loadJsonData("ProductList","acsf01");
};
apz.acsf01.importDetails.Back = function() {
    $("#acsf01__ImportSummary__Import_Details_Row").addClass("sno");
    $("#acsf01__ImportSummary__ImportSummary-Data").removeClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Approve").removeClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Header").removeClass("sno");
    $("#acsf01__ImportSummary__MobImportSummary_Header").removeClass("sno");
    apz.setTableHeight("acsf01__ImportSummary__Imports_Table", false);
};
apz.acsf01.importDetails.Approve = function() {
    debugger;
    apz.data.scrdata.acsf01__ImportDetailsDummy_Res.TbDbmiCorpUploadMaster.Status = "APPROVED";
    var req = {};
    req.TbDbmiCorpUploadMaster = []
    req.TbDbmiCorpUploadMaster.push(apz.data.scrdata.acsf01__ImportDetailsDummy_Res.TbDbmiCorpUploadMaster);
    req.importFunction = "Authorise";
    var lReq = {
        "ifaceName": "ImportSummary",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.importDetails.approveImportsCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsf01.importDetails.approveImportsCB = function(pResp) {
    debugger;
    if (pResp.status) {
        var req = {};
        req.TbDbmiCorpUploadMaster = pResp.req.TbDbmiCorpUploadMaster;
        req.importFunction = "MoveToFinalTable";
        req.Template_Type = "INVOICE";
        var lReq = {
            "ifaceName": "ImportSummary",
            "paintResp": "Y",
            "buildReq": "N",
            "req": req,
            "appId": "acsf01",
            "async": false,
            "callBack": apz.acsf01.importDetails.approveFinalCB,
            "callBackObj": ""
        };
        apz.server.callServer(lReq);
    }
};
apz.acsf01.importDetails.approveFinalCB = function(pResp) {
    debugger;
     var lMsg = {};
        lMsg.code = "IMPORT_APPROVED";
        apz.dispMsg(lMsg);
        
    $("#acsf01__ImportSummary__Import_Details_Row").addClass("sno");
    $("#acsf01__ImportSummary__ImportSummary-Data").removeClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Approve").removeClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Header").removeClass("sno");
    $("#acsf01__ImportSummary__MobImportSummary_Header").removeClass("sno");
    apz.setTableHeight("acsf01__ImportSummary__Imports_Table", false);
    apz.acsf01.importSummary.getImportSummary();
};
apz.acsf01.importDetails.Reject = function() {
    apz.data.scrdata.acsf01__ImportDetailsDummy_Res.TbDbmiCorpUploadMaster.Status = "REJECTED";
    var req = {};
    req.TbDbmiCorpUploadMaster = [];
    req.TbDbmiCorpUploadMaster.push(apz.data.scrdata.acsf01__ImportDetailsDummy_Res.TbDbmiCorpUploadMaster);
        req.importFunction = "Authorise";
        var lReq = {
            "ifaceName": "ImportSummary",
            "paintResp": "Y",
            "buildReq": "N",
            "req": req,
            "appId": "acsf01",
            "async": false,
            "callBack": apz.acsf01.importDetails.rejectImportsCB,
            "callBackObj": ""
        };
        apz.server.callServer(lReq);
    
};
apz.acsf01.importDetails.rejectImportsCB = function(pResp) {
     var lMsg = {};
        lMsg.code = "IMPORT_REJECTED";
        apz.dispMsg(lMsg);
        $("#acsf01__ImportSummary__Import_Details_Row").addClass("sno");
    $("#acsf01__ImportSummary__ImportSummary-Data").removeClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Approve").removeClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Header").removeClass("sno");
    $("#acsf01__ImportSummary__MobImportSummary_Header").removeClass("sno");
    apz.setTableHeight("acsf01__ImportSummary__Imports_Table", false);
    apz.acsf01.importSummary.getImportSummary();
};
