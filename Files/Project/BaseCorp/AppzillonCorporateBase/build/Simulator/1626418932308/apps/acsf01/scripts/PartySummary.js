apz.acsf01.partySummary = {};
apz.app.onLoad_PartySummary = function() {
    if (apz.Login) {
        apz.acsf01.partySummary.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acsf01.partySummary.sCorporateId = "000FTAC4321";
    }
    apz.acsf01.partySummary.getPartySummary();
};
apz.acsf01.partySummary.getPartySummary = function() {
    debugger;
    var req = {};
    req.tbDbmiCorpScfParty = {
        "corporateId": apz.acsf01.partySummary.sCorporateId,
        "type": "All"
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_scf_party";
    var lReq = {
        "ifaceName": "PartySummary",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.partySummary.getPartySummaryCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsf01.partySummary.getPartySummaryCB = function(pResp) {
    debugger;
};
apz.acsf01.partySummary.createParty = function() {
    debugger;
    $("#acsf01__PartySummary__PartySummary_Header").addClass('sno');
    $("#acsf01__PartySummary__MobPartySummary_Header").addClass('sno');
    $("#acsf01__PartySummary__PartySummary_List_Row").addClass('sno');
    $("#acsf01__PartySummary__PartyLauncherRow").removeClass('sno');
    var params = {};
    params.appId = "acsf01";
    params.scr = "PartyMaintenance";
    params.userObj = {
        "action":"New"
    };
    params.div = "acsf01__PartySummary__PartyDetailsLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
    
};
apz.acsf01.partySummary.partyDetails = function(pObj) {
    debugger;
    $("#acsf01__PartySummary__PartySummary_Header").addClass('sno');
     $("#acsf01__PartySummary__MobPartySummary_Header").addClass('sno');
    $("#acsf01__PartySummary__PartySummary_List_Row").addClass('sno');
    $("#acsf01__PartySummary__PartyLauncherRow").removeClass('sno');
    var lRow = $(pObj).attr('rowno');
    var params = {};
    params.appId = "acsf01";
    params.scr = "PartyDetails";
    params.userObj = {
        "Partydetails": apz.data.scrdata.acsf01__PartySummary_Res.tbDbmiCorpScfParty[lRow]
    };
    params.div = "acsf01__PartySummary__PartyDetailsLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.acsf01.partySummary.editParty = function(pObj) {
    debugger;
    $("#acsf01__PartySummary__PartySummary_Header").addClass('sno');
    $("#acsf01__PartySummary__MobPartySummary_Header").addClass('sno');
    $("#acsf01__PartySummary__PartySummary_List_Row").addClass('sno');
    $("#acsf01__PartySummary__PartyLauncherRow").removeClass('sno');
    var lRow = $(pObj).closest("li").attr('rowno');
    var params = {};
    params.appId = "acsf01";
    params.scr = "PartyMaintenance";
    params.userObj = {
        "action":"Edit",
        "Partydetails": apz.data.scrdata.acsf01__PartySummary_Res.tbDbmiCorpScfParty[lRow]
    };
    params.div = "acsf01__PartySummary__PartyDetailsLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
    event.stopPropagation();
};
apz.acsf01.partySummary.search = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acsf01__PartySummary__searchBy");
        var lInput = apz.getElmValue("acsf01__PartySummary__inputSearch");
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            lSearchType = "All";
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "All") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "All";
            }
        } else if (lType == "Buyer") {
            lSearchType = "Buyer";
        } else if (lType == "Seller") {
            lSearchType = "Seller";
        } else if (lType == "PartyId") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "PartyId";
            }
        } else if (lType == "PartyName") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "PartyName";
            }
        }
        if (flag) {
            debugger;
            var req = {};
            req.tbDbmiCorpScfParty = {
                "corporateId": apz.acsf01.partySummary.sCorporateId,
                "type": lSearchType,
                "value": lInput
            };
            req.action = "Query";
            req.table = "tb_dbmi_corp_scf_party";
            var lReq = {
                "ifaceName": "PartySummary",
                "paintResp": "Y",
                "buildReq": "N",
                "req": req,
                "appId": "acsf01",
                "async": false,
                "callBack": apz.acsf01.partySummary.getPartySummaryCB,
                "callBackObj": ""
            };
            apz.server.callServer(lReq);
        }
    }
};
