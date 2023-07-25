apz.acsf01.importSummary = {};
apz.app.onLoad_ImportSummary = function() {
    debugger;
    if (apz.Login) {
        apz.acsf01.importSummary.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acsf01.importSummary.sCorporateId = "000FTAC4321";
    }
    apz.acsf01.importSummary.getImportSummary();
};
apz.acsf01.importSummary.getImportSummary = function() {
    var req = {};
    req.corporateId = apz.acsf01.importSummary.sCorporateId;
    req.templateId = "1";
    req.importFunction = "Summary";
    var lReq = {
        "ifaceName": "ImportSummary",
        "paintResp": "N",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.importSummary.getImportSummaryCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsf01.importSummary.getImportSummaryCB = function(pResp) {
    debugger;
    $("#acsf01__ImportSummary__Imports_Tableul_ttl ul.adr-ctr").addClass('sno');
    $("#acsf01__ImportSummary__Imports_Table_tbody tr.selected").removeClass('selected');
    
     var lTasksArr = pResp.res.acsf01__ImportSummary_Res.TbDbmiCorpUploadMaster;
        var lTaskArrLength = lTasksArr.length;
        for (var i = 0; i < lTaskArrLength; i++) {
            lTasksArr[i].Upload_Date = lTasksArr[i].Upload_Date.substring(0,lTasksArr[i].Upload_Date.length-2);
        }
        apz.data.scrdata.acsf01__ImportSummary_Res = {};
        apz.data.scrdata.acsf01__ImportSummary_Res.TbDbmiCorpUploadMaster = lTasksArr;
        apz.data.loadData("ImportSummary","acsf01");
};
apz.acsf01.importSummary.Save = function() {
    debugger;
    var lImports = apz.data.buildData("ImportSummary", 'acsf01');
};
apz.acsf01.importSummary.launchDetails = function(pObj) {
    /* var lTargetId = $(pEvent.target).attr('for');
    if(lTargetId){
    var lTargetElem = lTargetId.split("_")[8];
    }else{
        lTargetElm = "";
    }
    */
    var pRow = $(pObj).attr("rowno");
    $("#acsf01__ImportSummary__Import_Details_Row").removeClass("sno");
    $("#acsf01__ImportSummary__ImportSummary-Data").addClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Approve").addClass("sno");
    $("#acsf01__ImportSummary__ImportSummary_Header").addClass("sno");
    $("#acsf01__ImportSummary__MobImportSummary_Header").addClass("sno");
    //var lPage = apz.scrMetaData.containersMap['acsf01__ImportSummary__Imports_Table'].currPage;
    //var lRecord = (lPage - 1) * 5 + parseInt(pRow);
    var lImportDetails = apz.data.scrdata.acsf01__ImportSummary_Res.TbDbmiCorpUploadMaster[pRow];
    var params = {};
    params.appId = "acsf01";
    params.scr = "ImportDetails";
    params.userObj = {
        "ImportDetails": lImportDetails
    };
    params.div = "acsf01__ImportSummary__LaunchImportDetails";
    params.layout = "All";
    apz.launchSubScreen(params);
    return false;
};
apz.acsf01.importSummary.Approve = function() {
    debugger;
    var lRows = getSelectedRows('acsf01__ImportSummary__Imports_Table');
    if (lRows != undefined && lRows.length != "0") {
        var lTotalRows = lRows.length;
        var lApprovedArr = [];
        for (var i = 0; i < lTotalRows; i++) {
            apz.data.scrdata.acsf01__ImportSummary_Res.TbDbmiCorpUploadMaster[lRows[i]].Status = "APPROVED";
            lApprovedArr.push(apz.data.scrdata.acsf01__ImportSummary_Res.TbDbmiCorpUploadMaster[lRows[i]]);
        };
        var req = {};
        req.TbDbmiCorpUploadMaster = lApprovedArr;
        req.importFunction = "Authorise";
        var lReq = {
            "ifaceName": "ImportSummary",
            "paintResp": "Y",
            "buildReq": "N",
            "req": req,
            "appId": "acsf01",
            "async": false,
            "callBack": apz.acsf01.importSummary.approveImportsCB,
            "callBackObj": ""
        };
        apz.server.callServer(lReq);
    }
};
apz.acsf01.importSummary.approveImportsCB = function(pResp) {
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
            "callBack": apz.acsf01.importSummary.approveFinalCB,
            "callBackObj": ""
        };
        apz.server.callServer(lReq);
    }
};
apz.acsf01.importSummary.approveFinalCB = function(pResp) {
    var lMsg = {};
    lMsg.code = "IMPORT_APPROVED";
    apz.dispMsg(lMsg);
    apz.acsf01.importSummary.getImportSummary();
};
apz.acsf01.importSummary.Reject = function() {
    var lRows = getSelectedRows('acsf01__ImportSummary__Imports_Table');
    debugger;
    if (lRows != undefined && lRows.length != "0") {
        var lTotalRows = lRows.length;
        var lRejectedArr = [];
        for (var i = 0; i < lTotalRows; i++) {
            apz.data.scrdata.acsf01__ImportSummary_Res.TbDbmiCorpUploadMaster[lRows[i]].Status = "REJECTED";
            lRejectedArr.push(apz.data.scrdata.acsf01__ImportSummary_Res.TbDbmiCorpUploadMaster[lRows[i]]);
        };
        var req = {};
        req.TbDbmiCorpUploadMaster = lRejectedArr;
        req.importFunction = "Authorise";
        var lReq = {
            "ifaceName": "ImportSummary",
            "paintResp": "Y",
            "buildReq": "N",
            "req": req,
            "appId": "acsf01",
            "async": false,
            "callBack": apz.acsf01.importSummary.rejectImportsCB,
            "callBackObj": ""
        };
        apz.server.callServer(lReq);
    }
};
apz.acsf01.importSummary.rejectImportsCB = function(pResp) {
    var lMsg = {};
    lMsg.code = "IMPORT_REJECTED";
    apz.dispMsg(lMsg);
    apz.acsf01.importSummary.getImportSummary();
};
apz.rowSelectorClicked = function(pEvent) {
    var lId = pEvent.target.id;
    var lRowObj = $("#" + lId).closest('tr')[0];
    $(lRowObj).toggleClass('selected');
};
getSelectedRows = function(containerId) {
    debugger;
    var rows = this.apz.scrMetaData.containersMap[containerId].pageRows;
    var value = new Array();
    for (var i = 0; i < rows; i++) {
        var id = containerId + '_row_' + i;
        var className = $('#' + id)[0].className;
        if (className.indexOf('selected') != -1) {
            //value[id] = $('#' + id);
            value.push(i);
        }
    }
    return value;
}
