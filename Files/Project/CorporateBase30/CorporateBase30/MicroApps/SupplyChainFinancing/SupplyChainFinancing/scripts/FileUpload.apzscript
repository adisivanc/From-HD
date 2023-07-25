apz.acsf01.fileUpload = {};
var ExcelData = "";
apz.app.onLoad_FileUpload = function(params) {
    debugger;
    $("#acsf01__FileUpload__Upload_File_li .ett-bttn.icl.med.inf.sec").addClass('sno');
    var req = {};
    req.tbDbmiCorpScfParty = {
        "corporateId": "000FTAC4321",
        "type": "All"
    };
    req.importFunction = "SCFParty";
    var lReq = {
        "ifaceName": "PartySummary",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.fileUpload.getPartySummaryCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsf01.fileUpload.getPartySummaryCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lParties = pResp.res.acsf01__PartySummary_Res.tbDbmiCorpScfParty;
        var lPartiesLength = lParties.length;
        var lArr = [{
            "val": "",
            "desc": "Please Select"
        }];
        for (var i = 0; i < lPartiesLength; i++) {
            var lObj = {
                "val": pResp.res.acsf01__PartySummary_Res.tbDbmiCorpScfParty[i].partyId,
                "desc": pResp.res.acsf01__PartySummary_Res.tbDbmiCorpScfParty[i].name,
            };
            lArr.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acsf01__FileUpload__el_dpd_1"), lArr);
        var req = {};
        req.tbDbmiCorpFileTemplate = {
            "corporateId": "000FTAC4321",
            "type": "All"
        };
        req.importFunction = "TemplateSummary";
        var lReq = {
            "ifaceName": "TemplateSummary",
            "paintResp": "Y",
            "buildReq": "N",
            "req": req,
            "appId": "acsf01",
            "async": false,
            "callBack": apz.acsf01.fileUpload.getTemplateSummaryCB,
            "callBackObj": ""
        };
        apz.server.callServer(lReq);
    }
};
apz.acsf01.fileUpload.getTemplateSummaryCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var Templates = pResp.res.acsf01__TemplateSummary_Res.tbDbmiCorpFileTemplate;
        var lTemplatesLength = Templates.length;
        var lArr = [{
            "val": "MultiParty",
            "desc": "Multi Party"
        }];
        for (var i = 0; i < lTemplatesLength; i++) {
            var lObj = {
                "val": pResp.res.acsf01__TemplateSummary_Res.tbDbmiCorpFileTemplate[i].templateId,
                "desc": pResp.res.acsf01__TemplateSummary_Res.tbDbmiCorpFileTemplate[i].templateName,
            };
            lArr.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acsf01__FileUpload__el_inp_1"), lArr);
    }
};
apz.acsf01.fileUpload.fileSected = function(obj, event) {
    debugger;
    //var fileObj = $(obj)[0].files[0];
    var files = document.getElementById('acsf01__FileUpload__Upload_File').files;
    /*var myfile = files[0];
    var lFIle = myfile.name;
    var reader = new FileReader();
    reader.onload = function() {
        ExcelData = reader.result;
    };
    reader.readAsBinaryString(myfile);
    */
};
apz.acsf01.fileUpload.Upload = function() {
    /*var req = {};
    req.corporateId = apz.Login.sCorporateId;
    req.templateId = "1";
    req.importFunction = "Import";
    req.userId = apz.Login.sUserId;
    req.filePath = "/Users/girish.p/Desktop/Appzillon Projects/CorporateBanking_3.5/InvoiceTemplate.xlsx";
    var lReq = {
        "ifaceName": "ImportSummary",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.fileUpload.uploadCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
    */
    var json = {
        "fieldID": "acsf01__FileUpload__Upload_File",
        "destination": "/Files",
        "overWrite": "Y"
    };
    json.filePath = "";
    json.sessionReq = "Y"; //Y or N
    json.id = "UPLOADFILE_ID";
    json.callBack = uploadFileCallback;
    apz.ns.uploadFile(json);
};
uploadFileCallback = function(params) {
    debugger;
    
    // if (params.status) {
    //     alert("Uploaded Successfully");
    // } else {
    //     alert(params.errorCode);
    // }
    
    var lMsg = {};
    lMsg.code = "FILE_SUCCESS";
    apz.dispMsg(lMsg);
}
apz.acsf01.fileUpload.uploadCB = function(pResp) {
    debugger;
    var lMsg = {};
    lMsg.code = "FILE_SUCCESS";
    apz.dispMsg(lMsg);
    $("#acsf01__FileUpload__File_Upload_Header").addClass('sno');
    $("#acsf01__FileUpload__File_Upload_Data").addClass('sno');
    var params = {};
    params.appId = 'acsf01';
    params.scr = 'ImportSummary';
    params.layout = 'All';
    params.div = "acsf01__FileUpload__Launch_Imports_Summary";
    apz.launchSubScreen(params);
};
apz.acsf01.fileUpload.fnViewHistory = function() {
    $("#acsf01__FileUpload__File_Upload_Header").addClass("sno");
    $("#acsf01__FileUpload__File_Upload_Data").addClass("sno");
    debugger;
    var lauchParams = {
        "appId": "acsf01",
        "scr": "ImportSummary",
        "div": "acsf01__FileUpload__Launch_Imports_Summary",
        "layout": "All"
    }
     apz.launchSubScreen(lauchParams);
}
