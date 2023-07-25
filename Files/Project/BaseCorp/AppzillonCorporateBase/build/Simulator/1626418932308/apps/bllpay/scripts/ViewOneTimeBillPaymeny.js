apz.bllpay.ViewOneTimeBillPaymeny = {};
apz.bllpay.ViewOneTimeBillPaymeny.sCache = null;
var fromSearch = "F"
//onload function
apz.app.onLoad_ViewOneTimeBillPaymeny = function(params) {
debugger;
 
}


apz.app.onShown_ViewOneTimeBillPaymeny = function(params) {
    debugger;
    $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2").attr("type","tel");


    apz.bllpay.ViewOneTimeBillPaymeny.sCache = params
  

    var filePath = apz.getDataFilesPath("bllpay") + "/ListOfProviders.json";
    var content = apz.getFile(filePath);
    var providers = JSON.parse(content);
    apz.data.scrdata.bllpay__ServiceProviders_Res = {};
    apz.data.scrdata.bllpay__ServiceProviders_Res.listOfServices = providers;
    apz.data.loadData("ServiceProviders", "bllpay");
   
    if (apz.deviceGroup == "Mobile") {
        $("#bllpay__ViewOneTimeBillPaymeny__gr_col_2").addClass('sno');
         $("#bllpay__ViewOneTimeBillPaymeny__el_btn_5").removeClass('sno');
    } else {
        if (params.data.from !== undefined) {
            for (var i = 0, len = providers.length; i < len; i++) {
                if (providers[i].providerType === params.data.paymentName) {
                    $("#bllpay__ServiceProviders__o__listOfServices__providerType_" + i).trigger("click");
                }
            }
        } else {
            $("#bllpay__ServiceProviders__o__listOfServices__providerType_0").trigger("click");
        }
    }
    if(params.from == "creditcard"){
        
        apz.bllpay.ViewOneTimeBillPaymeny.fnOpenPaymentForm( $("#bllpay__ServiceProviders__o__listOfServices__icon_3"));
       apz.bllpay.ViewOneTimeBillPaymeny.populateValues();
       apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_inp_1","100009312263")
        
    }
    if (params.from === "Search") {
        fromSearch = "T"
        apz.bllpay.ViewOneTimeBillPaymeny.fnOpenPaymentForm();
    }
     if( apz.bllpay.ViewOneTimeBillPaymeny.sCache.from == "Dashboard")
{
    apz.bllpay.ViewOneTimeBillPaymeny.fnDashboard();
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_inp_1","100009312263")
}
}
apz.bllpay.ViewOneTimeBillPaymeny.populateValues = function(){
    debugger;
      details = apz.bllpay.ViewOneTimeBillPaymeny.sCache.data.details;
    $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2").val(details.number);
    $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val(details.amount);
    
}
//launch otp app
apz.bllpay.ViewOneTimeBillPaymeny.fnLaunchOtp = function() {
    var lLaunchParams = {
        "appId": "otpeng",
        "scr": "PaymentOTP",
        "div": "bllpay__Launcher__launcher",
        "userObj": {
            "action": "SetRefNo",
            "data": {
                "OTPRefNo": +new Date(),
                "billpayments": apz.bllpay.billpayments
            },
            "back": apz.bllpay.ViewOneTimeBillPaymeny.fnViewPaymentDetails,
            "control": {
                "appId": "otpeng",
                "callBack": apz.bllpay.ViewOneTimeBillPaymeny.fnBackToPaymentForm,
                "destroyDiv": "bllpay__BillPay__Launcher"
            }
        }
    };
    apz.launchApp(lLaunchParams);
}
//open according service form
apz.bllpay.ViewOneTimeBillPaymeny.fnOpenPaymentForm = function(element) {
    debugger
$("#bllpay__ViewOneTimeBillPaymeny__ct_lst_1 > ul >li").removeClass("current")
    $(element).parents("li").addClass("current")
    var rowNo = $(element).attr("rowno");
    var services = apz.data.scrdata.bllpay__ServiceProviders_Res.listOfServices;
    apz.populateDropdown($("#bllpay__ViewOneTimeBillPaymeny__el_dpd_1")[0], services[rowNo].serviceProviders);
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__payment_title", services[rowNo].providerType + " Payment");
    apz.bllpay.ViewOneTimeBillPaymeny.providerType = services[rowNo].providerType;
    
    if (services[rowNo].providerType !== "Mobile" && services[rowNo].providerType !== "Credit Card") {
        $("#bllpay__ViewOneTimeBillPaymeny__mobile_method").addClass("sno");
        $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2_grp_lbl").text("Subscriber Id")
    } else if (services[rowNo].providerType == "Credit Card") {
        $("#bllpay__ViewOneTimeBillPaymeny__mobile_method").addClass("sno");
        $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2_grp_lbl").text("Credit Card Number")
    } else {
        $("#bllpay__ViewOneTimeBillPaymeny__mobile_method").removeClass("sno")
        $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2_grp_lbl").text("Mobile Number")
    }
    
    if (services[rowNo].providerType !== "Mobile" ) {
    $("#bllpay__ViewOneTimeBillPaymeny__planListLink").addClass("sno");
        
    }
    
    else if (services[rowNo].providerType == "Mobile" ) {
    $("#bllpay__ViewOneTimeBillPaymeny__planListLink").removeClass("sno");
        
    }
    
    apz.bllpay.ViewOneTimeBillPaymeny.fnBackToPaymentForm("initialTime");
    
    $("#bllpay__ViewOneTimeBillPaymeny__otp_Screen").addClass('sno');
    $("#bllpay__ViewOneTimeBillPaymeny__successrow").addClass('sno');
    
    if(apz.deviceGroup == "Mobile"){
         $("#bllpay__ViewOneTimeBillPaymeny__gr_col_2").removeClass('sno');
        $("#bllpay__ViewOneTimeBillPaymeny__gr_col_1").addClass('sno');
    }
}
//view payment details
apz.bllpay.ViewOneTimeBillPaymeny.fnViewPaymentDetails = function() {
    debugger;
    $(
        "#bllpay__ViewOneTimeBillPaymeny__el_btn_3,#bllpay__ViewOneTimeBillPaymeny__el_btn_4,#bllpay__ViewOneTimeBillPaymeny__deatils_form,#bllpay__ViewOneTimeBillPaymeny__payment_screen"
    ).removeClass("sno");
    $(
        "#bllpay__ViewOneTimeBillPaymeny__payment_form,#bllpay__ViewOneTimeBillPaymeny__el_btn_2,#bllpay__ViewOneTimeBillPaymeny__otp_Screen,#bllpay__ViewOneTimeBillPaymeny__el_btn_5"
    ).addClass('sno');
    if (apz.bllpay.ViewOneTimeBillPaymeny.providerType !== "Mobile") {
        $("#bllpay__ViewOneTimeBillPaymeny__mobile_service").addClass("sno")
    }
    var obj ={};
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_5", $("#bllpay__ViewOneTimeBillPaymeny__el_dpd_1").val());
    obj["providerName"] = $("#bllpay__ViewOneTimeBillPaymeny__el_dpd_1").val();
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_6", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_1").val());
    obj["accountNumber"] =  $("#bllpay__ViewOneTimeBillPaymeny__el_inp_1").val();
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_4", (apz.getElmValue("bllpay__ViewOneTimeBillPaymeny__el_tgl_1") === "on") ? "Prepaid" :
        "Postpaid");
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_10", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2").val());
     obj["customerId"] = $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2").val();
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_11", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val());
    obj["amount"] = $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val();
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_12", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_4").val());
    obj["remarks"] = $("#bllpay__ViewOneTimeBillPaymeny__el_inp_4").val();
    apz.bllpay.billpayments = [];
    apz.bllpay.billpayments.push(obj);
}
//back to payment form screen
apz.bllpay.ViewOneTimeBillPaymeny.fnBackToPaymentForm = function(from) {
    $(
        "#bllpay__ViewOneTimeBillPaymeny__el_btn_3,#bllpay__ViewOneTimeBillPaymeny__el_btn_4,#bllpay__ViewOneTimeBillPaymeny__deatils_form,#bllpay__ViewOneTimeBillPaymeny__otp_Screen"
    ).addClass("sno");
    $(
        "#bllpay__ViewOneTimeBillPaymeny__payment_form,#bllpay__ViewOneTimeBillPaymeny__el_btn_2,#bllpay__ViewOneTimeBillPaymeny__payment_screen,#bllpay__ViewOneTimeBillPaymeny__gr_col_2"
    ).removeClass('sno');
    $(
        "#bllpay__ViewOneTimeBillPaymeny__el_inp_1,#bllpay__ViewOneTimeBillPaymeny__el_inp_2,#bllpay__ViewOneTimeBillPaymeny__el_inp_3,#bllpay__ViewOneTimeBillPaymeny__el_inp_4"
    ).val("");
    if (apz.deviceType !== "SIMULATOR" && apz.deviceType !== "WEB") {
        if (from !== undefined) {
            $("#bllpay__ViewOneTimeBillPaymeny__gr_col_1").addClass('sno');
            $("#bllpay__ViewOneTimeBillPaymeny__el_btn_5").removeClass('sno');
        } else {
            $("#bllpay__ViewOneTimeBillPaymeny__gr_col_1").removeClass('sno');
            $("#bllpay__ViewOneTimeBillPaymeny__gr_col_2").addClass('sno');
        }
    }
}
//go to otp page
apz.bllpay.ViewOneTimeBillPaymeny.fnGoToOTP = function() {
    //apz.bllpay.ViewOneTimeBillPaymeny.fnLaunchOtp();
    $("#bllpay__ViewOneTimeBillPaymeny__payment_screen").addClass("sno");
    $("#bllpay__ViewOneTimeBillPaymeny__otp_Screen").removeClass('sno');
    $("#bllpay__ViewOneTimeBillPaymeny__successrow").removeClass('sno');
    
    
     apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__inpacctno", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_1").val());
   
     apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__inpservicervider", $("#bllpay__ViewOneTimeBillPaymeny__el_dpd_1").val());
    
     apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__inpsubid", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2").val());
     apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__inpamt", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val());
   
     apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__inpmobile", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_2").val());
    
    
}
//for mobile back to menu
apz.bllpay.ViewOneTimeBillPaymeny.fnBackToMenu = function() {
    if(    apz.bllpay.ViewOneTimeBillPaymeny.sCache.from == "creditcard")
    {
        apz.launchApp({
            "scr": "Home",
            "div": "landin__Landing__launcher",
            "appId": "moblan",
            "userObj": {
              
                "control": {
                    "exitApp": {
                        "appId": "",
                        "div": "landin__Landing__launcher",
                        "callBack": ""
                    }
                }
            }
    })
    }
    else
    {
    $("#bllpay__ViewOneTimeBillPaymeny__gr_col_2").addClass('sno');
    $("#bllpay__ViewOneTimeBillPaymeny__gr_col_1").removeClass('sno');
    }
}



