apz.acsf01.scfTemplateDetails = {};
apz.app.onLoad_SCFTemplateDetails = function(params) {
    debugger;
    if (apz.Login) {
        apz.acsf01.scfTemplateDetails.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acsf01.scfTemplateDetails.sCorporateId = "000FTAC4321";
    }
    $("#acsf01__SCFTemplateSummary__SCFrow").hide();
    $("#acsf01__SCFTemplateSummary__MobSCFrow").hide();
    $(".adr-ctr").hide();
    apz.acsf01.scfTemplateDetails.lScrData = params.data.SCFData;
    apz.data.scrdata.acsf01__SCFTemplate_Req = {};
    apz.data.scrdata.acsf01__SCFTemplate_Req.tbDbmiCorpFileTemplate = {};
    apz.data.scrdata.acsf01__SCFTemplate_Req.tbDbmiCorpFileTemplate.templateType = apz.acsf01.scfTemplateDetails.lScrData.templateType;
    apz.data.scrdata.acsf01__SCFTemplate_Req.tbDbmiCorpFileTemplate = apz.acsf01.scfTemplateDetails.lScrData;
    var lkeys = Object.keys(JSON.parse(params.data.SCFData.template));
    var larr = [];
    for (var i = 0; i < lkeys.length; i++) {
        debugger;
        var ldb = JSON.parse(params.data.SCFData.template)[lkeys[i]].dbcolumn;
        var lSourceField = JSON.parse(params.data.SCFData.template)[lkeys[i]].sourcefield;
        var lDataLength = JSON.parse(params.data.SCFData.template)[lkeys[i]].datalength;
        var lDataType = JSON.parse(params.data.SCFData.template)[lkeys[i]].datatype;
        larr.push({
            "fieldname": lkeys[i],
            "dbColumn": ldb,
            "sourcefield": lSourceField,
            "datatype": lDataType,
            "datalength": lDataLength
        });
    }
    apz.data.scrdata.acsf01__SCFTemplate_Req.MappingTable = larr;
    apz.data.loadData("SCFTemplate", "acsf01");
};
apz.acsf01.scfTemplateDetails.fnCancel = function() {
    debugger;
    $("#acsf01__SCFTemplateSummary__launchScreenRow").addClass("sno");
    $("#acsf01__SCFTemplateSummary__SCFrow").show();
    $("#acsf01__SCFTemplateSummary__MobSCFrow").show();
    $("#acsf01__SCFTemplateSummary__SummaryRow").removeClass("sno");
};
