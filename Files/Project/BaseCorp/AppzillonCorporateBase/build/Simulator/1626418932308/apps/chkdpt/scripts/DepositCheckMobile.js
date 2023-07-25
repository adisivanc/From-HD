apz.chkdpt.DepositCheckMobile = {};
apz.chkdpt.DepositCheckMobile.checklistArr = [];
apz.app.onLoad_DepositCheckMobile = function(params) {
    debugger;
}
apz.chkdpt.DepositCheckMobile.fnShowAddcheckRow = function() {
    debugger;
    $("#chkdpt__DepositCheckMobile__addCheckRow").removeClass("sno");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpCheckno", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpBank", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpAmount", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpAccountno", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpName", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__frontImage", "apps/styles/themes/AppzillonCorporateBase/img/upimg25.png");
    apz.setElmValue("chkdpt__DepositCheckMobile__backImage", "apps/styles/themes/AppzillonCorporateBase/img/upimg25.png");
     apz.setElmValue("chkdpt__DepositCheckMobile__frontText", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__backText", "");
}
apz.chkdpt.DepositCheckMobile.fnHideAddcheckRow = function() {
    debugger;
    $("#chkdpt__DepositCheckMobile__addCheckRow").addClass("sno");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpCheckno", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpBank", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpAmount", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpAccountno", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__inpName", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__frontImage", "apps/styles/themes/AppzillonCorporateBase/img/upimg25.png");
    apz.setElmValue("chkdpt__DepositCheckMobile__backImage", "apps/styles/themes/AppzillonCorporateBase/img/upimg25.png");
    apz.setElmValue("chkdpt__DepositCheckMobile__frontText", "");
    apz.setElmValue("chkdpt__DepositCheckMobile__backText", "");
}
apz.chkdpt.DepositCheckMobile.fnonImageClick = function(pthis, ptype,ptext) {
    debugger;
    apz.chkdpt.DepositCheckMobile.ptype = ptype;
    apz.chkdpt.DepositCheckMobile.ptext = ptext;
    //$("#chkdpt__DepositCheckMobile__frontupload").trigger("click");
   
    //  var jsonobj = {
    //     "zoomLevel": "20",
    //     "targetWidth": "400",
    //     "targetHeight": "400",
    //     "crop": "Y", //Y or N  
    //     "flash": "N",
    //     "action": "base64_Save", // save,base64 
    //     "fileName": "Sample",
    //     "quality": "50",
    //     "encodingType": "JPG",
    //     "sourceType": "camera" // photo 
    // };
    // jsonobj.id = "CAMERA_ID";
    // jsonobj.callBack = apz.chkdpt.DepositCheckMobile.fnonImageClickCB;
    // apz.ns.openCamera(jsonobj);
    
    
    var jsonobj = {
        "zoomLevel": "0",
        "targetWidth": "",
        "targetHeight": "",
        "crop": "Y", //Y or N
        "flash": "N",
        "action": "base64_Save", // save,base64
        "fileName": "Identity_Image",
        "quality": "100",
        "sourceType": "photo" // photo
    };
    jsonobj.id = "CAMERA_ID";
    jsonobj.callBack = apz.chkdpt.DepositCheckMobile.fnonImageClickCB;
    apz.ns.openCamera(jsonobj);
    
    
    
    
    
}
apz.chkdpt.DepositCheckMobile.fnOnfrontBrowse = function(pthis) {
    debugger;
    let fileObj = pthis.files[0];
    var fileName = fileObj.name;
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        let base64Str = btoa(binaryStr);
        apz.setElmValue("chkdpt__DepositCheckMobile__" + apz.chkdpt.DepositCheckMobile.ptype, base64Str);
        apz.setElmValue("chkdpt__DepositCheckMobile__" + apz.chkdpt.DepositCheckMobile.ptext, fileName);
        
         if(apz.chkdpt.DepositCheckMobile.ptype == "frontImage"){
        apz.chkdpt.DepositCheckMobile.fngetOCRServiceData({
            "status": true,
            encodedImage: base64Str,
            filenames:fileName
        });
         }
    }
    apzFileReader.readAsBinaryString(fileObj);
}
apz.chkdpt.DepositCheckMobile.fnonImageClickCB = function(params) {
    debugger;
    if (params.encodedImage != undefined) {
        apz.setElmValue("chkdpt__DepositCheckMobile__" + apz.chkdpt.DepositCheckMobile.ptype, params.encodedImage);
        apz.setElmValue("chkdpt__DepositCheckMobile__" + apz.chkdpt.DepositCheckMobile.ptext, params.path.split("/").pop());
        if (apz.chkdpt.DepositCheckMobile.ptype == "frontImage") {
            apz.chkdpt.DepositCheckMobile.fngetOCRServiceData({
                "status": true,
                encodedImage: params.encodedImage,
                filenames: params.path.split("/").pop()
            });
        }
    }
}
apz.chkdpt.DepositCheckMobile.fngetOCRServiceData = function(params) {
    debugger;
    //apz.startLoader();
    var Random_digit = Math.floor(Math.random() * 1000000000);
    var today = new Date();
    var date = today.getFullYear() + "" + (today.getMonth() + 1) + "" + today.getDate();
    var time = today.getHours() + "" + today.getMinutes() + "" + today.getSeconds() + today.getMilliseconds();
    var dateTime = date + "" + time;
    var user_id = "ADMIN";
  //  var txn_id_no = apz.appId + "_" + user_id + "_WEB_TRADE_LICENSE_" + Random_digit + "_" + dateTime;
    var ocrrequestjson = {
        "user_id": "ADMIN",
        "txn_id": String(+new Date),
        "document_type": "CHEQUE_SLIP",
        "document_id": "HDFC_Front",
        "data_format": "IMG_BASE64",
        "preprocessed_type": "COLOR",
        "device_type": "WEB",
        "data_text": "",
        "data_cord": "",
        "addtional_param": [],
        "data_base64": params.encodedImage
    };
    
    
     if(params.filenames.indexOf("HDFCFront") !=-1){
        ocrrequestjson.document_id = "HDFC_Front";
    }
     if(params.filenames.indexOf("SBIFront") !=-1){
        ocrrequestjson.document_id = "SBI_Front";
    }
     if(params.filenames.indexOf("AosFront") !=-1){
        ocrrequestjson.document_id = "BoA_front";
    }
    
    var lParams = {
        "ifaceName": "CheckDepositOCR",
        "buildReq": "N",
        "appId": "chkdpt",
        "paintResp": "N",
        "req": ocrrequestjson,
        "async": false,
        "callBack": apz.chkdpt.DepositCheckMobile.fngetOCRServiceDataCB
    };
    
    //  apz.dispMsg({
    //         "message": "OCR Service is down"
    //     });
    
    apz.server.callServer(lParams);
}
apz.chkdpt.DepositCheckMobile.fngetOCRServiceDataCB = function(pResp) {
    debugger;
    apz.stopLoader();
    if (!pResp.res.chkdpt__CheckDepositOCR_Res.extracted_entities) {
        apz.dispMsg({
            "message": "Certificate Not Valid"
        });
    } else {
        var result = pResp.res.chkdpt__CheckDepositOCR_Res.extracted_entities;
        
        apz.setElmValue("chkdpt__DepositCheckMobile__inpCheckno", result.cheque_no);
        apz.setElmValue("chkdpt__DepositCheckMobile__inpBank", result.bank_name);
        apz.setElmValue("chkdpt__DepositCheckMobile__inpAmount", result.amount);
        apz.setElmValue("chkdpt__DepositCheckMobile__inpAccountno", result.account_no);
        apz.setElmValue("chkdpt__DepositCheckMobile__inpName", result.holder_name);
        //apz.data.loadData("corpInfo", "comdtl")
    }
}
apz.chkdpt.DepositCheckMobile.fnAddtoCheckList = function() {
    debugger;
    var lobj = {};
    lobj.frontImage = apz.getElmValue("chkdpt__DepositCheckMobile__frontImage");
    lobj.backImage = apz.getElmValue("chkdpt__DepositCheckMobile__backImage");
    lobj.frontName = apz.getElmValue("chkdpt__DepositCheckMobile__frontText");
    lobj.backName = apz.getElmValue("chkdpt__DepositCheckMobile__backText");
    lobj.checkNo = apz.getElmValue("chkdpt__DepositCheckMobile__inpCheckno");
    lobj.Bank = apz.getElmValue("chkdpt__DepositCheckMobile__inpBank");
    lobj.AccountNo = apz.getElmValue("chkdpt__DepositCheckMobile__inpAccountno");
    lobj.Name = apz.getElmValue("chkdpt__DepositCheckMobile__inpName");
    lobj.Amount = apz.getElmValue("chkdpt__DepositCheckMobile__inpAmount");
    apz.chkdpt.DepositCheckMobile.checklistArr.push(lobj);
    apz.data.scrdata.chkdpt__DepositCheck_Res = {}
    apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = apz.chkdpt.DepositCheckMobile.checklistArr;
    apz.data.loadData("DepositCheck", "chkdpt");
    $("#chkdpt__DepositCheckMobile__checkList").removeClass("sno");
    $("#chkdpt__DepositCheckMobile__addCheckRow").addClass("sno");
}
apz.chkdpt.DepositCheckMobile.fnDeleteCheck = function(pthis) {
    debugger;
    var params = {
        "targetId": "chkdpt__DepositCheckMobile__delconfirmModal",
    }
    apz.toggleModal(params);
    apz.chkdpt.DepositCheckMobile.lrow = $(pthis).attr("rowno");
}
apz.chkdpt.DepositCheckMobile.fnCancelDelete = function() {
    var params = {
        "targetId": "chkdpt__DepositCheckMobile__delconfirmModal",
    }
    apz.toggleModal(params);
}
apz.chkdpt.DepositCheckMobile.fnConfirmDelete = function() {
    var params = {
        "targetId": "chkdpt__DepositCheckMobile__delconfirmModal",
    }
    apz.toggleModal(params);
    apz.chkdpt.DepositCheckMobile.checklistArr.splice(apz.chkdpt.DepositCheckMobile.lrow, 1);
    apz.data.scrdata.chkdpt__DepositCheck_Res = {}
    apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = apz.chkdpt.DepositCheckMobile.checklistArr;
    apz.data.loadData("DepositCheck", "chkdpt");
}
apz.chkdpt.DepositCheckMobile.fnSubmit = function() {
    var params = {};
    params.message = "Thank you for depositing your check(s). We wiil review it and notify you when your check(s) has been cleared."
    params.type = "S"
    params.callBack = apz.chkdpt.DepositCheckMobile.fnApproveCB;
    apz.dispMsg(params);
    var params = {};
    params.appId = "chkdpt";
    params.scr = "ChkDepositLauncher";
    params.layout = "All";
    params.description = "Remote Check Deposits";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}
apz.chkdpt.DepositCheckMobile.fnApproveCB = function(presp) {
    var params = {};
    params.appId = "chkdpt";
    params.scr = "ChkDepositLauncher";
    params.layout = "All";
    params.description = "Remote Check Deposits";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}

apz.chkdpt.DepositCheckMobile.fnPreviewImg = function(pthis,ptype){
    debugger;
    var lrow = $(pthis).attr("rowno");
     apz.toggleModal({
        targetId: "chkdpt__DepositCheckMobile__imagemodal"
    });
    
    var imagetxt = apz.chkdpt.DepositCheckMobile.checklistArr[lrow][ptype];
    apz.setElmValue("chkdpt__DepositCheckMobile__previewimg", imagetxt);
}
