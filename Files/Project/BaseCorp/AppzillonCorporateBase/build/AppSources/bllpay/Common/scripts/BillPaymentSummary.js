apz.bllpay.BillPaymentSummary = {};
apz.bllpay.BillPaymentSummary.sParams = {};
//onload function
apz.app.onLoad_BillPaymentSummary = function(params) {
    debugger;
   
    apz.bllpay.BillPaymentSummary.sParams = params;
    apz.data.loadJsonData("BillPaymentSummary", "bllpay");
     
     if (params.from == "OmniSearch") {
         var lsearchArr = [];
         var lobj = {};
        lobj.providerCategory = params.entities.entities[0]["extractedValue"][0];
       
            lobj.billType = params.entities.entities[1]["extractedValue"][0];
            lobj.fromAcc = params.entities.entities[2]["extractedValue"][0];
            lobj.dueDate = params.entities.entities[3]["extractedValue"][0];
            lobj.amount = params.entities.entities[4]["extractedValue"][0];
            lobj.providerImg = "Airtel.png";
            lsearchArr.push(lobj);
            
 apz.launchSubScreen({
        appId: "bllpay",
        scr: "ViewBillPayment",
        div: "ACNR01__Navigator__launchPad",
        userObj: {
            summary: lsearchArr,
            
            from: "billPayment"
        }
    })

      
//  "providerImg": "4change.png",
//             "providerName": "4Change Energy",
//             "status": "Autopay Scheduled",
//             "dueDate": "05/07/2020",
//             "subsriberId": "3231212",
//             "billType": "Electricity",
//             "providerCategory": "4Change Energy",
//             "amount":"6,000.00"
    
}
}
//onshown function
apz.app.onShown_BillPaymentSummary = function(params) {
    debugger;
    $("#bllpay__BillPaymentSummary__el_inp_4").attr("type","tel");
        $("#bllpay__BillPaymentSummary__el_inp_5").attr("type","tel");
                $("#bllpay__BillPaymentSummary__el_inp_6").attr("type","tel");




    var paymentDetails = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary;
    apz.bllpay.BillPaymentSummary.summaryLength = apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary.length;
    var match = "F"
     var psrvcPrd = params.entities.entities[0].extractedValue[0]
    for (var i = 0, len = paymentDetails.length; i < len; i++) {
        if (paymentDetails[i].billType === "Mobile") {
            $("#bllpay__BillPaymentSummary__mobile_no_label_" + i).removeClass("sno");
            $("#bllpay__BillPaymentSummary__cust_id_label_" + i).addClass("sno");
        }
        if (paymentDetails[i].status === "pending") {
            $("#bllpay__BillPaymentSummary__dueDate_label_" + i).removeClass("sno");
            $("#bllpay__BillPaymentSummary__o__summary__status_" + i).addClass('sno')
        } else if (paymentDetails[i].status === "Autopay Scheduled") {
            $("#bllpay__BillPaymentSummary__o__summary__status_" + i).addClass('suc');
        } else {
            $("#bllpay__BillPaymentSummary__el_cbx_1_" + i + ",#bllpay__BillPaymentSummary__el_btn_2_" + i).attr("disabled", "disabled");
        }
        var servcProvider = apz.getElmValue("bllpay__BillPaymentSummary__o__summary__providerName_" + i)
        if (params.entities.entities[0].extractedValue[0]) {
           
            if (psrvcPrd.toLowerCase() == servcProvider.toLowerCase()) {
                match = "T"
                var cont = i
            }
        }
    }
    if (params.from === "Search") {
        if (match == "T") {
          
            $("#bllpay__BillPaymentSummary__el_btn_2_" + cont).trigger("click");
        } else if(match == "F") {
           // $("#bllpay__BillPaymentSummary__el_btn_2_2").trigger("click");
           apz.bllpay.BillPaymentSummary.sParams.from = "billPayment"
        }
    }
}
//show payment details
apz.bllpay.BillPaymentSummary.fnShowPaymentDetails = function(element) {
    debugger;
    var id = $(element).attr("id");
    if (apz.getElmValue(id) === "y") {
        $("#bllpay__BillPaymentSummary__sc_col_16").removeClass("sno")
    } else {
        $("#bllpay__BillPaymentSummary__sc_col_16").addClass("sno")
    }
}
//get service provider name
apz.bllpay.BillPaymentSummary.fnGetServiceProvider = function(element) {
    debugger;
    var providerType = $(element).val();
    var filePath = apz.getDataFilesPath("bllpay") + "/ListOfProviders.json";
    var content = apz.getFile(filePath);
    var providers = JSON.parse(content);
    for (var i = 0, len = providers.length; i < len; i++) {
        if (providers[i].providerType == providerType) {
             var lObj = document.getElementById("bllpay__BillPaymentSummary__el_dpd_2");
        apz.populateDropdown(lObj,  providers[i].serviceProviders);
           
        }
    }
}
//open add biller form
apz.bllpay.BillPaymentSummary.fnOpenBillerForm = function() {
    debugger;
    $("#bllpay__BillPaymentSummary__addBiller").removeClass("sno");
    $("#bllpay__BillPaymentSummary__gr_row_1").addClass("sno");
    if (apz.deviceGroup === "Mobile") {
        $("#bllpay__BillPaymentSummary__gr_row_1").addClass("sno");
    }
}
//close biller form
apz.bllpay.BillPaymentSummary.fnCloseBillerForm = function() {
    debugger;
    $("#bllpay__BillPaymentSummary__addBiller").addClass("sno");
    $("#bllpay__BillPaymentSummary__gr_row_1").removeClass("sno");
    if (apz.deviceGroup === "Mobile") {
        $("#bllpay__BillPaymentSummary__gr_row_1").removeClass("sno");
    }
}
//save biller form
apz.bllpay.BillPaymentSummary.fnSaveBillerForm = function() {
    apz.dispMsg({
        type: "S",
        message: "Biller details added successfully",
        callBack :apz.bllpay.BillPaymentSummary.fnCloseBillerForm
    });
}
//checkbox multiple payment
apz.bllpay.BillPaymentSummary.fnMultiplePay = function(element) {
    debugger;
    var rowNo = $(element).attr('rowno');
    var id = $(element).attr('id');
    apz.bllpay.paymentSummary = [];
    if (apz.getElmValue(id) === "y") {
        $("#bllpay__BillPaymentSummary__el_icn_1_" + rowNo).removeClass('sno');
        $("#bllpay__BillPaymentSummary__el_btn_2_" + rowNo).addClass('sno');
    } else {
        $("#bllpay__BillPaymentSummary__el_btn_2_" + rowNo).removeClass('sno');
        $("#bllpay__BillPaymentSummary__el_icn_1_" + rowNo).addClass('sno');
    }
    var checked = false;
    for (var i = 0, len = apz.bllpay.BillPaymentSummary.summaryLength; i < len; i++) {
        if (apz.getElmValue("bllpay__BillPaymentSummary__el_cbx_1_" + i) === "y") {
            checked = true;
            apz.bllpay.paymentSummary.push(apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary[i])
        }
    }
    if (checked) {
        if (apz.deviceGroup !== "Mobile") {
            $("#bllpay__BillPaymentSummary__el_hpl_2,#bllpay__BillPaymentSummary__el_hpl_1").addClass("sno");
            $("#bllpay__BillPaymentSummary__common_pay").removeClass("sno");
        } else {
            $("#bllpay__BillPaymentSummary__ct_nav_3").removeClass("sno");
        }
    } else {
        if (apz.deviceGroup !== "Mobile") {
            $("#bllpay__BillPaymentSummary__el_hpl_2,#bllpay__BillPaymentSummary__el_hpl_1").removeClass("sno");
            $("#bllpay__BillPaymentSummary__common_pay").addClass("sno");
        } else {
            $("#bllpay__BillPaymentSummary__ct_nav_3").addClass("sno");
        }
    }
}
//open onetime biller page
apz.bllpay.BillPaymentSummary.fnOpenOnetimeBiller = function() {
    debugger;
     apz.launchSubScreen({
        appId: "bllpay",
        scr: "ViewOneTimeBillPaymeny",
        div: "ACNR01__Navigator__launchPad",
        layout:"All"
        
    });
}
//open payment screen
apz.bllpay.BillPaymentSummary.fnOpenPaymentScreen = function(paymentAction, element) {
    debugger;
    if (apz.bllpay.BillPaymentSummary.sParams.from == "Search") {
        var fromScr = "Search"
    } else {
        var fromScr = "billPayment"
    }
    var paymentSummary = [];
    if (paymentAction == "single") {
        var rowNo = $(element).attr("rowno");
        paymentSummary.push(apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary[rowNo]);
    } else if (paymentAction == 'ocrService') {
        paymentSummary = element;
    } else {
        paymentSummary = apz.bllpay.paymentSummary;
    }
    apz.launchSubScreen({
        appId: "bllpay",
        scr: "ViewBillPayment",
        div: "ACNR01__Navigator__launchPad",
        userObj: {
            summary: paymentSummary,
            ...apz.bllpay.BillPaymentSummary.sParams,
            from: fromScr
        }
    })
}
apz.bllpay.BillPaymentSummary.fnlaunchScreen = function(fromScr,paymentSummary){
    debugger;
        

    apz.launchSubScreen({
        appId: "bllpay",
        scr: "ViewBillPayment",
        div: "ACNR01__Navigator__launchPad",
        userObj: {
            summary: paymentSummary,
            ...apz.bllpay.BillPaymentSummary.sParams,
            from: fromScr
        }
    })
}
//show billing menu
apz.bllpay.BillPaymentSummary.fnShowBillMenu = function() {
    debugger;
    if (!$("#bllpay__BillPaymentSummary__ct_nav_2").hasClass("sno")) {
        $("#bllpay__BillPaymentSummary__ct_nav_2").addClass("sno");
    } else {
        $("#bllpay__BillPaymentSummary__ct_nav_2").removeClass("sno");
    }
    $("#bllpay__BillPaymentSummary__ct_nav_3").addClass("sno");
}
$(document).on("click", function(e) {
    if (!$(e.target).is("#bllpay__BillPaymentSummary__el_icn_2,#btn_icon_icon-plus") && !$("#bllpay__BillPaymentSummary__ct_nav_2").hasClass(
        "sno")) {
        $("#bllpay__BillPaymentSummary__ct_nav_2").addClass("sno");
    }
})
apz.bllpay.BillPaymentSummary.fnReadCamera = function() {
    debugger;
    const jsonobj = {
        "zoomLevel": "20",
        "targetWidth": "200",
        "targetHeight": "200",
        "crop": "Y",
        "flash": "N",
        "action": "base64",
        "fileName": "Sample",
        "quality": "90",
        "encodingType": "JPG",
        "sourceType": "camera", // photo,
        "id": "CAMERA_ID",
        "callBack": apz.bllpay.BillPaymentSummary.fnReadCameraCB
    };
    if (apz.deviceType != 'SIMULATOR') {
        apz.mockServer = false;
        apz.ns.openCamera(jsonobj);
    }
}
apz.bllpay.BillPaymentSummary.fnReadCameraCB = function(params) {
    debugger;
    if (params.status) {
        $.ajax({
            "url": "http://13.67.51.88:8216/ocrextraction",
            "dataType": "json",
            "method": "POST",
            "data": JSON.stringify({
                base64string: params.encodedImage
            }),
            error: function(error) {
                apz.stopLoader()
                apz.dispMsg({
                    message: "OCR service is down."
                })
            },
            beforeSend: function() {
                apz.startLoader();
            },
            success: apz.bllpay.BillPaymentSummary.getOCRServiceDataCB
        });
    }
}
apz.bllpay.BillPaymentSummary.getOCRServiceDataCB = function(params) {
    debugger;
    apz.stopLoader();
    if (!params.extractedValues) {
        apz.dispMsg({
            message: params.statusText || 'BillType Not Supported.'
        })
        return;
    }
    const response = params.extractedValues;
    apz.bllpay.BillPaymentSummary.fnOpenPaymentScreen('ocrService', [{
        providerName: response.operator_name,
        subsriberId: response.mobile_number,
        relationshipNumber: response.relationship_number,
        billDate: response.bill_date,
        billPeriod: response.bill_period,
        providerCategory: response.name,
        amount: response.amount || "0",
        providerImg: response.operator_name + ".png"
    }])
}
