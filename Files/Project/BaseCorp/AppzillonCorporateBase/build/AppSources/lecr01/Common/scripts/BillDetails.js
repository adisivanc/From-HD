apz.lecr01.billDetails = {};
apz.app.onLoad_BillDetails = function(params) {
    debugger;
    $(".pgn-ctr").addClass("sno")
    var lRefNo = params.refNo;
    apz.lecr01.billDetails.getBillDetials(lRefNo);
};
apz.app.onShown_BillDetails = function() {
    debugger;
};
apz.lecr01.billDetails.getBillDetials = function(pRefNo) {
    var req = {
        "GetBillDetails": {
            "corporateId": apz.lecr01.billCollections.sCorporateId,
            "referenceNumber": pRefNo,
            "type": "All"
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_bill_collection";
    var lParams = {
        "ifaceName": "BillDetails",
        "paintResp": "Y",
        "appId": "lecr01",
        "buildReq": "N",
        "req": req,
        "async": false,
        "callBack": apz.lecr01.billDetails.fnBillDetailsCB,
    };
    apz.server.callServer(lParams);
};
apz.lecr01.billDetails.Back = function() {
    debugger;
    $(".details").addClass('sno');
    $(".summary").removeClass('sno');
    apz.show("lecr01__LCSummary__lcRow");
    apz.show("lecr01__LCSummary__BCRow");
    apz.show("lecr01__LCSummary__MobBCRow");
    apz.hide("lecr01__LCSummary__tradeIcon");
    $("#lecr01__LCSummary__subScreenLauncher").html("");
    var params = {};
    params.appId = "lecr01";
    params.scr = "BillCollections";
    params.layout = "All";
    params.div = "lecr01__LCSummary__tradeDivLauncher";
    apz.launchInDiv(params);
};
apz.lecr01.billDetails.fnBillDetailsCB = function(pResp) {
    if (pResp.status) {
        if (pResp.res) {
            if (pResp.res.lecr01__BillDetails_Res) {
                if (pResp.res.lecr01__BillDetails_Res.tbDbmiCorpBillCollection) {
                    apz.data.loadJsonData("ImportLCDetailsBills", "lecr01");
                    if (pResp.res.lecr01__BillDetails_Res.tbDbmiCorpBillCollection.referenceNumber == "001BCOL190340002") {
                        apz.setElmValue("lecr01__BillDetails__prod_category", "Export");
                        apz.setElmValue("lecr01__BillDetails__bill_type", "Collection");
                        apz.setElmValue("lecr01__BillDetails__lc_ref_no", "");
                    }
                }
            }
        }
    }
};
apz.lecr01.billDetails.showAdvice = function() {
    apz.toggleModal({
        targetId: "lecr01__BillDetails__advice_modal"
    });
    apz.data.loadJsonData("ImportLCDetailsBills", "lecr01");
};
apz.lecr01.billDetails.showAdviceDoc = function(pObj) {
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
apz.lecr01.billDetails.fnShowHiderow = function(pthis, rowid) {
    debugger;
    $("#lecr01__BillDetails__viewbillrow").addClass("sno");
    $("#lecr01__BillDetails__billdetailrow").addClass("sno");
    $("#lecr01__BillDetails__partiesrow").addClass("sno");
    $("#lecr01__BillDetails__documentrow").addClass("sno");
    $("#lecr01__BillDetails__discrepancyrow").addClass("sno");
    $("#lecr01__BillDetails__statusdaterow").addClass("sno");
    $("#lecr01__BillDetails__bankinstrow").addClass("sno");
    $("#lecr01__BillDetails__chargerow").addClass("sno");
    $("#lecr01__BillDetails__commisionrow").addClass("sno");
    $("#lecr01__BillDetails__interestrow").addClass("sno");
    $("#lecr01__BillDetails__evntsrow").addClass("sno");
    $("#lecr01__BillDetails__collateralrow").addClass("sno");
    $("#lecr01__BillDetails__" + rowid).removeClass("sno");
    
    $("#lecr01__BillDetails__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}