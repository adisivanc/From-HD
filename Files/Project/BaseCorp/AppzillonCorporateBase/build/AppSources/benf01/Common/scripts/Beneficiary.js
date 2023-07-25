apz.benf01 = {};
apz.benf01.Beneficiary = {};
var count = 0;
var datalength;
apz.app.onLoad_Beneficiary = function() {
    debugger;
    // apz.show("benf01__Beneficiary__benHead");
    apz.benf01.Beneficiary.otherBankDOM();
};
apz.benf01.Beneficiary.sameBank = function() {
    debugger;
    $("#benf01__Beneficiary__beneficaryCol .current").removeClass("current");
    $("#benf01__Beneficiary__samebankpnl_div").addClass("current");
    $("#benf01__Beneficiary__sameBankPanel").addClass("current");
    var params = {};
    params.appId = "benf01";
    params.scr = "SameBank";
    params.layout = "All";
    params.div = "benf01__Beneficiary__launchSubScreen";
    $("#benf01__Beneficiary__OBHead").addClass("sno");
    $("#benf01__Beneficiary__INTHead").addClass("sno");
    $("#benf01__Beneficiary__benHead").removeClass("sno");
    apz.launchSubScreen(params);
};
apz.benf01.Beneficiary.otherBankDOM = function() {
    debugger;
    $("#benf01__Beneficiary__beneficaryCol .current").removeClass("current");
    $("#benf01__Beneficiary__otherbankdompnl_div").addClass("current");
    $("#benf01__Beneficiary__domesticPanel").addClass("current");
    
    $("#benf01__Beneficiary__el_btn_6").removeClass("inf");
    $("#benf01__Beneficiary__el_btn_7").addClass("inf");
    
    var params = {};
    params.appId = "benf01";
    params.scr = "OtherBankDOM";
    params.layout = "All";
    params.div = "benf01__Beneficiary__launchSubScreen";
    $("#benf01__Beneficiary__benHead").addClass("sno");
    $("#benf01__Beneficiary__OBHead").removeClass("sno");
    $("#benf01__Beneficiary__INTHead").addClass("sno");
    apz.launchSubScreen(params);
};
apz.benf01.Beneficiary.otherBankINT = function() {
    debugger;
    $("#benf01__Beneficiary__beneficaryCol .current").removeClass("current");
    $("#benf01__Beneficiary__otherbankintpnl_div").addClass("current");
    $("#benf01__Beneficiary__internationalPanel").addClass("current");
    
    $("#benf01__Beneficiary__el_btn_6").addClass("inf");
    $("#benf01__Beneficiary__el_btn_7").removeClass("inf");
    
    var params = {};
    params.appId = "bein01";
    params.scr = "OtherBankINT";
    params.layout = "All";
    params.div = "benf01__Beneficiary__launchSubScreen";
    $("#benf01__Beneficiary__benHead").addClass("sno");
    $("#benf01__Beneficiary__OBHead").addClass("sno");
    $("#benf01__Beneficiary__INTHead").removeClass("sno");
    apz.launchApp(params);
};
apz.benf01.Beneficiary.uploadBeneficiary = function() {
    debugger;
    $("#benf01__Beneficiary__fileupload")[0].value = "";
    $("#benf01__Beneficiary__fileupload").trigger("click");
}
apz.benf01.Beneficiary.onChangeFileUpload = function(pThis) {
    debugger;
    if ($("#benf01__Beneficiary__fileupload").prop("files").length > 0) {
        apz.benf01.Beneficiary.getBase64($("#benf01__Beneficiary__fileupload").prop("files")[0]);
    }
}
apz.benf01.Beneficiary.getBase64 = function(file) {
    debugger;
    var reader = new FileReader();
    reader.readAsBinaryString(file);
    reader.onload = function(e) {
        debugger;
        var data = e.target.result;
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
        workbook.SheetNames.forEach(function(sheetName) {
            debugger;
            if (sheetName == "Beneficiary") {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                console.log(json_object);
                apz.benf01.Beneficiary.parseAndPaintData(json_object);
            }
        })
    };
    reader.onerror = function(error) {
        debugger;
        console.log('Error: ', error);
    };
};
apz.benf01.Beneficiary.parseAndPaintData = function(params) {
    debugger;
    var lres = params;
    apz.benf01.Beneficiary.XLdata = JSON.parse(lres.replace(/Beneficiary Name/g, "beneficaryName").replace(/Nick Name/g, "nickName").replace(
        /Benefciary Type/g, "benType").replace(/Email ID/g, "emailId").replace(/Account Number/g, "accountNumber").replace(/IFSC Code/g,
        "ifscCode").replace(/Bank Name/g, "bankName").replace(/Address/g, "benAddress").replace(/Corporate Id/g, "corporateId").replace(
        /Account Type/g, "accountType").replace(/Beneficiary Type/g, "beneficaryType").replace(/Contact Number/g, "phNum").replace(
        /Beneficiary Country/g, "benCountry").replace(/IBAN/g, "iban").replace(/Swift Code/g, "swiftCode").replace(/ABA Number/g, "abaNumber").replace(
        /CHIPUID/g, "chipUid").replace(/Bank Address/g, "bankAddress").replace(/Inter Swift Code/g, "interSwiftCode").replace(/Inter Bank Name/g,
        "interBankName").replace(/Inter ABA Number/g, "interAbaNumber").replace(/Inter CHIPUID/g, "interChipUid").replace(/Inter Bank Address/g,
        "interBankAddress"));
    //
    datalength = apz.benf01.Beneficiary.XLdata.length;
    apz.benf01.Beneficiary.fnSaveBeneficiary();
};
apz.benf01.Beneficiary.fnSaveBeneficiary = function() {
    debugger;
    var lTransferDetails = apz.benf01.Beneficiary.XLdata[count];
    var lReqJson = {};
    lReqJson.addBeneficiaryDetails = lTransferDetails;
    lReqJson.action = "New";
    lReqJson.table = "tb_dbmi_corp_role_beneficary";
    var lServerParams = {
        "ifaceName": "FetchBeneficaryService",
        "appId": "benf01",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.benf01.Beneficiary.fnSaveBeneficiaryCB,
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
}
apz.benf01.Beneficiary.fnSaveBeneficiaryCB = function(params) {
    debugger;
    if (params.res.benf01__FetchBeneficaryService_Res.Status) {
        count++
        if (count == datalength) {
            count = 0;
            var params = {};
            params.message = "Beneficiaries Uploaded successfully.";
            params.type = "S";
            params.callBack = apz.benf01.Beneficiary.fnViewBeneficiary;
            apz.dispMsg(params);
        } else {
            apz.benf01.Beneficiary.fnSaveBeneficiary();
        }
    }
}
apz.benf01.Beneficiary.fnViewBeneficiary = function(params) {
    debugger;
    apz.benf01.Beneficiary.otherBankDOM();
}