apz.bllpay.ViewOneTimeBillPaymeny.fnDashboard = function() {
    var rowElementNo;
    if( apz.bllpay.ViewOneTimeBillPaymeny.sCache.data.customerID.from == "dashboard")
    {
        if(apz.bllpay.ViewOneTimeBillPaymeny.sCache.data.customerID.paymentName == "Mobile")
        {
            rowElementNo= 0;
        }
        else if(apz.bllpay.ViewOneTimeBillPaymeny.sCache.data.customerID.paymentName == "Electricity")
        {
            rowElementNo = 2;
        }
        else if(apz.bllpay.ViewOneTimeBillPaymeny.sCache.data.customerID.paymentName == "Gas")
                {
                    rowElementNo = 4;
                }
                else
                {
                    rowElementNo = 8;
                }
              $("#bllpay__ViewOneTimeBillPaymeny__ct_lst_1 > ul >li").eq(rowElementNo).find("svg").trigger("click")  

    }
}




apz.bllpay.ViewOneTimeBillPaymeny.fnSplitBill = function() {
    debugger;
    var obj ={};
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_5", $("#bllpay__ViewOneTimeBillPaymeny__el_dpd_1").val());
    obj["providerName"] = $("#bllpay__ViewOneTimeBillPaymeny__el_dpd_1").val();
   
    apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_txt_11", $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val());
    obj["amount"] = $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val();
   
    apz.bllpay.billpayments = [];
    apz.bllpay.billpayments.push(obj);
    apz.toggleModal({
                targetId: "bllpay__ViewOneTimeBillPaymeny__pu_mdl_1"
            });
    apz.launchApp({
            appId: "blspli",
            scr: "LauncherSplit",
            div: "bllpay__ViewOneTimeBillPaymeny__splitmodalonetime",
            userObj: {
                "amount":   apz.bllpay.billpayments[0].amount,
                "serviceProvider":   apz.bllpay.billpayments[0].providerName,
                "callBack":apz.bllpay.ViewOneTimeBillPaymeny.fnPopulateAmount
            }
    })
            
        }
        
        
        
        
        
        
        
        
        apz.bllpay.ViewOneTimeBillPaymeny.fnPopulateAmount = function(amount){
    debugger;
     $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val(apz.formatNumber({
            "value": amount,
            decimalPoints: "2",
            decimalSep: ".",
            mask: "MILLION"
        }));
        $("#bllpay__ViewOneTimeBillPaymeny__el_hpl_1").attr("disabled","disabled");
        $("#bllpay__ViewOneTimeBillPaymeny__el_hpl_1").addClass("disabled");
}


