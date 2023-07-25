apz.lecr01.GuaranteesDetails = {};
apz.lecr01.GuaranteesDetails.sCorporateId = "000FTAC4321";
apz.app.onLoad_GuaranteesDetails = function(params) {
    debugger;
    $(".pgn-ctr").addClass("sno");
    apz.lecr01.GuaranteesDetails.sRefno = params.refNo;
    $("#lecr01__LCSummary__GuaranteesRow").addClass("sno");
    $("#lecr01__LCSummary__MobGuaranteesRow").addClass("sno");
    $("#lecr01__LCSummary__tradefinancerow").addClass("sno");
    $("#lecr01__LCSummary__Mobtradefinancerow").addClass("sno");
    $("#lecr01__LCSummary__tradeIcon").attr("onclick", "apz.lecr01.GuaranteesDetails.fnCancel();");
    var lServerParams = {
        "ifaceName": "FetchGuaranteeDetails",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.lecr01.GuaranteesDetails.queryLCCB,
        "callBackObj": "",
    };
    var req = {
        "guaranteeDetails": {
            "referenceNumber": params.refNo
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_guarantee_issuance";
    lServerParams.req = req;
    if (params.close) {
        $("#lecr01__GuaranteesDetails__close_btn").removeClass("sno");
    }
    apz.server.callServer(lServerParams);
};
apz.lecr01.GuaranteesDetails.queryLCCB = function(pResp) {
    debugger;
    if (pResp.res.lecr01__FetchGuaranteeDetails_Res.Status) {
        apz.data.loadJsonData("ImportLCDetails", "lecr01");
        if (pResp.res.lecr01__FetchGuaranteeDetails_Res.guaranteeDetails.referenceNumber == "1519979100023") {
            apz.setElmValue("lecr01__GuaranteesDetails__product_category", "Incoming");
            apz.setElmValue("lecr01__GuaranteesDetails__el_label_1", "Issuing Bank");
            $("#lecr01__GuaranteesDetails__rowadvbank").addClass("sno");
            $("#lecr01__GuaranteesDetails__rowconbank").addClass("sno");
            $("#lecr01__GuaranteesDetails__ps_pls_3_li2 h4").text("Applicant Details");
        }
        if (pResp.res.lecr01__FetchGuaranteeDetails_Res.guaranteeDetails.guaranteeFormat == "upload") {
            apz.show("lecr01__GuaranteesDetails__docsUpload");
        } else {
            apz.hide("lecr01__GuaranteesDetails__docsUpload");
        }
    }
};
apz.lecr01.GuaranteesDetails.fnCancel = function() {
    apz.show("lecr01__LCSummary__lcRow");
    apz.show("lecr01__LCSummary__GuaranteesRow");
    apz.show("lecr01__LCSummary__MobGuaranteesRow");
    apz.hide("lecr01__LCSummary__tradeIcon");
    $("#lecr01__LCSummary__subScreenLauncher").html("");
    var params = {};
    params.appId = "lecr01";
    params.scr = "Guarantees";
    params.layout = "All";
    params.div = "lecr01__LCSummary__tradeDivLauncher";
    apz.launchInDiv(params);
};
apz.lecr01.GuaranteesDetails.fnDownloadFiles = function(pthis) {
    var lfilename = apz.getObjValue(pthis);
    var json = {
        "destinationPath": "Downloads",
        "filePath": "MasterGuarantee",
        "sessionReq": "Y" //Y or N
    };
    json.fileName = lfilename;
    json.base64 = "N";
    json.id = "DOWNLOADFILE_ID";
    json.callBack = apz.lecr01.GuaranteesDetails.fnDownloadFilesCB;
    apz.ns.downloadFile(json);
};
apz.lecr01.GuaranteesDetails.fnDownloadFilesCB = function(pResp) {
    debugger;
};
apz.lecr01.GuaranteesDetails.showAdvice = function() {
    apz.toggleModal({
        targetId: "lecr01__GuaranteesDetails__advice_modal"
    });
    apz.data.loadJsonData("ImportLCDetails", "lecr01");
};
apz.lecr01.GuaranteesDetails.showAdviceDoc = function(pObj) {
    var rowNo = $(pObj).attr("rowno");
    var myBase64string = apz.data.scrdata.lecr01__ImportLCDetails_Res.Advice[rowNo].advicedoc;
    var objbuilder = '';
    objbuilder += ('<object width="100%" height="100%" data="data:application/pdf;base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="application/pdf" class="internal">');
    objbuilder += ('<embed src="data:application/pdf;base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="application/pdf"  />');
    objbuilder += ('</object>');
    var win = window.open("#", "_blank");
    var title = "Advice document";
    win.document.write('<html><title>' + title + '</title><body style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px;">');
    win.document.write(objbuilder);
    win.document.write('</body></html>');
    var layer = jQuery(win.document);
};
apz.lecr01.GuaranteesDetails.fnCloseGuarantee = function() {
    var params = {
        "targetId": "lecr01__GuaranteesDetails__remarksmodal",
    }
    apz.toggleModal(params);
};
apz.lecr01.GuaranteesDetails.showSucMsg = function() {
    var params = {
        "targetId": "lecr01__GuaranteesDetails__remarksmodal",
    }
    apz.toggleModal(params);
    apz.dispMsg({
        message: "Request for closure of guarantee submitted successfully. Your reference number is GACL85432618",
        type: "S",
        callBack: apz.lecr01.GuaranteesDetails.fnCancel
    });
}
apz.lecr01.GuaranteesDetails.fnShowHiderow = function(pthis, rowid) {
    debugger;
    $("#lecr01__GuaranteesDetails__bendetailrow").addClass("sno");
    $("#lecr01__GuaranteesDetails__guaranteedetrow").addClass("sno");
    $("#lecr01__GuaranteesDetails__bankdetrow").addClass("sno");
    $("#lecr01__GuaranteesDetails__chargerow").addClass("sno");
    $("#lecr01__GuaranteesDetails__collateralrow").addClass("sno");
    $("#lecr01__GuaranteesDetails__eventrow").addClass("sno");
    $("#lecr01__GuaranteesDetails__claimrow").addClass("sno");
    $("#lecr01__GuaranteesDetails__" + rowid).removeClass("sno");
    
    $("#lecr01__GuaranteesDetails__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}