apz.lecr01.ImportLCDetails = {};
apz.lecr01.ImportLCDetails.sCorporateId = "000FTAC4321";
apz.app.onLoad_ImportLCDetails = function(params) {
    apz.lecr01.ImportLCDetails.srefno = params.refNo;
    $(".pgn-ctr").addClass("sno");
    apz.hide("lecr01__ImportLCDetails__comments_div");
    $("#lecr01__LCSummary__tradefinancerow").addClass("sno");
    $("#lecr01__LCSummary__Mobtradefinancerow").addClass("sno");
    $("#lecr01__LCSummary__tradeIcon").attr("onclick", "apz.lecr01.ImportLCDetails.fnCancel();");
    var req = {
        "letterDetails": {
            "referenceNumber": params.refNo
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_letter_credit";
    if (params.close) {
        $("#lecr01__ImportLCDetails__close_btn").removeClass("sno");
    }
    var lServerParams = {
        "ifaceName": "FetchLetterofCreditsService",
        "buildReq": "N",
        "appId": "lecr01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.lecr01.ImportLCDetails.queryLCCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.lecr01.ImportLCDetails.queryLCCB = function(pResp) {
    debugger;
    if (apz.lecr01.ImportLCDetails.srefno == "1560339246175") {
        apz.setElmValue("lecr01__ImportLCDetails__el_label_3", "Issuing bank");
        apz.setElmValue("lecr01__ImportLCDetails__el_label_5", "Issuing through Bank");
        apz.setElmValue("lecr01__ImportLCDetails__product_category", "Export");
    }
    apz.lecr01.ImportLCDetails.renderStaticContent();
    // if (!pResp.errors) {
    //     if (apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.shippmentDelivery == "cross") {
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__shippmentPort");
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__shippmentIncoterm");
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__shippmentInsurance");
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__portOfLoading_ctrl_grp_div");
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__portOfDischarge_ctrl_grp_div");
    //     }
    //     if (apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.shippmentIncoterm == "Others") {
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__shippmentIncotermOther_ctrl_grp_div");
    //     }
    //     if (apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.shippmentDocument.indexOf("Others")>=0) {
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__shippmentDocumentOther_ctrl_grp_div");
    //     }
    //     if (apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.shippmentInsurance == "Applicant") {
    //         apz.show("lecr01__FetchLetterofCreditsService__o__letterDetails__shippmentInsuranceApplicant");
    //     }
    // }
};
apz.lecr01.ImportLCDetails.fnCancel = function() {
    apz.show("lecr01__LCSummary__lcRow");
    apz.show("lecr01__LCSummary__tradefinancerow");
    apz.show("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__tradeIcon");
    $("#lecr01__LCSummary__subScreenLauncher").html("");
    var params = {};
    params.appId = "lecr01";
    params.scr = "ImportLC";
    params.layout = "All";
    params.div = "lecr01__LCSummary__tradeDivLauncher";
    apz.launchInDiv(params);
};
apz.lecr01.ImportLCDetails.fnDownloadFiles = function(pthis) {
    var lfilename = apz.getObjValue(pthis);
    var json = {
        "destinationPath": "Downloads",
        "filePath": "MasterLC",
        "sessionReq": "Y" //Y or N
    };
    json.fileName = lfilename;
    json.base64 = "N";
    json.id = "DOWNLOADFILE_ID";
    json.callBack = apz.lecr01.ImportLCDetails.fnDownloadFilesCB;
    apz.ns.downloadFile(json);
};
apz.lecr01.ImportLCDetails.fnDownloadFilesCB = function(pResp) {
    debugger;
}
apz.lecr01.ImportLCDetails.renderStaticContent = function() {
    if (apz.data.scrdata) {
        if (apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res) {
            if (apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails) {
                apz.data.loadJsonData("ImportLCDetails", "lecr01");
                var maxAmount = amount;
                if (apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.status == "Pending Rework") {
                    apz.show("lecr01__ImportLCDetails__comments_div");
                }
                var amount = apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.amount;
                var toleranceAbove = apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.toleranceAbove;
                if (!apz.isNull(amount) && !apz.isNull(toleranceAbove)) {
                    if (!isNaN(amount) && !isNaN(toleranceAbove)) {
                        maxAmount = amount + ((amount * toleranceAbove) / 100);
                        if (!isNaN(maxAmount)) {
                            apz.setElmValue("lecr01__ImportLCDetails__max_amt", maxAmount);
                        }
                    }
                }
            }
        }
    }
};
apz.lecr01.ImportLCDetails.showAdvice = function() {
    apz.toggleModal({
        targetId: "lecr01__ImportLCDetails__advice_modal"
    });
    apz.data.loadJsonData("ImportLCDetails", "lecr01");
};
apz.lecr01.ImportLCDetails.showAdviceDoc = function(pObj) {
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
apz.lecr01.ImportLCDetails.launchBillDetails = function(pObj) {
    var rowNo = $(pObj).attr("rowno")
    var lRefNo = apz.data.scrdata.lecr01__ImportLCDetails_Res.Bills[rowNo].ref_no;
    if (!apz.isNull(lRefNo)) {
        apz.lecr01.billCollections = {}
        apz.lecr01.billCollections.sCorporateId = apz.lecr01.ImportLCDetails.sCorporateId
        var params = {};
        params.appId = "lecr01";
        params.scr = "BillDetails";
        params.layout = "All";
        params.div = "lecr01__LCSummary__subScreenLauncher";
        params.userObj = {
            "refNo": lRefNo
        };
        apz.launchSubScreen(params);
    }
};
apz.lecr01.ImportLCDetails.reInput = function() {
    //apz.lecr01.ImportLC.createLCFromTemplate("<p>"+apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterDetails.referenceNumber+"</p>");
    apz.dispMsg({
        message: "The LC has been sent for re-input",
        type: "S"
    });
};
apz.lecr01.ImportLCDetails.fnCloseLC = function() {
    apz.dispMsg({
        message: "Request for closure of LC submitted successfully. Your reference number is LCCL85432618",
        type: "S",
        callBack: apz.lecr01.ImportLCDetails.fnCancel
    });
};
apz.lecr01.ImportLCDetails.fnShowHiderow = function(pthis, rowid) {
    debugger;
    $("#lecr01__ImportLCDetails__lettercreditrow").addClass("sno");
    $("#lecr01__ImportLCDetails__partydetailsrow").addClass("sno");
    $("#lecr01__ImportLCDetails__bankdetailsrow").addClass("sno");
    $("#lecr01__ImportLCDetails__shipmentdetailsrow").addClass("sno");
    $("#lecr01__ImportLCDetails__docreqrow").addClass("sno");
    $("#lecr01__ImportLCDetails__documentrow").addClass("sno");
    $("#lecr01__ImportLCDetails__chargerow").addClass("sno");
    $("#lecr01__ImportLCDetails__commissionrow").addClass("sno");
    $("#lecr01__ImportLCDetails__eventrow").addClass("sno");
    $("#lecr01__ImportLCDetails__billrow").addClass("sno");
    $("#lecr01__ImportLCDetails__" + rowid).removeClass("sno");
    
    $("#lecr01__ImportLCDetails__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}
