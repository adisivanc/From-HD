apz.crlmch.cardoperation = {};
apz.app.onLoad_CardOperations = function(params) {
    debugger;
 
    apz.crlmch.cardoperation.fnInitialise(params);
};
apz.crlmch.cardoperation.fnInitialise = function(params) {
    debugger;
    apz.crlmch.cardoperation.sParams = params;
    //apz.crlmch.cardoperation.fnCheckStatusDC();
    apz.crlmch.cardoperation.fnGoToStage1();
};

apz.crlmch.cardoperation.fnGoToStage1 = function() {
    debugger;
    apz.crlmch.cardoperation.fnSetValuesStage1();
    //apz.crlmch.cardoperation.fnRenderStage1();
};
apz.crlmch.cardoperation.fnSetValuesStage1 = function() {
    debugger;
    //apz.setElmValue("crlmch__CardOperations__Stage1CardType", apz.crlmch.cardoperation.sParams.action, +"Card");
    apz.setElmValue("crlmch__CardOperations__Stage1CardNo", apz.crlmch.cardoperation.sParams.cardNo);
        apz.setElmValue("crlmch__CardOperations__Stage1NameOnCard",     apz.crlmch.cardoperation.sParams.cardHolderName);
        
        

    var lObj = {
        "decimalSep": apz.decimalSep,
        "thousandSep": apz.thousandSep,
        "value": apz.crlmch.cardoperation.sParams.availableCreditLimit,
        "mask": "MILLION",
        "decimalPoints": 2
    };
    var lAmount = apz.formatNumber(lObj);
     apz.setElmValue("crlmch__CardOperations__Stage1AvlAmt", lAmount);
    
    
    // apz.setElmValue("crlmch__CardOperations__Stage1NameOnCard", apz.crlmch.cardoperation.sParams.data.nameOnCard);
    // var lObj = {
    //     "decimalSep": apz.decimalSep,
    //     "thousandSep": apz.thousandSep,
    //     "value": apz.crlmch.cardoperation.sParams.data.unbilledAmount,
    //     "mask": "MILLION",
    //     "decimalPoints": 2
    // };
    // var lUnbilledAmout = apz.formatNumber(lObj);
    // apz.setElmValue("crlmch__CardOperations__Stage1UnbilledAmt", lUnbilledAmout);
    // var lObj = {
    //     "decimalSep": apz.decimalSep,
    //     "thousandSep": apz.thousandSep,
    //     "value": apz.crlmch.cardoperation.sParams.data.unbilledAmount,
    //     "mask": "LAKH",
    //     "decimalPoints": 2
    // };
    // var lAvlLmtAmt = apz.formatNumber(lObj);
    // apz.setElmValue("crlmch__CardOperations__Stage1AvlLmtAmt", lAvlLmtAmt);
    // apz.setElmValue("crlmch__CardOperations__Stage1AccountNo", apz.crlmch.cardoperation.sParams.data.accountNo);
    // if (apz.crlmch.cardoperation.sParams.action == "Credit Card") {
    //     $(".AvlAmount").addClass("sno");
    //     $(".CreditCard").removeClass("sno");
    // } else {
    //     $(".AvlAmount").removeClass("sno");
    //     $(".CreditCard").addClass("sno");
    // }
    // apz.setElmValue("crlmch__CardOperation__i__CardDtls__cardNumber", apz.crlmch.cardoperation.sParams.data.cardNumber);
    // apz.setElmValue("crlmch__CardOperation__i__CardDtls__action", apz.crlmch.cardoperation.sParams.operation, +"Card");
    // apz.setElmValue("crlmch__CardOperation__i__CardDtls__cardType", apz.crlmch.cardoperation.sParams.action);
    // apz.setElmValue("crlmch__CardOperation__i__CardDtls__customerId", apz.crlmch.cardoperation.sParams.data.customerId);
    // apz.setElmValue("crlmch__CardOperation__i__CardDtls__accountNumber", apz.crlmch.cardoperation.sParams.data.accountNo);
    //apz.setElmValue("crlmch__CardOperations__Stage1AvlLmtAmt", lAvlLmtAmt);
};



