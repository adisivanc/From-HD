apz.docupl.DocumentUpload = {};
apz.app.onLoad_DocumentUpload = function(params) {
    debugger;
    apz.setElmValue("docupl__DocumentUpload__inpcomanyName", apz.Login.sCorporateId);
    
    var docTypeList = JSON.parse(apz.getFile(apz.getDataFilesPath("docupl") + "/DocumentTypeList.json")).CorporateDocs;
    apz.data.scrdata.docupl__CorporateDocuments_Req = {
        tbComiCorporateDocuments: docTypeList
    }
    for (var i = 0; i < docTypeList.length; i++) {
        apz.data.scrdata.docupl__CorporateDocuments_Req.tbComiCorporateDocuments[i].document = "upimg25.png";
        
       
    }
    apz.docupl.DocumentUpload.tempDocArr = apz.data.scrdata.docupl__CorporateDocuments_Req.tbComiCorporateDocuments;
    apz.data.loadData("CorporateDocuments", "docupl");
   
}


apz.docupl.DocumentUpload.fnBrowseCorpDoc = function(pThis) {
    debugger;
    apz.docupl.DocumentUpload.lCorprow = $(pThis).attr("rowNo");
    $("#docupl__DocumentUpload__browsefile").trigger("click");
}
apz.docupl.DocumentUpload.fnGetFile = function(pthis) {
    debugger;
    let fileObj = pthis.files[0];
    apz.docupl.DocumentUpload.ldocName = fileObj.name;
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        var encodedImage = binaryStr.split(",").pop();
        apz.docupl.DocumentUpload.fnGetBase64({
            encodedImage
        })
        $("#" + pthis.id).val("");
    }
    apzFileReader.readAsDataURL(fileObj);
}
apz.docupl.DocumentUpload.fnGetBase64 = function(params) {
    debugger;
    apz.data.scrdata.docupl__CorporateDocuments_Req.tbComiCorporateDocuments[apz.docupl.DocumentUpload.lCorprow].document = params.encodedImage;
    apz.data.scrdata.docupl__CorporateDocuments_Req.tbComiCorporateDocuments[apz.docupl.DocumentUpload.lCorprow].documentName = apz.docupl.DocumentUpload
        .ldocName;
    apz.setElmValue("docupl__CorporateDocuments__i__tbComiCorporateDocuments__document_" + apz.docupl.DocumentUpload.lCorprow, params.encodedImage);
    apz.setElmValue("docupl__CorporateDocuments__i__tbComiCorporateDocuments__documentName_" + apz.docupl.DocumentUpload.lCorprow, apz.docupl.DocumentUpload
        .ldocName);
}
apz.docupl.DocumentUpload.fnSaveApplicationDetails = function() {
    debugger;
    
    apz.dispMsg({
        "message": "Documents Uploaded Successfully",
        "type": "S",
        "callBack":apz.docupl.DocumentUpload.fnSaveApplicationDetailsCB
    })
   
}

apz.docupl.DocumentUpload.fnSaveApplicationDetailsCB = function(params){
     var params = {};
    params.appId = "docupl";
    params.scr = "DocumentUpload";
    params.layout = "All";
    params.description = "";
    params.div = "ACNR01__Navigator__launchPad";
   
    apz.launchApp(params);
}

apz.docupl.DocumentUpload.fnSendMail = function() {
    debugger;
    apz.dispMsg({
        "message": "A link to update details has been sent successfully to registered email Id",
        "type": "S"
        
    })
}
apz.docupl.DocumentUpload.fnShowDocument = function(pthis) {
    var lrow = $(pthis).attr("rowno");
    var limg = apz.getElmValue("docupl__CorporateDocuments__i__tbComiCorporateDocuments__document_" + lrow);
    var docType = apz.getElmValue("docupl__CorporateDocuments__i__tbComiCorporateDocuments__documentType_" + lrow);
    if(limg.indexOf("upimg25.png")== -1){
         apz.toggleModal({
        targetId: "docupl__DocumentUpload__previewModal"
    });
    apz.setElmValue("docupl__DocumentUpload__inpDocType", docType);
    apz.setElmValue("docupl__DocumentUpload__viewImg", limg);
    }
   
}