apz.bllpay.ViewOneTimeBillPaymeny.fnBack = function(){
    debugger;
}

apz.bllpay.ViewOneTimeBillPaymeny.fnOpenPlanModal = function(){
    debugger;
    
    apz.toggleModal({
                targetId: "bllpay__ViewOneTimeBillPaymeny__planModal"
            });
    
    apz.bllpay.ViewOneTimeBillPaymeny.fnShowPlanList("topup");
}

apz.bllpay.ViewOneTimeBillPaymeny.fnShowPlanList= function(pType){
    debugger;
    $("#bllpay__ViewOneTimeBillPaymeny__ct_nav_6 :button").removeClass("current");
    $("#bllpay__ViewOneTimeBillPaymeny__btn"+pType).addClass("current");
    apz.data.loadJsonData("PlanList", "bllpay");
    apz.bllpay.ViewOneTimeBillPaymeny.sPlanList = apz.data.scrdata.bllpay__PlanList_Res[pType];
    apz.data.scrdata.bllpay__PlanList_Res.result = apz.bllpay.ViewOneTimeBillPaymeny.sPlanList;
    apz.data.loadData("PlanList","bllpay");
}

apz.bllpay.ViewOneTimeBillPaymeny.fnSelectPlan = function(pthis){
    debugger;
    
    var lrow = $(pthis).attr("rowno");
    var lamount = apz.data.scrdata.bllpay__PlanList_Res.result[lrow].amount;
    
     $("#bllpay__ViewOneTimeBillPaymeny__el_inp_3").val(apz.formatNumber({
            "value": lamount,
            decimalPoints: "2",
            decimalSep: ".",
            mask: "MILLION"
        }));
    
    //apz.setElmValue("bllpay__ViewOneTimeBillPaymeny__el_inp_3",lamount);
     apz.toggleModal({
                targetId: "bllpay__ViewOneTimeBillPaymeny__planModal"
            });
}

apz.bllpay.ViewOneTimeBillPaymeny.fnToggleChange = function(){
    debugger;
    
    if(apz.getElmValue("bllpay__ViewOneTimeBillPaymeny__el_tgl_1") === "on"){
         $("#bllpay__ViewOneTimeBillPaymeny__planListLink").removeClass("sno");
    }
    else{
        $("#bllpay__ViewOneTimeBillPaymeny__planListLink").addClass("sno");
    
}
}