apz.crlmch.cardoperation.fnRemoveValue = function(pthis) {
    if (pthis.value != "") {
        if (pthis.id.split("_")[4].slice(0, -1) == "Stage1PIN") {
            var lCurrentStage = parseInt(pthis.id.split("_")[4].slice(9));
            $("#crlmch__CardOperations__Stage1PIN" + lCurrentStage).val('');
        }
        if (pthis.id.split("_")[4].slice(0, -1) == "Stage1ReEnterPIN") {
            var lCurrentStage = parseInt(pthis.id.split("_")[4].slice(16));
            $("#crlmch__CardOperations__Stage1ReEnterPIN" + lCurrentStage).val('');
        }
    }
};
apz.crlmch.cardoperation.fnSetPinStages = function(pthis) {
    debugger;
    if (apz.isNull(apz.val.validateNumberObj(pthis)) === false) {
        $("#" + pthis.id).val("");
    }
    if ((pthis.value != '') && (apz.getElmValue(pthis.id) != '')) {
        var lCurrentStage = parseInt(pthis.id.split("_")[4].slice(9));
        var lSetstage = lCurrentStage + 1;
        $("#crlmch__CardOperations__Stage1PIN" + lSetstage).val('');
        $("#crlmch__CardOperations__Stage1PIN" + lSetstage).focus();
    }
    if (pthis.id.split("_")[4].slice(-1) == 4) {
        var lValue = apz.getElmValue("crlmch__CardOperations__Stage1PIN4");
        lValue = lValue.slice(-1);
        apz.setElmValue("crlmch__CardOperations__Stage1PIN4", lValue);
    }
};
apz.crlmch.cardoperation.fnReEnterSetPinStages = function(pthis) {
    debugger;
    if (apz.isNull(apz.val.validateNumberObj(pthis)) === false) {
        $("#" + pthis.id).val("");
    }
    if (pthis.value != '') {
        var lCurrentStage = parseInt(pthis.id.split("_")[4].slice(16));
        var lSetstage = lCurrentStage + 1;
        $("#crlmch__CardOperations__Stage1ReEnterPIN" + lSetstage).val('');
        $("#crlmch__CardOperations__Stage1ReEnterPIN" + lSetstage).focus();
    }
    if (pthis.id.split("_")[4].slice(-1) == 4) {
        var lValue = apz.getElmValue("crlmch__CardOperations__Stage1ReEnterPIN4");
        lValue = lValue.slice(-1);
        apz.setElmValue("crlmch__CardOperations__Stage1ReEnterPIN4", lValue);
    }
};

apz.crlmch.cardoperation.fnValidatePin = function(pthis) {
    debugger;
    var lNewPinValue = '';
    var lReEnterPinValue = '';
    for (i = 1; i < 5; i++) {
        var lValue = apz.getElmValue("crlmch__CardOperations__Stage1PIN" + i);
        lNewPinValue = lNewPinValue.concat(lValue);
        var lValue = apz.getElmValue("crlmch__CardOperations__Stage1ReEnterPIN" + i);
        lReEnterPinValue = lReEnterPinValue.concat(lValue);
    }
    /* for (i = 1; i < 5; i++) {
        var lValue = apz.getElmValue("crlmch__CardOperations__Stage1ReEnterPIN" + i);
        lReEnterPinValue = lReEnterPinValue.concat(lValue);
    }*/
    if (parseInt(lNewPinValue) != parseInt(lReEnterPinValue)) {
        var lMsg = {
            "message": "Please enter valid PIN"
        };
        apz.dispMsg(lMsg);
        // for (i = 1; i < 5; i++) {
        //     $("#crlmch__CardOperations__Stage1ReEnterPIN" + i).val('');
        //     $("#crlmch__CardOperations__Stage1PIN" + i).val('');
        // }
    }
   
};

apz.crlmch.cardoperation.fnBack = function() {
    debugger;
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

apz.crlmch.cardoperation.fnConfirmStage1 = function(){
    debugger;
    var lValid = apz.crlmch.cardoperation.fnVaidateStage1();
    if (lValid) {
        
        apz.toggleModal({
        "targetId": "crlmch__CardOperations__transactionSuccess"
    });
    }
}




apz.crlmch.cardoperation.fnVaidateStage1 = function() {
    debugger;
    var lValid = false;
   
        var lNewPinValue = '';
        var lReEnterPinValue = '';
        for (i = 1; i < 5; i++) {
            var lValue = apz.getElmValue("crlmch__CardOperations__Stage1PIN" + i);
            lNewPinValue = lNewPinValue.concat(lValue);
            var lValue = apz.getElmValue("crlmch__CardOperations__Stage1ReEnterPIN" + i);
            lReEnterPinValue = lReEnterPinValue.concat(lValue);
        }
        if (lNewPinValue == lReEnterPinValue) {
            lValid = true;
        } else {
            lValid - false;
            var lMsg = {
                "mesage": "Please enter correct PIN"
            }
            apz.dispMsg(lMsg);
        }
    
   
    return lValid;
};

apz.crlmch.cardoperation.fnOnClickOk = function() {
    apz.toggleModal({
        "targetId": "crlmch__CardOperations__transactionSuccess"
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
};