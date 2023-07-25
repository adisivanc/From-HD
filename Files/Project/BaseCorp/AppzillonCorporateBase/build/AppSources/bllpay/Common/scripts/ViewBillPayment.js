apz.bllpay.ViewBillPayment = {};
apz.bllpay.ViewBillPayment.sParams = {};
//onload function
apz.app.onLoad_ViewBillPayment = function(params)
{
    debugger;
    apz.bllpay.ViewBillPayment.sParams = params;
    
    if(apz.bllpay.ViewBillPayment.sParams.fromAnd== "PopOver")
    {
    apz.Common.fnremovePopOver();
    }
}
apz.app.onShown_ViewBillPayment = function(params) {
    debugger;
    $("#bllpay__ViewBillPayment__el_inp_3").attr("type", "tel");
    $("#bllpay__ViewBillPayment__acc_no").attr("type", "tel");
    apz.bllpay.ViewBillPayment.sParams = params;
    if (!apz.data.scrdata.bllpay__BillPaymentSummary_Res) {
        apz.data.scrdata.bllpay__BillPaymentSummary_Res = {};
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = [];
    }
    var AccountArray = [{
        val: "",
        desc: "Select Account no"
    }, {
        val: "90,000",
        desc: "XXXXXXXXXX3712"
    }, {
        val: "90,000",
        desc: "XXXXXXXXXX4239"
    }, {
        val: "200,000",
        desc: "XXXXXXXXX3734"
    },
    {
        val: "200,000",
        desc: "XXXXXXXXX9021"
    }];
    apz.populateDropdown($("#bllpay__ViewBillPayment__el_dpd_1")[0], AccountArray);
    if (params.from == "billPayment") {
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = params.summary;
        apz.data.loadData("BillPaymentSummary", "bllpay");
        var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
        var amount = 0;
if(paymentDetails.length > 1){
	$("#bllpay__ViewBillPayment__el_hpl_1").addClass("sno");
}

        for (var i = 0, len = paymentDetails.length; i < len; i++) {
            if (paymentDetails[i].billType === "Mobile") {
                $("#bllpay__ViewBillPayment__mobile_no_label_" + i).removeClass("sno");
                $("#bllpay__ViewBillPayment__cust_id_label_" + i).addClass("sno");
            }
            amount += parseInt(paymentDetails[i].amount.replace(",", ""));
        }
        $("#bllpay__ViewBillPayment__el_inp_2").val(apz.formatNumber({
            "value": amount,
            decimalPoints: "2",
            decimalSep: ".",
            mask: "MILLION"
        }));
        apz.setElmValue("bllpay__ViewBillPayment__amount", amount + ".00");
        apz.setElmValue("bllpay__ViewBillPayment__el_inp_2", amount + ".00");
        
    } else if (params.from == "multipleBillPay") {
        
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = params.summary;
        apz.data.loadData("BillPaymentSummary", "bllpay");
        var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
        var amount = 0;
        // for (var i = 0, len = paymentDetails.length; i < len; i++) {}
        amount += parseInt(paymentDetails[0].Amount.replace(",", ""));
        $("#bllpay__ViewBillPayment__el_inp_2").val(apz.formatNumber({
            "value": amount,
            decimalPoints: "2",
            decimalSep: ".",
            mask: "MILLION"
        }));
        apz.setElmValue("bllpay__ViewBillPayment__amount", amount + ".00");
        apz.setElmValue("bllpay__BillPaymentSummary__o__summary__providerCategory_0", paymentDetails[0].ServiceName);
        apz.setElmValue("bllpay__BillPaymentSummary__o__summary__amount_0", paymentDetails[0].Amount);
        apz.setElmValue("bllpay__BillPaymentSummary__o__summary__subsriberId_0", paymentDetails[0].ConsumerNumber);
    } else if (params.from == "Dashboard") {
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = params.summary;
        apz.data.loadData("BillPaymentSummary", "bllpay");
        var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
        var amount = 0;
        // for (var i = 0, len = paymentDetails.length; i < len; i++) {}
        amount += parseInt(paymentDetails[0].Amount.replace(",", ""));
        $("#bllpay__ViewBillPayment__el_inp_2").val(amount);
        apz.setElmValue("bllpay__ViewBillPayment__amount", amount + ".00");
        apz.setElmValue("bllpay__BillPaymentSummary__o__summary__amount_0", paymentDetails[0].Amount);
        apz.setElmValue("bllpay__ViewBillPayment__el_dpd_1", "500");
    } else if (params.from == "favourites") {
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = params.summary;
        apz.data.loadData("BillPaymentSummary", "bllpay");
        var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
        var amount = paymentDetails[0].amount;
        // for (var i = 0, len = paymentDetails.length; i < len; i++) {}
        // amount += parseInt(.replace(",", ""));
        // amount = paymentDetails.Amount
        $("#bllpay__ViewBillPayment__el_inp_2").val(amount);
        apz.setElmValue("bllpay__ViewBillPayment__amount", amount + ".00");
        apz.setElmValue("bllpay__BillPaymentSummary__o__summary__amount_0", paymentDetails[0].amount);
        apz.setElmValue("bllpay__ViewBillPayment__el_dpd_1", "500");
    } else if (params.from == "favAndDash") {
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = params.summary;
        apz.data.loadData("BillPaymentSummary", "bllpay");
        var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
        var amount = paymentDetails[0].amount;
        // for (var i = 0, len = paymentDetails.length; i < len; i++) {}
        // amount += parseInt(.replace(",", ""));
        // amount = paymentDetails.Amount
        $("#bllpay__ViewBillPayment__el_inp_2").val(amount);
        apz.setElmValue("bllpay__ViewBillPayment__amount", amount + ".00");
        apz.setElmValue("bllpay__BillPaymentSummary__o__summary__amount_0", paymentDetails[0].amount);
        apz.setElmValue("bllpay__ViewBillPayment__el_dpd_1", "500");
    } else if (params.from == "UpcomingPayments") {
        debugger;
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = params.summary;
        apz.data.loadData("BillPaymentSummary", "bllpay");
        var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
        var amount = paymentDetails[0].amount;
        // for (var i = 0, len = paymentDetails.length; i < len; i++) {}
        // amount += parseInt(.replace(",", ""));
        // amount = paymentDetails.Amount
        $("#bllpay__ViewBillPayment__el_inp_2").val(amount);
        apz.setElmValue("bllpay__ViewBillPayment__amount", amount + ".00");
        apz.setElmValue("bllpay__BillPaymentSummary__o__summary__amount_0", paymentDetails[0].amount);
        apz.setElmValue("bllpay__ViewBillPayment__el_dpd_1", "500");
    } else if (params.from == "Search") {
        providername = params.entities.entities[0]["extractedValue"][0];
        if (params.entities.entities[4]["extractedValue"][0] != undefined) {
            amount = params.entities.entities[4]["extractedValue"][0];
            amount = amount + ".00";
            apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary[0].amount = amount;
        } else {
            amount = apz.bllpay.ViewBillPayment.sParams.summary[0].amount;
        }
        apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary = params.summary;
        apz.data.loadData("BillPaymentSummary", "bllpay");
        var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
        $("#bllpay__ViewBillPayment__el_inp_2").val(amount);
        apz.setElmValue("bllpay__ViewBillPayment__amount", amount);
    }
}
//get remarks
apz.bllpay.ViewBillPayment.fnGetRemarks = function(element, targetId) {
    debugger;
    var fieldValue = $(element).val();
    apz.setElmValue("bllpay__ViewBillPayment__" + targetId, fieldValue);
}
//get account number
apz.bllpay.ViewBillPayment.fnGetAccountNumber = function(element) {
    debugger;
    var accountNumber = $(element).val();
    apz.bllpay.accno = accountNumber;
    var elementId = $(element).attr('id');
    var balance = apz.getElmValue(elementId);
    apz.setElmValue("bllpay__ViewBillPayment__avail_bal", apz.formatNumber({
        "value": balance,
        decimalPoints: "2",
        decimalSep: ".",
        mask: "MILLION"
    }));
    apz.setElmValue("bllpay__ViewBillPayment__acc_no", accountNumber);
    
    if (apz.deviceGroup === "Mobile") {
        if(accountNumber == "Select Account no"){
        $("#bllpay__ViewBillPayment__sc_col_7").addClass("sno");
        }
        else{
             $("#bllpay__ViewBillPayment__sc_col_7").removeClass("sno");
        }
    }
    
}
//go to confirmation screen
apz.bllpay.ViewBillPayment.fnGotoConfirmation = function() {
    debugger;
    var result = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
    amount = $("#bllpay__ViewBillPayment__el_inp_2").val();
      apz.setElmValue("bllpay__ViewBillPayment__amount", amount);
    if (apz.bllpay.ViewBillPayment.sParams.from === "multipleBillPay") {
        apz.bllpay.billpayments = result.reduce((temp, item) => {
            obj = {};
            obj["providerName"] = item.ServiceName;
            obj["customerId"] = item.ConsumerPIN;
            obj["amount"] = item.Amount;
            obj["remarks"] = apz.getElmValue("bllpay__ViewBillPayment__el_txa_1");
            obj["accountNumber"] = apz.bllpay.accno;
            temp.push(obj);
            return temp;
        }, [])
    } else {
        apz.bllpay.billpayments = result.reduce((temp, item) => {
            obj = {};
            obj["providerName"] = item.providerName;
            obj["customerId"] = item.subsriberId;
            obj["amount"] =  $("#bllpay__ViewBillPayment__el_inp_2").val();
            obj["remarks"] = apz.getElmValue("bllpay__ViewBillPayment__el_txa_1");
            obj["accountNumber"] = apz.bllpay.accno;
            temp.push(obj);
            return temp;
        }, [])
    }
    $("#bllpay__ViewBillPayment__confirm_form,#bllpay__ViewBillPayment__el_btn_3").removeClass("sno");
    $("#bllpay__ViewBillPayment__payment_form,#bllpay__ViewBillPayment__el_btn_2").addClass("sno");
}
// go to otp screen
apz.bllpay.ViewBillPayment.fnGotoOtp = function() {
    debugger;
    //apz.bllpay.ViewBillPayment.fnBackToPrviousScreen();
    $("#bllpay__ViewBillPayment__confirm_form,#bllpay__ViewBillPayment__el_btn_2,#bllpay__ViewBillPayment__el_btn_3").addClass("sno");
     $("#bllpay__ViewBillPayment__success").removeClass("sno");
}
//from OTP to  summary screen
apz.bllpay.ViewBillPayment.fnBackToPrviousScreen = function() {
    if (apz.bllpay.ViewBillPayment.sParams.from === "favourites") {
        apz.launchApp({
            appId: "favour",
            scr: "FavouriteSummary",
            div: apz.bllpay.ViewBillPayment.sParams.control.exitApp.div,
            userObj: {...apz.bllpay.ViewBillPayment.sParams,
                from: "BillPay"
            }
        })
    } else {
        apz.launchApp({
            appId: "bllpay",
            scr: "BillPaymentSummary",
            div: apz.bllpay.ViewBillPayment.sParams.control.exitApp.div,
            userObj: {...apz.bllpay.ViewBillPayment.sParams
            }
        })
    }
}
//from OTP to same screen
apz.bllpay.ViewBillPayment.fnBackToCurrentApp = function() {
    apz.launchApp({
        appId: "bllpay",
        scr: "ViewBillPayment",
        div: apz.bllpay.ViewBillPayment.sParams.control.exitApp.div,
        userObj: {...apz.bllpay.ViewBillPayment.sParams
        }
    })
}
//back to screen
apz.bllpay.ViewBillPayment.fnBacktoScreen = function() {
    debugger;
    delete apz.bllpay.ViewBillPayment.sParams.summary;
    var playout = "";
    if (apz.deviceGroup === "Mobile") {
        playout= "Mobile";
    }
    
    else{
         playout= "All";
    }
    apz.launchSubScreen({
        appId: "bllpay",
        scr: "BillPaymentSummary",
        div: "ACNR01__Navigator__launchPad",
        layout:playout
    });
}
apz.bllpay.ViewBillPayment.fnSplitBill = function() {
    debugger;
    apz.toggleModal({
                targetId: "bllpay__ViewBillPayment__pu_mdl_1"
            });
    apz.launchApp({
            appId: "blspli",
            scr: "LauncherSplit",
            div: "bllpay__ViewBillPayment__splitmodal",
            userObj: {
                "amount": apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary[0].amount,
                "serviceProvider": apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary[0].providerName,
                "callBack":apz.bllpay.ViewBillPayment.fnPopulateAmount
            }
    })
            
        }
apz.bllpay.ViewBillPayment.fnPopulateAmount = function(amount){
    debugger;
     $("#bllpay__ViewBillPayment__el_inp_2").val(apz.formatNumber({
            "value": amount,
            decimalPoints: "2",
            decimalSep: ".",
            mask: "MILLION"
        }));
        $("#bllpay__ViewBillPayment__el_hpl_1").attr("disabled","disabled");
        $("#bllpay__ViewBillPayment__el_hpl_1").addClass("disabled");
}
