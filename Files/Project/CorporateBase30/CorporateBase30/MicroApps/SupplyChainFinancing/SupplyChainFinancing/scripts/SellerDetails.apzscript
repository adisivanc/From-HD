apz.acsf01.sellerDetails = {};
apz.app.onLoad_SellerDetails = function(params) {
    debugger;
    apz.acsf01.sellerDetails.showPartyDetails(params.Partydetails);
    apz.data.loadJsonData("DocumentList", "acsf01");
};
apz.acsf01.sellerDetails.Back = function() {
    $("#acsf01__SellerSummary__PartySummary_Header").removeClass('sno');
     $("#acsf01__SellerSummary__MobPartySummary_Header").removeClass('sno');
    $("#acsf01__SellerSummary__PartySummary_List_Row").removeClass('sno');
    $("#acsf01__SellerSummary__PartyLauncherRow").addClass('sno');
};
apz.acsf01.sellerDetails.showPartyDetails = function(pPartyDetails) {
    debugger;
    apz.data.scrdata.acsf01__PartyDetailsDummy_Res = {};
    apz.data.scrdata.acsf01__PartyDetailsDummy_Res.tbDbmiCorpScfParty = pPartyDetails;
    apz.data.loadData("PartyDetailsDummy", 'acsf01');
    if (pPartyDetails.logo != undefined && pPartyDetails.logo != "") {
        var blob = convertBase64toBlob(pPartyDetails.logo);
        var blobUrl = URL.createObjectURL(blob);
        $("#acsf01__PartyDetailsDummy__o__tbDbmiCorpScfParty__logo").attr("src", blobUrl);
    } else {
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
apz.acsf01.sellerDetails.fnDownload = function(pthis) {
    debugger;
    // var lfilename = apz.getObjValue(pthis);
    // var json = {
    //     "destinationPath": "Downloads",
    //     "filePath": "Upload/user1",
    //     "sessionReq": "Y" //Y or N
    // }
    // json.fileName = lfilename;
    // json.base64 = "N";
    // json.id = "DOWNLOADFILE_ID";
    // json.callBack = apz.acsf01.sellerDetails.fnDownloadCB;
   // apz.ns.downloadFile(json);
    
     var myBase64string = apz.data.scrdata.acsf01__DocumentList_Res.documents[0].base64;
     var objbuilder = '';
    objbuilder += ('<object width="100%" height="100%" data="data:image/jpeg;base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="application/pdf" class="internal">');
    objbuilder += ('<embed src="data:image/jpeg;base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="image/jpeg"  />');
    objbuilder += ('</object>');
    var win = window.open("#", "_blank");
    var title = "Trade License";
    win.document.write('<html><title>' + title + '</title><body style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px;">');
    win.document.write(objbuilder);
    win.document.write('</body></html>');
    var layer = jQuery(win.document);
    
};
apz.acsf01.sellerDetails.fnDownloadCB = function(pResp) {
    debugger;
    if (params.status) {
        console.log("success");
    } else {
        console.log("error");
    }
};
