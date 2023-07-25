apz.aclo01.ApplyLoan = {};
apz.app.onLoad_ApplyLoan = function(params) {
    apz.data.createRow("aclo01__ApplyLoan__ct_tbl_1");
    apz.data.createRow("aclo01__ApplyLoan__ct_tbl_2")
}
apz.aclo01.ApplyLoan.fnLoanCalc = function() {
    var lparam = {
        "appId": "aclo01",
        "scr": "LoanSimulator",
        "div": "aclo01__LoansSummary__LoanDetailsLaunch",
        "layout": "All",
        "userObj": {
            "callBack": apz.aclo01.ApplyLoan.getLoanSimulator
        }
    };
    apz.launchSubScreen(lparam);
}
apz.aclo01.ApplyLoan.getLoanSimulator = function() {
    apz.show("aclo01__LoansSummary__LoansSummaryList");
    apz.show("aclo01__LoansSummary__LoansSummaryHeader");
    apz.show("aclo01__LoansSummary__LoanSummarySearchrow");
    apz.hide("aclo01__LoansSummary__LoanDetailsLaunchRow");
}
apz.aclo01.ApplyLoan.fnSubmit = function() {
    var params = {};
    params.message = "Loan applied successfully";
    params.type = "S";
    params.callBack = apz.aclo01.ApplyLoan.fnSubmitCB;
    apz.dispMsg(params);
}

apz.aclo01.ApplyLoan.fnSubmitCB = function(){
    apz.aclo01.ApplyLoan.getLoanSimulator();
}

apz.aclo01.ApplyLoan.fnGetFile= function(pthis){
    debugger;
    apz.aclo01.ApplyLoan.rowno = $(pthis).attr("rowno");
    var documentType=apz.getElmValue("aclo01__UploadDocs__o__Docs__DocType_"+apz.aclo01.ApplyLoan.rowno);
    if(documentType !==""){
            let fileObj = pthis.files[0];
            let apzFileReader = new FileReader();
            apzFileReader.onload = function() {
                debugger;
                let binaryStr = apzFileReader.result;
                //apz.usrdtl.AddtionalDetails.signatoryDocuments[documentType]=binaryStr.split(",").pop();;
                apz.aclo01.ApplyLoan.fnShowFile(binaryStr);
                $("#" + pthis.id).val("");
            }
            apzFileReader.readAsDataURL(fileObj);
    }
    else{
        apz.dispMsg({
            "message": "Please select the document type for the document you are trying to upload."
        })
    }
}

apz.aclo01.ApplyLoan.fnShowFile = function(fileBase64) {
   debugger;
    //$("#usrdtl__DocumentDetails__" + docName + "_nav").removeClass("sno");
    apz.setElmValue("aclo01__UploadDocs__o__Docs__DocImg_" + apz.aclo01.ApplyLoan.rowno, fileBase64);
    
}

apz.aclo01.ApplyLoan.fnImgModal = function(pThis){
    debugger;
    apz.toggleModal({targetId:"aclo01__ApplyLoan__imgmodal"});
     apz.setElmValue("aclo01__ApplyLoan__viewimg" , $(pThis).attr("src"));
    
}
