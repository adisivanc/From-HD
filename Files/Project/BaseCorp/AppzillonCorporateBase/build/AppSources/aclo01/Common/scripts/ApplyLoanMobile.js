apz.aclo01.ApplyLoanMobile = {};
apz.aclo01.ApplyLoanMobile.liabilityArr = [];
apz.app.onLoad_ApplyLoanMobile = function(params) {
    debugger;
}
apz.aclo01.ApplyLoanMobile.fnLoanCalc = function() {
    var lparam = {
        "appId": "aclo01",
        "scr": "LoanSimulator",
        "div": "aclo01__LoansSummary__LoanDetailsLaunch",
        "layout": "All",
        "userObj": {
            "callBack": apz.aclo01.ApplyLoanMobile.getLoanSimulator
        }
    };
    apz.launchSubScreen(lparam);
}
apz.aclo01.ApplyLoanMobile.getLoanSimulator = function() {
    apz.show("aclo01__LoansSummary__LoansSummaryList");
    apz.show("aclo01__LoansSummary__LoansSummaryHeader");
    apz.show("aclo01__LoansSummary__LoanSummarySearchrow");
    
    apz.hide("aclo01__LoansSummary__LoanDetailsLaunchRow");
}
apz.aclo01.ApplyLoanMobile.fnAddLiabilities = function() {
    debugger;
   
    $("#aclo01__ApplyLoanMobile__liabilityList").removeClass("sno");
    var lobj = {};
    lobj.Bank = apz.getElmValue("aclo01__ApplyLoanMobile__bank");
    lobj.FinancingType = apz.getElmValue("aclo01__ApplyLoanMobile__financingtype");
    lobj.Amoount = apz.getElmValue("aclo01__ApplyLoanMobile__financeamt");
    lobj.MonthlyInstallment = apz.getElmValue("aclo01__ApplyLoanMobile__monthlyins");
    apz.aclo01.ApplyLoanMobile.liabilityArr.push(lobj);
    apz.data.scrdata.aclo01__Liabilities_Res = {};
    apz.data.scrdata.aclo01__Liabilities_Res.liability = apz.aclo01.ApplyLoanMobile.liabilityArr;
    apz.data.loadData("Liabilities", "aclo01");
    apz.setElmValue("aclo01__ApplyLoanMobile__bank", "");
    apz.setElmValue("aclo01__ApplyLoanMobile__financingtype", "");
    apz.setElmValue("aclo01__ApplyLoanMobile__financeamt", "");
    apz.setElmValue("aclo01__ApplyLoanMobile__monthlyins", "");
}
apz.aclo01.ApplyLoanMobile.fnDeleteLiabilities = function(pthis) {
    debugger;
    var params = {
        "targetId": "aclo01__ApplyLoanMobile__delconfirmModal",
    }
    apz.toggleModal(params);
    apz.aclo01.ApplyLoanMobile.lrow = $(pthis).attr("rowno");
}
apz.aclo01.ApplyLoanMobile.fnCancelDelete = function() {
    var params = {
        "targetId": "aclo01__ApplyLoanMobile__delconfirmModal",
    }
    apz.toggleModal(params);
}
apz.aclo01.ApplyLoanMobile.fnConfirmDelete = function() {
    var params = {
        "targetId": "aclo01__ApplyLoanMobile__delconfirmModal",
    }
    apz.toggleModal(params);
    apz.aclo01.ApplyLoanMobile.liabilityArr.splice(apz.aclo01.ApplyLoanMobile.lrow, 1);
    apz.data.scrdata.aclo01__Liabilities_Res = {};
    apz.data.scrdata.aclo01__Liabilities_Res.liability = apz.aclo01.ApplyLoanMobile.liabilityArr;
    apz.data.loadData("Liabilities", "aclo01");
}
apz.aclo01.ApplyLoanMobile.fnUploadDoc = function(pthis, ptype) {
    debugger;
    apz.aclo01.ApplyLoanMobile.docType = ptype;
    $("#aclo01__ApplyLoanMobile__filebrowse").trigger("click");
}
apz.aclo01.ApplyLoanMobile.fnGetFile = function(pthis) {
    debugger;
    let fileObj = pthis.files[0];
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        //apz.usrdtl.AddtionalDetails.signatoryDocuments[documentType]=binaryStr.split(",").pop();
        apz.aclo01.ApplyLoanMobile.docname = fileObj.name;
        apz.aclo01.ApplyLoanMobile.fnShowFile(binaryStr);
        $("#" + pthis.id).val("");
    }
    apzFileReader.readAsDataURL(fileObj);
}

