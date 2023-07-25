apz.acsf01.scfTemplateSummary = {};
apz.acsf01.scfTemplateSummary.sAction = "";
apz.app.onLoad_SCFTemplateSummary = function() {
    if (apz.Login) {
        apz.acsf01.scfTemplateSummary.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acsf01.scfTemplateSummary.sCorporateId = "000FTAC4321";
    }
    apz.acsf01.scfTemplateSummary.getTemplateSummary();
};
apz.acsf01.scfTemplateSummary.getTemplateSummary = function() {
    debugger;
    var req = {};
    req.tbDbmiCorpFileTemplate = {
        "corporateId": apz.acsf01.scfTemplateSummary.sCorporateId,
        "type": "All"
    };
    // req.action = "Query";
    // req.table = "tb_dbmi_corp_file_template";
    req.importFunction = "TemplateSummary";
    var lReq = {
        "ifaceName": "TemplateSummary",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.scfTemplateSummary.getTemplateSummaryCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsf01.scfTemplateSummary.getTemplateSummaryCB = function(pResp) {
    debugger;
};
apz.acsf01.scfTemplateSummary.search = function(event,SearchBy,Search) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acsf01__SCFTemplateSummary__"+SearchBy);
        var lInput = apz.getElmValue("acsf01__SCFTemplateSummary__"+Search);
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_MSGCHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "PartyType") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "partyType";
            }
        } else if (lType == "PartyName") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "partyName";
            }
        } else if (lType == "TemplateType") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "templateType";
            }
        }
        if (flag) {
            var req = {};
            req.tbDbmiCorpFileTemplate = {
                "corporateId": apz.acsf01.scfTemplateSummary.sCorporateId,
                "type": lSearchType,
                "value": lInput
            };
            // req.action = "Query";
            // req.table = "tb_dbmi_corp_file_template";
            req.importFunction = "TemplateSummary";
            var lReq = {
                "ifaceName": "TemplateSummary",
                "paintResp": "Y",
                "buildReq": "N",
                "req": req,
                "appId": "acsf01",
                "async": false,
                "callBack": apz.acsf01.scfTemplateSummary.getPartySummaryCB,
                "callBackObj": ""
            };
            apz.server.callServer(lReq);
        }
    }
};
apz.acsf01.scfTemplateSummary.createTemplate = function() {
    debugger;
    var params = {};
    params.appId = "acsf01";
    params.scr = "SCFTemplate";
    params.layout = "All";
    params.div = "acsf01__SCFTemplateSummary__launchScreen";
    $("#acsf01__SCFTemplateSummary__SummaryRow").addClass('sno');
    $("#acsf01__SCFTemplateSummary__launchScreenRow").removeClass('sno');
    apz.launchSubScreen(params);
};
apz.acsf01.scfTemplateSummary.fnOnSelectSCF = function(lObj, event) {
    debugger;
    //  var lRow = parseInt(lObj.id.split("_")[6]);
    var lRow = $(lObj).attr("rowno");
    var lScrData;
    var lRef = apz.getElmValue("acsf01__TemplateSummary__o__tbDbmiCorpFileTemplate__templateId_" + lRow);
    for (var i = 0; i < apz.data.scrdata.acsf01__TemplateSummary_Res.tbDbmiCorpFileTemplate.length; i++) {
        if (apz.data.scrdata.acsf01__TemplateSummary_Res.tbDbmiCorpFileTemplate[i].templateId == lRef) {
            lScrData = apz.data.scrdata.acsf01__TemplateSummary_Res.tbDbmiCorpFileTemplate[i];
            break;
        }
    }
    var params = {};
    params.appId = "acsf01";
    params.scr = "SCFTemplateDetails";
    params.userObj = {
        "data": {
            "SCFData": lScrData
        }
    };
    params.div = "acsf01__SCFTemplateSummary__launchScreen";
    params.layout = "All";
    $("#acsf01__SCFTemplateSummary__SummaryRow").addClass('sno');
    $("#acsf01__SCFTemplateSummary__launchScreenRow").removeClass('sno');
    apz.launchSubScreen(params);
};
