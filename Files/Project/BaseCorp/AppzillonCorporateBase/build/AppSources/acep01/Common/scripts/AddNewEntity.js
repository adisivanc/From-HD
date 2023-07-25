apz.acep01.AddNewEntity = {};
apz.acep01.AddNewEntity.userLogo = "";
apz.acep01.AddNewEntity.onClickSave = function() {
    var lmsg={};
        lmsg.code="Success_Message";
        apz.dispMsg(lmsg); 
        apz.launchSubScreen({
            appId: "acep01",
            scr: "CorporateHierarchy",
            animation: 2,
            div: "ACNR01__Navigator__gr_row_4" 
        });
}
apz.acep01.AddNewEntity.onClickCancel = function() {
    apz.launchSubScreen({
        appId: "acep01",
        scr: "CorporateHierarchy",
        animation: 2,
        div: "ACNR01__Navigator__gr_row_4" 
    });
}

apz.acep01.AddNewEntity.imageFileSected = function(obj, event) {
    debugger;
    var fileObj = $(obj)[0].files[0];
    var apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        var binaryStr = apzFileReader.result;
        var base64Str = btoa(binaryStr);
        apz.acep01.AddNewEntity.userLogo = base64Str;
        var blob = convertBase64toBlob(base64Str, 'image/jpg');
        var blobUrl = URL.createObjectURL(blob);
        $("#acep01__AddNewEntity__el_img_1").attr("src", blobUrl);
    };
    apzFileReader.readAsBinaryString(fileObj);
} 

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