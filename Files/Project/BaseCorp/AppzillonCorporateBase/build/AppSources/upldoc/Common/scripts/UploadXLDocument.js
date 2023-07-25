apz.upldoc.UploadXLDocument = {};
apz.upldoc.UploadXLDocument.sCache = {};
var counter = 1;
apz.app.onLoad_UploadXLDocument = function(params) {
    apz.upldoc.UploadXLDocument.sCache = params;
    $(".filebox").next().addClass("sno");
};

apz.app.onShown_UploadXLDocument = function(params) {
    $(".BrowseToUpload").attr({
        "ondrop": "apz.upldoc.UploadXLDocument.fnGetDroppedFile(event)",
        "ondragover": "apz.upldoc.UploadXLDocument.allowDrop(event)"
    });
   
}

// apz.upldoc.UploadXLDocument.uploadDocument = function(pthis) {
//     debugger;
   
//         $("#upldoc__UploadXLDocument__fileUpload").trigger("click");
    
// }

apz.upldoc.UploadXLDocument.allowDrop = function(e) {
    e.preventDefault();
}

apz.upldoc.UploadXLDocument.fnGetDroppedFile = function(e) {
    e.preventDefault();
    apz.upldoc.UploadXLDocument.fileList = e.target.files || e.dataTransfer.files;
    apz.setElmValue("upldoc__UploadXLDocument__txtfile",e.dataTransfer.files[0].name)
    //$("#upldoc__UploadXLDocument__fileUpload").trigger("clik");
}

apz.upldoc.UploadXLDocument.fnSubmitDetails = function() {
    debugger;
    apz.upldoc.UploadXLDocument.XLParse();
};
apz.upldoc.UploadXLDocument.XLParse = function() {
    debugger;
    if ($("#upldoc__UploadXLDocument__fileUpload").prop("files").length > 0) {
        apz.upldoc.UploadXLDocument.getBase64($("#upldoc__UploadXLDocument__fileUpload").prop("files")[0]);
    }
    else if(apz.upldoc.UploadXLDocument.fileList.length > 0){
        apz.upldoc.UploadXLDocument.getBase64(apz.upldoc.UploadXLDocument.fileList[0]);
    }
    
    else {
        var msg = {};
        msg.code = "APZ-CNT-009";
        apz.dispMsg(msg);
        apz.upldoc.UploadXLDocument.sCache.onXLUPloadCBmethod(apz.upldoc.UploadXLDocument.sCache.scrdata);
    }
};
apz.upldoc.UploadXLDocument.getBase64 = function(file) {
    var reader = new FileReader();
    reader.readAsBinaryString(file);
    reader.onload = function(e) {
        var data = e.target.result;
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
        workbook.SheetNames.forEach(function(sheetName) {
            debugger;
            if (sheetName == "MultipleTransfer") {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                console.log(json_object);
                apz.upldoc.UploadXLDocument.parseAndPaintData(json_object);
            }
            
            if (sheetName == "AchPayments") {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                console.log(json_object);
                apz.upldoc.UploadXLDocument.parseAndPaintACHData(json_object);
            }
            
            
        })
    };
    reader.onerror = function(error) {
        console.log('Error: ', error);
    };
};
apz.upldoc.UploadXLDocument.parseAndPaintData = function(params) {
    debugger;
    var lres = params;
    params = JSON.parse(lres.replace(/From Account/g, "fromAccount").replace(/Transfer Type/g, "type").replace(/Beneficiary Account/g, "toAccount").replace(/Currency/g, "currency").replace(/Amount/g, "amount").replace(/Email/g, "emailId").replace(/IFSC/g, "ifscCode").replace(/Beneficiary Name/g, "benificiaryName"));
    var lDetails = params;
    apz.upldoc.UploadXLDocument.sCache.callBack(lDetails);
};

apz.upldoc.UploadXLDocument.parseAndPaintACHData = function(params) {
    debugger;
    var lres = params;
    params = JSON.parse(lres.replace(/Transaction Date/g, "txnDate").replace(/Amount/g, "amount").replace(/Account Number/g, "toAccount").replace(/Vendor Id/g, "vendorId").replace(/Vendor Description/g, "vendorDesc").replace(/ABA Code/g, "abaCode").replace(/Account Type/g, "accountType").replace(/Transaction Code/g, "transactionCode"));
    var lDetails = params;
    apz.upldoc.UploadXLDocument.sCache.callBack(lDetails);
};
apz.upldoc.UploadXLDocument.fnBack = function() {
    apz.upldoc.UploadXLDocument.sCache.backFunction();
}
