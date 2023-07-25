apz.acsf01.partyDetails = {};
apz.app.onLoad_PartyDetails = function(params) {
    debugger;
    apz.acsf01.partySummary.showPartyDetails(params.Partydetails);
};

apz.acsf01.partyDetails.Back = function(){
    $("#acsf01__PartySummary__PartySummary_Header").removeClass('sno');
    $("#acsf01__PartySummary__MobPartySummary_Header").removeClass('sno');
    $("#acsf01__PartySummary__PartySummary_List_Row").removeClass('sno');
    $("#acsf01__PartySummary__PartyLauncherRow").addClass('sno');
     
};

apz.acsf01.partySummary.showPartyDetails = function(pPartyDetails){
    apz.data.scrdata.acsf01__PartyDetailsDummy_Res = {};
    apz.data.scrdata.acsf01__PartyDetailsDummy_Res.tbDbmiCorpScfParty = pPartyDetails;
    apz.data.loadData("PartyDetailsDummy",'acsf01');
};
