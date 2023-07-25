apz.crdt01.Payment = {};
apz.app.onLoad_Payment = function() {
    $("#crdt01__Payment__el_rdo_1_grp_lbl").parent().addClass("sno");
    apz.data.scrdata["crdt01__Payments_Req"] = {}
    apz.data.scrdata["crdt01__Payments_Req"]["Payments"] = {
        "CardNo": "5000-XXXX-XXXX-0656",
        "LastBilledDate": "02/20/2019",
        "MinDueAmout": "50",
        "OtherAmount": "",
        "FrmAccount":"",
        "LastStmtAmount":"1000"
    }
    apz.data.loadData("Payments", "crdt01");
}
apz.crdt01.Payment.fnOnClickProceed = function() {
    $("#crdt01__Payment__crdtPaymentProceed").removeClass("sno");
    $("#crdt01__Payment__crdtPaymentDiv").addClass("sno");
    apz.data.buildData("Payments", "crdt01");
    var amt = "";
    apz.data.scrdata["crdt01__PaymentDetails_Req"] = {}
    apz.data.scrdata["crdt01__PaymentDetails_Req"]["PaymentDetails"] = {};
    apz.data.scrdata["crdt01__PaymentDetails_Req"]["PaymentDetails"]["CardNo"] = apz.data.scrdata["crdt01__Payments_Req"]["Payments"]["CardNo"];
    apz.data.scrdata["crdt01__PaymentDetails_Req"]["PaymentDetails"]["FrmAccount"] = apz.data.scrdata["crdt01__Payments_Req"]["Payments"]["FrmAccount"];
    for (var i = 1; i <= 3; i++) {
        var checked = $("#crdt01__Payment__el_rdo_2_option_" + i).attr("checked");
        if (typeof checked != "undefined") {
            switch (i) {
                case 1:
                    apz.data.scrdata["crdt01__PaymentDetails_Req"]["PaymentDetails"]["Amount"] = apz.data.scrdata["crdt01__Payments_Req"]["Payments"]
                    ["LastStmtAmount"];
                    break;
                case 2:
                    apz.data.scrdata["crdt01__PaymentDetails_Req"]["PaymentDetails"]["Amount"] = apz.data.scrdata["crdt01__Payments_Req"]["Payments"]
                    ["MinDueAmout"];
                    break;
                case 3:
                    apz.data.scrdata["crdt01__PaymentDetails_Req"]["PaymentDetails"]["Amount"] = apz.data.scrdata["crdt01__Payments_Req"]["Payments"]
                    ["OtherAmount"];
                    break;
            }
            break;
        }
    }
  apz.data.loadData("PaymentDetails", "crdt01");
}


apz.crdt01.Payment.fnOnClickOk = function(){
    apz.toggleModal({
        "targetId": "crdt01__Payment__transactionSuccess"
    });
    var params = {};
    params.appId = "card01";
    params.scr = "Cards";
    //params.layout = "All";
    params.description = "Cards";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
     if (apz.deviceGroup == "Mobile") {
         params.layout = "Mobile";
    }
    else {
         params.layout = "All";
    }
    
    apz.launchApp(params);
}


apz.crdt01.Payment.fnOnClickContinue = function() {
    apz.data.buildData("PaymentDetails", "crdt01");
    apz.toggleModal({
        "targetId": "crdt01__Payment__transactionSuccess"
    });
    apz.setElmValue("crdt01__Payment__trnsId_txtcnt",Math.random().toString().slice(2,11));
    var getTodate = new Date();
    apz.setElmValue("crdt01__Payment__txnDate_txtcnt",(getTodate.getMonth()+1)+"/"+getTodate.getDate()+"/"+getTodate.getFullYear());
    apz.setElmValue("crdt01__Payment__el_txt_23_txtcnt",apz.data.scrdata["crdt01__PaymentDetails_Req"]["PaymentDetails"]["Amount"]);
}
apz.crdt01.Payment.fnOnCancel = function() {
    $("#crdt01__Payment__crdtPaymentDiv").removeClass("sno");
    $("#crdt01__Payment__crdtPaymentProceed").addClass("sno");
}
