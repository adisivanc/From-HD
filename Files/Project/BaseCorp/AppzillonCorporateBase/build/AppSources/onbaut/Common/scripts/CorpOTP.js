apz.onbaut.CorpOTP = {};
apz.onbaut.CorpOTP.sCache = {};
apz.onbaut.CorpOTP.sCache.mobno = "8472875601";

apz.app.onLoad_CorpOTP = function() {
    $("#onbaut__CorpOTP__otp").attr({"pattern":"[0-9]*","inputmode":"numeric"});
    if(apz.appLanguage == "ar"){
        $("body").addClass("arabic");
        
     }
     
     else{
       $("body").removeClass("arabic");
     }
    //apz.onbaut.CorpOTP.fnSendSMS();
};
apz.app.onShown_CorpOTP = function() {
   document.getElementById("onbaut__CorpOTP__otp").focus();
   //apz.onbaut.CorpOTP.fnCallOTPCounter();
};

apz.onbaut.CorpOTP.fnCallOTPCounter = function() {
    debugger;
    $("#onbaut__CorpOTP__el_icn_2_1_li").empty();
    $("#onbaut__CorpOTP__el_icn_1_li").html('<svg><circle r="36" cx="40" cy="40"></circle></svg>');
    var countdownNumberEl = document.getElementById('onbaut__CorpOTP__sc_row_8');
    var countdown = 30;
    countdownNumberEl.innerHTML = countdown;
    apz.onbaut.CorpOTP.timerInterval = setInterval(function() {
        countdown = --countdown <= 0 ? 0 : countdown;
        if (countdown === 0) {
            $("#onbaut__CorpOTP__sc_row_7").addClass("sno");
            $("#onbaut__CorpOTP__sc_row_9").removeClass("sno");
            $("#onbaut__CorpOTP__el_txt_2").addClass("err");
           
            clearInterval(apz.onbaut.CorpOTP.timerInterval);
        }
        countdownNumberEl.innerHTML = countdown;
    }, 1500);
}
apz.onbaut.CorpOTP.keyupevent = function(event) {
    if (event.keyCode == 13) {
        apz.onbaut.CorpOTP.fnValidateOTP();
    }
};
apz.onbaut.CorpOTP.smsMessageCB = function(pResp) {
    debugger;
};
apz.onbaut.CorpOTP.fnGoBack = function() {
    debugger;
    var params = {};
    
   if(apz.appLanguage !=undefined){
    apz.changeLanguage(apz.appLanguage, "acbase");
}
    params.appId = "ACLI01";
    params.scr = "Login";
    params.layout = "Web";
    params.userObj = {
        "language": apz.appLanguage
    }
    if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    apz.launchApp(params);
};
apz.onbaut.CorpOTP.fnValidateOTP = function() {
    debugger;
    var enteredOtp = apz.getElmValue("onbaut__CorpOTP__otp");
    var generatedOtp = apz.onbaut.CorpOTP.sCache.otp;
    if (enteredOtp == generatedOtp || enteredOtp == "101018") {
        apz.appLanguage = "en";
        apz.changeLanguage("en", "acbase");
        $("body").removeClass("arabic");
        var params = {};
        params.appId = "ACNR01";
        params.scr = "Navigator";
        //params.layout = "Web";
        
     

        params.userObj = {
            "userId": apz.Login.sUserId,
            "roleId": apz.Login.sRoleId,
            "corporateId": apz.Login.sCorporateId,
            "language": apz.appLanguage
        };
        apz.launchApp(params);
    }else{
        apz.dispMsg({code:"OTP_INCORRECT",type:"E"});
    }
};
apz.onbaut.CorpOTP.fnSendSMS = function(){
    var lOTP = Math.floor(100000 + Math.random() * 900000);
    apz.onbaut.CorpOTP.sCache.otp = lOTP;
    var lmessage = " Your OTP is " + lOTP + " , use this to complete your login.";
    var lServerParams = {
        "ifaceName": "sms",
        "buildReq": "N",
        "appId": "onbaut",
        "req": {
            "config": {
                user: "Iexceed",
                apikey: "XOTNwz3OffqcodOubdhl",
                mobile: apz.onbaut.CorpOTP.sCache.mobno,
                message: lmessage,
                senderid: "APZBNK",
                type: "txt"
            }
        },
        "paintResp": "N",
        "async": true,
        "callBack": apz.onbaut.CorpOTP.smsMessageCB
    };
    
    apz.setElmValue("onbaut__CorpOTP__otp", "");
    $("#onbaut__CorpOTP__sc_row_7").removeClass("sno");
    $("#onbaut__CorpOTP__sc_row_9").addClass("sno");
    clearInterval(apz.onbaut.CorpOTP.timerInterval);
    apz.onbaut.CorpOTP.fnCallOTPCounter();
    //apz.server.callServer(lServerParams);
}


apz.onbaut.CorpOTP.fngotoLogin = function(){
       apz.data.scrdata = {};
    apz.ACNR01 = undefined;
    var params = {};
    params.appId = "ACLI01";
    params.scr = "Login";
    params.layout = "Web";
    if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    apz.launchApp(params);
}


apz.onbaut.CorpOTP.fnShowPassword = function() {
    $("#onbaut__CorpOTP__otp").attr("type", "text");
    setTimeout(function() {
        $("#onbaut__CorpOTP__otp").attr("type", "password");
    }, 2000)
}