apz.aclo01.ApplyLoanMobile.fnCaptureDoc = function(pthis,ptype,psourcetype){
    debugger;
    apz.aclo01.ApplyLoanMobile.docType = ptype;
     var jsonobj = {
        "zoomLevel": "20",
        "targetWidth": "400",
        "targetHeight": "400",
        "crop": "Y", //Y or N  
        "flash": "N",
        "action": "base64_Save", // save,base64 
        "fileName": "Sample",
        "quality": "50",
        "encodingType": "JPG",
        "sourceType": psourcetype // photo 
    };
    jsonobj.id = "CAMERA_ID";
    jsonobj.callBack = apz.aclo01.ApplyLoanMobile.fnCaptureDocCB;
    apz.ns.openCamera(jsonobj);
}

apz.aclo01.ApplyLoanMobile.fnCaptureDocCB = function(params){
    debugger;
    apz.aclo01.ApplyLoanMobile.docname = params.path.split("/").pop();
    apz.aclo01.ApplyLoanMobile.fnShowFile(params.encodedImage);
}


apz.aclo01.ApplyLoanMobile.fnShowFile = function(fileBase64) {
    debugger;
    $("#aclo01__ApplyLoanMobile__" + apz.aclo01.ApplyLoanMobile.docType + "_row").addClass("sno");
    $("#aclo01__ApplyLoanMobile__" + apz.aclo01.ApplyLoanMobile.docType + "Suc_row").removeClass("sno");
    apz.setElmValue("aclo01__ApplyLoanMobile__" + apz.aclo01.ApplyLoanMobile.docType + "text", apz.aclo01.ApplyLoanMobile.docname);
    apz.setElmValue("aclo01__ApplyLoanMobile__" + apz.aclo01.ApplyLoanMobile.docType + "img", fileBase64);
}
apz.aclo01.ApplyLoanMobile.fnViewImg = function(pthis, ptype) {
    debugger;
    apz.toggleModal({
        targetId: "aclo01__ApplyLoanMobile__imagemodal"
    });
    var imagetxt = apz.getElmValue("aclo01__ApplyLoanMobile__" + ptype + "img");
    apz.setElmValue("aclo01__ApplyLoanMobile__vieimage", imagetxt);
}
apz.aclo01.ApplyLoanMobile.fnDeletefile = function(pthis, ptype) {
    debugger;
    $("#aclo01__ApplyLoanMobile__" + ptype + "_row").removeClass("sno");
    $("#aclo01__ApplyLoanMobile__" + ptype + "Suc_row").addClass("sno");
}

apz.aclo01.ApplyLoanMobile.fnSubmit = function() {
    var params = {};
    params.message = "Loan applied successfully";
    params.type = "S";
    params.callBack = apz.aclo01.ApplyLoanMobile.fnSubmitCB;
    apz.dispMsg(params);
}

apz.aclo01.ApplyLoanMobile.fnSubmitCB = function(){
    apz.aclo01.ApplyLoanMobile.getLoanSimulator();
}

apz.aclo01.ApplyLoanMobile.fnClickLiabilities = function(){
    debugger;
    $("#aclo01__ApplyLoanMobile__documentList").addClass("sno");
    $("#aclo01__ApplyLoanMobile__liabilityForm").removeClass("sno");
     $("#aclo01__ApplyLoanMobile__el_btn_2").removeClass("inf");
     $("#aclo01__ApplyLoanMobile__el_btn_3").addClass("inf");
    
    
    if(apz.aclo01.ApplyLoanMobile.liabilityArr.length >0){
        $("#aclo01__ApplyLoanMobile__liabilityList").removeClass("sno");
    }
    
}

apz.aclo01.ApplyLoanMobile.fnClickUploadDocuments = function(){
    debugger;
     $("#aclo01__ApplyLoanMobile__liabilityForm").addClass("sno");
    $("#aclo01__ApplyLoanMobile__liabilityList").addClass("sno");
     $("#aclo01__ApplyLoanMobile__documentList").removeClass("sno");
      $("#aclo01__ApplyLoanMobile__el_btn_2").addClass("inf");
     $("#aclo01__ApplyLoanMobile__el_btn_3").removeClass("inf");
    
}


