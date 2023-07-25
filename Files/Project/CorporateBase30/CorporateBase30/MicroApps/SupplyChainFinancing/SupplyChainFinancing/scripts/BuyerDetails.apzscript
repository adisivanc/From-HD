apz.acsf01.buyerDetails = {};
apz.app.onLoad_BuyerDetails = function(params) {
    debugger;
    apz.acsf01.buyerDetails.showPartyDetails(params.Partydetails);
};
apz.acsf01.buyerDetails.Back = function() {
    $("#acsf01__BuyerSummary__PartySummary_Header").removeClass('sno');
    $("#acsf01__BuyerSummary__MobPartySummary_Header").removeClass('sno');
    $("#acsf01__BuyerSummary__PartySummary_List_Row").removeClass('sno');
    $("#acsf01__BuyerSummary__PartyLauncherRow").addClass('sno');
};
apz.acsf01.buyerDetails.showPartyDetails = function(pPartyDetails) {
    debugger;
    apz.data.scrdata.acsf01__PartyDetailsDummy_Res = {};
    apz.data.scrdata.acsf01__PartyDetailsDummy_Res.tbDbmiCorpScfParty = pPartyDetails;
    apz.data.loadData("PartyDetailsDummy", 'acsf01');
    if(pPartyDetails.logo != undefined && pPartyDetails.logo != "" && pPartyDetails.logo.indexOf("user-placeholder") == -1){
    var blob = convertBase64toBlob(pPartyDetails.logo);
    var blobUrl = URL.createObjectURL(blob);
    $("#acsf01__PartyDetailsDummy__o__tbDbmiCorpScfParty__logo").attr("src", blobUrl);
    }else{
        $("#acsf01__PartyDetailsDummy__o__tbDbmiCorpScfParty__logo").attr("src", 'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
    }
};

function convertBase64toBlob(content, contentType) {
    contentType = contentType || '';
    var sliceSize = 512;
    var byteCharacters = window.atob(content); //method which converts base64 to binary
    var byteArrays = [];
    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);
        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }
        var byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }
    var blob = new Blob(byteArrays, {
        type: contentType
    }); //statement which creates the blob
    return blob;
};
