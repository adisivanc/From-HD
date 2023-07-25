apz.acsf01.partyMaintenance = {};
apz.app.onLoad_PartyMaintenance = function(params) {
    debugger;
    if (params.action == "Add") {
        apz.data.scrdata.acsf01__PartyMaintenance_Res = {};
        apz.data.loadData("PartyDetailsMaintenance", 'acsf01');
    } else if (params.action == "Edit") {
        apz.acsf01.partyMaintenance.showPartyDetails(params.Partydetails);
    }
    
};
apz.acsf01.partyMaintenance.getTemplateSummaryCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        //var lEntities = pResp.res.acus01__EntitiesQuery_Res.tbDbmiCorpEntityMaster;
        //var lEntitiesLength = lEntities.length;
        var lArr = [{
            "val": "MultiParty",
            "desc": "Multi Party"
        }];
        /*for (var i = 0; i < lEntitiesLength; i++) {
            var lObj = {
                "val": lEntities[i].entityId,
                "desc": lEntities[i].entityId,
            };
            lArr.push(lObj);
        }
        */
        
        apz.populateDropdown(document.getElementById("acsf01__PartyMaintenance__o__tbDbmiCorpScfParty__templateName"), lArr);
    }
};
apz.acsf01.partyMaintenance.showPartyDetails = function(pPartyDetails) {
    apz.data.scrdata.acsf01__PartyMaintenance_Res = {};
    apz.data.scrdata.acsf01__PartyMaintenance_Res.tbDbmiCorpScfParty = pPartyDetails;
    apz.data.loadData("PartyMaintenance", 'acsf01');
};
apz.acsf01.partyMaintenance.Save = function() {
    var lPartyDetails = apz.data.buildData("PartyMaintenance", "acsf01");
    lPartyDetails = lPartyDetails.acsf01__PartyMaintenance_Res.tbDbmiCorpScfParty;
    lPartyDetails.corporateId = apz.acsf01.partySummary.sCorporateId;
    var lReq = {};
    lReq.PartyDetails = lPartyDetails;
    lReq.action = "Query";
    lReq.table = "tb_dbmi_corp_scf_party";
    var lServerParams = {
        "ifaceName": "PartyMaintenance",
        "buildReq": "N",
        "req": lReq,
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acsf01.partyMaintenance.saveCB,
    };
    apz.server.callServer(lServerParams);
};
apz.acsf01.partyMaintenance.saveCB = function(pResp) {
    debugger;
    if (pResp.status) {
        var lMsg = {};
        lMsg.code = "PARTY_SAVED";
        apz.dispMsg(lMsg);
        $("#acsf01__PartySummary__PartySummary_Header").removeClass('sno');
        $("#acsf01__PartySummary__MobPartySummary_Header").removeClass('sno');
        $("#acsf01__PartySummary__PartySummary_List_Row").removeClass('sno');
        $("#acsf01__PartySummary__PartyLauncherRow").addClass('sno');
    }
};
apz.acsf01.partyMaintenance.Back = function() {
    $("#acsf01__PartySummary__PartySummary_Header").removeClass('sno');
    $("#acsf01__PartySummary__MobPartySummary_Header").removeClass('sno');
    $("#acsf01__PartySummary__PartySummary_List_Row").removeClass('sno');
    $("#acsf01__PartySummary__PartyLauncherRow").addClass('sno');
};
